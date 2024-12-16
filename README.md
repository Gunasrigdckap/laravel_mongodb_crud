# Laravel MongoDB CRUD Operations

## Overview

This project shows how to perform CRUD (Create, Read, Update, Delete) operations using Laravel and MongoDB.

## Prerequisites

Before you begin, ensure you have the following installed:
- PHP (>=8.0)
- MongoDB installed on your system or cloud instance
- Laravel 10.0

## Installation

1. **Clone the Repository:**
   ```bash
   git clone https://github.com/your-repo/laravel-mongodb-crud.git
   cd laravel-mongodb-crud
   ```

2. **Install Dependencies:**
   ```bash
   composer install

   composer require mongodb/laravel-mongodb:4.0.0
   ```
3. **Update database config**
    - Open config `database.php` and add the MongoDB connection:
```php

 'connections' => [
    'mongodb' => [
        'driver'   => 'mongodb',
        'dsn'      => env('DB_URI'),
        'database' => env('DB_DATABASE'),  
    ],
],
   ```

4. **Set Up Environment Variables:**
   - Rename `.env.example` to `.env`:
     ```bash
       mv .env.example .env
     ```
   - Update your `.env` file with the MongoDB connection details:

     ```env
     DB_CONNECTION=mongodb
     DB_DATABASE=your_database_name
     DB_URI=your_db_uri_string
     ```

## CRUD operations URL

### Create

```
Endpoint: /create
Method: GET
Description: Creates a new document in MongoDB.
```

### Read
```

Endpoint: /find_eloquent
Method: GET
Description: Retrieves documents from MongoDB using Eloquent ORM.
```

### Update
```
Endpoint: /update_eloquent
Method: GET
Description: Updates an existing document in MongoDB.
```


### Delete
```
Endpoint: /delete_eloquent
Method: GET
Description: Deletes a document from MongoDB.
```
## Features

- Full implementation of CRUD operations using MongoDB as the database.
- Supports nested data structures.
