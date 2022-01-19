# Technical assignment full-stack engineer

You’re working on an online shopping platform. The sales team wants to know which items were added to a basket, but removed before checkout. We will use this data later for targeted discounts.

Build a shopping basket that helps you get this data. You are free to use the languages, frameworks and tools you prefer.

**Timing**

You have 1 week to accomplish the assignment. You decide yourself how much time and effort you invest in it, but one of our colleagues tends to say: "Make sure it is good" ;-). Please send us (jobs@madewithlove.com) an email when you are ready with the assignment. Please mention your name, Github username and a link to what we need to review.

#Notes

####Setup steps

Firstly, clone the repo or pull changes if you have it cloned already:
`git clone git@github.com:madewithlove/technical-assignment-full-stack-engineer-iamalminko.git`
or
`git pull`

In the project folder, run the installation of packages:
`composer install`

Create a new databse, in your DB software, named:
`MadeWithLove-Alminko`

Edit .env file (lines 12-16) according to your enviroment:
```DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=8889
DB_DATABASE=MadeWithLove-Alminko
DB_USERNAME=root
DB_PASSWORD=root```

Run migrations for the DB:
`php artisan migrate`

Finally start the server:
`php artisan serve`
and open the link in your browser, for example:
`http://127.0.0.1:8001/`
