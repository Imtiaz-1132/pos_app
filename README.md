# POS Management System

A web-based **Point of Sale (POS) Management System** developed using **Laravel, PHP, Blade, Bootstrap, JavaScript, and MySQL**.

The project is developed by recreating the required interface and functionality of the existing **POS360 web application (`pos.japan365.co`)**. Screenshots and the existing system were used as references to understand the layout, navigation, forms, tables, purchase management workflow, and other required functionalities.

The system includes the **Home Dashboard** and the first three Purchase modules with frontend, backend, database integration, CRUD operations, validation, file upload, search, filtering, printing, column visibility, and export functionality.

---

## Project Overview

The main objective of this project is to recreate and implement selected POS360 functionalities as an independent Laravel application.

### Implemented Areas

- Home Dashboard
- Purchase Data Manage
- View Purchase Data
- Purchase Order

The project follows the **Laravel MVC architecture** and uses **MySQL** for persistent data storage.

---

## Reference System

The existing **POS360 web application (`pos.japan365.co`)** was used as the primary design and functionality reference.

Screenshots of the existing system were captured and analyzed to recreate:

- Dashboard layout
- Sidebar navigation
- Top navigation bar
- Purchase management pages
- Information entry forms
- Data tables
- Search functionality
- Filtering system
- Dropdown menus
- Action buttons
- Purchase order interface
- Print interface
- Column visibility controls
- CSV/Excel/PDF export interfaces

The application was independently implemented using Laravel rather than modifying the original POS360 system.

---

# Technology Stack

## Frontend

- HTML5
- CSS3
- Bootstrap
- JavaScript
- Blade Template Engine

## Backend

- PHP
- Laravel Framework
- Laravel MVC Architecture
- Eloquent ORM

## Database

- MySQL
- Laravel Migrations
- Database CRUD Operations

## Development Tools

- Visual Studio Code
- Composer
- Git
- GitHub
- XAMPP
- PHP

---

# Implemented Modules

## 1. Home Dashboard

The Home Dashboard provides the main interface of the POS application.

### Implemented Features

- POS dashboard layout
- Sidebar navigation
- Top navigation bar
- Purchase module navigation
- Quick action section
- Sales and purchase summary cards
- Product and customer summary
- System overview section
- Recent purchase section
- Navigation to purchase management modules

The dashboard interface was recreated based on the reference screenshots and POS360 interface.

---

# 2. Purchase Data Manage

The **Purchase Data Manage** module is used to enter and manage customer/purchase-related information.

## Information Entry Form

The form includes:

- Name
- Gender
- Address
- Telephone
- Date
- Date of Birth
- Email Address
- Occupation
- NID Front Photo
- NID Back Photo

## Implemented Functionality

- Add new purchase data
- Save information to MySQL
- View saved purchase data
- Edit existing records
- Update records
- Delete records
- Form validation
- File upload
- NID document management
- Database integration
- Saved data listing
- Action buttons for view, edit, and delete

## File Upload

The system supports uploading NID documents through Laravel's file handling system.

Supported file types include:

```text
JPG
JPEG
PNG
PDF