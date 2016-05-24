# iheart
This exercise is to demo casestudy for iheart.
I have implemented a front controller with mvc design pattern. The action parameter dictates how different things happen in the app.
I have simple todo_items table where i store any todo created by the user. it also has a completed flag which indicates that status of whether it was completed or not. I have simulated a logged in user by hardcoding user id 1. The user tables / login / registartion were out of scope for this exercise. so the user part has been simulated by hardcoding. 


To recreate the project, please execute the schema.sql file on your mysql db. it is located inside schema folder.
Then create a user with privellage to access the iheart database and update the db-config.php file inside config folder.

place the project in your webroot folder inside a folder called iheart and then hit the location with your browser.
Let me know if you have any questions.
