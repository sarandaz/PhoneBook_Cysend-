
/db/config.php -> 
        ipaddress -> localhost
        port
        dbname
        user
        password

index.php
    2 Menus, Login and Public Phonebook
    if logged in , Logout, Public phonebook, my contacts

login.php
    title, username and password input fileds and submit button

public phonebook 
    all phones that are public with show details in javascript

my contact
    col-4 
    contact
       -> drop down menu from database
    phone numbers 
        as many as needed with add button + checkbox to make it public
    emails
        as many as needed with add button + checkbox to make it public


#DATABASE
table -> User
        ID -> autoincrement, pk
        Username -> varchar(255)
        first name varchar(255)
        last name varchar(255)
        Address varchar(255)
        country varchar(255)
        Password -> varchar(255)
        published -> boolean

table -> phonenumbers
        ID, -> autoincrement, pk
        UserID -> int
        phone_number -> int
        published -> boolean

table -> emails
        ID, -> autoincrement, pk
        UserID -> int
        email -> varchar(255)
        published -> boolean
