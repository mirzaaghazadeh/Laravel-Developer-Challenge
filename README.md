# Laravel Developer Challenge

A comprehensive 3-level challenge system designed to test senior Laravel developers' skills in PHP, Laravel framework, and advanced web development concepts.

## 🎯 Overview

This challenge system is designed to evaluate senior Laravel developers through practical, hands-on coding challenges. Candidates must find and fix bugs, optimize code, and solve problems to capture hidden flags within a 30-minute time limit.

## 📋 Challenge Structure

### Level 1: PHP Logic & Debugging (4 Challenges)
- **Array Function Fix**: Debug broken array manipulation
- **String Manipulation**: Fix string processing logic
- **Factorial Function**: Resolve recursive function issues
- **Caesar Cipher**: Fix mixed-case decoding

### Level 2: Laravel API & Database (6 Challenges)
- **API Validation**: Fix validation rules and logic
- **Database Query**: Optimize N+1 query problems
- **Cache Strategy**: Implement proper caching
- **API Response**: Fix pagination structure
- **Relationship Query**: Optimize Eloquent queries
- **Middleware Security**: Fix security implementation

### Level 3: Advanced Laravel (7 Challenges)
- **Queue Job**: Implement async processing
- **Event System**: Fix event/listener architecture
- **Collection Operations**: Advanced collection manipulation
- **Service Container**: Dependency injection issues
- **Testing**: Write proper assertions
- **Query Builder**: Complex database operations
- **Middleware Pipeline**: Advanced middleware implementation

## 🚀 Quick Start

### Prerequisites
- PHP 8.2+
- Composer
- Laravel 12.0+
- MySQL/PostgreSQL/SQLite

### Installation

1. **Clone the repository**
```bash
git clone <repository-url>
cd laravel_problem
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

### For Candidates

1. **Start the Challenge**: Navigate to `http://localhost:8000`
2. **Choose a Level**: Start with Level 1, then progress to Level 2 and 3
3. **Solve Challenges**: 
   - Read the problem description
   - Analyze the broken code
   - Identify and fix the issues
   - Test your solution
4. **Find Flags**: Flags are hidden in:
   - Console outputs
   - API responses
   - Web page content
   - Success messages
5. **Submit Flags**: Use the flag submission form to verify your solutions

### For Evaluators

1. **Monitor Progress**: Watch the candidate's approach to problem-solving
2. **Evaluate Skills**: Assess:
   - Debugging techniques
   - Laravel framework knowledge
   - Code optimization skills
   - Security awareness
   - Testing knowledge
3. **Time Management**: 30-minute time limit for all challenges
4. **Flag Verification**: Each successful solution reveals a unique flag

## 🔍 Challenge Details

### Flag System
- Each challenge has a unique encrypted flag
- Flags are revealed when challenges are solved correctly
- Format: `FLAG_X_CHALLENGENAME_XXXXXXXX`
- X represents the level (1, 2, or 3)
- XXXXXXXX is a unique hash

### Evaluation Criteria

#### Level 1 (Beginner - 15 minutes expected)
- Basic PHP syntax and logic
- Debugging simple functions
- Understanding of string/array operations

#### Level 2 (Intermediate - 10 minutes expected)
- Laravel framework knowledge
- Database optimization
- API design principles
- Security best practices

#### Level 3 (Advanced - 5 minutes expected)
- Advanced Laravel concepts
- Architecture patterns
- Performance optimization
- Testing strategies

## 🛠️ Technical Implementation

### Architecture
- **MVC Pattern**: Controllers, Models, Views
- **Service Layer**: Business logic separation
- **Event System**: Laravel events and listeners
- **Queue System**: Asynchronous job processing
- **Cache Layer**: Performance optimization

### Security Features
- **Encrypted Flags**: Laravel's encryption system
- **Input Validation**: Proper request validation
- **SQL Injection Prevention**: Eloquent ORM usage
- **XSS Protection**: Blade templating auto-escaping

### Monitoring
- **Flag Submission Logs**: Track all flag attempts
- **Performance Metrics**: Query counting and timing
- **Error Handling**: Comprehensive error reporting

## 📁 Project Structure

```
app/
├── Challenges/
│   ├── Level1/
│   │   └── PHPLogicChallenge.php
│   ├── Level2/
│   │   └── LaravelAPIChallenge.php
│   └── Level3/
│       └── AdvancedLaravelChallenge.php
├── Http/Controllers/Challenges/
│   ├── Level1Controller.php
│   ├── Level2Controller.php
│   ├── Level3Controller.php
│   └── ChallengeController.php
├── Jobs/
│   └── ProcessDataJob.php
├── Events/
│   └── DataProcessedEvent.php
├── Services/
│   ├── FlagService.php
│   └── DataProcessingService.php
└── Models/
    └── Challenge.php

resources/views/challenges/
├── layouts/
│   └── challenge.blade.php
├── level1/
│   └── index.blade.php
├── level2/
│   └── index.blade.php
├── level3/
│   └── index.blade.php
├── dashboard.blade.php
├── progress.blade.php
└── index.blade.php

database/
├── migrations/
│   └── 2024_01_01_000000_create_challenges_table.php
└── seeders/
    ├── ChallengeSeeder.php
    └── DatabaseSeeder.php
```

## 🧪 Testing

### Running Tests
```bash
# Run all tests
php artisan test

# Run specific test
php artisan test --filter ChallengeTest

# Generate coverage report
php artisan test --coverage
```

### Challenge Testing
Each challenge endpoint can be tested directly:

```bash
# Level 1 - Array Challenge
curl -X POST http://localhost:8000/level1/array \
  -H "Content-Type: application/json" \
  -d '{"numbers":[1,2,3,4,5,6,7,8,9,10]}'

# Level 2 - Validation Challenge
curl -X POST http://localhost:8000/level2/validation \
  -H "Content-Type: application/json" \
  -d '{"name":"Test","email":"test@example.com","age":25}'

# Level 3 - Queue Challenge
curl -X POST http://localhost:8000/level3/queue \
  -H "Content-Type: application/json" \
  -d '{"data":{"test":"payload"}}'
```

## 🔧 Configuration

### Environment Variables
```env
# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_challenge
DB_USERNAME=root
DB_PASSWORD=

# Cache
CACHE_DRIVER=file
QUEUE_CONNECTION=sync

# Application
APP_ENV=local
APP_DEBUG=true
APP_KEY=base64:...
```

### Queue Configuration
For production use, configure a proper queue driver:
```env
QUEUE_CONNECTION=redis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

## 📊 Monitoring & Analytics

### Flag Submission Tracking
All flag submissions are logged with:
- Challenge ID
- Submitted flag
- Timestamp
- Success/failure status
- IP address

### Performance Metrics
- Query execution time
- Memory usage
- Response times
- Error rates

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
php artisan queue:failed-table
```

4. **Asset Issues**
```bash
npm install
npm run build
php artisan storage:link
```

### Debug Mode
Enable debug mode in `.env`:
```env
APP_DEBUG=true
LOG_LEVEL=debug
```

## 🤝 Contributing

1. Fork the repository
2. Create a feature branch
3. Add your challenge
4. Update documentation
5. Submit a pull request

### Adding New Challenges

1. Create challenge class in appropriate level folder
2. Add controller method
3. Create view components
4. Add routes
5. Update seeder
6. Add tests

## 📄 License

This project is licensed under the MIT License - see the LICENSE file for details.

## 🆘 Support

For questions or issues:
- Check the troubleshooting section
- Review the logs in `storage/logs/laravel.log`
- Verify environment configuration
- Ensure all dependencies are installed

---

**Good luck with the challenges!** 🎉

Remember: The goal is not just to find the flags, but to demonstrate your understanding of Laravel best practices, debugging skills, and problem-solving abilities.
