# Event Registration System — Final Documentation

This document summarizes the project, how it works, and step-by-step instructions to set up and run it locally (Windows/XAMPP).

## Overview
- Framework: CodeIgniter 4 style application (lightweight custom front controller in `public/index.php`).
- Language: PHP (recommended PHP 7.4+)
- Database: MySQL
- UI: Bootstrap 5

## Short Architecture Summary
- MVC structure under `app/`:
  - `app/Controllers/` — page and API controllers (e.g., `Home`, `Event`, `Auth`, `AdminEvent`, `AdminParticipant`).
  - `app/Models/` — data access/business logic (e.g., `EventModel`, `RegistrationModel`, `AdminModel`).
  - `app/Views/` — templates and partials used by controllers.
  - `app/Config/` — configuration (notably `Database.php`, `Routes.php`, and `Filters.php`).
- Public entrypoint: `public/index.php` (contains a simple router + view renderer to run the app under XAMPP without a full CI bootstrap).
- SQL schema and sample data: `database.sql`.

## Important Implementation Notes (observations)
- The app contains two places where the database name appears:
  - `app/Config/Database.php` uses the default database name `event_registration`.
  - `public/index.php` attempts a direct `mysqli` connection to `event_system`.
  - Ensure these are consistent; otherwise you will see DB connection errors or missing tables. Recommended database name: `event_system` (update `Database.php` or the `.env` accordingly).

## Prerequisites
- XAMPP (Apache + PHP + MySQL) installed on Windows.
- PHP 7.4 or newer (verify with `php -v`).
- MySQL / MariaDB running.

## Setup (Windows + XAMPP)
1. Place project in XAMPP `htdocs` folder (example):

   C:\xampp\htdocs\Event-system

2. Start XAMPP and ensure Apache and MySQL are running (use XAMPP Control Panel).

3. Create or import the database:
   - Open phpMyAdmin (http://localhost/phpmyadmin).
   - Create a new database named `event_system` (recommended).
   - Import the file `database.sql` (root of the project).

   Alternative CLI import (PowerShell):
   ```powershell
   mysql -u root -p event_system < database.sql
   ```

4. Verify configuration values:
   - Open `app/Config/Database.php` and set `database` to the database you created (e.g., `event_system`) or update `.env` if present.
   - If using `.env`, ensure `database.default.database` matches the database name.

5. Ensure the `writable/` directory exists and is writable by PHP (used for logs/sessions).

6. (Optional) Install Composer dependencies if the project uses them:
   ```powershell
   cd C:\xampp\htdocs\Event-system
   composer install
   ```

## Run the App
- Open a browser and go to:
  - User frontend: http://localhost/Event-system/
  - Admin panel: http://localhost/Event-system/admin/login

- The `public/index.php` file contains a lightweight router that maps requests to controllers in `app/Controllers/`.

## Admin Credentials (default from repository README)
- Username: `admin`
- Password: `admin123`

If these do not work, check the `admin` table in the database or the seed data in `database.sql`.

## Folder Map (high level)
- `app/Config/` — database, routes, filters
- `app/Controllers/` — application controllers
- `app/Models/` — database models
- `app/Views/` — HTML templates and partials
- `public/` — `index.php` (entrypoint) and `assets/` (css, js)
- `database.sql` — schema + sample data

## How the Request Flow Works
1. Browser requests `http://localhost/Event-system/...` which serves `public/index.php`.
2. `public/index.php` computes the request path and maps it to controllers/methods (it also contains some legacy/explicit routes mirroring `app/Config/Routes.php`).
3. The controller loads models and views; views are rendered using a small `ViewRenderer` class implemented in `public/index.php`.
4. The app uses sessions for admin authentication and CSRF tokens for forms.

## Common Tasks
- Create an event: Login to admin → Events → Create.
- Register for an event: Open event detail page and submit the registration form.
- Export participants: Admin → Participants → choose CSV/Excel/PDF.

## Troubleshooting
- Database connection fails:
  - Confirm MySQL is running in XAMPP.
  - Confirm DB name/credentials in `app/Config/Database.php` and in `.env` (if present) match the actual DB.
  - Check `public/index.php` mysqli connection—synchronize the DB name.
- 404 routing issues:
  - Verify `app/Config/Routes.php` contains the needed routes (it does) and `public/index.php` base URL mapping matches `/Event-system` route prefix.
- Session or login issues:
  - Ensure PHP sessions work and `writable/` folder is writable by the webserver.

## Notes & Recommendations
- Standardize the DB name across `app/Config/Database.php`, `.env`, and `public/index.php` to avoid confusion.
- Consider replacing the simplified `public/index.php` bootstrap with the official CodeIgniter 4 `public/index.php` to leverage framework features and security hardening.
- Add a small `README_RUN.md` with one-line run steps for new devs (this file is intended to be that final, consolidated doc).

---
If you want, I can:
- update `app/Config/Database.php` to use `event_system`,
- add a `.env.example` with recommended settings, or
- replace the simplified `public/index.php` with a standard CI4 bootstrap. Which would you like me to do next?
