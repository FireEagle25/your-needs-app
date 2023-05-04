# Readme

This project is a simple CRUD application for managing books and authors built using the Laravel framework. It implements RESTful APIs for accessing and manipulating data and includes a simple web-based interface for managing authors and books.

## Requirements

PHP >= 7.4
MySQL or MariaDB
Composer
## Installation

1. Clone the repository:
git clone https://github.com/username/repo.git

2. Navigate to the project directory:
cd your-needs-app

3. Install the dependencies:
composer install

4. Create a copy of the .env.example file and name it .env:
cp .env.example .env

5. Generate a new application key:
php artisan key:generate

6. Configure your database settings in the .env file:
DB_HOST=your_database_host
DB_PORT=your_database_port
DB_DATABASE=your_database_name
DB_USERNAME=your_database_username
DB_PASSWORD=your_database_password

7. Run the database migrations and seeders:
php artisan migrate --seed

8. Start the development server:
Copy code
php artisan serve
## Usage

### RESTful APIs
The following endpoints are available for accessing and manipulating data:

#### Authors

GET /api/authors - Get a list of authors
GET /api/authors/{id} - Get an author by ID
POST /api/authors - Create a new author
PUT /api/authors/{id} - Update an existing author
DELETE /api/authors/{id} - Delete an author
#### Books

GET /api/books - Get a list of books
GET /api/books/{id} - Get a book by ID
POST /api/books - Create a new book
PUT /api/books/{id} - Update an existing book
DELETE /api/books/{id} - Delete a book

### Validation

All input data is validated before being stored in the database or returned as a response. Validation rules are defined in the app/Http/Requests directory.

### Seeder

A seeder is provided to populate the database with test data. To run the seeder, use the following command:
php artisan db:seed
