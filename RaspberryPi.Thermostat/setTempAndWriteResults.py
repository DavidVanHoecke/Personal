#!/usr/bin/python

import Adafruit_DHT
import RPi.GPIO as GPIO
import time
import sys
import json

from time import gmtime, strftime
now = strftime("%Y%m%d %H%M%S", gmtime())
    
desiredTemp = 15;
if len(sys.argv) == 2:
    desiredTemp = int(sys.argv[1])
print(desiredTemp)
tempObj = {
        'DesiredTemp':desiredTemp,
        'Date': now
    }
with open('/var/www/html/desiredTemp.json', 'w') as outfile:
    json.dump(tempObj, outfile)
outfile.close() 
        
    
# Sensor should be set to Adafruit_DHT.DHT11,
# Adafruit_DHT.DHT22, or Adafruit_DHT.AM2302.
sensor = Adafruit_DHT.DHT11
dht11Pin = 25
relayPin = 23

# Try to grab a sensor reading.  Use the read_retry method which will retry up
# to 15 times to get a sensor reading (waiting 2 seconds between each retry).
humidity, temperature = Adafruit_DHT.read_retry(sensor, dht11Pin)


##GPIO.setmode(GPIO.BCM)
##GPIO.setwarnings(False)
##GPIO.setup(relayPin,GPIO.OUT)

##print "relay on"
##GPIO.output(relayPin,GPIO.HIGH)


##print "relay off"
##GPIO.output(relayPin,GPIO.LOW)

# Note that sometimes you won't get a reading and
# the results will be null (because Linux can't
# guarantee the timing of calls to read the sensor).
# If this happens try again!
if humidity is not None and temperature is not None:
    # turn heating on and off
    if temperature + 1 < desiredTemp:
        ##GPIO.output(relayPin,GPIO.HIGH)
        print('Turning on heating!')

    if temperature - 1 > desiredTemp:
        ##GPIO.output(relayPin,GPIO.LOW)
        print('Turning off heating!')

    if temperature == desiredTemp:
        ##GPIO.output(relayPin,GPIO.LOW)
        print('No change in heating status.')

    # write climate readings to file
    now = strftime("%Y%m%d %H%M%S", gmtime())
    msg = '"ActualTemp":{0:0.1f};"ActualHumidity":{1};"DesiredTemp":{2};"Date":{3};'.format(temperature, humidity, desiredTemp, now)
    print(msg)
    climate = {
        'ActualTemp' : temperature,
        'ActualHumidity': humidity,

        'Date': now
    }
    with open('/var/www/html/climate.json', 'w') as outfile:
        json.dump(climate, outfile)
    outfile.close() 
else:
    print('Failed to get reading. Try again!')


