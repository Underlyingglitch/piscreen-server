#!/bin/bash

echo "Installing piscreen-server"

if [[ $EUID -ne 0 ]]; then
  echo "This script must be run as root" 1>&2
  exit 1
fi

echo "Installing packages"
apt-get -y install php

echo "Removing apache2"
sudo apt-get remove apache2
sudo apt-get purge apache2

echo "Creating startup scripts"
mv dist/scripts/piscreen-server-api.service /lib/systemd/system/piscreen-server-api.service
mv dist/scripts/piscreen-server-controlpanel.service /lib/systemd/system/piscreen-server-controlpanel.service
sudo chmod 644 /lib/systemd/system/piscreen-server-api.service
sudo chmod 644 /lib/systemd/system/piscreen-server-controlpanel.service
chmod +x /home/pi/piscreen-server/webserver/startapiserver.py
chmod +x /home/pi/piscreen-server/webserver/startcontrolpanel.py

echo "Reloading startup sequence"
systemctl daemon-reload

echo "Starting services"
systemctl enable piscreen-server-api.service
systemctl enable piscreen-server-controlpanel.service
systemctl start piscreen-server-api.service
systemctl start piscreen-server-controlpanel.service
