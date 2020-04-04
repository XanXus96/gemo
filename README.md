# Backend Coding Challenge

My submission to the backend coding challenge proposed by Gemography

## Requirements

* locally:
    - php >= 7.2.5
    - composer
<br />
* on container:

    - make
    - docker
    - docker-compose

## Install the app

* locally:
    - composer install
<br />
* on container:

    - make install

## Run the app

* locally:
    - php artisan serve
<br />
* on container:

    - make run

## Stop the app

* locally:
    - Ctrl+c
<br />
* on container:

    - make stop

## ENDPOINTS

**List of the languages used by the 100 trending public repos on GitHub**
----
  This endpoint lists the languages used by the 100 trending public repos on GitHub.
  For every language, we have the number of repos using this language and the list of repos using the language

* **URL**

  /api/top

* **Method:**
  

  `GET`
  
*  **URL Params**


   **Optional:**
 
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

  * **Code:** 422 UNPROCESSABLE ENTRY
    **Content:** 
    ```json
    { "error" : "Email Invalid" }
    ```

  OR

  * **Code:** 4xx CLIENT ERROR or 5xx SERVER ERROR
    **Content:** 
    ```json
    {
    "date": [
            "The date does not match the format Y-m-d\\TH:i:s\\Z.",
            "The date must be a date before or equal to {current datetime}."
        ]
    }
    ```

* **Sample Call:**

  ```bash
  curl --location --request GET 'http://localhost:8080/api/top'

  curl --location --request GET 'http://localhost:8080/api/top?date=2020-01-01T00:00:00Z'
  ```

<!-- * **Notes:**

  <i>empty</i>  -->
