# Competition-App

## Instructions

You will need to have **docker** and **docker-compose** installed to successfully run this project locally.
Visit `https://www.docker.com/products/docker-desktop/` to download docker
Follow the steps below to setup the project.

1. Clone the repository to your computer.
2. On your terminal, cd to the project root folder and run `cp .env.example .env` to copy the environment variables.
3. Navigate to the `.env` file and set the neccessary variables.
4. Run `docker-compose up -d webserver` to start up the nginx webserver, php runtime and mysql database containers. Note that docker-compose will attempt to build the image if it hasn't been built already.
5. Run `docker-compose run --rm runtime php artisan migrate` to run database migrations.
6. Run `docker-compose run --rm runtime php artisan db:seed` to seed the database with test competition and athlete.
7. Make a POST request to `http://localhost:{YOUR_APP_PORT}/api/competitions/ddb8610a-cf0d-11ed-afa1-0242ac120002/athlete/      74557280-e509-483e-bdca-d62db74bb24e/start` to mark competition as start.
8. Make a PUT request to `http://localhost:{YOUR_APP_PORT}/api/competitions/ddb8610a-cf0d-11ed-afa1-0242ac120002/athlete/74557280-e509-483e-bdca-d62db74bb24e/finish` to mark competition as finish.
9. Make a GET request to `http://localhost:{YOUR_APP_PORT}/api/competitions/ddb8610a-cf0d-11ed-afa1-0242ac120002/leaderboard` to view leaderboard.
    Note defualt port is `8080` if you do not set `{YOUR_APP_PORT}`
10. The GET leaderboard endpoint will return one result, your can run `docker-compose run --rm runtime php artisan db:seed --class=AddMoreParticipantSeeder` to add 10 more participant
10. To run testcases, run `docker-compose run --rm runtime php artisan test`

**Note**: You can execute php artisan commands inside a container by running `docker-compose exec runtime sh`. This will prevent you from always typing `docker-compose run --rm runtime` to run one-off commands.


## Example 

Example leaderboard response with one participant:  
  `{
    "results": [
        {
            "athlete": "74557280-e509-483e-bdca-d62db74bb24e",
            "position": 1,
            "duration": "11.0"
        }
      ]
    }
  `
  
Example leaderboard response after run add more participant seeder:  
  `{
    "results": [
        {
            "athlete": "74557280-e509-483e-bdca-d62db74bb24e",
            "position": 1,
            "duration": "11.0"
        },
        {
            "athlete": "5227da9c-c06a-4877-8c2c-e273c204b81a",
            "position": 2,
            "duration": "20.0"
        },
        {
            "athlete": "8c24d9b5-7546-4b8d-ab9d-e77a2bc2dff1",
            "position": 3,
            "duration": "25.0"
        },
        {
            "athlete": "bec5da21-32c9-4c18-8542-d8d41a90438d",
            "position": 4,
            "duration": "31.0"
        },
        {
            "athlete": "65c9bdd3-2f78-4050-9ac5-321175c7cbe4",
            "position": 5,
            "duration": "33.0"
        },
        {
            "athlete": "be2c4053-9f0b-4eb2-b54c-9b30c384acd8",
            "position": 6,
            "duration": "37.0"
        },
        {
            "athlete": "c9d87934-a0eb-4430-ae49-13bce3369a65",
            "position": 7,
            "duration": "62.0"
        },
        {
            "athlete": "3ae54bf7-8533-4b60-8a23-f007af21052c",
            "position": 8,
            "duration": "64.0"
        },
        {
            "athlete": "efd76ff4-063a-4a04-a9ba-05680d52cb6c",
            "position": 9,
            "duration": "68.0"
        },
        {
            "athlete": "deec983c-c02d-4c4b-8e56-5d43a92db6ec",
            "position": 10,
            "duration": "76.0"
        },
        {
            "athlete": "52c1f693-2afc-432d-84bc-68f96d80ed68",
            "position": 11,
            "duration": "77.0"
        }
    ]
}
  `