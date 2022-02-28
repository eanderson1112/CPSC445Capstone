DROP DATABASE IF EXISTS Inventory;
CREATE DATABASE Inventory;
USE Inventory;

DROP TABLE IF EXISTS Users CASCADE;
CREATE TABLE Users
(
    userName VARCHAR(255) UNIQUE NOT NULL,
    fName    VARCHAR(10)  NOT NULL,
    lName    VARCHAR(15)  NOT NULL,
    email    varchar(255) UNIQUE NOT NULL,
    pswd     VARCHAR(255) NOT NULL,
    salt     VARCHAR(255) NOT NULL,
    phone    VARCHAR(10) NOT NULL,
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
    availability INT NOT NULL,
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
    userName     VARCHAR(255)       NOT NULL,
    fName        VARCHAR(10)        NOT NULL,
    lName        VARCHAR(15)        NOT NULL,
    email        VARCHAR(50)        NOT NULL,
    phone        VARCHAR(10)        NOT NULL,
    PRIMARY KEY (checkOutID),
    FOREIGN KEY (itemID) REFERENCES Inventory (itemID),
    FOREIGN KEY (userName) REFERENCES Users (userName)
);

# INSERT INTO Users
# VALUES ('eanderson1112', 'Elijah', 'Anderson', 'elijah.anderson.18@cnu.edu', 'somesalt', 'thisisatest', '7577084183');
# INSERT INTO Users
# VALUES ('cchris1985', 'Captain', 'Chris', 'captain.chris@cnu.edu', 'apassword', 'somesalt', '7578675309');
# INSERT INTO Users
# VALUES ('ckreider', 'Chris', 'Kreider', 'chris.kreider@cnu.edu', 'somepassword', 'somesalt', '8005882300');
#
# INSERT INTO Inventory
# VALUES (00001, 'Canon 90D', TRUE);
# INSERT INTO Inventory
# VALUES (00002, 'Behringer Xenyx 802USB', FALSE);
# INSERT INTO Inventory
# VALUES (00003, 'Behringer B85', False);
#
# INSERT INTO Log
# VALUES (000001, 00002, 'Canon 90D', '2022-02-02', 'eanderson1112', 'Elijah', 'Anderson', 'elijah.anderson.18@cnu.edu',
#         '7577084183');