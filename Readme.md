# Symfony Dockerized Project

* PHP 8.4 (FPM)
* MySQL 8.4
* Docker & Docker Compose

---

## 🧱 Project Structure

```
project-root/
├── docker-compose.yml
├── Dockerfile
├── .env            # auto-generated from .env.example
├── .env.example    # environment configuration template
├── src/            # Symfony source code
└── ...
```

---

## 🚀 Setup Instructions

### 1. Clone the Repository

```bash
git clone https://github.com/knarels/mobilly mobilly
cd mobilly
```

### 2. Copy Environment File

```bash
cp .env.example .env
```

This file contains environment variables for MySQL and Symfony.

> ✅ **Note**: `.env` is gitignored to keep sensitive values local.

### 3. Build and Start Containers

```bash
docker compose up -d --build
```

> ✅ **Note**: `docker-entrypoint.sh` will install composer dependencies, run migrations and run initial data import.

---

## Commands

### 1. Rerun the Meteorology Station data import

```bash
docker compose exec -it php bin/console app:import-meteorology-stations
```

> ✅ **Note**: in real case scenario where data change is expected - I would add this to a CRON.

---

### 2. API request example: station list

```bash
docker compose exec -it php curl -X GET http://localhost:8000/api/stations -H "Authorization: Bearer supersecretkey123" -H "Accept: application/json"
```

---

### 3. API request example: station details

```bash
docker compose exec -it php curl -X GET http://localhost:8000/api/stations/SIGULDA -H "Authorization: Bearer supersecretkey123" -H "Accept: application/json"

```

---

## 🌐 Access the App

Once running:

🔗 Visit: [http://localhost:8000](http://localhost:8000)

---
