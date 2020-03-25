#!/bin/bash

echo "Installing piscreen-server"

if [[ $EUID -ne 0 ]]; then
  echo "This script must be run as root" 1>&2
  exit 1
fi

echo "Installing packages"
apt-get -y install php5 php5-fpm php5-mysql

echo "Creating startup scripts"
mv dist/scripts/piscreen-server-api.service /lib/systemd/system/piscreen-server-api.service
sudo chmod 644 /lib/systemd/system/piscreen-server-api.service
chmod +x /home/pi/webserver/startapiserver.sh

echo "Reloading startup sequence"
systemctl daemon-reload

echo "Starting services"
systemctl enable piscreen-server-api.service
systemctl start piscreen-server-api.service
