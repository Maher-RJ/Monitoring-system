# Monitoring-system

<img width="692" alt="Screenshot 2020-02-20 at 15 31 09" src="https://user-images.githubusercontent.com/57875037/74944246-09d16700-53f6-11ea-947f-ddb00f5af8a7.png">

## System Interfaces

<img width="715" alt="Screenshot 2020-02-20 at 15 38 22" src="https://user-images.githubusercontent.com/57875037/74945126-75680400-53f7-11ea-8505-ce49083625a7.png">

## Hardware implementation of the system
<img width="695" alt="Screenshot 2020-02-20 at 15 38 54" src="https://user-images.githubusercontent.com/57875037/74945195-99c3e080-53f7-11ea-8fa3-8821c1f005bc.png">




## Laravel Installation

1)Downloading 1.1) Clone the Repository
```
git clone https://github.com/Maher-RJ/Monitoring-system.git
```
2)Install the Dependencies via Composer 2.1) If you don't have composer installed globally
```
cd your-folder
curl -s http://getcomposer.org/installer | php
php composer.phar install
```
2.2)For globally composer installations (Recommended!)
```
cd Laravel-folder 
composer install
```
To make the database work, in .env file you will need to edit DB_DATABASE and put there the path of data.sqlite which you will find it also in folder Laravel->database.
```
cd Laravel-folder
sudo nano .env
DB_DATABASE=/Users/MJ/Desktop/Laravel/database/data.sqlite  //I use mac if you use mac too then instead of MJ, put your mac home folder name
```

Finally in Laravel Folder
``` 
cd Laravel-folder
php artisan serve --host=192.168.0.11 --port=8000  //put your ip 
```

<img width="1230" alt="login" src="https://user-images.githubusercontent.com/57875037/75121282-d52e0b80-5692-11ea-94ed-d42615724450.png">

<img width="1241" alt="AirHumCHart" src="https://user-images.githubusercontent.com/57875037/75376679-ba48da80-58d0-11ea-8e5d-b06eef73f7ab.png">




## Android
After you clone my Android repository, open Android studio and choose
``` Open an existing Android studio proejct``` 
then open my android folder and choose ``` build.gradle ```. 
You need to make some change in file``` Request.kt```.
in ```public val url: String = "http://192.168.0.11:8000/api/"```
Change it to your Laravel localhost ip adress. Becuase the mobile app has to send an email and password using post HTTP request to the web API

<img width="805" alt="Screenshot 2020-01-04 at 21 49 39" src="https://user-images.githubusercontent.com/57875037/75119472-69907200-5683-11ea-8cb2-98f3a02a54fb.png">
