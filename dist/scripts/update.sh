#!/bin/bash

echo "Updating piscreen-server"

if [[ $EUID -ne 0 ]]; then
  echo "This script must be run as root" 1>&2
  exit 1
fi

rm -rf /var/www/api
rm -rf /var/www/controlpanel
rm -rf /home/pi/piscreen-server
rm -rf /home/pi/piscreen-server/piscreen-server.zip

git clone https://github.com/Underlyingglitch/piscreen-server /home/pi/piscreen-server

sudo sh /home/pi/piscreen-server/update.sh
