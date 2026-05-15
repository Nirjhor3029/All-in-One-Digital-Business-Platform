<p align="center">
    <img src="https://via.placeholder.com/200x80/0F172A/6366F1?text=Apnar+Business" alt="Apnar Business" width="400">
</p>

<h1 align="center">Apnar Business</h1>

<p align="center">
    Bangladesh's first all-in-one digital platform —<br>
    <strong>Learn. Build. Grow.</strong>
</p>

<p align="center">
    <img src="https://img.shields.io/badge/Laravel-11-red?style=flat-square&logo=laravel" alt="Laravel 11">
    <img src="https://img.shields.io/badge/Filament-3-orange?style=flat-square&logo=filament" alt="Filament 3">
    <img src="https://img.shields.io/badge/Livewire-3-blue?style=flat-square&logo=livewire" alt="Livewire 3">
    <img src="https://img.shields.io/badge/PHP-8.2-777BB4?style=flat-square&logo=php" alt="PHP 8.2">
    <img src="https://img.shields.io/badge/status-7%2F8%20phases%20complete-green?style=flat-square" alt="Status">
</p>

---

## Overview

**Apnar Business** is a full-stack digital business platform built for the Bangladesh market. It unifies **online education**, **software/services marketplace**, **SaaS subscription management**, **e-commerce**, and **content publishing** into a single, cohesive ecosystem — powered by Laravel 11, Filament 3, Livewire 3, Alpine.js, and TailwindCSS.

The platform serves three core audiences:
- **Learners** — enroll in premium courses, track progress, earn certificates
- **Customers** — purchase software solutions, subscribe to SaaS products, manage billing
- **Administrators** — manage content, process orders, oversee subscriptions, deliver services

---

## Modules

### 1. Learning Management System (LMS)

A complete online course delivery platform.

| Feature | Description |
|---|---|
| **Courses** | Multi-level categorization, pricing (free/paid/discounted), featured flags, SEO metadata |
| **Sections & Lectures** | Ordered course structure with video (YouTube/Vimeo/etc.), rich text, file attachments |
| **Enrollments** | Unique per user/course, tracks completion status and date |
| **Lecture Progress** | Per-lecture completion tracking with timestamps |
| **Video Player** | Plyr-based player with prev/next navigation, progress bar, mark-complete toggle |
| **Course Filters** | Livewire-powered search, category/level/price filters, sorting |
| **Auto-Certificates** | Certificate PDF auto-generated upon course completion |

**Routes:** `/courses`, `/courses/{slug}`, `/learning/{course}`, `/my-courses`

### 2. Services & Software Marketplace

A digital storefront for selling software solutions and digital services.

| Feature | Description |
|---|---|
| **Service Listings** | Provider, category, starting price, delivery time, featured/published flags |
| **Tiered Plans** | Multiple pricing tiers per service with feature lists (JSON), popular badge |
| **Service Purchases** | Tracks delivery status, download URLs, credentials, admin notes |
| **Customer Portal** | "My Services" page with download links and delivery tracking |
| **Admin Delivery** | Filament resource for managing deliveries with "Mark Delivered" action |

**Routes:** `/services`, `/services/{slug}`, `/my-services`

### 3. SaaS Subscription Engine

Recurring billing and subscription lifecycle management for service plans.

| Feature | Description |
|---|---|
| **Billing Intervals** | Monthly/yearly recurring billing with trial period support |
| **Lifecycle States** | Trial → Active → Cancelled/Suspended, with full audit trail |
| **Overdue Detection** | Daily artisan command flags subscriptions 7+ days past due |
| **Payment Reminders** | Automated email reminders 3 days before period end |
| **Suspension Logs** | Complete audit trail for all suspend/activate/cancel actions |
| **External Verification** | REST API endpoint for third-party subscription validation |
| **Email Notifications** | Payment due, suspension warning, payment confirmation (3 mail classes) |

**Artisan Commands:** `subscription:check-overdue`, `subscription:send-reminders`

**Routes:** `/my-subscriptions`, `/api/subscriptions/verify`

### 4. E-Commerce & Payments

Full shopping cart and checkout flow with Bangladesh's leading payment gateway.

| Feature | Description |
|---|---|
| **Shopping Cart** | One cart per user, polymorphic items (courses + service plans) |
| **Coupon Engine** | Fixed/percentage discounts with min total, max uses, expiry dates |
| **Checkout** | Billing information form with order creation |
| **SSLCommerz Integration** | Sandbox/live toggle, initiation, validation, IPN handling |
| **Order Management** | Polymorphic order items, payment status tracking (unpaid/paid/failed/refunded) |
| **Auto-Provisioning** | On payment confirmation: enrollments created, subscriptions activated, services recorded |
| **Invoice PDF** | Downloadable invoice generation via dompdf |

**Routes:** `/cart`, `/checkout`, `/orders`, `/payment/*`

### 5. Blog & Content Management

A full-featured CMS for publishing articles and engaging with the community.

| Feature | Description |
|---|---|
| **Posts** | Rich text content, featured images, SEO metadata, scheduled publishing |
| **Categories & Tags** | Hierarchical categorization with many-to-many tagging |
| **Comments** | Per-post discussion with guest posting, approval workflow |
| **Live Search** | Debounced AJAX search with dropdown results |
| **SEO** | Per-post meta title/description for search engine optimization |

**Routes:** `/blog`, `/blog/{slug}`, `/blog/category/{slug}`, `/blog/tag/{slug}`

### 6. Certificate System

Automated certificate generation and management upon course completion.

| Feature | Description |
|---|---|
| **Auto-Generation** | Certificate PDF queued for generation when all lectures completed |
| **Unique Numbering** | Every certificate receives a unique identifier |
| **PDF Templates** | Professionally designed Blade PDF template |
| **Admin Controls** | Manual creation, download, and management via Filament |
| **Download & Stream** | CertificateService handles file storage and delivery |

### 7. User Dashboard & Notifications

Personalized control center for each user.

| Feature | Description |
|---|---|
| **Stats Overview** | Enrolled/completed courses, certificates, orders, subscriptions, services |
| **Recent Activity** | Latest enrollments, orders, and course progress |
| **In-App Notifications** | Database-channel notifications with title, body, URL, icon |
| **Notification Bell** | Livewire navbar component with unread count and dropdown |
| **Bulk Actions** | Mark single or all notifications as read |

**Routes:** `/dashboard`, `/dashboard/notifications`

### 8. Admin Panel (Filament 3)

Full administrative control over every aspect of the platform.

| Resource | Purpose |
|---|---|
| **Users** | Manage all user accounts, roles, permissions |
| **Courses** | Full CRUD for courses, sections, lectures |
| **Services** | Manage service listings and pricing plans |
| **Orders** | Process orders, update payment status |
| **Subscriptions** | Oversee subscription lifecycle |
| **Service Purchases** | Deliver digital products to customers |
| **Posts, Tags, Comments** | Publish content and moderate discussions |
| **Coupons** | Create and manage promotional discounts |
| **Certificates** | View, download, and manually issue certificates |
| **Categories & Types** | Configure content taxonomy |
| **Roles & Permissions** | Fine-grained access control via Spatie |
| **Settings** | Site-wide configuration (hero section, social links, SEO) |

**Route:** `/admin`

### 9. Projects Showcase

Portfolio display of products built by the platform, serving as social proof.

| Feature | Description |
|---|---|
| **Project Cards** | Title, description, tech stack, color theme, icon |
| **Sortable** | Configurable sort order and active/inactive toggles |

### 10. Static Pages

| Page | Purpose |
|---|---|
| `/about` | Company information and mission |
| `/contact` | Contact form and business details |
| `/faq` | Frequently asked questions |
| `/privacy-policy` | Privacy policy and data handling |
| `/terms` | Terms of service |

---

## Combined Ecosystem Flow

```
                    ┌──────────────────────────────────────────────┐
                    │                   USER                       │
                    │  (Learner / Customer / Admin)                │
                    └──────┬───────┬──────────┬───────────────────┘
                           │       │          │
              ┌────────────┘       │          └──────────────┐
              ▼                    ▼                         ▼
     ┌─────────────────┐  ┌──────────────────┐  ┌──────────────────────┐
     │   Browse        │  │  Browse          │  │  Admin Dashboard     │
     │   Courses (LMS) │  │  Services/Market │  │  (Filament 3)        │
     └────────┬────────┘  └────────┬─────────┘  └──────────────────────┘
              │                    │
              ▼                    ▼
     ┌─────────────────┐  ┌──────────────────┐
     │   Enroll /      │  │  Select Plan     │
     │   Watch Lectures│  │  (One-time/SaaS) │
     └────────┬────────┘  └────────┬─────────┘
              │                    │
              └──────────┬─────────┘
                         ▼
              ┌──────────────────────┐
              │   Cart & Checkout    │
              │   (Coupons, SSLComz) │
              └──────────┬───────────┘
                         ▼
              ┌──────────────────────┐
              │   Payment Confirmed  │
              └──────────┬───────────┘
                         │
          ┌──────────────┼──────────────┐
          ▼              ▼              ▼
   ┌────────────┐ ┌────────────┐ ┌──────────────┐
   │ Enrollment │ │ Subscription│ │ServicePurchase│
   │ Created    │ │ Activated   │ │ Recorded     │
   └─────┬──────┘ └──────┬─────┘ └──────┬───────┘
         │               │              │
         ▼               ▼              ▼
   ┌────────────┐ ┌────────────┐ ┌──────────────┐
   │ Complete   │ │ Recurring  │ │ Download &   │
   │ All Lectures│ │ Billing    │ │ Delivery     │
   └─────┬──────┘ └────────────┘ └──────────────┘
         │
         ▼
   ┌────────────┐
   │ Certificate│
   │ Auto-Issued│
   └────────────┘
```

---

## Tech Stack

| Layer | Technology |
|---|---|
| **Backend** | Laravel 11 (PHP 8.2+) |
| **Admin Panel** | Filament v3 |
| **Frontend Components** | Livewire v3 |
| **Frontend UI** | Blade + Alpine.js v3 + TailwindCSS v3 |
| **Build Tool** | Vite 6 |
| **Video Player** | Plyr |
| **Slider** | Swiper |
| **PDF** | Dompdf |
| **Payments** | SSLCommerz |
| **Search** | Laravel Scout |
| **Roles & Permissions** | Spatie Laravel Permission |
| **Activity Log** | Spatie Laravel Activitylog |
| **Slugs** | Spatie Laravel Sluggable |
| **Database** | MySQL |
| **Queue** | Database-driven queue |
| **Real-Time** | Laravel Reverb (configured) |
| **Notifications** | Database broadcast channel |

### Design System

- **Colors:** Primary `#0F172A`, Accent `#6366F1`, Highlight `#F59E0B`
- **Fonts:** Inter (body), Syne (display), Hind Siliguri (Bengali support)
- **Shadows:** Card `0 4px 24px rgba(0,0,0,0.08)`, Hover `0 12px 40px rgba(0,0,0,0.14)`
- **Borders:** Card radius `12px`, Button radius `8px`

---

## Database Architecture

The platform uses **35+ migrations** producing a relational schema with the following core entity groups:

**LMS Core:** `courses` → `sections` → `lectures` → `lecture_progress`, `enrollments`

**Marketplace:** `services` → `service_plans` → `service_purchases`

**Subscriptions:** `subscriptions` → `payment_records`, `suspension_logs`

**Commerce:** `carts` → `cart_items` (polymorphic), `orders` → `order_items` (polymorphic) → `transactions`

**Content:** `posts` ↔ `tags` (pivot), `posts` → `comments`

**Certificates:** `certificates` (linked to users, courses, enrollments)

**Supporting:** `categories` (self-referencing), `types`, `coupons`, `wishlists` (polymorphic), `projects` (standalone showcase)

All major entities support **soft deletes**. Orders and cart items use **polymorphic relationships** to handle multiple product types (courses, service plans) through a single table.

---

## Key Routes

### Public
| Method | URI | Description |
|---|---|---|
| GET | `/` | Homepage |
| GET/POST | `/login`, `/register` | Authentication |
| GET | `/courses` | Course catalog |
| GET | `/courses/{slug}` | Course detail |
| GET | `/services` | Service listings |
| GET | `/services/{slug}` | Service detail with plans |
| GET | `/blog` | Blog listing |
| GET | `/blog/{slug}` | Blog post |
| GET | `/about`, `/contact`, `/faq` | Static pages |

### Authenticated
| Method | URI | Description |
|---|---|---|
| GET | `/dashboard` | User dashboard |
| GET | `/learning/{course}` | Course player |
| GET | `/my-courses` | Enrolled courses |
| GET | `/cart` | Shopping cart |
| GET/POST | `/checkout` | Checkout flow |
| GET | `/orders` | Order history |
| GET | `/my-services` | Purchased services |
| GET | `/my-subscriptions` | Active subscriptions |
| GET | `/wishlist` | Saved items |

### Admin
| Method | URI | Description |
|---|---|---|
| GET | `/admin` | Filament admin panel |

### API
| Method | URI | Description |
|---|---|---|
| GET | `/api/subscriptions/verify` | Subscription verification |

---

## Installation

```bash
# 1. Clone the repository
git clone https://github.com/your-org/apnar-business-open.git
cd apnar-business-open

# 2. Install PHP dependencies
composer install

# 3. Install frontend dependencies
npm install && npm run build

# 4. Environment setup
cp .env.example .env
php artisan key:generate

# 5. Configure your .env file (database, mail, SSLCommerz, Reverb)

# 6. Run migrations and seeders
php artisan migrate --seed

# 7. Storage link
php artisan storage:link

# 8. Serve the application
php artisan serve
```

---

## Scheduled Tasks

The following artisan commands should be registered in your server's cron:

```bash
* * * * * php artisan schedule:run >> /dev/null 2>&1
```

| Command | Frequency | Purpose |
|---|---|---|
| `subscription:check-overdue` | Daily | Alert on subscriptions 7+ days overdue |
| `subscription:send-reminders` | Daily | Email reminders 3 days before renewal |
| `queue:work` | Continuously | Process background jobs (certificates, emails) |

---

## Development Status

- **Phase 1-7:** ✅ Complete (Core, LMS, Commerce, Services, Subscriptions, Blog, Certificates/Dashboard/Notifications)
- **Phase 8:** ⏳ Production Deployment (pending)

---

## License

This project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
