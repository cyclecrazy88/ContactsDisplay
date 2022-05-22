use Contacts_Example;


use contacts_example;

show tables;

/*
dataList.push({
                    email:dataItem.email,
                    phone:dataItem.phone,
                    mobile:dataItem.cell,
                    name:dataItem.name.first +" "+dataItem.name.last,
                    city:dataItem.location.city,
                    country:dataItem.location.country,
                    state:dataItem.location.state,
                    postcode:dataItem.location.postcode,
                    thumbnail:dataItem.picture.medium
                })
*/
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

select * from CommentsList;


/*drop table ContactsList;*/


select * from ContactsList;
insert into ContactsList (email,phone,mobile,`name`,city,country,postcode,state,thumbnail)
			values("test@test.com","123","1234","name","city","country","post","state","thumb");

select Country, count(*) as count from ContactsList  group by Country;
            
create table users(
	`id` int primary key auto_increment,
    name varchar(250),
    email varchar(250),
    timestamp DateTime,
    password varchar(250)
);

drop table users;

select * from users;