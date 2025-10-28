# About webkit api

This is a plain webkit that has security configured only.

### GrumPHP:Tasks
- PHPstan: Static code analysis, finds bugs
- PHPUnit: Runs tests, checks assertions

### GrumPHP:Purpose
<p>GrumPHP ensures that all checks and tests pass before a developer can commit code. If the checks succeed, the developer is allowed to push to the repository. Otherwise, the push is blocked to maintain code quality</p>

### Setup Application
Install the composer
```
composer install
```

create .env
```
cp .env.example .env
```
<p>or</p>
<p>Manually create .env file and copy paste the content of the file .env.example to .env file that you just created.</p>

Run:
```
php artisan app:init
```
Create Admin user
```
php artisan user:create
```


