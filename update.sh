#!/bin/bash

echo "Updating piscreen-server"

if [[ $EUID -ne 0 ]]; then
  echo "This script must be run as root" 1>&2
  exit 1
fi

echo "Updating packages"
apt-get -y update
apt-get -y upgrade

echo "Updating webfiles"
echo "Downloading files"
git clone https://github.com/Underlyingglitch/piscreen-server piscreen-server-update
cd piscreen-server-update
echo "Removing old files"
rm -rf ../../webserver
echo "Copying new files"
cp -r webserver ../../webserver

echo "Restarting services"
mv dist/scripts/piscreen-server-api.service /lib/systemd/system/piscreen-server-api.service
mv dist/scripts/piscreen-server-controlpanel.service /lib/systemd/system/piscreen-server-controlpanel.service
chmod 644 /lib/systemd/system/piscreen-server-api.service
chmod 644 /lib/systemd/system/piscreen-server-controlpanel.service
chmod +x /home/pi/piscreen-server/webserver/startapiserver.py
chmod +x /home/pi/piscreen-server/webserver/startcontrolpanel.py

echo "Reloading deamon"
systemctl daemon-reload

echo "Activating services"
systemctl enable piscreen-server-api.service
systemctl enable piscreen-server-controlpanel.service
systemctl start piscreen-server-api.service
systemctl start piscreen-server-controlpanel.service

echo "Removing tmp files"
cd ../../
rm -rf piscreen-server-update
