class TH:
    def __init__(self):
        self._temperature = 0.0
        self._humidity=0.0

    def __init__(self,temperature,humidity):
        self._temperature = temperature
        self._humidity=humidity

    @property
    def humidity(self):
        return self._humidity
    
    @property
    def temperature(self):
        return self._temperature
        
    @temperature.setter
    def temperature(self, value):
        self._temperature = value
        
    @humidity.setter
    def humidity(self, value):
        self._humidity = value
    
    @humidity.getter
    def humidity(self):
        return self._humidity
         
    @temperature.getter
    def temperature(self):
        return self._temperature
        
    @temperature.deleter
    def temperature(self):
        del self._temperature
        
    @humidity.deleter
    def humidity(self):
        del self._humidity
    
    def get_string(self,id,stamp):
        return (b'{0},{1},{2:3.1f},{3:3.1f}'.format(stamp,id,self._temperature, self._humidity))