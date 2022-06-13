# Atmosphere

Air Quality Home Device
<p align="center">
<img src="https://github.com/MatteoBavecchi/Atmosphere/blob/master/Photos/atmosphere_on_table.png">
</p>

## Introduction

Atmosphere is the prototype of a device that detects some values of the surrounding air and let the the user know when it seems not to be livable.

All this is possible with the use of gas sensors, temperature sensors, a buzzer and a WiFi module which sends data collected to two servers.

The goal of the project is create a costomer product, in fact the Atmosphere ecosystem manages more than one user and catalogs the data sent by the various devices in a single database.

Any aspect has been studied to be as much as possible oriented towards an untrained user, and mobile friendly, that is viewable and configurable correctly from any mobile device.


The device is mainly composed by a customized electronic board and a plastic case manufactured with a 3D printer.<br>
Everything has been designed, designed, built and assembled by myself.


## PCB Board Design

<img src="https://github.com/MatteoBavecchi/Atmosphere/blob/master/Photos/atmosphere_scheme.jpg">

I used the Atmega-328p_au for this project.
The PCB board has been made by OSH Park.

<a href="https://oshpark.com/shared_projects/vfo74W1z"><img src="https://oshpark.com/assets/badge-5b7ec47045b78aef6eb9d83b3bac6b1920de805e9a0c227658eac6e19a045b9c.png" alt="Order from OSH Park"></img></a>

## The webserver
<p align="center">
<img src="https://github.com/MatteoBavecchi/Atmosphere/blob/master/Photos/screenshot.png"></p>

Atmosphere communicates with the server http://atmosphere.96.lt and with the Thingspeak server, which can be reached from the IP address 184.106.153.149.
The dialogue with both servers is limited to a GET request on port 80, let's see how:



The syntax of the GET request to the Atmosphere server is as follows:

```
GET /data.php?mac=1&t=2&h=3&gpl=4&co2=5&co=6
```
1: MAC address that resides in the Atmosphere EEPROM.<br>
2: Temperature, expressed in degrees centigrade.<br>
3: Relative humidity, expressed as a percentage.<br>
4: Quantity of LPG in the air, expressed in ppm.<br>
5: Amount of CO2 present in the air, expressed in ppm.<br>
6: Amount of carbon monoxide in the air, expressed in ppm.<br>



The sintax for send data to the Thingspeak server is as follows:

```
GET   /update?key=1&field1=2&field2=3&field3=4&field4=5&field5=6
```
1: Thingspeak private key<br>
2: Temperature, in degrees centigrade.<br>
3: Relative humidity, expressed as a percentage.<br>
4: Quantity of LPG in the air, expressed in ppm.<br>
5: Amount of CO2 present in the air, expressed in ppm.<br>
6: Amount of carbon monoxide in the air, expressed in ppm.<br>


<br><br>
## How the device works



Atmosphere doesn't need expert users to be used, you just need to power on and it will automatically calibrate itself and begin to analyze the surrounding air, sending, every 30 seconds, the data on the internet.
Atmosphere has not any button or display that allows you to configure it. To make it connect to your home WiFi network, I created a smartphone app, which can communicate the login credentials to Atmosphere.

### First Startup
Atmosphere, when powered on, creates a WiFi network, this will be accessible for one minute.
We connect our smartphone to this network and start the "Atmosphere" App.
We have two fields to fill, the name of the network and the password, and under the "Send" button.
Below there's the MAC address of Atmosphere, this must be entered on the website during registration. By doing so, we associate our newly created account with our Atmosphere.
Let's go back to the smartphone and type the network credentials in the fields and press "Send".
Atmosphere will store them inside the EEPROM and connect to the desired network.

It can be powered with a micro usb cable, but even without this, it works for about an hour thanks to the internal battery.

<br><br>
## Database

<img src="https://github.com/MatteoBavecchi/Atmosphere/blob/master/Photos/schema%20logico%20db.jpg">

