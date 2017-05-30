# Import the modules to send commands to the system 
import os

# Restart
os.system('shutdown now -r')


sudo chown root:www-data /usr/src/restart.py
sudo chmod 755 /usr/src/restart.py