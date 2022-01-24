# Technical assignment full-stack engineer

You’re working on an online shopping platform. The sales team wants to know which items were added to a basket, but removed before checkout. We will use this data later for targeted discounts.

Build a shopping basket that helps you get this data. You are free to use the languages, frameworks and tools you prefer.

**Timing**

You have 1 week to accomplish the assignment. You decide yourself how much time and effort you invest in it, but one of our colleagues tends to say: "Make sure it is good" ;-). Please send us (jobs@madewithlove.com) an email when you are ready with the assignment. Please mention your name, Github username and a link to what we need to review.

## Setup steps

Firstly, clone the repo or pull changes if you have it cloned already:

```bash
git clone git@github.com:madewithlove/technical-assignment-full-stack-engineer-iamalminko.git
```

or

```bash
git pull
```

In the project folder, run the installation of packages:

```bash
composer install
```

Create a new databse, in your DB software (suggested name: `FixForm-Alminko`)

Edit .env file (lines 12-16) according to your enviroment:
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=8889
DB_DATABASE=FixForm-Alminko
DB_USERNAME=root
DB_PASSWORD=root
```

Import the db file `RootDir\FixForm-Alminko.db` into your MySQL DB software (The file is an SQL type)
After the import you should have the tables created and some records in the tables.

Finally start the server:
```bash
php artisan serve
```
and open the link in your browser, for example:
`http://127.0.0.1:8001/`


|        | Page      | Endpoint      | Info                                                                                                                                                                            |   |
|--------|-----------|---------------|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|---|
| <ul><li>[x] </li></ul>| Login     | /login        | After DB import, use alm@fixform.com:12345678 to log in.                                                                                                                        |   |
| <ul><li>[x] </li></ul>| Register  | /register     | Registration by default creates a customer-level-user.  Manually change level in the DB to 1 to be able to set  discounts in the /dashboard.                                    |   |
| <ul><li>[x] </li></ul>| Home      | /             | Number of items in the cart (top right) is dynamic according  to the DB. 'On Sale' section shows first products that have  been previously deleted by the user at the checkout. |   |
| <ul><li>[x] </li></ul>| Shop      | /shop         | Products from the database are displayed.  It is possible to add them to the cart                                                                                               |   |
| <ul><li>[x] </li></ul>| Cart      | /cart         | See your cart. Change the amount or remove products.                                                                                                                            |   |
| <ul><li>[x] </li></ul>| Dashboard | /dashboard    | Salesman dashboard. Discount can be changed for all products.                                                                                                                   |   |
| <ul><li>[] </li></ul>| Checkout  | /checkout     |                                                                                                                                                                                 |   |
| <ul><li>[] </li></ul>| Details   | /details/{id} | Display details and reviews of a single product.        