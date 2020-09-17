#!/bin/bash

echo "Installing piscreen-server"

if [[ $EUID -ne 0 ]]; then
  echo "This script must be run as root" 1>&2
  exit 1
fi

echo "Installing packages"
apt -y update
apt -y install php7.3 curl php7.3-curl libapache2-mod-php python python-pip
pip install -r /home/pi/piscreen-server/requirements.txt

echo "Removing unnessesary packages"
apt -y autoremove

echo "Removing default apache config"
rm /etc/apache2/ports.conf
rm /etc/apache2/sites-enabled/000-default.conf
rm /etc/php/7.3/apache2/php.ini

echo "Copying new configuration"
mv /home/pi/piscreen-server/dist/apache/000-default.conf /etc/apache2/sites-enabled/000-default.conf
mv /home/pi/piscreen-server/dist/apache/ports.conf /etc/apache2/ports.conf
mv /home/pi/piscreen-server/dist/apache/php.ini /etc/php/7.3/apache2/php.ini

echo "Copying webfiles to new location"
mv /home/pi/piscreen-server/webserver/controlpanel /var/www
mv /home/pi/piscreen-server/webserver/api /var/www

echo "Creating file location"
mkdir /var/www/data
mkdir /var/www/data/media
mkdir /var/www/data/media/text
mkdir /var/www/data/media/uploads
mkdir /var/www/data/scripts
mv /home/pi/piscreen-server/dist/datafiles/media.json /var/www/data/media/media.json
mv /home/pi/piscreen-server/dist/datafiles/playlists.json /var/www/data/playlists.json
mv /home/pi/piscreen-server/dist/datafiles/players.json /var/www/data/players.json
mv /home/pi/piscreen-server/dist/datafiles/controlpanel_users.json /var/www/data/controlpanel_users.json
mv /home/pi/piscreen-server/dist/datafiles/updates.json /var/www/data/updates.json
mv /home/pi/piscreen-server/CURRENT_VERSION /var/www/data/CURRENT_VERSION
mv /home/pi/piscreen-server/dist/scripts/update.sh /var/www/data/scripts/update.sh

echo "Setting timezone"
rm /etc/localtime
ln /usr/share/zoneinfo/Europe/Amsterdam /etc/localtime

echo "Restarting apache"
systemctl restart apache2

raspi-config nonint do_hostname piscreenserver

echo "Setting chmod permissions"
chmod -R 777 /var/www

echo "Creating services"
mv /home/pi/piscreen-server/dist/scripts/piscreen.py /var/www/data/scripts/piscreen.py
mv /home/pi/piscreen-server/dist/files/piscreen.service /lib/systemd/system/piscreen.service
chmod 644 /lib/systemd/system/piscreen.service
chmod +x /var/www/data/scripts/piscreen.py
systemctl daemon-reload
systemctl enable piscreen.service
systemctl start piscreen.service

echo "Installation done!"
rm -rf /home/pi/piscreen-server

echo "Rebooting in 10 seconds"
sleep 10
reboot
