import time
from machine import Pin
from oneWire.ds18x20 import DS18X20
from oneWire.onewire import OneWire

class TemperatureSensor:
    """
    Represents a Temperature sensor
    """

    def __init__(self, pin):
        """
        Finds address of single DS18B20 on bus specified by `pin`
        :param pin: 1-Wire bus pin
        :type pin: int
        """
        self.ds = DS18X20(OneWire(Pin(pin)))
        addrs = self.ds.scan()
        if not addrs:
            raise Exception('no DS18B20 found at bus on pin %d' % pin)
        # save what should be the only address found
        self.addr = addrs.pop()

    def read_temp(self):
        """
        Reads temperature from a single DS18X20
        :param fahrenheit: Whether or not to return value in Fahrenheit
        :type fahrenheit: bool
        :return: Temperature
        :rtype: float
        """
        temp=-1
        try:
            self.ds.convert_temp()
            time.sleep_ms(750)
            temp = self.ds.read_temp(self.addr)
        except:
            print('CRC error')
        return (temp
