CREATE TABLE assignment1 (
    id int not null auto_increment,
    name varchar(255) NOT NULL,
    count int(3) NOT NULL,
    coffee_type VARCHAR(255) NOT NULL,
    temperature varchar (500) NOT NULL,
    size VARCHAR(255) NOT NULL,
    milk_option varchar (255),
    sweeteners varchar (255),
    flavored_syrups varchar (255),
    primary key (id)
);
