output "project_name" {
  value = var.project_name
}

output "application_name" {
  value = var.application_name
}

output "deploy_branch" {
  value = var.application_deploy_branch
}

output "database_public_ip" {
  value = google_sql_database_instance.database.public_ip_address
}

output "database_connection_name" {
  value = google_sql_database_instance.database.connection_name
}

output "build_trigger_id" {
  value = google_cloudbuild_trigger.backend.trigger_id
}

output "cloud_run_url" {
  value = one(google_cloud_run_service.backend.status[*].url)
}
