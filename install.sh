#!/bin/bash

echo "Installing piscreen-server"

if [[ $EUID -ne 0 ]]; then
  echo "This script must be run as root" 1>&2
  exit 1
fi

echo "Installing packages"
apt-get -y install php

echo "Removing default apache2 configuration"
sudo rm /etc/apache2/sites-available/000-default.conf
echo "Adding new configuration"
sudo mv dist/scripts/000-default.conf /etc/apache2/sites-available/000-default.conf
sudo chmod 644 /etc/apache2/sites-available/000-default.conf

echo "Changing webserver rights"
sudo chown -R pi:www-data /home/pi/piscreen-server/webserver/controlpanel

echo "Creating startup scripts"
mv dist/scripts/piscreen-server-api.service /lib/systemd/system/piscreen-server-api.service
sudo chmod 644 /lib/systemd/system/piscreen-server-api.service
chmod +x /home/pi/piscreen-server/webserver/startapiserver.py

echo "Reloading startup sequence"
systemctl daemon-reload

echo "Starting services"
systemctl enable piscreen-server-api.service
systemctl start piscreen-server-api.service
sudo service apache2 restart
