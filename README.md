# Test 2 of 3

**NOTICE:** The test required the PHP backend to be built on CodeIgniter Framework.

As of this is a PHP Framework that doesn't follow the most modern and RECOMMEND PSR, I couldn't go with it and proceed the test using it.

The Job Oportunity that was given listed "Laravel Framework" and not CodeIgniter, so I am suspicious that this test was not the best target to me.

I hope the evaluator take into consideration that PHP has matured and it can not be conceived to use such a framework that doesn't abide to PSR's in their least recommendations and accept the Lumen/Laravel used here.



## Installing


Clone this Repository.

To install the testing environment it is recommended that you have docker installed in order to get the most out of it.



## Running Docker Images

When running:

`sudo docker-compose up -d`

it will start up all the Docker images and will set the whole environment and you are ready to go.



## Intalling PHP Required Libraries

As the API uses PHP with composer, it is mandatory to install the PHP dependencies:

`sudo docker exec -it test2_web composer install`



## Running the Migrations

Once PHP dependencies are correctly installed, the MySQL database and tables must be created, and that is done by running the Artisan Migration tool:

`sudo docker exec -it test2_web php artisan migrate`



## Populating the tables

Having the tables in place, you can seed my personal information to have something to test on.

`sudo docker exec -it test2_web php artisan db:seed`



## Checking the Installation

As simple as that, you can now test if the environment has been correctly set up by entering `http://localhost:8888`.



## Testing the EndPoints

If everything goes right, you can run some PHP scripts to validate the API.

In order to be more effective, you can use PostMan from Google Web Store.



### Listing All People

At this moment theres only my personal information, but you can add more later.

_For this test and all the following I am presuming you are using PostMan or some similar tool._


**GET**: `http://localhost:8888/api/people`



### Listing a Single Person

Differently from the previous one person is fetched and there are no RESTful verbosity in the JSON returned.

**GET**: `http://localhost:8888/api/people/1`


### Inserting a Person

To insert a person you should pass a keys and values to POST Body:

**POST**: `http://localhost:8888/api/people`

**Body**:

`name `: Pessoa Teste 1

`contacts[contact][]` : phone

`contacts[value][]` : (11)99999-9999

`contacts[contact][]` : email

`contacts[value][]` : teste@teste.com



You can check by re-visiting:

**GET**: `http://localhost:8888/api/people`

or _(if you still have a incremental id)_

**GET**: `http://localhost:8888/api/people/2`




### Updating a Person

To update a person the process is similar to fetch and create, except for the fact that if you want to update contacts  you should pass the `id` of each one, otherwise they will be inserted:


**PUT**: `http://localhost:8888/api/people/2`

**Body**:

`name`:Pessoa Teste 1 Editada

`contacts[id][]`:6

`contacts[contact][]`:phone

`contacts[value][]`:(11)99999-8888

`contacts[contact][]`:email

`contacts[value][]`:teste2@teste.com


In the above Body, the contact with ID 6 will be updated and a new email will be added.



### Deleting a Person


To delete a person you should just go to:

**DELETE**: `http://localhost:8888/api/people/2`




### Deleting a Contact 

To delete a single contact of a person you should just go to:

**DELETE**: `http://localhost:8888/api/contacts/CONTACT_ID`





