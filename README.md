# Task Manager using laravel & livewire

## Installation

### Here is how you can run the project locally:

### 1. Clone this repo
```bash
git clone https://github.com/abderrahmane140/Tasks-manager.git
```
### 2. Go into the project root directory
```bash
cd Tasks-manager
```

### 3. Copy .env.example file to .env file
```bash
cp .env.example .env
```

### 4. Create database task_manager (you can change database name)

### 5. Go to .env file and set database credentials(DB_DATABASE=task_manager , DB_USERNAME=root, DB_PASSWORD=)

### 6. install PHP dependencies
```bash
composer install
```

### 7. Generate key
```bash
php artisan key:generate
```

### 8. install front-end dependencies
```bash
npm install && npm run build
```

### 9. Run migration
```bash
php artisan migrate
```

### 10. Run seeder
```bash
php artisan db:seed --class=RoleSeeder
```

this command will create 2 users (admin and employee):

email: admin@example.com , password: password
email: employe@example.com , password: password

### 11. Run server
```bash
php artisan serve
```


