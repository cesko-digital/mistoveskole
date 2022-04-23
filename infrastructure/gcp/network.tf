resource "google_compute_network" "default" {
  name                    = "default"
  description             = "Default network"
  auto_create_subnetworks = false
}

resource "google_compute_subnetwork" "default" {
  name          = "default"
  ip_cidr_range = "10.0.0.0/22"
  region        = var.cloud_region
  network       = google_compute_network.default.self_link
}

resource "google_compute_firewall" "allow-ssh" {
  name        = "${google_compute_network.default.name}-allow-ssh"
  description = "Allow SSH from external"
  network     = google_compute_network.default.self_link

  allow {
    protocol = "tcp"
    ports    = ["22"]
  }

  source_ranges = ["0.0.0.0/0"]
  target_tags   = ["allow-ssh"]
}

resource "google_compute_firewall" "allow-https" {
  name        = "${google_compute_network.default.name}-allow-https"
  description = "Allow HTTPS from external"
  network     = google_compute_network.default.self_link

  allow {
    protocol = "tcp"
    ports    = ["443"]
  }

  source_ranges = ["0.0.0.0/0"]
  target_tags   = ["allow-https"]
}

resource "google_compute_firewall" "allow-internal" {
  allow {
    protocol = "tcp"
    ports    = ["0-65535"]
  }

  allow {
    protocol = "udp"
    ports    = ["0-65535"]
  }

  allow {
    protocol = "icmp"
  }

  description   = "Allow internal traffic"
  direction     = "INGRESS"
  name          = "allow-internal"
  network       = google_compute_network.default.self_link
  source_ranges = ["10.0.0.0/22"]
}
