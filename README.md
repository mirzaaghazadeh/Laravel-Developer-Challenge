# Laravel Developer Challenge

A comprehensive challenge system designed to test senior Laravel developers' skills in PHP, Laravel framework, and advanced web development concepts.

**Created by Navid Mirzaaghazadeh** | [GitHub](https://github.com/mirzaaghazadeh)

## 🎯 Overview

This challenge system evaluates senior Laravel developers through practical coding challenges. Candidates must find and fix bugs, optimize code, and solve problems to capture hidden flags within a 30-minute time limit.

## 📋 Challenge Structure

### Level 1: PHP Logic & Debugging
- Array Function Fix
- String Manipulation
- Factorial Function
- Caesar Cipher

### Level 2: Laravel API & Database
- API Validation
- Database Query Optimization
- Cache Strategy
- API Response Structure
- Relationship Query
- Middleware Security

### Level 3: Advanced Laravel
- Queue Job Implementation
- Event System
- Collection Operations
- Service Container
- Testing
- Query Builder
- Middleware Pipeline

## 🚀 Quick Start

### Prerequisites
- PHP 8.2+
- Composer
- Laravel 12.0+
- MySQL/PostgreSQL/SQLite

### Installation

1. **Clone the repository**
```bash
git clone https://github.com/mirzaaghazadeh/Laravel-Developer-Challenge
cd Laravel-Developer-Challenge
```

2. **Install dependencies**
```bash
composer install
npm install
```

3. **Environment setup**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Database setup**
```bash
php artisan migrate
php artisan db:seed
```

5. **Build assets**
```bash
npm run build
```

6. **Start the application**
```bash
php artisan serve
```

7. **Access the challenge**
```
http://localhost:8000
```

## 🎮 How to Complete Challenges

1. **Start the Challenge**: Navigate to `http://localhost:8000`
2. **Choose a Level**: Start with Level 1, then progress to higher levels
3. **Solve Challenges**: 
   - Read the problem description
   - Analyze the broken code
   - Identify and fix the issues
   - Test your solution
4. **Find Flags**: Flags are hidden in console outputs, API responses, web page content, and success messages
5. **Submit Flags**: Use the flag submission form to verify your solutions

## 🔍 Flag System

- Each challenge has a unique encrypted flag
- Flags are revealed when challenges are solved correctly
- Format: `FLAG_X_CHALLENGENAME_XXXXXXXX`
- X represents the level (1, 2, or 3)
- XXXXXXXX is a unique hash

## 📁 Project Structure

```
app/
├── Challenges/
│   ├── Level1/
│   ├── Level2/
│   └── Level3/
├── Http/Controllers/Challenges/
├── Jobs/
├── Events/
├── Services/
└── Models/

resources/views/challenges/
├── level1/
├── level2/
├── level3/
├── dashboard.blade.php
├── progress.blade.php
└── index.blade.php

database/
├── migrations/
└── seeders/
```

## 🧪 Testing

```bash
# Run all tests
php artisan test

# Run specific test
php artisan test --filter ChallengeTest
```

## 🔧 Configuration

### Environment Variables
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_challenge
DB_USERNAME=root
DB_PASSWORD=

CACHE_DRIVER=file
QUEUE_CONNECTION=sync

APP_ENV=local
APP_DEBUG=true
```

## 🚨 Troubleshooting

### Common Issues

1. **Migration Errors**
```bash
php artisan migrate:fresh
php artisan db:seed
```

2. **Cache Issues**
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
```

3. **Queue Problems**
```bash
php artisan queue:work
```

4. **Asset Issues**
```bash
npm install
npm run build
php artisan storage:link
```

## 📄 License

This project is licensed under the MIT License.

---

**Good luck with the challenges!** 🎉
