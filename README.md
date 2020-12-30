# AddressBook

## Server side REST API

DB neded: 
 - databse: mydatabase (rest_api/config/Database.php)
 - tabe: myaddressbook (rest_api/models/Person.php)
 - user: user (rest_api/config/Database.php)
 - password: user (rest_api/config/Database.php)
 
*In case of diferent settings, change in appropriate files
few tabel data in myaddressbook.sql

### GET (read)
get all:
http://localhost/AddressBook/rest_api/api/read.php

*returns: JSON array of all persons in DB

get by ID:
http://localhost/AddressBook/rest_api/api/read.php?id=2

*returns: JSON of person with id=2

### POST (create)
http://localhost/AddressBook/rest_api/api/create.php
Headers: Content-Type: application/json
Body: {	"firstname": "Alan",	"lastname": "Turing",	"mail": "turing@machine.uk",	"phone": "655214489" }

*returns: {"message":"Person created"} if succesful

### PUT (update)
http://localhost/AddressBook/rest_api/api/update.php
Headers: Content-Type: application/json
Body: { "id":"6","firstname":"Nala","lastname":"Gnirut","mail":"turing@machine.uk","phone":"655214489" }

*returns: {"message":"Person updated"} if succesful

### DELETE (delete)
http://localhost/AddressBook/rest_api/api/delete.php
Headers: Content-Type: application/json
{ "id":"6" }

*returns: {"message":"Person deleted"} if succesful




#TODO:
frontend

