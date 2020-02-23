# Monitoring-system

<img width="692" alt="Screenshot 2020-02-20 at 15 31 09" src="https://user-images.githubusercontent.com/57875037/74944246-09d16700-53f6-11ea-947f-ddb00f5af8a7.png">

## System Interfaces

<img width="715" alt="Screenshot 2020-02-20 at 15 38 22" src="https://user-images.githubusercontent.com/57875037/74945126-75680400-53f7-11ea-8505-ce49083625a7.png">

## Hardware implementation of the system
<img width="695" alt="Screenshot 2020-02-20 at 15 38 54" src="https://user-images.githubusercontent.com/57875037/74945195-99c3e080-53f7-11ea-8fa3-8821c1f005bc.png">




## Laravel Installation
###### To Start the Laravel Project
######  1) Downloading ######  1.1) Clone the Repository
git clone https://github.com/Maher-RJ/Monitoring-system.git


and then download the folder from my repository and put it in Desktop then you need to edit .env file to make the database work, in .env file you will need to edit DB_DATABASE and put there the path of data.sqlite which you will find it also in folder Laravel->database. After this you need just to start the server in Terminal by using "php artisan serve --host=192.168.0.55 --port=8000".//Put your ip

<img width="1230" alt="login" src="https://user-images.githubusercontent.com/57875037/75121282-d52e0b80-5692-11ea-94ed-d42615724450.png">


* For the android app after you open it with android studio, you need first to change in Request.kt and put there the ip adress of laravel server in public val url: String. Becuase the mobile app has to send an email and password using post HTTP request to the web API

<img width="805" alt="Screenshot 2020-01-04 at 21 49 39" src="https://user-images.githubusercontent.com/57875037/75119472-69907200-5683-11ea-8cb2-98f3a02a54fb.png">
