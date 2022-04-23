# resource "google_storage_bucket" "artifacts" {
#   location                 = "EU"
#   name                     = "eu.artifacts.mistoveskole.appspot.com"
#   project                  = var.project_name
#   public_access_prevention = "inherited"
#   storage_class            = "STANDARD"
# }

resource "google_container_registry" "container_registry" {
  project  = var.project_name
  location = "EU"
}

# NOTE: You need to connect Cloud Build to the Github first,
#       https://cloud.google.com/build/docs/automating-builds/build-repos-from-github#installing_gcb_app.

resource "google_cloudbuild_trigger" "backend" {
  name = "backend"

  github {
    owner = "cesko-digital"
    name  = "mistoveskole"

    push {
      branch = var.application_deploy_branch
    }
  }

  build {
    step {
      id   = "Build"
      name = "gcr.io/cloud-builders/docker"
      args = ["build", "--no-cache", "-t", "$_GCR_BASE_PATH:$SHORT_SHA", "backend", "-f", "backend/Dockerfile"]
    }

    step {
      id   = "Push Commit"
      name = "gcr.io/cloud-builders/docker"
      args = ["push", "$_GCR_BASE_PATH:$SHORT_SHA"]
    }

    step {
      id         = "Deploy"
      name       = "gcr.io/google.com/cloudsdktool/cloud-sdk:slim"
      entrypoint = "gcloud"
      args       = ["run", "services", "update", "$_SERVICE_NAME", "--platform=managed", "--image=$_GCR_BASE_PATH:$SHORT_SHA", "--region=${var.cloud_region}", "--quiet"]
    }

    timeout = "1200s"
  }

  substitutions = {
    _GCR_BASE_PATH = "eu.gcr.io/${var.project_name}/${var.application_name}/backend"
    _SERVICE_NAME  = google_cloud_run_service.backend.name
  }
}
