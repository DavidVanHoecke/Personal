#!/usr/bin/python

import json
import os
import time

while True:
    with open('/var/www/html/desiredTemp.json') as data_file:    
        data = json.load(data_file)
        data_file.close()
        cmd = "python /var/www/html/setTempAndWriteResults.py " + str(data["DesiredTemp"])
        os.system(cmd)
    time.sleep(30)
