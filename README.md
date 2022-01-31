# Technical assignment full-stack engineer

You’re working on an online shopping platform. The sales team wants to know which items were added to a basket, but removed before checkout. We will use this data later for targeted discounts.

Build a shopping basket that helps you get this data. You are free to use the languages, frameworks and tools you prefer.

**Timing**

You have 1 week to accomplish the assignment. You decide yourself how much time and effort you invest in it, but one of our colleagues tends to say: "Make sure it is good" ;-). Please send us (jobs@madewithlove.com) an email when you are ready with the assignment. Please mention your name, Github username and a link to what we need to review.

## Setup steps

- Clone the repository with __git clone__
- Copy __.env.example__ file to __.env__ and edit database credentials there
- Create a new database, in your DB software (suggested name: `FixForm-Alminko`)
- Import the db file `RootDir\FixForm-Alminko.db` into your MySQL DB software (The file is an SQL type)
- Run __composer install__
- Run __php artisan key:generate__
- (Skip if you imported the SQL DB file) Run __php artisan migrate__
- Run __npm install__
- Run __npm run dev__
- Run __php artisan serve__
- That's it: launch the main URL, ex. __http://127.0.0.1:8000/__

## Implementation table

|        | Page      | Endpoint      | Info                                                                                                                                                                            |   |
|--------|-----------|---------------|---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------|---|
| <ul><li>[x] </li></ul>| Login     | /login        | If you imported DB, use alm@fixform.com:12345678 to log in.                                                                                                                        |   |
| <ul><li>[x] </li></ul>| Register  | /register     | Registration by default creates a customer-level-user.  Manually change level in the DB to 1 to be able to set  discounts in the /dashboard.                                    |   |
| <ul><li>[x] </li></ul>| Home      | /             | Number of items in the cart (top right) is dynamic according  to the DB. 'On Sale' section shows first products that have  been previously deleted by the user before checkout. |   |
| <ul><li>[x] </li></ul>| Shop      | /shop         | Products from the database are displayed.  It is possible to add them to the cart                                                                                               |   |
| <ul><li>[x] </li></ul>| Cart      | /cart         | See your cart. Change the amount or remove products.                                                                                                                            |   |
| <ul><li>[x] </li></ul>| Dashboard | /dashboard    | Salesman dashboard. Discount can be changed for all products.                                                                                                                   |   |
| <ul><li>[ ] </li></ul>| Checkout  | /checkout     |                                                                                                                                                                                 |   |
| <ul><li>[ ] </li></ul>| Details   | /details/{id} | Display details and reviews of a single product.        


## Tests

There is a couple of tests for the FrontEnd:

Run __php artisan test__
