## Project Overview

This project is a simple apartment management application built with Symfony and Docker.
It provides a basic web interface and a JSON API for listing apartments, along with database
migrations, fixtures, and console commands.

The project was created as part of coursework requirements and focuses on clean architecture,
Doctrine ORM usage, and containerized development.

## Requirements

- Docker
- Docker Compose (v2.10+)
- Git

No local PHP or database installation is required.

1. Clone the repository:

   ```bash
   git clone <repository-url>
   cd <repository-directory>
   ```

2. Build Docker images:

   ```bash
   docker compose build --pull --no-cache
   ```

3. Start the containers:

   ```bash
   docker compose up --wait
   ```

4. Open the application in your browser:

   ```
   https://localhost
   ```

   Accept the auto-generated TLS certificate when prompted.

5. To stop containers:

   ```bash
   docker compose down --remove-orphans
   ```

---

## Database & Migrations

### Running migrations

```bash
docker compose exec php bin/console doctrine:migrations:migrate
```

### Loading fixtures

```bash
docker compose exec php bin/console doctrine:fixtures:load
```

Fixtures generate sample data (apartments, categories, settings) with varied values.

---

## API Usage

### Get all apartments

```http
GET https://localhost/api/apartments
```

Response format:

```json
{
  "status": "success",
  "count": 3,
  "data": [
    {
      "id": 1,
      "title": "Apartment title",
      "price": 3200,
      "rooms": 2,
      "area": 45,
      "address": "Example address",
      "createdAt": "2026-02-01 12:00:00"
    }
  ]
}
```

---

## Console Commands

### Add a new apartment

```bash
docker compose exec php bin/console app:apartment:add "Test apartment" 3500 2
```

Arguments:

* `title` – apartment title
* `price` – price
* `rooms` – number of rooms

The command creates a new apartment entity and saves it to the database.

---

## Project Structure Overview

* `src/Controller` – Web and API controllers
* `src/Entity` – Doctrine entities
* `src/Repository` – Database queries
* `src/DataFixtures` – Sample data
* `src/Command` – Symfony console commands
* `templates/` – Twig templates

---

## Features Implemented

* Dockerized Symfony environment
* PostgreSQL database with migrations and fixtures
* Apartment listing with filters
* API endpoint returning JSON
* Custom Symfony console command
* Query Builder usage
* Clean separation between web and API controllers

---

## Notes

* Application is available via HTTPS only (`https://localhost`)
* API endpoints are prefixed with `/api`
* Adminer is available on port `8080`

---

## License

MIT License

---

Based on Symfony Docker by Kévin Dunglas, co-maintained by Maxime Helias and sponsored by Les-Tilleuls.coop.
