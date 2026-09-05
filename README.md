# Study Manager
---
> A web-based academic management platform designed to centralize and simplify the management of students, professors, courses, grades, absences, announcements, reports, rooms, and academic communication.

## Overview

`Study Manager` is a web application developed to provide a centralized platform for managing academic activities within an educational institution.

The platform provides different interfaces and functionalities for **administrators, professors, and students**, allowing each role to access the information and operations relevant to them.

The application follows an MVC-inspired architecture, separating:

- Models — database entities and data access
- Controllers — application logic and request handling
- Views — user interfaces
- Core — reusable application infrastructure such as routing, database access, validation, file downloads, and communication

The project also integrates WebSocket communication and Excel file processing for additional functionality.

## Features
### Student Management
- Manage student information
- View student profiles
- Organize students by program and promotion
- Import student information from Excel files
- Access academic information
### Professor Management
- Add and manage professors
- View professor profiles
- Associate professors with courses and modules
- Provide professor-specific interfaces
### Academic Management
- Manage courses
- Manage modules
- Manage academic programs
- Manage promotions
- Manage rooms
- Track academic activities
### Grades Management
- Record and manage student grades
- Access grades through student and professor interfaces
- Organize academic results by course/module
### Attendance Management
- Record student absences
- Consult attendance information
- Manage absence records
### Announcements
- Create announcements
- Publish academic information
- Upload files associated with announcements
- Allow students to access published announcements
### Reports and Documents
- Upload academic reports
- Download documents
- Manage course and report files
- Process Excel files through PHPSpreadsheet
### Communication
- Internal messaging functionality
- Real-time communication using WebSockets
- Dedicated communication infrastructure using Ratchet
- Authentication and Roles

The system provides role-specific interfaces for:

- Administrator
- Professor
- Student

Each role has access to different pages and management operations.

---

## Architecture

The application follows an MVC-inspired architecture:

```text

                    ┌──────────────────────┐
                    │      Web Browser     │
                    │   HTML / CSS / JS    │
                    └──────────┬───────────┘
                               │
                               ▼
                    ┌──────────────────────┐
                    │       Router         │
                    │    App/core/Router   │
                    └──────────┬───────────┘
                               │
                               ▼
                    ┌──────────────────────┐
                    │     Controllers      │
                    │   Business Logic     │
                    └──────────┬───────────┘
                               │
                    ┌──────────┴───────────┐
                    ▼                      ▼
          ┌──────────────────┐   ┌──────────────────┐
          │      Models      │   │      Views       │
          │   Data Access    │   │  User Interface  │
          └────────┬─────────┘   └──────────────────┘
                   │
                   ▼
          ┌──────────────────┐
          │     Database     │
          │      MySQL       │
          └──────────────────┘

                   │
                   ▼
          ┌──────────────────┐
          │     Services     │
          │                  │
          │ WebSockets       │
          │ Excel Processing │
          │ File Management  │
          └──────────────────┘
  ```
---
## Project Structure 
```text
study-manager/
│
├── App/
│   ├── controllers/       # Application controllers
│   ├── models/            # Database models
│   ├── views/             # User interfaces
│   └── core/              # Core application components
│
├── Public/
│   └── static/
│       ├── Css/           # Stylesheets
│       ├── Js/            # JavaScript files
│       └── Images/        # Application images
│
├── Uploads/
│   ├── annonce/           # Announcement attachments
│   ├── cours/             # Course documents
│   ├── media/             # Media files
│   └── rapport/           # Report documents
│
├── Test/
│   └── Etudiant.xlsx      # Example Excel data
│
├── vendor/                # Composer dependencies
│
├── eservice.sql           # Database schema and data
├── composer.json          # PHP dependencies
├── index.php              # Main application entry point
├── server.php             # WebSocket/server entry point
├── .htaccess              # Apache configuration
└── README.md
```
---

## Database

The project includes an SQL database dump:

`eservice.sql`

The database contains the data required by the different modules of the application, including entities related to:

- Users
- Students
- Professors
- Administrators
- Programs
- Promotions
- Modules
- Courses
- Grades
- Absences
- Announcements
- Messages
- Rooms
- Reports

---

## Installation
### Prerequisites

Make sure the following software is installed:

- PHP
- MySQL
- Apache
- Composer
- Git

You can verify your PHP and Composer installations with:
```bash
php --version
composer --version
```

#### 1. Clone the Repository
```bash
git clone https://github.com/your-username/study-manager.git
cd study-manager
```
#### 2. Install PHP Dependencies

Install the dependencies defined in composer.json:
```bash
composer install
```
This will install the required packages into the vendor/ directory.

### 3. Create the Database

Create a MySQL database, then import the provided SQL file:
```bash
mysql -u root -p your_database_name < eservice.sql
```

> Alternatively, you can import eservice.sql using a database management tool such as phpMyAdmin.

#### 4. Configure the Application

Update the database configuration in:

`App/core/config.php`

Configure the appropriate:

Database host
Database name
Database username
Database password

Make sure the configuration matches your local MySQL environment.

---
## Running the Application
Using Apache

Place the project inside your Apache web root, for example:
```text
htdocs/
└── study-manager/
```

Then start Apache and MySQL from your local development environment.

The application can then be accessed through:

http://localhost/study-manager/

The included `.htaccess` file is used to support application routing.

---

## WebSocket Server

The project also contains:

`server.php`

which is used for the application's real-time communication infrastructure.

The WebSocket server can be started according to the configuration implemented in the project.

