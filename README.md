
# TMP Suggestions

This coding project showcases the hypothetical scenario of moving Suggestions for the TruckersMP project to the Website instead of the forum
## Features
- Authentication used with ability to login and register
- Admin user and normal user provided with seeder
- Ability to create suggestions with both a short and long description
- Relational database used with appropriate foreign key constraints
- Suggestions can be voted on once by each user
- Suggestions can be approved, denied and re-opened by admin users
## Project Setup
Clone the project from GitHub

Run the following commands in order:

```bash
  cp .env.example .env
```
At this point, please create a new schema in MySQL and modify the .env file to point to this database. It is also advised to re-name the App Name to "TMP Suggestions". Following this, please continue to run these commands in order:

```bash
  composer install
```
```bash
  npm install
```
```bash
  npm run build
```
```bash
  php artisan key:generate
```
```bash
  php artisan migrate:fresh --seed
```

You may now access the project by running
```bash
  php artisan serve
```

## Authors

- [Dan Bracey](https://www.github.com/danbracey)


## Running Tests

To run tests, run the following command. Please always seed the database first before running tests.

```bash
  php artisan test
```