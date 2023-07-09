# easyservice
Class project about home service booking and management etc
## Setup 
Download and extract files in htdocs directory of your xampp installation. Run setup_database.sql on your sql server with phpMyAdmin or other suitable sql server in your database before using the program.

### First Stage

Database is set up in following way: 
    - schema name is *easyservice*
	- users
	    - user_id
		- name
		- phone_number
		- password (stored as hash)
		- signed_up

Page index.html supplies following values in post request:
    - phone_number
	- password (plaintext)
	