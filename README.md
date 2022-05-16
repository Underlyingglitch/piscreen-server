# piscreen-server
## Project Ended
Due to other projects and tasks I can no longer maintain this project. This project and the server package will become archived. If you want to restart this project, or want to use (part of) the code, please contact me on Discord (Underlyingglitch#6612)

## Over deze software
Gebruik deze software samen met [piscreen-client](https://github.com/Underlyingglitch/piscreen-client)

Deze applicatie geeft u de mogelijkheid om uw piscreen clients te beheren. Deze software is gebouwd voor de Raspberry Pi, maar kan in theorie op bijna alle Linux OS's gebruikt worden.

Deze software moet op een apart apparaat worden geïnstalleerd. De server software kan niet naast de client software op hetzelfde apparaat draaien

## Installatie (niet werkend)
Er zijn 2 manieren om deze software te installeren, met een .img bestand (aangeraden) of handmatig

### Met een .img bestand
1. Download de laatste versie via de [releases](https://github.com/Underlyingglitch/piscreen-server/releases)

2. Download Balena Etcher (of een vergelijkbare tool) van [hun website](https://www.balena.io/etcher/)

3. Flash het .img bestand naar een lege SD kaart (Waarschuwing: bestaande data zal verloren gaan)

4. Start de Raspberry Pi op, HDMI scherm is niet nodig, maar wel een internetkabel

5. Gebruik SSH voor toegang tot de Raspberry Pi

   `ssh pi@piscreenserver`

   of gebruik het lokale IP adres:

   `ssh pi@xxx.xxx.xx.xx`

6. Verander het wachtwoord voor beveiliging

   `sudo passwd pi`

   Vul uw nieuwe wachtwoord in

7. Ga verder naar de setup sectie

### Handmatige installatie
1. Flash een versie van Raspbian Buster Lite naar een lege SD kaart.

2. Maak een leeg bestand aan in de root map van de SD kaart genaamd `ssh`, kleine letters, geen inhoud, en geen extensie

3. Gebruik SSH voor toegang tot de Raspberry Pi

   `ssh pi@piscreenserver`

   of gebruik het lokale IP adres:

   `ssh pi@xxx.xxx.xx.xx`

4. Verander het wachtwoord voor beveiliging

   `sudo passwd pi`

   Vul uw nieuwe wachtwoord in

5. Clone de GitHub repository naar de home map

   `git clone https://github.com/Underlyingglitch/piscreen-server`

6. `cd` naar de map

   `cd piscreen-server`

7. Run het install.sh script

   `sudo sh ./install.sh`

8. Ga verder naar de setup sectie

## Setup
Nadat de server software is geïnstalleerd op de Raspberry Pi door een van de bovenstaande installatiemethoden, kunt u gebruik maken van het 'web-based' beheerportaal.

De server hoeft alleen toegang te hebben tot stroom en een internetkabel (WiFi is ook mogelijk, maar wordt afgeraden). Er is geen HDMI kabel met scherm nodig. Alle communicatie gaat via het beheerportaal.

Om in te loggen op het beheerportaal gaat u naar het volgende adres:

http://piscreenserver/

WAARSCHUWING: als de firewall in het netwerk deze hostnames niet accepteerd, gebruik dan het locale IP adres:

http://xxx.xxx.xx.xx/

Login met de volgende gegevens:

```
gebruikersnaam: admin
wachtwoord: admin
```

De admin gebruiker heeft toegang tot alle pagina's binnen het beheerportaal. Ga naar de gebruikerspagina door gebruik te maken van de navigatie kolom aan de linkerkant.

Om het wachtwoord te veranderen, klik op de 'Reset wachtwoord' knop achter de admin gebruiker.

![users page](https://user-images.githubusercontent.com/36314703/79972569-715b6f80-8496-11ea-9501-b5d825b989ff.png)

Vul 2 keer een nieuw wachtwoord in en klik op opslaan

![reset password](https://user-images.githubusercontent.com/36314703/79980290-2c8a0580-84a3-11ea-8319-a19de0cb6fbc.png)

De software is nu helemaal klaar voor gebruik. Voor meer informatie, bekijk de [wiki pagina](https://github.com/Underlyingglitch/piscreen-server/wiki)
