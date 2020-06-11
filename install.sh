#!/bin/bash

echo "Installing piscreen-server"

if [[ $EUID -ne 0 ]]; then
  echo "This script must be run as root" 1>&2
  exit 1
fi

echo "Installing packages"
apt -y update
apt -y install php libapache2-mod-php

echo "Removing unnessesary packages"
apt -y autoremove

echo "Removing default apache config"
rm /etc/apache2/ports.conf
rm /etc/apache2/sites-enabled/000-default.conf

echo "Copying new configuration"
mv /home/pi/piscreen-server/dist/apache/000-default.conf /etc/apache2/sites-enabled/000-default.conf
mv /home/pi/piscreen-server/dist/apache/ports.conf /etc/apache2/ports.conf

echo "Copying webfiles to new location"
mv /home/pi/piscreen-server/webserver/controlpanel /var/www/controlpanel
mv /home/pi/piscreen-server/webserver/api /var/www/api

echo "Creating file location"
mkdir /var/www/data
mkdir /var/www/data/media
mkdir /var/www/data/media/text
mkdir /var/www/data/media/uploads
mkdir /var/www/data/players
mkdir /var/www/data/users
mv /home/pi/piscreen-server/dist/datafiles/media.json /var/www/data/media/media.json
mv /home/pi/piscreen-server/dist/datafiles/players.json /var/www/data/players/players.json
mv /home/pi/piscreen-server/dist/datafiles/controlpanel_users.json /var/www/data/users/controlpanel_users.json

echo "Restarting apache"
systemctl restart apache2

raspi-config nonint do_hostname piscreenserver

echo "Installation done!"
