# Competition-leaderboard

## Instructions

You'll need to have **docker** and **docker-compose** installed to successfully run this project locally.
Follow the steps below to setup the project.

1. Clone the repository to your computer.
2. On your terminal, cd to the project root folder and run `cp .env.example .env` to copy the environment variables.
3. Navigate to the `.env` file and set the neccessary variables.
4. Run `docker-compose up -d webserver` to start up the nginx webserver, php runtime and mysql database containers. Note that docker-compose will attempt to build the image if it hasn't been built already.
5. Run `docker-compose run --rm runtime php artisan migrate` to run database migrations.
6. Run `docker-compose run --rm runtime php artisan db:seed` to seed the database with test products.
7. Visit `http://localhost:{YOUR_APP_PORT}/api/inventory/products` to see the products list.
8. To run testcases, run `docker-compose run --rm runtime php artisan test`

**Note**: You can execute php artisan commands inside a container by running `docker-compose exec runtime sh`. This will prevent you from always typing `docker-compose run --rm runtime` to run one-off commands.

## Description
We want you to implement a REST API endpoint that given a list of products, applies some
discounts to them and can be filtered.
You are free to choose whatever language and tools you are most comfortable with, but, we value you to use laravel since our main platform is also on laravel / php.
We will value your ability to apply the following rules on the corresponding layers following Domain Driven Design. 
Please add instructions on how to run it and publish it on your fork.

## Deliverable 

Fork the project, work on the solution and send us back a link to your forked GitHub project to examine your answer to this test.

## Conditions 


The prices are integers for example, 100.00€ would be 10000.
  
1. [x] You can store the products as you see fit (json file, in memory, rdbms of choice)
2. [x] Products in the "insurance" category have a 30% discount.
3. [x] The product with sku = 000003 has a 15% discount.
4. [x] Provide a single endpoint. GET /products.
5. [x] Can be filtered by category as a query string parameter.
6. [x] (optional) Can be filtered by price as a query string parameter, this filter applies before discounts are applied.
7. [x] Returns a list of Products with the given discounts applied when necessary Product model.
8. [x] price.currency is always EUR.
9. [x] When a product does not have a discount, price.final and price.original should be the same number and discount_percentage should be null.
10. [x] When a product has a discount, price.original is the original price, price.final is the amount with the discount applied and discount_percentage represents the applied discount with the % sign.

Example product with a discount of 30% applied:  
`    {
      "sku": "000001",
      "name": "Full coverage insurance",
      "category": "insurance",
      "price": {
          "original": 89000,
          "final": 62300,
          "discount_percentage": "30%",
          "currency": "EUR"
      }
    }`
  
  Example product without a discount:
  
      `{
        "sku": "000002",
        "name": "Compact Car X3",
        "category": "vehicle",
        "price": {
            "original": 89000,
            "final": 89000,
            "discount_percentage": null,
            "currency": "EUR"
        }
      }`
      
## Dataset.       
The following dataset is the only dataset you need to be able to serve on the API: 

`{
    "products": [
      {
        "sku": "000001",
        "name": "Full coverage insurance",
        "category": "insurance",
        "price": 89000
      },
      {
        "sku": "000002",
        "name": "Compact Car X3",
        "category": "vehicle",
        "price": 99000
      },
      {
        "sku": "000003",
        "name": "SUV Vehicle, high end",
        "category": "vehicle",
        "price": 150000
      },
      {
        "sku": "000004",
        "name": "Basic coverage",
        "category": "insurance",
        "price": 20000
      },
      {
        "sku": "000005",
        "name": "Convertible X2, Electric",
        "category": "vehicle",
        "price": 250000
      }
    ]
  }`