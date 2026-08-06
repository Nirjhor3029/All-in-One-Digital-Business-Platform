# Project Progress & Findings

> Working notes for the Apnar Business platform. Updated as work progresses.

---

## Current Status: Course System Audit

The full course journey was audited end-to-end:

```
CourseResource (admin) → sections → lectures
  ↓ published
/courses + /courses/{slug} (browse)
  ↓ cart.add → checkout → SSLCommerz → success
Order::updated hook (payment_status→'paid') → OrderService::createEnrollments → enrollment('active')
  ↓
/courses/{slug}/learn/{lecture} (auth+verified+enrolled) → CoursePlayer (video+content+progress)
  ↓ all lectures complete
GenerateCertificate job → certificate + notification
```

**Verdict: the core wiring is correct.** Admin marking an order "paid" in Filament also triggers enrollment via the `Order::updated` hook (`Order.php:32`, `OrderResource` EditOrder).

---

## Gaps & Findings (course system)

### 🟥 Real bugs

1. **`courses.enroll` is not behind auth** (`routes/web.php:23`).
   `CourseController::enroll:80` uses `auth()->id()` — a guest POSTing → `user_id = null` → FK error → **500**. The UI hides the button from guests, but the endpoint is unprotected.

2. **`lectures.complete` route** (`web.php:30`) and **`courses.progress`** (`web.php:32`) lack the `enrolled` middleware.
   Any logged-in user can POST-complete any lecture, or read progress of any course. (The UI actually uses Livewire's `toggleComplete`, so not user-reachable — but a real API gap.)

3. **"Free Preview" lecture flag is half-built.**
   `lecture.is_free` only shows a badge on the curriculum; the `enrolled` middleware blocks non-enrolled users regardless (`EnsureEnrolled.php:17` only bypasses for free *courses*). No preview path exists for non-enrolled users.

### 🟨 UX / consistency

4. **No inline content management.**
   `CourseResource::getRelations()` returns `[]` — cannot add sections/lectures from the course edit page. Admin must juggle 3 separate resources (Course → Section → Lecture).

5. **No direct "start learning" path after purchase.**
   `checkout/success.blade.php` links to Orders/Browse — not to My Courses → course.

6. **`myCourses` filters `status='active'`** (`CourseController:34`).
   Demo seeders create `in_progress/not_started/completed` enrollments → those won't appear in My Courses (still accessible via direct URL). Production only creates `active`, so OK in practice, but fragile.

7. **"$" vs "৳" bug** — `courses/show.blade.php:119` renders "Add to Cart — $12,000" while the sidebar uses ৳.

8. **Can re-buy an already-owned course** — `cart.add` has no enrollment check.

### 🟩 Missing features / half-built

9. **No video upload** — link-only (YouTube/Vimeo embed, or raw `<video>` for anything else).
   - `video_url` + `video_provider` (youtube/vimeo/bunny/custom) on `lectures` table.
   - Player logic: `resources/views/livewire/course-player.blade.php:5-32`.

10. **Lecture `attachments` stored but never rendered** in the player.
    Field: `LectureResource.php:84` (`TagsInput` of URLs) → `lectures.attachments` (JSON). Not displayed anywhere on frontend.

11. **Section `description` stored but never rendered.**

12. **`bunny` provider** falls to the plain `<video>` tag — HLS `.m3u8` won't play reliably.

13. **Deployment risk: certificates need a queue worker** (`QUEUE_CONNECTION=database`).
    On shared hosting without `queue:work`, certificates silently never generate.

---

## Features (fully working)

- Course / Section / Lecture CRUD in Filament (LMS group).
- Course listing with search/filter/sort/pagination (`CourseFilter` Livewire).
- Course detail page: thumbnail, RichEditor description, curriculum accordion, price, enroll/cart/wishlist.
- Cart + coupon + checkout + SSLCommerz (sandbox) success/fail/cancel/IPN flow.
- Enrollment auto-creation on payment success + admin "paid" mark.
- Learning player: YouTube/Vimeo embed or raw `<video>`, RichEditor content, "Mark as Complete", prev/next, % progress sidebar.
- Auto certificate generation + notification on 100% completion.

---

## Admin Access (resolved earlier)

**Symptom:** `admin@apnarbusiness.com` / `password` worked locally but 403 on live (`APP_ENV=production`); changed to `local` and it worked.

**Root cause analysis:** `APP_ENV` itself does not affect the gate. The `/admin` gate is `EnsureHasRole` middleware → `$user->roles()->exists()` (spatie `model_has_roles` pivot). Real causes on live: stale `config:cache` pointing at the wrong DB, and/or DB dump carrying the `cache` table (`CACHE_STORE=database`) with poisoned spatie-permission entries.

**Fixes applied:**
- `app/Http/Middleware/EnsureHasRole.php` — now also accepts `users.role === 'admin'` (column survives DB dumps).
- `database/seeders/RoleAndPermissionSeeder.php` — idempotent `syncRoles()` for all users based on `users.role`.
- Live repair: `php artisan db:seed --class=RoleAndPermissionSeeder && php artisan optimize:clear`.

---

## Auth / Logout (resolved)

- Logout added to **dashboard sidebar** (`resources/views/layouts/dashboard.blade.php`) and **desktop navbar avatar dropdown** (`resources/views/components/navbar.blade.php`).
- Desktop navbar dropdown: avatar → Dashboard / Settings / Logout (POST).

---

## Homepage Dynamic (resolved)

- `HomeController` fetches settings + parses JSON arrays with fallback defaults.
- `SettingsPage` (Filament) — all 14 sections editable.
- `SettingsSeeder` — 24 keys with defaults.
- `welcome.blade.php` — fully dynamic, no hardcoded arrays.
- `APP_URL` set to `http://apnar-business.test` (was `localhost`, which broke `asset('storage/...')` URLs on the vhost).
- Storage images live under `storage/app/public/{courses,journey,settings}` and are referenced with their subdirectory (e.g. `settings/hero-graphic.png`).

---

## Demo Seeders

Registered in `DatabaseSeeder`: Admin, Type, Category, Settings, RoleAndPermission, Page, Project, Course (6 courses), Service (5 services + plans), Post (5 posts), Coupon (4), Enrollment (5), Order (3).

---

## Environment

- PHP 8.2.6 (`D:\developer\laragon2\bin\php\php-8.2.6-Win32-vs16-x64\php.exe`)
- Laravel 11 + Filament 3 + Livewire 3 + Tailwind
- MySQL `ab_apnar_business`
- DB charset `utf8` (utf8mb3), table collation `utf8mb4_unicode_ci`
- Storage link already created (`storage:link`)
- Queue: `database` (needs worker for certificates)
