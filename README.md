Demo BusinessLogicalBundle
=========================

This is a demo to show how to use the [BusinessLogicalBundle](https://github.com/NicolasJourdan/business-logic-bundle).

Please, feel free to explore the code.

## Load fixtures

In order to test the different endpoints, you can load some fixtures :`bin/console doctrine:fixtures:load`

## Endpoints

|        URI        | Method |        Description        |
|:-----------------:|:------:|:-------------------------:|
|       /users      |   GET  |       Get all users       |
|  /users/christmas |   PUT  |  Run the *christmas* rule |
| /users/new_bettor |   PUT  | Run the *new bettor* rule |

You can import [this file](Demo%20Business%20Logic%20Bundle.postman_collection.json) in postman.
