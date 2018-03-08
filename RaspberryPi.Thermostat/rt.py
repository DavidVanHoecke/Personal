#!/usr/bin/python

import Adafruit_DHT
import RPi.GPIO as GPIO

    
# Sensor should be set to Adafruit_DHT.DHT11,
# Adafruit_DHT.DHT22, or Adafruit_DHT.AM2302.
sensor = Adafruit_DHT.DHT11
dht11Pin = 23
GPIO.setmode(GPIO.BCM)
GPIO.setwarnings(False)

# Try to grab a sensor reading.  Use the read_retry method which will retry up
# to 15 times to get a sensor reading (waiting 2 seconds between each retry).
humidity, temperature = Adafruit_DHT.read_retry(sensor, dht11Pin)

# write climate readings to file
msg = '"ActualTemp":{0:0.1f};"ActualHumidity":{1};'.format(temperature, humidity)
print(msg)
    