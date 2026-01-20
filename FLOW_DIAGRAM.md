# Event Registration System - Complete Flow Diagram

## Request Flow (Start to End)

```
┌─────────────────────────────────────────────────────────────────────┐
│                         USER/BROWSER REQUEST                         │
│                    http://localhost/Event-system/                    │
└──────────────────────────────┬──────────────────────────────────────┘
                               │
                               ▼
┌─────────────────────────────────────────────────────────────────────┐
│                     public/index.php (Entry Point)                   │
│  - Loads .env configuration                                          │
│  - Loads Composer autoloader (vendor/autoload.php)                   │
│  - Parses REQUEST_URI path                                           │
│  - Starts PHP session                                                │
└──────────────────────────────┬──────────────────────────────────────┘
                               │
                               ▼
┌─────────────────────────────────────────────────────────────────────┐
│                       ROUTING LOGIC                                  │
│  - Check app/Config/Routes.php mapping                               │
│  - Extract controller name & method                                  │
│  Examples:                                                           │
│  • / → Home::index                                                   │
│  • /events → Event::index                                            │
│  • /admin/login → Auth::login                                        │
│  • /event/123 → Event::detail(123)                                   │
└──────────────────────────────┬──────────────────────────────────────┘
                               │
                               ▼
┌─────────────────────────────────────────────────────────────────────┐
│                  CONTROLLER EXECUTION                                │
│              app/Controllers/{Controller}.php                        │
│                                                                      │
│  Example: Event.php::detail($eventId)                                │
│  - Receives route parameters                                        │
│  - Calls appropriate Models                                         │
│  - Prepares data for View                                           │
└──────────────────────────────┬──────────────────────────────────────┘
                               │
                ┌──────────────┴──────────────┐
                │                             │
                ▼                             ▼
    ┌─────────────────────────┐   ┌──────────────────────────┐
    │   MODEL LAYER           │   │   DATABASE (MySQL)       │
    │ app/Models/*.php        │   │   event_system DB        │
    │                         │   │                          │
    │ • EventModel            │─→ │ • events table           │
    │ • RegistrationModel     │   │ • registrations table    │
    │ • AdminModel            │   │ • admin table            │
    │                         │   │                          │
    │ Handles:               │   │ Connected via:           │
    │ - Database queries     │   │ app/Config/Database.php  │
    │ - Business logic       │   │ (mysqli driver)          │
    │ - Data validation      │   │                          │
    └─────────────────────────┘   └──────────────────────────┘
                │
                └──────────────┬──────────────┐
                               │
                               ▼
┌─────────────────────────────────────────────────────────────────────┐
│                      VIEW RENDERING                                  │
│              app/Views/{folder}/{template}.php                      │
│                                                                      │
│  Layout Structure:                                                   │
│  ┌─────────────────────────────────────┐                            │
│  │  layout.php (Main template)         │                            │
│  │  ├─ _navbar.php (Navigation)        │                            │
│  │  └─ [Content section from view]     │                            │
│  │     ├─ home.php                     │                            │
│  │     ├─ events/index.php             │                            │
│  │     ├─ events/detail.php            │                            │
│  │     ├─ admin/login.php              │                            │
│  │     ├─ admin/dashboard.php          │                            │
│  │     ├─ admin/events/*.php           │                            │
│  │     └─ admin/participants/*.php     │                            │
│  └─────────────────────────────────────┘                            │
│                                                                      │
│  Assets Used:                                                        │
│  • public/assets/css/style.css                                       │
│  • public/assets/js/script.js                                        │
│  • Bootstrap 5 (CDN)                                                 │
│  • Font Awesome 6 (CDN)                                              │
└──────────────────────────────┬──────────────────────────────────────┘
                               │
                               ▼
┌─────────────────────────────────────────────────────────────────────┐
│                   HTML RESPONSE SENT TO BROWSER                      │
│                                                                      │
│  Browser renders page with:                                         │
│  ✓ Navbar                                                           │
│  ✓ Page content                                                     │
│  ✓ Forms (with CSRF tokens from csrf_field())                       │
│  ✓ Bootstrap styling                                                │
└─────────────────────────────────────────────────────────────────────┘
```

---

## Real Examples (A-Z)

### Example 1: User Views Events List
```
Browser → http://localhost/Event-system/events
    ↓
public/index.php (routing)
    ↓
Event Controller → index() method
    ↓
EventModel → getAll() [queries events table]
    ↓
app/Views/events/index.php [renders event cards]
    ↓
Browser: Shows event list with cards
```

### Example 2: Admin Login & Dashboard
```
Browser → http://localhost/Event-system/admin/login
    ↓
public/index.php
    ↓
Auth Controller → login() method
    ↓
app/Views/admin/login.php [shows login form]
    ↓
User submits: username=admin, password=admin123
    ↓
public/index.php (routing) → admin/authenticate
    ↓
Auth Controller → authenticate() method
    ↓
AdminModel → verifyCredentials() [checks admin table]
    ↓
If valid: session set ✓ → redirect to admin/dashboard
    ↓
AdminDashboard Controller → index() method
    ↓
EventModel, RegistrationModel [fetch statistics]
    ↓
app/Views/admin/dashboard.php [renders dashboard]
    ↓
Browser: Shows admin panel with stats & sidebar
```

### Example 3: User Registers for Event
```
Browser → http://localhost/Event-system/event/5 [event detail page]
    ↓
public/index.php
    ↓
Event Controller → detail(5) method
    ↓
EventModel → find(5) [get event details from DB]
    ↓
app/Views/events/detail.php [shows event + registration form]
    ↓
User submits registration form
    ↓
public/index.php → event/register/5
    ↓
Event Controller → register(5) method
    ↓
RegistrationModel → save() [inserts into registrations table]
    ↓
Check CSRF token ✓
Check email duplicate ✓
Validate input ✓
    ↓
Browser: Success message shown
```

---

## Key Files in Order of Execution

| Step | File | Purpose |
|------|------|---------|
| 1 | `public/index.php` | Entry point - router, session, helpers |
| 2 | `.env` | Configuration (loaded by index.php) |
| 3 | `app/Config/Routes.php` | Route definitions |
| 4 | `app/Controllers/*.php` | Handle requests, call models |
| 5 | `app/Models/*.php` | Database queries, business logic |
| 6 | `app/Config/Database.php` | DB connection settings |
| 7 | Database (MySQL) | event_system (events, registrations, admin) |
| 8 | `app/Views/**/*.php` | Render HTML responses |
| 9 | `public/assets/` | CSS, JS styling |
| 10 | Browser | Displays final HTML |

---

## Directory Structure with Execution Flow

```
Event-system/
├── public/
│   ├── index.php ⭐ (ENTRY POINT - Step 1)
│   └── assets/
│       ├── css/style.css (Step 9)
│       └── js/script.js (Step 9)
│
├── app/
│   ├── Config/
│   │   ├── Routes.php (Step 3)
│   │   └── Database.php (Step 6)
│   │
│   ├── Controllers/ (Step 4)
│   │   ├── Home.php
│   │   ├── Event.php
│   │   ├── Auth.php
│   │   ├── AdminDashboard.php
│   │   ├── AdminEvent.php
│   │   └── AdminParticipant.php
│   │
│   ├── Models/ (Step 5)
│   │   ├── EventModel.php
│   │   ├── RegistrationModel.php
│   │   └── AdminModel.php
│   │
│   └── Views/ (Step 8)
│       ├── layout.php (Main layout)
│       ├── _navbar.php
│       ├── home.php
│       ├── events/
│       │   ├── index.php
│       │   └── detail.php
│       └── admin/
│           ├── login.php
│           ├── dashboard.php
│           ├── events/
│           └── participants/
│
├── vendor/ (Step 1 - Composer packages)
│   ├── autoload.php
│   └── codeigniter4/framework/
│
├── .env (Step 2 - Configuration)
├── database.sql (Step 7 - Database schema)
└── composer.json (Dependency management)
```

---

## Summary

**REQUEST FLOW (Timeline):**
1. **Browser** sends HTTP request
2. **public/index.php** receives request (loads .env, autoloader, session)
3. **Routing** extracts controller & method
4. **Controller** processes logic & calls Models
5. **Model** queries MySQL database
6. **View** renders HTML template
7. **Browser** displays final page

**Key Technologies:**
- **Server:** PHP 8.2 + Apache (XAMPP)
- **Framework:** Custom lightweight + Composer (CodeIgniter 4 packages)
- **Database:** MySQL (event_system)
- **Frontend:** Bootstrap 5, HTML5, CSS3, JavaScript

---

Generated: 6 January 2026
