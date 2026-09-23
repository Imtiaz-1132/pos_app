# POS Management System

## Project Overview

This project is a web-based Point of Sale (POS) Management System developed using **Laravel**.

The system is developed based on the existing **POS360 web application interface (`pos.japan365.co`)**. Screenshots and interface references from the existing system were used as a design and functional reference, and the required pages and features were recreated and implemented in the Laravel application.

The project covers the **Frontend, Backend, Database, Home Dashboard, and Purchase Management** functionality.

### Project Scope

The main objective of this project is to recreate and implement the required POS functionality using:

- Laravel
- PHP
- Blade
- Bootstrap
- JavaScript
- MySQL

The implemented system includes the **Home Dashboard** and the first three Purchase subsections:

1. **Purchase Data Manage**
2. **View Purchase Data**
3. **Purchase Order**

The implementation includes frontend design, backend logic, database integration, forms, CRUD operations, validation, file uploads, searching, filtering, printing, column visibility, and data export functionality.

---

## Reference System

The existing **POS360 web application (`pos.japan365.co`)** was used as the primary interface and functionality reference.

Screenshots of the existing POS system were taken and analyzed to reproduce the required:

- Page layouts
- Navigation structure
- Forms
- Buttons
- Tables
- Filters
- Dropdowns
- Purchase management interfaces
- Purchase order interface
- Print interface
- Export interface

The recreated system is implemented using Laravel rather than directly modifying the existing website.

---

## Technology Stack

### Frontend

- HTML5
- CSS3
- Bootstrap
- JavaScript
- Blade Template Engine

### Backend

- PHP
- Laravel Framework
- Laravel MVC Architecture
- Eloquent ORM

### Database

- MySQL

### Development Tools

- Visual Studio Code
- Composer
- Git
- GitHub
- XAMPP / PHP

---

# Implemented Modules

## 1. Home Dashboard

The Home Dashboard provides the main interface of the POS application.

It includes:

- Main navigation
- POS navigation structure
- Dashboard interface
- Access to Purchase modules
- Access to other POS sections

The dashboard interface was recreated based on screenshots and references from the existing POS360 system.

---

## 2. Purchase Data Manage

The Purchase Data Manage section is used to enter and manage purchase/customer-related information.

### Implemented Fields

- Name
- Gender
- Address
- Telephone
- NID Front
- Date
- Date of Birth
- Email
- Occupation
- NID Back

### Implemented Functionality

- Add Purchase Data
- Save data to MySQL
- View saved data
- Edit data
- Update data
- Delete data
- Form validation
- File upload
- Pagination

### File Upload

NID documents can be uploaded using Laravel's file storage system.

Supported formats:

```text
JPG
JPEG
PNG
PDF