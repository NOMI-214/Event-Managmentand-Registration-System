# 🎉 Event Registration System - Professional Edition

A complete, production-ready Event Management System built with **CodeIgniter 4**, **MySQL**, and **Bootstrap 5**.

## 📋 Features

### 👥 User Features
- ✅ **Event Listing**: Browse all upcoming events
- ✅ **Event Details**: View complete event information
- ✅ **Online Registration**: Easy registration form with validation
- ✅ **Email Validation**: Prevent duplicate registrations
- ✅ **Real-time Seat Availability**: Check available spots

### 🛠 Admin Features
- ✅ **Secure Login**: Password-protected admin access
- ✅ **Event Management**: Create, edit, delete events
- ✅ **Participant Management**: View and manage registrations
- ✅ **Advanced Dashboard**: Real-time statistics and metrics
- ✅ **Multi-format Export**: CSV, Excel, and PDF exports
- ✅ **Session Management**: Secure admin sessions

### 🎯 Technical Features
- ✅ **MVC Architecture**: Clean separation of concerns
- ✅ **Input Validation**: Server-side and client-side validation
- ✅ **CSRF Protection**: Built-in security against CSRF attacks
- ✅ **Password Hashing**: Bcrypt password encryption
- ✅ **Responsive Design**: Mobile-friendly UI
- ✅ **Beautiful UI**: Modern Bootstrap 5 design

---

## 🗂 Project Structure

```
Event-system/
├── app/
│   ├── Config/
│   │   ├── Database.php         # Database configuration
│   │   ├── Routes.php           # Route definitions
│   │   └── Filters.php          # Filter configuration
│   ├── Controllers/
│   │   ├── Home.php             # Home page controller
│   │   ├── Event.php            # User event controller
│   │   ├── Auth.php             # Authentication controller
│   │   ├── AdminDashboard.php   # Admin dashboard
│   │   ├── AdminEvent.php       # Admin event management
│   │   └── AdminParticipant.php # Participant management & exports
│   ├── Models/
│   │   ├── EventModel.php       # Event model with business logic
│   │   ├── RegistrationModel.php # Registration model
│   │   └── AdminModel.php       # Admin model with authentication
│   ├── Filters/
│   │   └── AuthFilter.php       # Authentication middleware
│   └── Views/
│       ├── layout.php           # Main layout template
│       ├── _navbar.php          # Navigation bar component
│       ├── home.php             # Homepage
│       ├── events/
│       │   ├── index.php        # Events listing page
│       │   └── detail.php       # Event details & registration
│       └── admin/
│           ├── login.php        # Admin login page
│           ├── dashboard.php    # Admin dashboard
│           ├── _sidebar.php     # Admin sidebar navigation
│           ├── events/
│           │   ├── index.php    # Events management
│           │   ├── create.php   # Create event
│           │   └── edit.php     # Edit event
│           └── participants/
│               ├── index.php    # All participants
│               ├── byEvent.php  # Event participants
│               ├── pdf.php      # PDF template
│               └── eventPdf.php # Event-specific PDF
├── public/
│   ├── index.php                # Application entry point
│   └── assets/
│       ├── css/
│       │   └── style.css        # Custom styling
│       └── js/
│           └── script.js        # Custom JavaScript
├── database.sql                 # Database schema & sample data
└── .env                         # Environment configuration
```

---

## 🚀 Installation & Setup

### Prerequisites
- XAMPP (or any PHP 7.4+ server with MySQL 5.7+)
- Composer (for dependency management)
- CodeIgniter 4

### Step 1: Download/Clone the Project
```bash
cd /Applications/XAMPP/xamppfiles/htdocs/
git clone [repo-url] Event-system
cd Event-system
```

### Step 2: Install Dependencies
```bash
composer install
```

### Step 3: Configure Database
The database is automatically set up! Run this command to import the schema:

```bash
/Applications/XAMPP/bin/mysql -u root < database.sql
```

Or manually:
1. Open phpMyAdmin
2. Create database `event_system`
3. Import `database.sql` file

### Step 4: Configure .env
The `.env` file is already configured for local development:
```env
CI_ENVIRONMENT = development
app.baseURL = 'http://localhost/Event-system/'
database.default.hostname = localhost
database.default.database = event_system
database.default.username = root
database.default.password = 
```

### Step 5: Start XAMPP
```bash
# Mac: Start XAMPP from Applications
# Or from terminal:
/Applications/XAMPP/xamppfiles/bin/apachectl start
```

### Step 6: Access the Application
- **User Frontend**: http://localhost/Event-system/
- **Admin Panel**: http://localhost/Event-system/admin/login

---

## 🔐 Admin Credentials

```
Username: admin
Password: admin123
```

---

## 📱 User Workflow

1. **Visit Homepage** → See featured upcoming events
2. **Browse Events** → Click "Browse Events" to see all events
3. **View Event Details** → Click on an event to see full details
4. **Register** → Fill out the registration form with:
   - Full Name
   - Email Address
   - Phone Number
5. **Confirmation** → Receive success message

---

## 🛠 Admin Workflow

### Login
1. Go to http://localhost/Event-system/admin/login
2. Enter credentials (username: `admin`, password: `admin123`)

### Manage Events
1. Click "Manage Events" in sidebar
2. View all events in table format
3. **Create**: Click "Create Event" button
4. **Edit**: Click "Edit" on any event
5. **Delete**: Click "Delete" (with confirmation)
6. **View Participants**: Click "Participants" button

### Manage Participants
1. Click "Participants" in sidebar
2. View all registrations across all events
3. Filter by event using dropdown
4. Export data in multiple formats:
   - **CSV**: Click "CSV" button
   - **Excel**: Click "Excel" button
   - **PDF**: Click "PDF" button
5. Delete registrations if needed

---

## 📊 Database Schema

### events Table
```sql
CREATE TABLE events (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description LONGTEXT NOT NULL,
    date DATE NOT NULL,
    time TIME NOT NULL,
    location VARCHAR(255) NOT NULL,
    max_participants INT DEFAULT 100,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);
```

### registrations Table
```sql
CREATE TABLE registrations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    event_id INT NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20) NOT NULL,
    registered_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE,
    UNIQUE KEY unique_event_email (event_id, email)
);
```

### admin Table
```sql
CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```

---

## 🎨 Technology Stack

- **Backend**: PHP 7.4+ with CodeIgniter 4
- **Database**: MySQL 5.7+
- **Frontend**: Bootstrap 5, HTML5, CSS3, JavaScript
- **Icons**: Font Awesome 6
- **Security**: CSRF Protection, Password Hashing (Bcrypt)

---

## ✨ Key Highlights

### 🔒 Security Features
- ✅ Password hashing with bcrypt
- ✅ CSRF token protection on all forms
- ✅ Session-based authentication
- ✅ Input validation and sanitization
- ✅ SQL injection prevention (prepared statements)

### 📱 Responsive Design
- ✅ Mobile-friendly interface
- ✅ Bootstrap 5 grid system
- ✅ Adaptive navigation
- ✅ Touch-friendly buttons and forms

### 📈 Performance
- ✅ Optimized database queries
- ✅ Proper indexing on tables
- ✅ Efficient controller-model separation
- ✅ Minimal external dependencies

---

## 🧪 Testing the System

### Create Sample Event (as Admin)
1. Login as admin
2. Go to "Manage Events"
3. Click "Create Event"
4. Fill in details:
   - **Title**: "React Workshop"
   - **Description**: "Learn React fundamentals..."
   - **Date**: Pick a future date
   - **Time**: 14:00
   - **Location**: "Tech Center"
   - **Max Participants**: 50
5. Click "Create Event"

### Register as User
1. Go to homepage
2. Click on the newly created event
3. Fill registration form
4. Submit
5. See success message

### Export Participants
1. Login as admin
2. Go to "Participants"
3. Select event from dropdown (optional)
4. Click "CSV", "Excel", or "PDF" button
5. File will download

---

## 🐛 Troubleshooting

### Database Connection Error
- Check if MySQL is running: `brew services list | grep mysql`
- Verify credentials in `.env`
- Ensure database name is `event_system`

### Page Not Found (404)
- Verify `app.baseURL` in `.env` is correct
- Check routes are defined in `app/Config/Routes.php`
- Ensure `.htaccess` is in `public/` folder

### Session/Login Issues
- Clear browser cookies and try again
- Check `app.sessionDriver` in `.env` is set to `FileHandler`
- Verify `writable/` directory exists and has write permissions

### Export Not Working
- Check `writable/` directory permissions
- Verify browser allows downloads
- Try different export format

---

## 📝 Code Examples

### Creating an Event (Controller)
```php
public function store() {
    $eventData = [
        'title' => $this->request->getPost('title'),
        'description' => $this->request->getPost('description'),
        'date' => $this->request->getPost('date'),
        'time' => $this->request->getPost('time'),
        'location' => $this->request->getPost('location'),
        'max_participants' => $this->request->getPost('max_participants'),
    ];

    if ($this->eventModel->validate($eventData)) {
        $this->eventModel->save($eventData);
        return redirect()->to('admin/events')->with('success', 'Event created!');
    } else {
        return redirect()->back()->with('errors', $this->eventModel->errors());
    }
}
```

### Registering a User
```php
public function register($eventId) {
    // Check if email already registered for this event
    if ($registrationModel->isEmailRegisteredForEvent($eventId, $email)) {
        return redirect()->back()->with('error', 'Email already registered');
    }
    
    // Save registration
    $registrationModel->save($registrationData);
    return redirect()->to('/')->with('success', 'Registration successful!');
}
```

---

## 🚀 Future Enhancements

- [ ] Email notifications for registrations
- [ ] Payment gateway integration
- [ ] Event categories and tags
- [ ] User profiles and registration history
- [ ] QR code ticket generation
- [ ] Analytics and reporting
- [ ] Multi-language support
- [ ] Two-factor authentication for admin

---

## 📞 Support

For issues or questions:
1. Check the FAQ section
2. Review error logs in `writable/logs/`
3. Verify database connection
4. Clear browser cache

---

## 📄 License

This project is open source and available for educational and commercial use.

---

## 🙏 Credits

Built with ❤️ using CodeIgniter 4, Bootstrap 5, and modern web technologies.

**Happy Coding! 🎉**
# Event-Managment-System
