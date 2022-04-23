data "google_iam_policy" "public_access" {
  binding {
    role    = "roles/run.invoker"
    members = ["allUsers"]
  }
}

resource "google_cloud_run_service_iam_policy" "public_access" {
  location = var.cloud_region
  project  = var.project_name
  service  = google_cloud_run_service.backend.name

  policy_data = data.google_iam_policy.public_access.policy_data
}

resource "google_cloud_run_service" "backend" {
  name     = var.application_name
  location = var.cloud_region

  template {
    spec {
      containers {
        # This image is only for initial deployment, before the application image
        # is built and pushed to the registry. The real URL is:
        # "eu.gcr.io/${var.project_name}/${var.application_name}/backend:$COMMIT"
        image = "us-docker.pkg.dev/cloudrun/container/hello"
        ports {
          container_port = 8080
        }
        env {
          name = "DB_HOST"
          value = "/cloudsql/${google_sql_database_instance.database.connection_name}"
        }
        env {
          name = "DB_USER"
          value = "postgres"
        }
        env {
          name = "DB_PASSWORD"
          value = var.database_password
        }
        env {
          name = "DB_DBNAME"
          value = "mistoveskole"
        }
        env {
          name = "DB_VERSION"
          value = "13"
        }
      }
    }

    metadata {
      annotations = {
        "autoscaling.knative.dev/maxScale"      = "100"
        "run.googleapis.com/cloudsql-instances" = google_sql_database_instance.database.connection_name
        "run.googleapis.com/client-name"        = "terraform"
      }
    }
  }

  autogenerate_revision_name = true
}

# resource "google_cloud_run_domain_mapping" "app" {
#   location = var.cloud_region
#   name     = "admin.mistoveskole.cz"

#   metadata { namespace = "admin.mistoveskole.cz" }

#   spec { route_name = google_cloud_run_service.backend.name }
# }
