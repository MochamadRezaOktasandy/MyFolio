
```
# 🚀 Personal Portfolio CMS

A modern, responsive, and dynamic **Personal Portfolio Content Management System (CMS)** built with **Laravel 11**, **MySQL**, **Tailwind CSS**, and **Alpine.js**.

Designed specifically for Software Engineers and Tech Professionals to showcase their identity, projects, skills, career timeline, certificates, and receive client messages without hardcoding content in Blade views.

[![Laravel](https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![Tailwind CSS](https://img.shields.io/badge/Tailwind_CSS-3.x_(CDN)-38B2AC?style=for-the-badge&logo=tailwind-css&logoColor=white)](https://tailwindcss.com)
[![Alpine.js](https://img.shields.io/badge/Alpine.js-3.x_(CDN)-8BC0D0?style=for-the-badge&logo=alpine.js&logoColor=white)](https://alpinejs.dev)
[![MySQL](https://img.shields.io/badge/MySQL-8.0+-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://mysql.com)
[![License: MIT](https://img.shields.io/badge/License-MIT-yellow.svg?style=for-the-badge)](LICENSE)

---

## ✨ Features

- **⚡ Zero-Build Overhead**: Uses Tailwind CSS & Alpine.js via CDN. **No `npm install`, Node.js, or Vite build compilation required!**
- **🛡️ Secure Admin CMS**: Custom lightweight authentication protecting `/admin` route with session regeneration and rate limiting.
- **📊 Analytics & Metrics Dashboard**: Real-time summary cards for projects, skills, certificates, and unread incoming messages.
- **👤 Profile Management**: Edit bio, availability status, headline, avatar, and upload PDF CV/Resume.
- **🚀 Projects CMS (Case Studies)**: Full CRUD with image upload, many-to-many technology tags, category filtering, start/end date validation, and draft preview for admins.
- **⚙️ Inline Quick-Add & Safe-Delete**: Manage project categories and technologies on-the-fly directly inside project forms with cascade-delete protection.
- **⚡ Interactive Skills Matrix**: Group skills by category with interactive percentage sliders and featured badges.
- **💼 Career & Education Timelines**: Chronological experience and academic records with "Currently Working/Studying" toggles.
- **📜 Verified Credentials Gallery**: Showcase licenses and certifications with direct verification links and expiration logic.
- **✉️ Smooth AJAX Contact Form**: Instant form submission powered by Alpine.js Fetch API (zero page reload / zero scroll jump) + direct "Reply via Gmail Compose" button in the admin inbox.
- **🌐 Dynamic Social Links**: Centrally managed social media links shared across the Hero section and Footer via Laravel View Composers.
- **🌓 Dark & Light Mode**: Persistent class-based theme switcher with Anti-FOUC (Flash of Unstyled Content) prevention script.
- **🔍 SEO & Social Share Ready**: Auto-generated dynamic `sitemap.xml` and OpenGraph meta tags for rich social media cards.
- **📄 Resume Download**: Direct download route (`/resume`) mapped to uploaded CV files.

---

## 🛠️ Tech Stack

- **Framework**: [Laravel 11](https://laravel.com)
- **Database**: [MySQL 8.0+](https://mysql.com)
- **Styling**: [Tailwind CSS via CDN](https://tailwindcss.com) (with Typography & Forms plugins)
- **Interactivity**: [Alpine.js via CDN](https://alpinejs.dev)
- **Templating**: Blade

---

## 🚀 Getting Started

Follow these step-by-step instructions to get the application running locally:

### 1. Clone the repository
```bash
git clone https://github.com/YOUR_USERNAME/portfolio-cms.git
cd portfolio-cms
```

### 2. Install dependencies
```bash
composer install
```

### 3. Environment configuration
Create your environment file:
```bash
cp .env.example .env
```

Open `.env` and set your MySQL database credentials:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portfolio_cms
DB_USERNAME=root
DB_PASSWORD=
```

### 4. Generate app key
```bash
php artisan key:generate
```

### 5. Run database migrations & seeders
This command runs all migrations, creates default starter data, and sets up the default admin account:
```bash
php artisan migrate --seed
```

### 6. Create symbolic storage link
Allows uploaded images, thumbnails, and PDF files to be accessed publicly:
```bash
php artisan storage:link
```

### 7. Start development server
```bash
php artisan serve
```

Visit the website at **`http://127.0.0.1:8000`**.

---

## 🔐 Default Admin Account

Log in to the Admin Panel at **`http://127.0.0.1:8000/login`**:

| Field | Default Value |
| :--- | :--- |
| **Email** | `admin@example.com` |
| **Password** | `password` |

> ⚠️ **Important**: Remember to change the admin password and email before deploying to production!

---

## 🗺️ Route Overview

### Public Routes
| Method | URI | Description |
| :--- | :--- | :--- |
| `GET` | `/` | Portfolio Homepage |
| `GET` | `/projects` | Filterable Projects Archive |
| `GET` | `/projects/{slug}` | Project Case Study Detail Page |
| `GET` | `/certificates` | Credentials & Certificate Gallery |
| `POST` | `/contact` | AJAX Contact Form Handler |
| `GET` | `/resume` | One-Click PDF Resume Download |
| `GET` | `/sitemap.xml` | Search Engine XML Sitemap |

### Admin CMS Routes (`/admin`)
| Method | URI | Description |
| :--- | :--- | :--- |
| `GET` | `/admin` | Metrics Dashboard & Inbox Overview |
| `GET / PUT` | `/admin/profile` | Profile & CV Document CMS |
| `RESOURCE` | `/admin/projects` | Project Portfolio CRUD |
| `RESOURCE` | `/admin/skills` | Skills & Tech Stack CRUD |
| `RESOURCE` | `/admin/experiences` | Career Timeline CRUD |
| `RESOURCE` | `/admin/educations` | Academic Background CRUD |
| `RESOURCE` | `/admin/certificates` | Licenses & Certifications CRUD |
| `RESOURCE` | `/admin/messages` | Inbox Messages & Gmail Reply |
| `RESOURCE` | `/admin/social-links` | Dynamic Social Links CRUD |

---

## 🚀 Production Deployment Checklist

When deploying to a live VPS or Shared Hosting server:

1. Update `.env`:
   ```env
   APP_ENV=production
   APP_DEBUG=false
   APP_URL=https://yourdomain.com
   ```
2. Optimize framework caches:
   ```bash
   php artisan config:cache
   php artisan route:cache
   php artisan view:cache
   php artisan storage:link
   ```

---

## 📄 License

This project is licensed under the [MIT License](LICENSE) — feel free to use, modify, and distribute it for personal or commercial projects.
```