
# Simple Domain Ownership Verification

Simple laravel project uses TXT records of Domain and php functionality for authenticate users domains that registered in system.
Project needs php>=5.6.4 and 5.5 and above versions of laravel.project uses jwt for authenticating users.the package used is `tymon/jwt-auth`
## Installation

Simply clone project and install requirements via:
```
composer install
```

Create DB tables with artisan command:
```
php artisan migrate
```

## Getting start
At first you should register via url:
>api/register

After registration and taking token,you can call below url with POST method for submitting your domain:
>api/domains

Then you will take your hash key should put in TXT DNS records and after that you can call url with GET method to verify your domain:
>api/domains/{domain_url}/auth

Also authenticated users can see their urls and statuses with below url and GET method:
>api/domains

## TODO
- Write Tests
- Add More efficient model data retrieve

## Contributing
Contributions, useful comments, and feedback are most welcome!