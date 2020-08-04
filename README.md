# Monitoring-system

![Block diagram of final design](https://user-images.githubusercontent.com/57875037/85478154-01638580-b5bc-11ea-8d89-4ab3cedaaab8.png)

![IMG_3082](https://user-images.githubusercontent.com/57875037/84219448-dd3e7980-aad0-11ea-9576-4f27669f41e2.jpg)

<img width="1230" alt="login" src="https://user-images.githubusercontent.com/57875037/75121282-d52e0b80-5692-11ea-94ed-d42615724450.png">

![viber_image_2020-02-29_17-13-38](https://user-images.githubusercontent.com/57875037/76008662-4cc02e00-5f10-11ea-98f8-37d9ebd3ee87.jpg)

<img width="805" alt="Screenshot 2020-01-04 at 21 49 39" src="https://user-images.githubusercontent.com/57875037/75119472-69907200-5683-11ea-8cb2-98f3a02a54fb.png">

## Laravel Installation

1)Downloading 1.1) Clone the Repository
```
git clone https://github.com/Maher-RJ/Monitoring-system.git
```
2)Install the Dependencies via Composer 2.1) If you don't have composer installed globally
```
cd Laravel-folder  //the folder you cloned from github monitoring system
curl -s http://getcomposer.org/installer | php
php composer.phar install
```
2.2)For globally composer installations (Recommended!)
```
cd Laravel-folder 
composer install
```
2.3)For Mac users, Make sure to place composer’s system-wide vendor bin directory in your $PATH so the Laravel executable can be located by your system.
```
echo 'export PATH="$PATH:$HOME/.composer/vendor/bin"' >> ~/.bash_profile
source ~/.bash_profile
```
2.4) update the composer
```
cd Laravel-folder  //the folder you cloned in monitoring system
composer updat
```
3) Fix Database file Path
To make the database work, in .env file you will need to edit DB_DATABASE and put there the path of data.sqlite which you will find it also in folder Laravel->database.
```
cd Laravel-folder
sudo nano .env
DB_DATABASE=/Users/MJ/Desktop/Laravel/database/data.sqlite  //I use mac if you use mac too then instead of MJ, put your mac home folder name
```

4)Finally in Laravel Folder
``` 
cd Laravel-folder
php artisan serve --host=192.168.0.11 --port=8000  //put your ip 
```
note! i use md5 hash, by defualt the password is "secret" and email is maherj@kth.se

## Android
After you clone my Android repository, open Android studio and choose
``` Open an existing Android studio proejct``` 
then open my android folder and choose ``` build.gradle ```. 
You need to make some change in file``` Request.kt```.
in ```public val url: String = "http://192.168.0.11:8000/api/"```
Change it to your Laravel localhost ip adress. Becuase the mobile app has to send an email and password using post HTTP request to the web API

note! password is "secret" and email is maherj@kth.se

## Raspberry Pi Api Diagram
![rsz_raspberry_pi_api_diagram](https://user-images.githubusercontent.com/57875037/84219168-2e01a280-aad0-11ea-8805-88adb7f1e98d.png)

## Node Processing Stage
![rsz_node_processing_stage](https://user-images.githubusercontent.com/57875037/84219043-f85cb980-aacf-11ea-8efa-17a404ecf49a.png)

## System Interfaces

<img width="715" alt="Screenshot 2020-02-20 at 15 38 22" src="https://user-images.githubusercontent.com/57875037/74945126-75680400-53f7-11ea-8505-ce49083625a7.png">

## Mobile Application Login Process Diagram
![Mobile Application Login Process Diagram (1)](https://user-images.githubusercontent.com/57875037/84205046-99397d80-aaac-11ea-93cd-c5fa2c964887.png)

## Mobile Application Services Diagram
![Mobile Application Services Diagram (1)](https://user-images.githubusercontent.com/57875037/84205051-9b034100-aaac-11ea-98fc-5d63402479c9.png )
