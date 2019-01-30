# KW - Test

A test from Keller Williams

# Get Started

## Serving Application

`php -S localhost:8000 -t public`

## Unit Test

`vendor/bin/phpunit --filter=testShouldReturnAllChecklists`

## Authentication

### Register

Simply post this form encode to /register

```
email:jeremy@gmail.com
password:jeremi11
name:Jeremy
```

### Login

Set header to bearer token and use token from api_key login
