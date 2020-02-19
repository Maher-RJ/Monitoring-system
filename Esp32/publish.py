from time import sleep
from umqtt.simple import MQTTClient
from libraries.sensors import readDht,readSht,readLight,readPh
from libraries.mynetwork import SERVERIP,getMacAdd,doConnection
from libraries.tools import getId
from machine import Pin
from libraries.tools import getUnixTime
node_id=getId()
#id=1
TOPICWHT = b'WTH'
TOPICSHT = b'STH'
TOPICLI = b'LI'
TOPICPH=b'PH'

SlEEP_TIME=10
doConnection()
client = MQTTClient(str(node_id), SERVERIP)
client.connect()   # Connect to MQTT broker

def sendWTH(stamp):
    weather = readDht()
    if weather!=None:
        print("Weather:")
        data=weather.get_string(node_id,stamp)
        print (data)
        try:
            client.publish(TOPICWHT, data)
        except (OSError) as exp:
            print("error in connection")

def sendSTH(stamp):
    STH = readSht()
    if STH!=None:
        print("Soil:")
        data=STH.get_string(node_id,stamp)
        print (data)
        try:
            client.publish(TOPICSHT, data)
        except (OSError) as exp:
            print("error in connection")

def sendLight(stamp):
    light = readLight()
    if light!=None:
        print("Light:")
        print (str(light))
        try:
            client.publish(TOPICLI, (b'{0},{1},{2:3.1f}'.format(stamp,node_id,light)))
        except (OSError) as exp:
            print("error in connection")

def sendPh(stamp):
    ph = readPh()
    if ph!=None:
        print("ph:")
        print (str(ph))
        try:
            client.publish(TOPICPH, (b'{0},{1},{2:3.1f}'.format(stamp,node_id,ph)))
        except (OSError) as exp:
            print("error in connection")

while True:
    if node_id>0:
        stamp= getUnixTime()
        print(stamp)
        sendWTH(stamp)
        sendSTH(stamp)
        sendLight(stamp)
        sendPh(stamp)
    else:
        node_id=getId()
    
    sleep(SlEEP_TIME)
