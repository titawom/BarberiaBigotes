CREATE DATABASE BookStore;
USE BookStore;

CREATE TABLE Book(
    BookID varchar(50),
	BookTitle varchar(200),
    ISBN varchar(20),
    Price double(12,2),
    Author varchar(128),
    Type varchar(128),
    Image varchar(128),
    PRIMARY KEY (BookID)
);

CREATE TABLE Users(
    UserID int not null AUTO_INCREMENT,
    UserName varchar(128),
    Password varchar(16),
    PRIMARY KEY (UserID)
);

CREATE TABLE Customer (
	CustomerID int not null AUTO_INCREMENT,
    CustomerName varchar(128),
    CustomerPhone varchar(12),
    CustomerIC varchar(14),
    CustomerEmail varchar(200),
    CustomerAddress varchar(200),
    CustomerGender varchar(10),
    UserID int,
    PRIMARY KEY (CustomerID),
    CONSTRAINT FOREIGN KEY (UserID) REFERENCES Users(UserID) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE `Order`(
	OrderID int not null AUTO_INCREMENT,
    CustomerID int,
    BookID varchar(50),
    DatePurchase datetime,
    Quantity int,
    TotalPrice double(12,2),
    Status varchar(1),
    PRIMARY KEY (OrderID),
    CONSTRAINT FOREIGN KEY (BookID) REFERENCES Book(BookID) ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT FOREIGN KEY (CustomerID) REFERENCES Customer(CustomerID) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE Cart(
	CartID int not null AUTO_INCREMENT,
    CustomerID int,
    BookID varchar(50),
    Price double(12,2),
    Quantity int,
    TotalPrice double(12,2),
    PRIMARY KEY (CartID),
    CONSTRAINT FOREIGN KEY (BookID) REFERENCES Book(BookID) ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT FOREIGN KEY (CustomerID) REFERENCES Customer(CustomerID) ON DELETE SET NULL ON UPDATE CASCADE
);

CREATE TABLE `BookStore`.`Dates` ( `id` INT NOT NULL AUTO_INCREMENT , `fullname` VARCHAR(50) NOT NULL , `email` VARCHAR(50) NOT NULL , `phone` VARCHAR(50) NOT NULL , `date` VARCHAR(50) NOT NULL , `reason` VARCHAR(50) NOT NULL , PRIMARY KEY (`id`));


INSERT INTO `Book`(`BookID`, `BookTitle`, `ISBN`, `Price`, `Author`, `Type`, `Image`) VALUES ('B-001','Champú','123-456-789-1',12.32,'Autor','Producto','image/champu.jpg');
INSERT INTO `Book`(`BookID`, `BookTitle`, `ISBN`, `Price`, `Author`, `Type`, `Image`) VALUES ('B-002','Peine','123-456-789-1',8.95,'Autor','Producto','image/peine.jpg');
INSERT INTO `Book`(`BookID`, `BookTitle`, `ISBN`, `Price`, `Author`, `Type`, `Image`) VALUES ('B-003','Navaja','123-456-789-1',35.0,'Autor','Producto','image/navaja.jpg');