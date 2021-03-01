use `comp_1006_lesson_05`;
create table contacts(
	id int(11) not null auto_increment,
    first_name varchar(20) not null,
    last_name varchar(20) not null,
    email varchar(30) not null,
    country_code varchar(10) not null,
    area_code varchar(10) not null,
    phone_number varchar(10) not null,
	address_1 varchar(50) not null,
    address_2 varchar(50) not null,
    city varchar(20) not null,
    province varchar(20) not null,
    country varchar(20) not null,
    postal_code varchar(15) not null,
  
    
    created_at timestamp not null default current_timestamp,
    updated_at timestamp not null default current_timestamp on update current_timestamp,
    primary key(id)
    

);
