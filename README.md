Laravel Contacts Application

This is a simple Laravel Application which will pull down an example contact, display some information and allow the user 'update' append the information as desired to a local database.

Functionality does require an MySQL database to be setup before hand in Laravel to run.

https://laravel.com/ - Laravel App

App Functionality - Laravel - Routing (Requests in/out) and database storage.

Database Structure for Contacts List:
key	int	NO	PRI		auto_increment
email	varchar(250)	YES			
phone	varchar(250)	YES			
mobile	varchar(250)	YES			
name	varchar(250)	YES			
city	varchar(250)	YES			
country	varchar(250)	YES			
postcode	varchar(250)	YES			
state	varchar(250)	YES			
thumbnail	varchar(250)	YES			

Once the user clicks on the Save button, the functionality will find a local 'record' for the item in the known contacts list,
then attempt to update this and provide this as a record in the database in Laravel.

Backend Wise - The functionality is currently pretty lightweight, it's just used to set/update a local record.
Frontend Wise - Namely JavaScript to control the screen, with CSS/SASS being used to update and coordinate the 'state' for the running of the Application itself.
