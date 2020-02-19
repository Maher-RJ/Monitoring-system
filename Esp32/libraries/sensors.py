from machine import I2C,Pin,ADC
from libraries.TH import TH
from libraries.tools import mapvalue
from libraries.dht import DHT22
import libraries.bh1750fvi as light
from libraries.TemperatureSensor import TemperatureSensor

DHT_PIN=4
LI_SDA=23
LI_SCL=22
SH_Pin=34 #soil humidity pin
ST_Pin=2 #soil temperature pin
PH_Pin=39
dht22 = DHT22(Pin(DHT_PIN))
li_i2c = I2C(-1,Pin(LI_SCL),Pin(LI_SDA))
SH = ADC(Pin(SH_Pin)) #prepare pin to read soil humidity analog data
PH = ADC(Pin(PH_Pin)) #prepare pin to read soil humidity analog data
ST = TemperatureSensor(ST_Pin)
SH.atten(ADC.ATTN_11DB)
PH.atten(ADC.ATTN_11DB)

def readDht():
    try:
        dht22.measure()
        h=dht22.humidity()
        t=dht22.temperature()
        if isinstance(t, float) and isinstance(h, float):
            WHT=TH(h,t)
            return WHT
        else:
            return None
    except OSError:
        print("error in reading weather sesnor")
        return None

def readLight():
    try:
        result = float(light.sample(li_i2c)) # in lux
        if isinstance(result, float):
            return result
        else:
            return None
    except OSError:
        print("error in reading Light sesnor")
        return None

def readSht():
    try:
        humidity=SH.read()
        humidity=mapvalue(humidity,0,4095,0,100)
        temperature=ST.read_temp()

        if isinstance(temperature, float) and isinstance(humidity, float):
            STH=TH(humidity,temperature)
            return STH
        else:
            return None
    except OSError:
        print("error in reading soil sesnor")
        return None

def readPh():
    try:
        ph_value=PH.read()
        ph_value=mapvalue(ph_value,0,4095,0,14)

        if isinstance(ph_value, float):
            return ph_value
        else:
            return None
    except OSError:
        print("error in reading ph sesnor")
        return None
