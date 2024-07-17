# PHP Product Upload Version 2.5.1

## Objective

Allow a product to be uploaded to a database with the following:

- Product id
- Product Name
- Product Brand
- Product Price
- Product Quantity
- Product Image (link to image)
- Product Tags
- Product Short Description
- Product Long Description
- Product Review Count (Calculate the average review score)
- Seller (User - wont be changed)

Website will include pages to create a product, edit and update the values of a product in the database. Product pages will display all the information on the page from the database with the values from above.

## Features

- Registeration -  Users with a email, username and password that is hashed.
- Allows Logins and Logout
- Uses Sessions.
- Stores/Deletes Session details in Local Storage.
- Filter Products - On home page.
- Product Pagination - Home page, Backend account page.
- Account Page - Regular view, list view and grid view
- Flash Messages - For adding, editing, deleting and other message warnings
- Sellers - See which user is selling the product

## Registration

- Following data is needed to create an account:
    - Username
    - Email Address
    - Password
    - Confirm Password

## Routes

- Routes on adding and editing the product details are now protected. Also applies to the single product page. When the URL is changed to an ID that doesnt exist in the database, the page will redirect with a warning.

- Applies to:
    - Add Product
    - Edit Product
    - Product page

## Security

- Protection against XSS attack when displaying data on pages.
- Uses PDO structure for data inserting and updates.

## Database Setup

- Users:

| Column | Type |  Null | Default | Extra |
| --- | --- | --- | --- | --- |
| userId | int  | NOT NULL  | | AUTO_INCREMENT  |
| username | varchar(50)  | NOT NULL  |
| email | varchar(100)  | NOT NULL  |
| password | varchar(255)  | NOT NULL  |
| created_at | TIMESTAMP  | NOT NULL  | current_timestamp() |

Extra: PRIMARY KEY (userId)

- Products Table:

| Column | Type |  Null | Default | Extra |
| --- | --- | --- | --- | --- |
| prodid | int  | NOT NULL  | | AUTO_INCREMENT  |
| prodname | varchar(255)  | NOT NULL  |
| prodbrand | varchar(60)  | NOT NULL  |
| prodprice | decimal(11,2)  | NOT NULL  |
| prodquantity | int  | NOT NULL  |
| prodimage | varchar(255)  | NOT NULL  |
| prodtag | varchar(55)  | NOT NULL  | 
| prodlongdescription | varchar(255)  | NOT NULL  | 
| prodshortdescription | varchar(255)  | NOT NULL  | 
| prodreviewcount | int(11)  | NOT NULL  |
| userId | int  |

Extra: PRIMARY KEY (prodid), FOREIGN KEY (userId) REFERENCES Users(userId)

## SQL Code:

```
CREATE TABLE users (
userId INT NOT NULL AUTO_INCREMENT,
username varchar(50) NOT NULL,
email varchar(100) NOT NULL,
password varchar(255) NOT NULL,
created_at TIMESTAMP NOT NULL DEFAULT current_timestamp(),
PRIMARY KEY (userId)
);
```


```
CREATE TABLE products (
prodid int NOT NULL AUTO_INCREMENT,
prodname varchar(255) NOT NULL,
prodbrand varchar(60) NOT NULL,
prodprice decimal(11,2) NOT NULL,
prodquantity int NOT NULL,
prodimage varchar(255) NOT NULL,
prodtag varchar(55) NOT NULL,
prodlongdescription varchar(255) NOT NULL,
prodshortdescription varchar(255) NOT NULL,
prodreviewcount int(11) NOT NULL,
userId INT,
PRIMARY KEY (prodid),
FOREIGN KEY (userId) REFERENCES Users(userId)
); 
```



## Goal

- Move the Add Product, Update and Delete functionality when user is logged in.
