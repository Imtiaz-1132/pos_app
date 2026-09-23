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
- Saved Purchase Data
- Add Purchase

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


The POS Management System currently includes the following implemented modules and interfaces:


### 1. Home Dashboard

![Home Dashboard](screenshots/dashboard.png)

The Home Dashboard provides an overview of the POS system, including sales, purchases, products, customers, quick actions, system status, and recent purchases.

---

### 2. Purchase Data Manage

![Purchase Data Manage](screenshots/purchase-data-manage.png)

The Purchase Data Manage page provides an information entry form for managing purchase/customer-related information, including personal details, contact information, date information, and NID documents.

---

### 3. Saved Purchase Data

![Saved Purchase Data](screenshots/saved-purchase-data.png)

The Saved Purchase Data page displays previously stored records in a table with options to view NID documents, view records, edit information, and delete records.

---

### 4. View Purchase Data

![View Purchase Data](screenshots/view-purchase-data.png)

The View Purchase Data page provides purchase record management with reference-number search, supplier information, purchase date, payment status, total amount, paid amount, and due amount.

---

### 5. Purchase Order

![Purchase Order](screenshots/purchase-order.png)

The Purchase Order page provides filtering by business location, status, shipping status, date range, and supplier. It also includes search, export, print, column visibility, and purchase order management functionality.

---

### 6. Add Purchase

![Add Purchase](screenshots/add-purchase.png)

The Add Purchase page provides a purchase information entry interface with customer details, date information, contact information, occupation, and NID document upload functionality.

---

### 7. POS Home / Sales Interface
![POS Home / Sales Interface](screenshots/home_pos.png)

The POS Home / Sales Interface provides the main sales and transaction screen of the system. It includes customer selection, product search, category and brand filtering, product listing, cart management, payment options, and transaction controls.

---

### 8. NID Document View

![NID Document View](screenshots/nid_view.png)

The system provides a document viewing feature for uploaded NID documents. Users can access and view the uploaded NID document directly from the purchase data interface.

---

## 9. Purchase Order CSV Export

![Purchase Order CSV Export](screenshots/purchase-order_CSV.png)

The Purchase Order module includes a CSV export feature that allows purchase order data to be exported for further processing and record keeping.

---