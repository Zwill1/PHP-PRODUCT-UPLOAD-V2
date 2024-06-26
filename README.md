# PHP Product Upload Version 2.0.0

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

Website will include pages to create a product, edit and update the values of a product in the database. Product pages will display all the information on the page from the database with the values from above.

## Features

- Register users with a email, username and password that is hashed.
- Allows Logins and Logout
- Uses Sessions.
- Sets log in details to local storage and deletes when logged out.
- Includes an option to filter products on home page.
- Has pagination on home page and log in page.

## Registration

- Following data is needed to create an account:
    - Username
    - Email Address
    - Password
    - Confirm Password

## Security

- Protection against XSS attack when displaying data on pages.
- Uses PDO structure for data inserting and updates.

## Goal

- Move the Add Product, Update and Delete functionality when user is logged in.
