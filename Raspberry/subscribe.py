import paho.mqtt.client as mqtt
from weatherHTTable import weatherHTTable
from soilHTTable import soilHTTable
from lightTable import lightTable
from phTable import phTable

import time

SERVER='localhost'
PORT=1883
TOPIC=[('WTH',2),('STH',2),('LI',2),('PH',2)]
Connected = False   #global variable for the state of the connection

def on_connect(client, userdata, flags, rc):
    if rc == 0:
        print("Connected to broker")
        global Connected                #Use global variable
        Connected = True                #Signal connection
    else:
        print("Connection failed")

# Callback fires when a published message is received.
def on_message(client, userdata, msg):
    # map the inputs to the function blocks
    print(msg.topic)
    if msg.topic=='WTH':
        mytime = time.time()                # edited
        stamp,id,h,t = [float(x) for x in msg.payload.decode("utf-8").split(',')]
        weatherHTTable.insert(id,t, h,mytime)           # edited
        print('{0}C {1}% '.format(t, h))
    elif msg.topic=='STH':
        # Decode temperature and humidity values from binary message paylod.
        mytime = time.time()
        stamp,id,h,t = [float(x) for x in msg.payload.decode("utf-8").split(',')]
        print('{0}C {1}%'.format(t, h))
        soilHTTable.insert(id,t, h,mytime)
    elif msg.topic=='LI':
            # Decode temperature and humidity values from binary message paylod.
        mytime = time.time()                                                      # edited
        stamp,id,l = [float(x) for x in msg.payload.decode("utf-8").split(',')]
        print('{0}'.format(l))
        lightTable.insert(id,l,mytime)                                            # edited
    elif msg.topic=='PH':
        mytime = time.time()                                                      # edited
        stamp,id,l = [float(x) for x in msg.payload.decode("utf-8").split(',')]
        print('{0}'.format(l))
        phTable.insert(id,l,mytime)                                          #edited

client = mqtt.Client("RPi")
client.on_connect = on_connect  # Specify on_connect callback
client.on_message = on_message  # Specify on_message callback
client.connect(SERVER,PORT , 60)  # Connect to MQTT broker (also running on Pi).
client.subscribe(TOPIC)
# Processes MQTT network traffic, callbacks and reconnections. (Blocking)
client.loop_forever()
