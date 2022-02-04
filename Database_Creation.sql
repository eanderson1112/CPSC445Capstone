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
    phone  VARCHAR(10)                       NOT NULL,
    Constraint user_pk
        PRIMARY KEY (userID)
);

DROP TABLE IF EXISTS Inventory CASCADE;
CREATE TABLE Inventory
(
    itemID         INT AUTO_INCREMENT NOT NULL,
    productName    VARCHAR(50)        NOT NULL,
    warrantyStatus BOOLEAN,
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

INSERT INTO Users
VALUES (00001, 'Elijah', 'Anderson', 'elijah.anderson.18@cnu.edu', '7577084183');
INSERT INTO Users
VALUES (00002, 'Captain', 'Chris', 'captain.chris@cnu.edu', '7578675309');
INSERT INTO Users
VALUES (00003, 'Chris', 'Kreider', 'chris.kreider@cnu.edu', '8005882300');

INSERT INTO Inventory
VALUES (00001, 'Canon 90D', TRUE);
INSERT INTO Inventory
VALUES (00002, 'Behringer Xenyx 802USB', FALSE);
INSERT INTO Inventory
VALUES (00003, 'Behringer B85', False);

INSERT INTO Log
VALUES (000001, 00002, 'Canon 90D', '2022-02-02', 00001, 'Elijah', 'Anderson', 'elijah.anderson.18@cnu.edu',
        '7577084183');