# Laravel Todo App — Rwanda Build Backend Task

A simple per-user Todo application built with Laravel and Blade.  
Users can authenticate, then create, view, update, delete, and complete **only their own** todos.

---

## Features (Task Requirements)

 Authentication (Laravel Fortify starter kit)  
 Users can only manage their own todos (policies + per-user queries)  
 Todo fields:
- `title` (required)
- `description` (optional)
- `due_date` (required)
- `is_completed` (boolean)
- `completed_at` (timestamp)

 Mark todo as completed  
 Show when a todo was completed  
 CRUD routes + completion route  
 Blade pages for all UI views  
 Validation errors displayed in forms  
 Backend tests (Pest)

---

## Tech Stack
- Laravel (Starter Kit: Blade + Livewire)
- Blade Templating
- PostgreSQL
- Pest for testing

---

## Setup Instructions

### 1) Clone repository
```bash
git clone <YOUR_GITHUB_REPO_URL>
cd todo-app
```
### 2) Install dependencies
```bash
composer install
npm install
npm run build
```
### 3) Environment setup
```bash
cp .env.example .env
php artisan key:generate
```
### 4) Run migrations
```bash
php artisan migrate
```
### 5) Start the app
```bash
php artisan serve
```
- **Register:** http://127.0.0.1:8000/register  
- **Login:** http://127.0.0.1:8000/login  
- **Todos:** http://127.0.0.1:8000/todos

---

## Routes

| Method | Route                        | Description                          |
|--------|------------------------------|--------------------------------------|
| GET    | `/todos`                     | List logged-in user's todos          |
| GET    | `/todos/create`              | Show create form                     |
| POST   | `/todos`                     | Store new todo                       |
| GET    | `/todos/{todo}/edit`         | Show edit form                       |
| PUT    | `/todos/{todo}`              | Update todo                          |
| DELETE | `/todos/{todo}`              | Delete todo                          |
| PATCH  | `/todos/{todo}/complete`     | Mark todo as completed               |

---

## Tests

```bash
php artisan test
```


