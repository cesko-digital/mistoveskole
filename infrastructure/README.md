# Infrastructure

This folder contains code and resources to create infrastructure for the project
in [Google Cloud Platform (GCP)](https://cloud.google.com) with
[_Terraform_](https://www.terraform.io).

The code expects a project in GCP, *with billing enabled*.

Navigate to the `gcp` folder:

```
cd gcp/
```

Export the environment variables with information about the project and the application.

```
export PROJECT_ID=mistoveskole-tf-3
export USER_EMAIL=your.email@cesko.digital
export SERVICE_ACCOUNT_NAME=terraform-3
export DATABASE_PASSWORD=ABC123XXXXXXXXXXXXXXXXXXXXXXXX
```

Then, configure the [`gcloud`](https://cloud.google.com/sdk/gcloud)
utility to use the project:

```
gcloud config set project $PROJECT_ID
```

Enable the required services:

```
gcloud services enable \
  compute.googleapis.com \
  containerregistry.googleapis.com \
  cloudbilling.googleapis.com \
  cloudbuild.googleapis.com \
  cloudresourcemanager.googleapis.com \
  iam.googleapis.com \
  logging.googleapis.com \
  run.googleapis.com \
  servicenetworking.googleapis.com \
  sql-component.googleapis.com \
  sqladmin.googleapis.com \
  storage.googleapis.com \
  vpcaccess.googleapis.com
```

**Important**: Connect the Github repository to Cloud Build via the web console, following the [documentation](https://cloud.google.com/build/docs/automating-builds/build-repos-from-github).

Next, get the number of the project:

```
gcloud projects describe $PROJECT_ID
> ...
> projectId: $PROJECT_ID
> projectNumber: '123456789'

export PROJECT_NUMBER=123456789
```

Then, add permissions for Cloud Build to access Cloud Run:

```
gcloud projects add-iam-policy-binding $PROJECT_ID \
    --member="serviceAccount:$PROJECT_NUMBER@cloudbuild.gserviceaccount.com" \
    --role="roles/run.admin"
```

Add permissions for Cloud Build to use service accounts:

```
gcloud projects add-iam-policy-binding $PROJECT_ID \
    --member="serviceAccount:$PROJECT_NUMBER@cloudbuild.gserviceaccount.com" \
    --role="roles/iam.serviceAccountUser"
```

Add permissions for the default service account to access Cloud SQL:

```
gcloud projects add-iam-policy-binding $PROJECT_ID \
    --member="serviceAccount:$PROJECT_NUMBER-compute@developer.gserviceaccount.com" \
    --role="roles/cloudsql.client"
```

Add permissions for the default service account to access Cloud Run:

```
gcloud projects add-iam-policy-binding $PROJECT_ID \
    --member="serviceAccount:$PROJECT_NUMBER-compute@developer.gserviceaccount.com" \
    --role="roles/run.admin"
```

Create a service account with appropriate permissions:

```
gcloud iam service-accounts create $SERVICE_ACCOUNT_NAME --display-name="$SERVICE_ACCOUNT_NAME"

gcloud iam service-accounts add-iam-policy-binding \
    $SERVICE_ACCOUNT_NAME@$PROJECT_ID.iam.gserviceaccount.com \
    --member="user:$USER_EMAIL" \
    --role="roles/iam.serviceAccountUser"

gcloud projects add-iam-policy-binding $PROJECT_ID \
    --member="serviceAccount:$SERVICE_ACCOUNT_NAME@$PROJECT_ID.iam.gserviceaccount.com" \
    --role="roles/owner" \

gcloud projects add-iam-policy-binding $PROJECT_ID \
    --member="serviceAccount:$SERVICE_ACCOUNT_NAME@$PROJECT_ID.iam.gserviceaccount.com" \
    --role="roles/compute.admin"

gcloud projects add-iam-policy-binding $PROJECT_ID \
    --member="serviceAccount:$SERVICE_ACCOUNT_NAME@$PROJECT_ID.iam.gserviceaccount.com" \
    --role="roles/storage.admin"

gcloud projects add-iam-policy-binding $PROJECT_ID \
    --member="serviceAccount:$SERVICE_ACCOUNT_NAME@$PROJECT_ID.iam.gserviceaccount.com" \
    --role="roles/run.admin"

gcloud projects add-iam-policy-binding $PROJECT_ID \
    --member="serviceAccount:$SERVICE_ACCOUNT_NAME@$PROJECT_ID.iam.gserviceaccount.com" \
    --role="roles/cloudsql.client"
```

Then, create and download access keys for Terraform:

```
gcloud iam service-accounts keys create ../tmp/gcp-key-$SERVICE_ACCOUNT_NAME.json --iam-account="$SERVICE_ACCOUNT_NAME@$PROJECT_ID.iam.gserviceaccount.com"
```

Export the path as an
[environment variable](https://cloud.google.com/docs/authentication/production#passing_variable):

```
export GOOGLE_APPLICATION_CREDENTIALS=../tmp/gcp-key-$SERVICE_ACCOUNT_NAME.json
```

Create a Google Cloud Storage (GCS) bucket for storing the Terraform state:

```
gsutil mb -p $PROJECT_ID -l europe-west1 -b on gs://cesko-digital-terraform-$PROJECT_ID
```

Install required providers and initialize the configuration:

```
terraform init
```

Preview the infrastructure to be created ("dry-run"):

```
TF_VAR_database_password=$DATABASE_PASSWORD terraform plan
```

Create the infrastructure:

```
TF_VAR_database_password=$DATABASE_PASSWORD terraform apply
```

After the initial run, create the database in PostgreSQL:

```
gcloud sql databases create mistoveskole --instance=mistoveskole-db
```

Then, trigger the Cloud Build to build the image with the application:

```
gcloud beta builds triggers run backend --branch=deployment
```

The trigger should update the application image and deploy the current revision.
