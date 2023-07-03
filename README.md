# MaxComply

This is a simple backend application that manages data about vehicles. 

Used technologies:

* PHP 8.2
* Symfony 6.3
* MySQL 8.0
* PHPUnit 9.5

## Brief

Using REST API methodologies there are implemented three endpoints:
1. Endpoint for retrieving all the vehicle makers which are manufacturing a specific type of vehicle
2. Endpoint for retrieving all the technical details of a specific vehicle
3. Endpoint for updating a specific technical parameter of a vehicle

Only authorised request are served. Unauthorised requests are declined with status code ```401 Unauthorized```

Each vehicle can have up to 10 technical parameters.

## Project installation

1. Clone this repository

    ```
    git clone git@github.com:norbibartha/MaxComply.git
    ```

2. Install docker and docker-compose

    ```
    sudo apt-get update
    sudo apt install apt-transport-https ca-certificates curl software-properties-common
    curl -fsSL https://download.docker.com/linux/ubuntu/gpg | sudo apt-key add -
    sudo add-apt-repository "deb [arch=amd64] https://download.docker.com/linux/ubuntu focal stable"
    sudo apt install docker-ce
    sudo usermod -aG docker ${USER}
    sudo apt install docker-compose
    ```

3. Install Make package

    ```
    sudo apt install make
    ```

4. Generate local development environment

    ```
   cd MaxComply
   make dev
   ```

## Useful commands:

#### Run unit tests:

```
make run-unit-tests
```

# Possible improvements

* Add new endpoint for user registration
* ~~Add new endpoint for user login~~ (Done)
* Create new endpoint for adding new vehicles
* Introduce exception handling