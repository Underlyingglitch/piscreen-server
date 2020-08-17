import time, os, requests
from os import path

def updatecheck():
    #Check for updates
    newversion = requests.get('https://raw.githubusercontent.com/Underlyingglitch/piscreen-server/master/CURRENT_VERSION').text.strip()
    with open('/var/www/data/CURRENT_VERSION') as f:
        currentversion = f.read().strip()
    f.close()
    if (newversion != currentversion):
        # Update available
        with open('/var/www/controlpanel/update', 'w') as f:
            f.write('update available')
        f.close()

def updateInstall():
    if path.exists('/var/www/apiserver/server/reboot.command'):
        os.system('sudo sh /var/www/data/scripts/update.sh')
        os.remove('/var/www/controlpanel/update')

while True:
    time.sleep(3)
    updatecheck()
    updateInstall()
