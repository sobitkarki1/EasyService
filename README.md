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
	
	
# database

Lets properly define database entities and relationship First

## Dtabase

user
	user_id
	user_name
	phone_number
	password
	signed_up

service_category
	category_name
	category_id

service_provider
	provider_id
	phone
	email
	provider_name
	user_id fk
	
service
	service_id
	service_name
	description
	qualification_proof
	category_id fk
	user_id fk

booking
	booking_id
	booking_date
	booking_status
	service_id fk
	
review
	review_id
	review_comment
	review_rating
