#!/usr/bin/python

import RPi.GPIO as GPIO
ledPin = 18
GPIO.setmode(GPIO.BCM)
GPIO.setwarnings(False)
GPIO.setup(ledPin,GPIO.OUT)

    
GPIO.output(ledPin,GPIO.LOW)
       
print('ledOff.OFF!')


