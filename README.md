# Project Setup Guide

This guide outlines the steps to set up the project on your local environment.

## Requirements

Before starting, ensure you have the following software installed on your system:

- Node.js version 20.10
- Docker Compose version 2.23
- PHP version 8.3
- Composer version 2.7.2

## Setup Steps

1. **Clone the Repository:**
   ```
   git clone [repository-url]
   ```

2. **Navigate to the Project Directory:**
   ```
   cd [project-directory]
   ```

3. **Navigate to Symfony Backend:**
   ```
   cd symfony_backend
   ```

4. **Install Composer Dependencies:**
   ```
   composer install
   ```

5. **Build Docker Containers:**
   ```
   docker-compose build --no-cache
   ```

6. **Start Docker Containers:**
   ```
   docker-compose up --pull always -d --wait
   ```

7. **Create Databases:**
   ```
   bin/console doctrine:database:create
   bin/console doctrine:database:create --env=test
   ```

8. **Run Database Migrations:**
   ```
   bin/console doctrine:migrations:migrate
   bin/console doctrine:migrations:migrate --env=test
   ```

9. **Navigate to Vue Frontend:**
   ```
   cd ../vue_frontend
   ```

10. **Install Yarn Dependencies:**
    ```
    yarn install
    ```

11. **Run Vue.js Development Server:**
    ```
    npm run dev
    ```

After accepting insecure connections to localhost, you should be able to access the application in your browser at `localhost:5173`.

## Running Tests

- **Backend Tests:**
  Navigate to `symfony_backend` and run:
  ```
  bin/phpunit
  ```

- **Frontend Tests:**
  Navigate to `vue_frontend` and run:
  ```
  npm run test:unit
  ```
