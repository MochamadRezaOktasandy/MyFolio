# 🚀 Personal Portfolio CMS

A modern, responsive, and lightweight **Personal Portfolio Content Management System (CMS)** built with **Laravel 11**, **MySQL**, **Tailwind CSS**, and **Alpine.js**.

Designed specifically for software engineers and tech professionals to showcase projects, skills, career milestones, verified credentials, and manage client inquiries without hardcoding Blade views.

[![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.x_(CDN)-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![Alpine.js](https://img.shields.io/badge/Alpine.js-3.x_(CDN)-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white)](https://alpinejs.dev)
[![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=for-the-badge)](LICENSE)

---

## 📌 Table of Contents

- [Key Features](#-key-features)
- [Tech Stack](#-tech-stack)
- [Getting Started](#-getting-started)
- [Default Admin Account](#-default-admin-account)
- [Route Overview](#-route-overview)
- [Production Deployment](#-production-deployment)
- [License](#-license)

---

## ✨ Key Features

- **⚡ Zero-Build Setup**: Runs Tailwind CSS and Alpine.js via CDN. No Node.js, `npm install`, or Vite build step required.
- **🛡️ Secure Admin Panel**: Session regeneration, rate limiting, and role-based protection on `/admin`.
- **📊 Real-time Dashboard**: Overview counters for projects, published skills, certificates, and unread inquiries.
- **👤 Profile & Bio Manager**: Manage personal bio, headline, availability status, avatar, and downloadable PDF resume.
- **🚀 Projects & Case Studies**: Complete CRUD with cover image upload, many-to-many technology tagging, category filters, and draft preview mode.
- **⚙️ Dynamic Tagging & Inline Add**: Create categories and tech stack tags directly inside project forms with cascade-delete protection.
- **⚡ Interactive Skills Matrix**: Categorized skill bars with percentage sliders and featured badges.
- **💼 Career & Education Timelines**: Chronological career and academic milestones with "Current Role / Study" toggles.
- **📜 Verified Credentials**: Display licenses and certifications with verification links and expiry state handling.
- **✉️ Frictionless Contact Form**: AJAX submission powered by Alpine.js Fetch API with a direct "Reply via Gmail" trigger in the admin inbox.
- **🌐 Centralized Socials**: Social links managed in one place and shared across views via Laravel View Composers.
- **🌓 Dark / Light Mode**: Persistent theme toggle with inline anti-FOUC script.
- **🔍 SEO & OpenGraph**: Auto-generated `sitemap.xml` and metadata tags for social media previews.

---

## 🛠️ Tech Stack

| Layer | Technology |
| :--- | :--- |
| **Backend Framework** | [Laravel 11](https://laravel.com) |
| **Database** | [MySQL 8.0+](https://mysql.com) |
| **UI & Styling** | [Tailwind CSS 3.x (CDN)](https://tailwindcss.com) + Typography & Forms |
| **Frontend Behavior** | [Alpine.js 3.x (CDN)](https://alpinejs.dev) |
| **Templating Engine** | Blade |

---

## 🚀 Getting Started

Ensure your local environment meets Laravel 11 requirements (PHP >= 8.2, Composer, MySQL).

### 1. Clone the Repository
```bash
git clone https://github.com/YOUR_USERNAME/portfolio-cms.git
cd portfolio-cms
```

### 2. Install PHP Dependencies
```bash
composer install
```

### 3. Environment Configuration
Duplicate the example environment file:
```bash
cp .env.example .env
```

Open `.env` and configure your database connection:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portfolio_cms
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Application Key & Migrations
Generate the encryption key, run database migrations, and seed starter data:
```bash
php artisan key:generate
php artisan migrate --seed
```

### 5. Storage Symlink
Link the public storage folder to make uploaded assets and CVs accessible:
```bash
php artisan storage:link
```

### 6. Run the Application
```bash
php artisan serve
```

Access the portfolio at `http://127.0.0.1:8000`.

---

## 🔐 Default Admin Account

Access the management panel at `http://127.0.0.1:8000/login`:

| Field | Value |
| :--- | :--- |
| **Email** | `admin@example.com` |
| **Password** | `password` |

> ⚠️ **Security Warning**: Change the default email and password immediately before deploying to a public server.

---

## 🗺️ Route Overview

### Public Endpoints

| Method | URI | Description |
| :--- | :--- | :--- |
| `GET` | `/` | Portfolio landing page |
| `GET` | `/projects` | Filterable project showcase |
| `GET` | `/projects/{slug}` | Detailed project case study |
| `GET` | `/certificates` | Credentials and certificate list |
| `POST` | `/contact` | Async contact form handler |
| `GET` | `/resume` | One-click CV/resume download |
| `GET` | `/sitemap.xml` | Search engine XML index |

### Admin Endpoints (`/admin`)

| Method | URI | Description |
| :--- | :--- | :--- |
| `GET` | `/admin` | Metrics dashboard and unread inbox |
| `GET / PUT` | `/admin/profile` | Personal details and resume manager |
| `RESOURCE` | `/admin/projects` | Project case studies CRUD |
| `RESOURCE` | `/admin/skills` | Technical skills CRUD |
| `RESOURCE` | `/admin/experiences` | Professional work history CRUD |
| `RESOURCE` | `/admin/educations` | Academic background CRUD |
| `RESOURCE` | `/admin/certificates` | Certifications and licenses CRUD |
| `RESOURCE` | `/admin/messages` | Inquiries inbox and email replies |
| `RESOURCE` | `/admin/social-links` | External social profiles CRUD |

---

## 📦 Production Deployment

Run these steps when deploying to a VPS or production server:

1. **Configure Environment Variables**:
   ```env
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://yourdomain.com
   ```

2. **Optimize Laravel Caching**:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   php artisan storage:link
   ```

---

## 📄 License

Distributed under the [MIT License](LICENSE). Open for personal and commercial adaptation.
