Laravel Contacts Application

This is a simple Laravel Application which will pull down an example contact, display some information and allow the user 'update' append the information as desired to a local database.

Functionality does require an MySQL database to be setup before hand in Laravel to run.

Dependancies:
<pre>
1, MySQL ENV file is setup with username/password information.
2, Following database table is setup for local data caching.
3, Run as a Laravel app.
</pre>

https://laravel.com/ - Laravel App

App Functionality - Laravel - Routing (Requests in/out) and database storage.

Database Structure for Contacts List - Table name (ContactsList):
<pre>
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
</pre>	

Database Structure for Contacts List - Table name (CommentsList):
<pre>
key	int	NO	PRI		auto_increment
comment	text	YES			
</pre>

Create Table SQL Statement:
<pre>
create table ContactsList(
	`key` int primary key auto_increment,
    email varchar(250),
    phone varchar(250),
    mobile varchar(250),
    `name` varchar(250),
    city varchar(250),
    country varchar(250),
    postcode varchar(250),
    state varchar(250),
    thumbnail varchar(250)
);

create table CommentsList(
	`key` int primary key auto_increment,
    `comment` text
);

create table users(
	`id` int primary key auto_increment,
    name varchar(250),
    email varchar(250),
    timestamp DateTime,
    password varchar(250)
);
</pre>

Once the user clicks on the Save button, the functionality will find a local 'record' for the item in the known contacts list,
then attempt to update this and provide this as a record in the database in Laravel.

Backend Wise - The functionality is currently pretty lightweight, it's just used to set/update a local record.
Frontend Wise - Namely JavaScript to control the screen, with CSS/SASS being used to update and coordinate the 'state' for the running of the Application itself.