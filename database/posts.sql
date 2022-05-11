DROP DATABASE IF EXISTS netbase;
CREATE DATABASE IF NOT EXISTS netbase;

CREATE TABLE posts ( 
    tid INT AUTO_INCREMENT,
    PRIMARY KEY(tid),
    uid INT,
    post VARCHAR(255),
    date DATETIME,
    key(date),
    key(uid, date)
);
