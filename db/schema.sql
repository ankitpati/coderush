/* schema.sql */
/* Date  : 13 November 2016
 * Author: Ankit Pati
 */

drop database if exists coderush;
create database coderush;
use coderush;

create table submit (
    username char(100) not null,
    level tinyint unsigned not null,
    ques tinyint unsigned not null,
    ans text(512) not null,
    curtime datetime not null,
    primary key(username, level, ques)
);

create table users (
    username char(100) primary key not null,
    password char(100) not null,
    admin boolean not null
);
/* end of schema.sql */
