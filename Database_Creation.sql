DROP DATABASE IF EXISTS Inventory;
CREATE DATABASE Inventory;
USE Inventory;

DROP TABLE IF EXISTS Users CASCADE;
CREATE TABLE Users
(
    userID INT AUTO_INCREMENT UNIQUE NOT NULL,
    fName  VARCHAR(10)               NOT NULL,
    lName  VARCHAR(15)               NOT NULL,
    email  VARCHAR(50)               NOT NULL,
    phone  INT                       NOT NULL,
    Constraint user_pk
        PRIMARY KEY (userID)
);

DROP TABLE IF EXISTS Inventory CASCADE;
CREATE TABLE Inventory
(
    itemID         INT AUTO_INCREMENT NOT NULL,
    productName    VARCHAR(50)        NOT NULL,
    warrantyStatus VARCHAR(20),
    CONSTRAINT itemID_pk
        PRIMARY KEY (itemID)
);

DROP TABLE IF EXISTS Log CASCADE;
CREATE TABLE Log
(
    checkOutID   INT AUTO_INCREMENT NOT NULL,
    itemID       INT                NOT NULL,
    productName  VARCHAR(50)        NOT NULL,
    checkOutDate DATE               NOT NULL,
    userID       INT                NOT NULL,
    fName        VARCHAR(10)        NOT NULL,
    lName        VARCHAR(15)        NOT NULL,
    email        VARCHAR(50)        NOT NULL,
    phone        VARCHAR(10)        NOT NULL,
    PRIMARY KEY (checkOutID),
    FOREIGN KEY (itemID) REFERENCES Inventory (itemID),
    FOREIGN KEY (userID) REFERENCES Users (userID)
);
