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
cd piscreen-server-update/webserver
echo "Removing old files"
rm -rf ../../webserver/api
rm -rf ../../webserver/controlpanel
echo "Copying new files"
cp -r api ../../webserver/api
cp -r controlpanel ../../webserver/controlpanel

echo "restarting services"
systemctl restart piscreen-server-api.service
systemctl restart piscreen-server-controlpanel.service

echo "Removing tmp files"
cd ../../
rm -rf piscreen-server-update
