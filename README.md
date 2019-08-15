# RBG Registration Site

#### Register New User (RegisterUser.php)

A form allowing for input of username, password and email address to be submitted for creation of new user.\
Form cannot be submitted without input of captcha image string.\
Both client and server side validation are used.\
All fields must be completed for data to be sent to the server.\
Validation will be carried out by server code before attempting to save to database.\
If any information is invalid, user is redirected back to this page with error message.\
PHP will use md5 encryption for saving password to database.

![screenshot](/screenshots/regNewUserSS.png)

#### Sitter Search 

Displays a table of all verified users on the system.\
Each user can be selected to access more information.

![screenshot](/screenshots/sitterSearchSS.png)

#### Details For Selected Sitter (SitterDetails.php) - unfinished

The point of this page is show all details for the selected sitter; however this is unfinished.\
Struggling to think of the best way to show availability

![screenshot](/screenshots/detailsSelSitSS.png)

#### Login
The login page for registered users.\
If the user has not yet verified their account they will be taken to the verification page.

![screenshot](/screenshots/loginSS.png)
Username : ab123		password: pass

#### Login Success
Where the user is directed to after having logged in successfully.\
Now that the user is logged in, they can access the *Update Details* page and from there they can change their rates, images and availability.\
A logout link is also available for them in the top menu.

![screenshot](/screenshots/loginSuccessSS.png)

#### Update Details
Here the user can submit further details about them.\
Once the data has been updated, coming to this page will show the details they previously entered.

![screenshot](/screenshots/updateDetailsSS.png)

#### Update / Manage Images
User is able to upload images to the system.\
Needs further work to allow for deletion.

![screenshot](/screenshots/uploadImgsSS.png)

#### Update Availability
User can select / unselect which hours of the week they are available.\
Data is sent to the database when submitted through use of AJAX and read from database when the page is loaded.

![screenshot](/screenshots/availabilitySS1.png)

Availability continued
![screenshot](/screenshots/availabilitySS2.png)

#### View Update Rates
Provides functionality to add, change or delete rate.\
All rates not set to be deleted our retrieved from the database and displayed in a table.\
Each row can be selected to change or delete rate.\
Once a rate has been changed or deleted (set to be deleted), data is sent to the database and the table will show the change, without a reload of the page. This is through the use of AJAX.\
(Given rates are far too high but functionality is achieved)

![screenshot](/screenshots/changeRatesSS.png)

If *Add New Rate* is selected, user can input both number of hours and cost to add a new rate.

![screenshot](/screenshots/addRatesSS.png)