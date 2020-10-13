CREATE USER 'test'@'localhost' IDENTIFIED BY 'test';
GRANT ALL PRIVILEGES ON * . * TO 'test'@'localhost';

create database test_tienda;

create table producto(
     id int not null auto_increment,
     nombre varchar(20),
     descripcion text,
     referencia text,
     precio float,
     fecha_creacion date,
     primary key(id)
 );


 insert into producto values (default,'Camisa','Camisa deportiva','REF-1256',35000, current_date);
 insert into producto values (default,'Jean','Jean negro','REF-10140',85000, current_date);
 insert into producto values (default,'Vestido','Vestido dama','REF-014785',55000, current_date);
