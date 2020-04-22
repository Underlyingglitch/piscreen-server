# piscreen-server

## About
Use this package in combination with [piscreen-client](https://github.com/Underlyingglitch/piscreen-client)

This application lets you control your piscreen players. It was built for Raspberry PI, but can be used on almost all Linux devices.

This server package has to be installed on a seperate device. The server and client software can't run on the same device.

## Installation
There are 2 ways of installing this software: manual install, and by using the provided .img file

### Using the .img file (recommended)
1. Download the latest version from the releases tab.

2. Download Balena Etcher (or a similar tool) from [their website](https://www.balena.io/etcher/)

3. Flash the image to an SD card (Warning: the existing data will be destroyed)

4. Boot up the Raspberry Pi

5. Connect to the Raspberry Pi using SSH

   `ssh pi@piscreenserver`

   or by using the local IP address

   `ssh pi@xxx.xxx.xx.xx`

6. Change the password for security

   `sudo passwd pi`

   Enter your new password

7. Move on to the setup section

### Manual installation
1. Flash a version of Raspbian Buster (lite is recommended) software to an SD card. Install Raspbian to a Raspberry PI and make sure SSH is enabled.

2. SSH into the Raspberry PI

3. Change the user password for security

   `sudo passwd pi`

   Enter your new password

4. Clone the GitHub repository to the home folder

   `git clone https://github.com/Underlyingglitch/piscreen-server`

5. Cd into the directory

   `cd piscreen-server`

6. Run install.sh script

   `sudo sh ./install.sh`

7. Move on to the setup section

## Setup
After you installed the server software to the Raspberry Pi using one of the methods above, you can use the software to control client devices.

The server device only needs power and an ethernet cable (WiFi is possible, but not recommended). You don't need an HDMI screen. Everything is done using the web-based control panel.

To log in to the control panel, go to the following address:

http://piscreenserver/

WARNING: if the firewall in your network is configured to block these hostnames, replace the hostname with the local IP address like this:

http://xxx.xxx.xx.xx/

Log in using these credentials:

```
username: admin
password: admin
```

The admin user has access to every page in the control panel. Go to the users page using the navigation bar on the left side.

![users page](https://user-images.githubusercontent.com/36314703/79972569-715b6f80-8496-11ea-9501-b5d825b989ff.png)
