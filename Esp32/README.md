## Flashing & Installing uPycraft for esp32 (Windows)


![Screenshot 2020-02-25 at 23 24 14](https://user-images.githubusercontent.com/57875037/75293200-0428b680-5826-11ea-8bcb-e1e8ec1fb31e.png)

With uPyCraft IDE installed in your computer, you can easily flash your ESP32 or ESP8266 boards with the MicroPython firmware

##### 1) Downloading and Flashing the MicroPython Firmware on ESP32

To download the latest version of MicroPython firmware for the ESP32, go to http://micropython.org/download#esp32 and scroll all the way down to the ESP32 section.

You should see a similar web page (see figure below) with the latest link to download the ESP32 .bin file – for example: <br />
 ``` esp32-20181007-v1.9.4-631-g338635ccc.bin. ```
 
##### 2) Selecting Serial Port
Go to Tools > Serial and select your ESP32 COM port (COM5 or COM3) depends on.

##### Important: 
if you plug your ESP32 board to your computer, but you can’t find the ESP32 Port available in your uPyCraft IDE, it might be one of these two problems: 1. USB drivers missing or 2. USB cable without data wires.

##### 3) Selecting Serial Port
Go to Tools > Board. For this tutorial, we assume that you’re using the ESP32, so make sure you select the “esp32” option:

##### 4) Flashing/Uploading MicroPython Firmware
Finally, go to Tools > BurnFirmware menu to flash your ESP32 with MicroPython.

Select all these options to flash the ESP32 board:
* board: esp32
* burn_addr: 0x1000
* erase_flash: yes
* com: COMX (COM5 or COM3)
* Firmware: Select “Users” and choose the ESP32 .bin file downloaded earlier

Having all the settings selected, hold-down the “BOOT/FLASH” button in your ESP32 board <br />
While holding down the “BOOT/FLASH“, click the “ok” button in the burn firmware window <br />
When the “EraseFlash” process begins, you can release the “BOOT/FLASH” button. After a few seconds, the firmware will be flashed into your ESP32 board. <br />
Note: if the “EraseFlash” bar doesn’t move and you see an error message saying “erase false.“, it means that your ESP32 wasn’t in flashing mode. You need to repeat all the steps described earlier and hold the “BOOT/FLASH” button again to ensure that your ESP32 goes into flashing mode.<br />

#####  This is example of my first test on sensor dht22 

![dht22](https://user-images.githubusercontent.com/57875037/75294743-76e76100-5829-11ea-9c32-1c301ecb110b.png)

