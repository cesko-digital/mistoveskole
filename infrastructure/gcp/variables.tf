variable "project_name" {
  description = "The ID of the project"
  default     = "mistoveskole-tf-3"
}

variable "application_name" {
  description = "Name of the application - must be unique in region"
  default     = "mistoveskole-v3"
}

variable "application_deploy_branch" {
  description = "GitHub branch to deploy"
  default     = "deployment"
}

variable "database_name" {
  description = "Name of the database"
  default     = "mistoveskole"
}

variable "cloud_region" {
  description = "The GCP region where to create resources"
  default     = "europe-west1"
}

variable "database_instance_type" {
  description = "Type of the Cloud SQL instance"
  default     = "db-f1-micro"
}

variable "database_password" {
  type        = string
  description = "Main password for database"
  nullable    = false
  sensitive   = true

  validation {
    condition     = length(var.database_password) >= 30
    error_message = "The password must be at least 30 character long."
  }
}
