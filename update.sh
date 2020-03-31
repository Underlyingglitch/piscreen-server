#!/bin/bash

echo "Updating piscreen-server"

if [[ $EUID -ne 0 ]]; then
  echo "This script must be run as root" 1>&2
  exit 1
fi

echo "Installing packages"
apt-get -y update
apt-get -y upgrade

echo "Updating webfiles"
cd ~
echo "Downloading files"
git clone https://github.com/Underlyingglitch/piscreen-server piscreen-server-update
cd piscreen-server-update/webserver
echo "Removing old files"
rm -rf ~/piscreen-server/webserver/api
rm -rf ~/piscreen-server/webserver/controlpanel
echo "Copying new files"
cp api ~/piscreen-server/webserver/api
cp controlpanel ~/piscreen-server/webserver/controlpanel

echo "restarting services"
systemctl restart piscreen-server-api.service
systemctl restart piscreen-server-controlpanel.service
