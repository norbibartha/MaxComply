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
## Example requests:

#### ```POST /api/login_check```

Request body:
```
{
    "username": "admin@example.com",
    "password": "xxxxxxxxx"
}
```

Response:
```
{
   "token": "xxxxxxxxxxxxx"
}
```

#### ```PATCH /api/vehicles/details/{technicalDetailId}```
Request header:
```
   "Authorization": "Bearer xxxxxxxxxxxxxx"
```
Request body:
```
{
    "value": "250 km/h",
}
```

Response:
```
{
    "id": 1,
    "name": "Top speed",
    "value": "250 km/h"
}
```
#### ```GET /api/vehicles/makers```
Request header:
```
   "Authorization": "Bearer xxxxxxxxxxxxxx"
```

Response:
```
[
    {
        "id": 1,
        "name": "Mazda"
    },
    {
        "id": 2,
        "name": "Land Rover"
    }
]
```

#### ```GET /api/vehicles/{vehicleId}/details```
Request header:
```
   "Authorization": "Bearer xxxxxxxxxxxxxx"
```

Response:
```
[
    {
        "id": 1,
        "name": "Top speed",
        "value": "219 km/h"
    },
    {
        "id": 2,
        "name": "Acceleration 0-100 km/h",
        "value": "6.5s"
    },
    {
        "id": 3,
        "name": "Engine code",
        "value": "SkyActiv-G"
    },
    {
        "id": 4,
        "name": "Engine cubic capacity",
        "value": "1998 cc"
    },
    {
        "id": 5,
        "name": "Fuel consumption",
        "value": "6.9 l/100 km"
    },
    {
        "id": 6,
        "name": "Fuel type",
        "value": "Petrol (Gasoline)"
    },
    {
        "id": 7,
        "name": "Power",
        "value": "184 Hp @ 7000 rpm"
    },
    {
        "id": 8,
        "name": "Torque",
        "value": "205 Nm @ 4000 rpm"
    },
    {
        "id": 9,
        "name": "Engine aspiration",
        "value": "Naturally aspirated engine"
    },
    {
        "id": 10,
        "name": "Weight",
        "value": "1025 kg"
    }
]
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