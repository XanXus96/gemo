# Backend Coding Challenge

My submission to the backend coding challenge proposed by Gemography

## Requirements

* locally:
    - php >= 7.2.5
    - composer

* on container:
    - make
    - docker
    - docker-compose

## Install the app

* locally:
     `composer install`

* on container:
     `make install`

## Run the app

* locally:
     `php artisan serve`

* on container:
     `make run`

## Stop the app

* locally:
    Ctrl+c

* on container:
     `make stop`

## ENDPOINTS

**List of the languages used by the 100 trending public repos on GitHub**
----
  This endpoint lists the languages used by the 100 trending public repos on GitHub on the last 30 days by default.
  For every language, we have the number of repos using this language and the list of repos using the language

* **URL**

  /api/top

* **Method:**
  

  `GET`
  
*  **URL Params**


   **Optional:**
 
    date : date from where the repositories are created after
    
    
   `date=[datetime:{format:'Y-m-dTH:i:sZ'}]`

* **Success Response:**

  * **Code:** 200 <br />
    **Content:** 
    ```json
    {
        "total": 19,
        "items": {
            "JavaScript": {
                "total": 23,
                "items": [
                    {
                        "id": 245438989,
                        "node_id": "MDEwOlJlcG9zaXRvcnkyNDU0Mzg5ODk=",
                        "name": "core",
                        "full_name": "JAVClub/core",
                        "private": false,
                        "owner": {
                            "login": "JAVClub",
                            ...
                        },
                        "html_url": "https://github.com/JAVClub/core",
                        ...
                    },
                    ...
                ]
            },
            ...
        }
    }
    ```
 
* **Error Response:**

  * **Code:** 422 UNPROCESSABLE ENTRY <br />
    **Content:** 
    ```json
    {
    "date": [
            "The date does not match the format Y-m-d\\TH:i:s\\Z.",
            "The date must be a date before or equal to {current datetime}."
        ]
    }
    ```

  OR

  * **Code:** 4xx CLIENT ERROR or 5xx SERVER ERROR <br />
    **Content:** 
    ```json
    { "error" : "Client or Server Error encountered" }
    ```

* **Sample Call:**

  ```bash
  curl --location --request GET 'http://localhost:8000/api/top'

  curl --location --request GET 'http://localhost:8000/api/top?date=2020-01-01T00:00:00Z'
  ```

<!-- * **Notes:**

  <i>empty</i>  -->
