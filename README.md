# Miniplume

A tiny, secure blog/CMS built with **native PHP 8.2 + PDO**.  
Publish articles with tags and comments, manage content from a simple admin, and ship production-friendly basics (RBAC, CSRF, XSS protection, file uploads, RSS, sitemap, caching).

No frameworks: minimal MVC, light router, plain PHP views.

---
## Roles & permissions (RBAC)

- **admin** – full access (users, posts, tags, comments).

- **author** – manage own posts (create/edit/delete), see moderation.

- **reader** – can comment (public front), manage own comments (optional routes).

---

## Features

- **Posts**: CRUD, tag chips, scheduled publish (`published_at`), cover image upload.
- **Tags**: CRUD + browsing by `/tag/{slug}` with pagination.
- **Comments**: public submission (reader role), admin moderation (pending/approved/spam).
- **Auth & RBAC**: session login, roles: `admin`, `author`, `reader`.
- **Security**: CSRF tokens, prepared statements, password hashing, basic login rate-limit, HTML/Markdown whitelist rendering.
- **Feeds**: `sitemap.xml`, `feed.rss` (W3C-friendly), lightweight file cache.
- **Perf**: fast list view (<200ms @1k posts on local), cached feed/sitemap.
- **DX**: tiny front controller, tiny router, simple PHP views & components.

---

## Tech stack

- **PHP** ≥ 8.2 (CLI or Apache with PHP module)
- **MySQL** 8.x (MariaDB OK)
- **PDO** for DB access
- **Apache (XAMPP)** recommended for local dev
- No external template engines or frameworks

---

