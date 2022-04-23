resource "google_sql_database_instance" "database" {
  name                = "mistoveskole-db"
  region              = var.cloud_region
  database_version    = "POSTGRES_13"
  deletion_protection = false

  settings {
    tier = var.database_instance_type

    activation_policy = "ALWAYS"
    availability_type = "ZONAL"

    backup_configuration {
      backup_retention_settings {
        retained_backups = 7
        retention_unit   = "COUNT"
      }

      enabled                        = true
      location                       = "eu"
      point_in_time_recovery_enabled = true
      transaction_log_retention_days = 7
    }

    disk_autoresize       = true
    disk_autoresize_limit = 0
    disk_size             = 20
    disk_type             = "PD_SSD"

    ip_configuration {
      ipv4_enabled    = true
    }

    insights_config {
      query_insights_enabled = true
      query_string_length    = 1024
    }
  }
}
