DROP DATABASE IF EXISTS Inventory;
CREATE DATABASE Inventory;
USE Inventory;

DROP TABLE IF EXISTS Users CASCADE;
CREATE TABLE Users
(
    userName VARCHAR(255) UNIQUE NOT NULL,
    fName    VARCHAR(10)         NOT NULL,
    lName    VARCHAR(15)         NOT NULL,
    email    varchar(255) UNIQUE NOT NULL,
    pswd     VARCHAR(255)        NOT NULL,
    salt     VARCHAR(255)        NOT NULL,
    auth     VARCHAR(30)         NOT NULL DEFAULT 'Standard',
    phone    VARCHAR(10)         NOT NULL,
    CONSTRAINT user_pk
        PRIMARY KEY (userName)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8mb4;


DROP TABLE IF EXISTS Inventory CASCADE;
CREATE TABLE Inventory
(
    itemID         INT AUTO_INCREMENT NOT NULL,
    productName    VARCHAR(50)        NOT NULL,
    warrantyStatus BOOLEAN,
    availability   INT                NOT NULL,
    CONSTRAINT itemID_pk
        PRIMARY KEY (itemID)
);

DROP TABLE IF EXISTS Log CASCADE;
CREATE TABLE Log
(
    checkOutID       INT AUTO_INCREMENT NOT NULL,
    itemID           INT                NOT NULL,
    productName      VARCHAR(50)        NOT NULL,
    checkOutDateTime DATETIME           NOT NULL,
    checkInDateTime  DATETIME,
    fName            VARCHAR(10)        NOT NULL,
    lName            VARCHAR(15)        NOT NULL,
    email            VARCHAR(50)        NOT NULL,
    phone            VARCHAR(10)        NOT NULL,
    PRIMARY KEY (checkOutID)
);
