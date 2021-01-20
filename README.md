# AddressBook

## Server side REST API

DB neded: 
 - databse: mydatabase (rest_api/config/Database.php)
 - tabe: myaddressbook (rest_api/models/Person.php)
 - user: user (rest_api/config/Database.php)
 - password: user (rest_api/config/Database.php)
 
*In case of diferent settings, change in appropriate files.
Few tabel data in myaddressbook.sql*

### GET (read)
get all:

GET http://localhost/AddressBook/rest_api/api.php

*returns: JSON array of all persons in DB*

get by ID:

GET http://localhost/AddressBook/rest_api/api.php?id=2

*returns: JSON of person with id=2*

### POST (create)
POST http://localhost/AddressBook/rest_api/api.php

Headers: Content-Type: application/json

Body: {	"firstname": "Alan",	"lastname": "Turing",	"mail": "turing@machine.uk",	"phone": "655214489" }

*returns: {"message":"Person created"} if succesful*   
*{"message":"Incomplete data"} if some fields were left empty*

### PUT (update)
PUT http://localhost/AddressBook/rest_api/api.php

Headers: Content-Type: application/json

Body: { "id":"6","firstname":"Nala","lastname":"Gnirut","mail":"turing@machine.uk","phone":"655214489" }

*returns: {"message":"Person updated"} if succesful*

### DELETE (delete)
DELETE http://localhost/AddressBook/rest_api/api.php

Headers: Content-Type: application/json

Body: { "id":"6" }

*returns: {"message":"Person deleted"} if succesful*


_________

## Frontend
http://localhost/AddressBook/index.html

