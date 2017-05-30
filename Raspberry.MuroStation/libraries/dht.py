# Importeer Adafruit DHT bibliotheek.
import Adafruit_DHT
# Importeer bibliotheek voor systeemfuncties.
import sys
# Importeer bibliotheek voor tijdfuncties.
import time
# Importeer bibliotheek voor CSV functies.
import csv
# Set up timer
from time import sleep
  
sensor = Adafruit_DHT.DHT11
pin = 4

#count = 0
#while (count < 9):
varC = 1
while varC == 1 :
  #count = count + 1
  sleep(300)

  # Definieer variabelen.
  DY = time.strftime("%Y")
  DM = time.strftime("%m")
  DD = time.strftime("%d")
  TH = time.strftime("%H")
  TM = time.strftime("%M")

  humidity, temperature = Adafruit_DHT.read_retry(sensor, pin)
  humidity = round(humidity, 2)
  temperature = round(temperature, 2)
  if humidity is not None and temperature is not None:
    print 'Temperatuur = {0:0.1f}*C  Luchtvochtigheid={1:0.1f}%'.format(temperature, humidity)
  else:
    print 'Kan de sensor niet uitlezen!'
 
  data = [DY, DM, DD, TH, TM, humidity, temperature]
  # Sla gegevens op in een bestand (per maand) in /usr/src/DHT_DATA_[YYYY]_[MM]_[DD].csv
  csvfile = "/var/www/html/data/DHT_DATA_" + DY + DM + DD + ".csv"
 
  # Open het csv bestand en schijf door achter de bestaande inhoud.
  with open(csvfile, "a") as output:
    writer = csv.writer(output, delimiter=";", lineterminator='\n')
    writer.writerow(data)
