# Bunq Back End Engineer assignment

## Assignment
*Write a very simple 'chat' application backend in PHP. A user should be able to send a simple text
message to another user and a user should be able to get the messages sent to him and the
author users of those messages. The users and messages should be stored in a simple SQLite
database. All communication between the client and server should happen over a simple JSON
based protocol over HTTP (which may be periodically refreshed to poll for new messages). A GUI,
user registration and user login are not needed but the users should be identified by some token
or ID in the HTTP messages and the database. You have the freedom to use any framework and
libraries; keep in mind though that we love custom-build.*

## Requirements

### User journey

#### Login page

In this page the user will have a text box to input the username and a submit button.
The username can be an string of alphanumeric (no spaces). 

* When the submit is clicked, the user will be redirected to the dashboard page.
* If a user with that username does not exists, it will be created.

#### Dashboard page

In this page the user will be shown a list of users we has had messages with (existing chats), and a text box and a button too start new chat.

* When one of the existing chats is clicked, the user will be redirected to the chat page with that other user.
* When the new chat button is clicked, if the textbox contains a valid username, the user will be redirected to a blank chat page.

#### Chat page

In this page the user will see the username of the other, and all the messages sent and received in that chat, with the time they were sent and received; and a text area and a button to send a new message.

* When the new message button is clicked, the new message will be sent and it will appear in the list of messages.

* The list of messages will be automatically refreshed every minute.

### Tech stack

* Apache server
* PHP
* Silex framework
* SQLite database
* Docker container

## Tech actions

* Set up docker container with Apache and PHP
* Install Silex application as a docker volume
* Define database schema
* Implement services/queries to:
    * Create new user
    * Retrieve list of existing chats for a user
    * Retrieve list of messages for a chat
    * Send new message
* Implement controllers for:
    * Login (redirect to user's dashboard and, optionally, create new user)
    * Dashboard (retrieve list of chats and create new chat)
    * Chat (retrieve messages, update messages, send new message)
* Implement templates
* Implement front-end login:
    * Validation and submit of the login form
    * Validation for the new chat form
    * Validation for the new message form
    * Automatic update of messages
