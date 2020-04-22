# piscreen-server

## About
Use this package in combination with [piscreen-client](https://github.com/Underlyingglitch/piscreen-client)

This application lets you control your piscreen players. It was built for Raspberry PI, but can be used on almost all Linux devices.

This server package has to be installed on a seperate device. The server and client software can't run on the same device.

## Installation
There are 2 ways of installing this software: manual install, and by using the provided .img file

### Using the .img file (recommended)

### Manual installation
1. Flash a version of Raspbian Buster (lite is recommended) software to an SD card. Install Raspbian to a Raspberry PI and make sure SSH is enabled.

2. SSH into the Raspberry PI

3. Clone the GitHub repository to the home folder

   `git clone https://github.com/Underlyingglitch/piscreen-server`

4. Cd into the directory

   `cd piscreen-server`

5. Run install.sh script

   `sudo sh ./install.sh`
