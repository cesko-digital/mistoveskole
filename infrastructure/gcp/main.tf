terraform {
  required_version = ">= 1.1"

  backend "gcs" {
    bucket = "cesko-digital-terraform-mistoveskole-tf-3"
    prefix = "tf-state"
  }
}

provider "google" {
  project = var.project_name
  region  = var.cloud_region
}
