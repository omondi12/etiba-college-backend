# Etiba Training College — Backend API

A dedicated Laravel 13 REST API backend for the **Etiba Training College** public website. Completely separate from the main Etiba platform backend, with its own database and environment.

---

## Tech Stack

| Layer | Technology |
|---|---|
| Framework | Laravel 13 (PHP 8.2+) |
| Authentication | Laravel Sanctum (token-based) |
| Database | MySQL (`etiba_college`) |
| Storage | Laravel Public Disk |
| API Style | REST — JSON responses |

---

## Architecture

This backend serves only the college website frontend. It is intentionally isolated from the main Etiba platform backend to avoid compliance and data mixing issues.

```
etiba-college-backend/     ← This repo (API)
etiba-training-college/    ← Frontend (React + Vite)
etiba-backend/             ← Main platform backend (separate system)
```

---

## Model Standards

Every content model extends `BaseModel` which enforces full auditability, soft deletes, and archive support:

| Column | Purpose |
|---|---|
| `deleted_at` | Soft delete |
| `is_active` | Show/hide on public site |
| `is_archived` | Archive support |
| `archived_at` | When archived |
| `archived_by` | Who archived |
| `created_by` | Who created |
| `updated_by` | Who last updated |
| `deleted_by` | Who deleted |

---

## API Endpoints

Base URL: `{APP_URL}/api/v1`

### Authentication
| Method | Endpoint | Access |
|---|---|---|
| POST | `/api/v1/login` | Public |
| POST | `/api/v1/logout` | Protected |
| GET | `/api/v1/user` | Protected |

### Public Read Routes
| Method | Endpoint |
|---|---|
| GET | `/api/v1/courses` |
| GET | `/api/v1/courses/{id}` |
| GET | `/api/v1/events` |
| GET | `/api/v1/events/{id}` |
| GET | `/api/v1/gallery` |
| GET | `/api/v1/gallery/{id}` |
| GET | `/api/v1/testimonials` |
| GET | `/api/v1/testimonials/{id}` |
| GET | `/api/v1/team-members` |
| GET | `/api/v1/team-members/{id}` |
| GET | `/api/v1/articles` |
| GET | `/api/v1/articles/{id}` |
| GET | `/api/v1/site-settings` |
| POST | `/api/v1/contact-us` |

### Protected Admin Routes (Bearer token required)
| Method | Endpoint |
|---|---|
| POST/PUT/DELETE | `/api/v1/courses/{id}` |
| POST/PUT/DELETE | `/api/v1/events/{id}` |
| POST/PUT/DELETE | `/api/v1/gallery/{id}` |
| POST/PUT/DELETE | `/api/v1/testimonials/{id}` |
| POST/PUT/DELETE | `/api/v1/team-members/{id}` |
| POST/PUT/DELETE | `/api/v1/articles/{id}` |
| PUT | `/api/v1/site-settings` |
| GET | `/api/v1/contact-enquiries` |
| PATCH | `/api/v1/contact-enquiries/{id}/read` |
| DELETE | `/api/v1/contact-enquiries/{id}` |

---

## Local Setup

```bash
# 1. Clone and install
git clone https://github.com/Kakaye-Tech-Labs/etiba-college-backend.git
cd etiba-college-backend
composer install

# 2. Environment
cp .env.example .env
php artisan key:generate

# 3. Database
mysql -u root -e "CREATE DATABASE etiba_college CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;"
php artisan migrate
php artisan db:seed

# 4. Storage
php artisan storage:link
mkdir -p storage/app/public/gallery
# Copy gallery images from the frontend repo:
cp /path/to/etiba-training-college/src/assets/gallery/*.webp storage/app/public/gallery/

# 5. Start
php artisan serve --port=8000
```

---

## Environment Variables

```env
APP_NAME="Etiba Training College"
APP_ENV=local
APP_URL=http://127.0.0.1:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=etiba_college
DB_USERNAME=root
DB_PASSWORD=

FRONTEND_URL=http://localhost:5173

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=your@email.com
MAIL_PASSWORD=your_app_password
MAIL_FROM_ADDRESS=info@etiba.ac.ke
```

---

## Default Admin Credentials

Seeded by `DatabaseSeeder`:

| Field | Value |
|---|---|
| Email | `admin@etiba.ac.ke` |
| Password | `Admin@1234` |

> Change this password immediately on any non-local environment.

---

## Deployment

```bash
php artisan migrate
php artisan db:seed
php artisan storage:link
php artisan serve --port=8000
```

Set `FRONTEND_URL` in `.env` to your frontend domain for CORS to work correctly.

---

## Content Managed via Admin Panel

| Section | Table |
|---|---|
| Courses | `courses` |
| Events | `events` |
| Gallery | `gallery` |
| Testimonials | `testimonials` |
| Team Members | `team_members` |
| Articles / Blog | `articles` |
| Contact Enquiries | `contact_enquiries` |
| Site Settings | `site_settings` |
