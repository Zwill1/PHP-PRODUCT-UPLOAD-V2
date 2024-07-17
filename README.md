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

| prodid  | prodname | prodbrand | prodprice | prodquantity | prodimage | prodtag | prodlongdescription | prodshortdescription | prodviewcount | userId | 
| ------------- | ------------- |
| Content Cell  | Content Cell  |
| Content Cell  | Content Cell  |


## Goal

- Move the Add Product, Update and Delete functionality when user is logged in.
