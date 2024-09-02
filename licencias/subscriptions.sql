create database subscriptions;
use subscriptions;

create table subscriptions(
id INT AUTO_INCREMENT PRIMARY KEY,
    licencia VARCHAR(255) NOT NULL,
    start_date DATE NOT NULL,
    end_date DATE NOT NULL,
    email VARCHAR(255) NOT NULL,
    sender VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
select*from subscriptions;
drop table subscriptions;
