##Johdanto
Taistelupelien tulospalveluun (Hiihtokisojen tulospalvelu) voi kirjata eri taistelupelien turnausten kulkua ja tuloksia.

Sivustolla voi selata joko tällä hetkellä käynnissä olevia turnauksia, viimeisimpiä tuloksia tai esim. valita pelin, jonka turnauksia haluaa tarkastella. Rekisteröityneet käyttäjät voivat lisätä omia turnauksia, mutta vain ylläpitäjä voi lisätä uusia pelejä.

Turnauksen luoja saa avaimen, jota käyttämällä myös muut järjestäjät voivat kirjautumatta ylläpitää tuloksia. Ainoastaan turnauksen luoja voi tehdä isompia muutoksia, esim. muuttaa virheellisiä tietoja. Pelkkien tulosten lisäksi palveluun kirjataan myös, mitä hahmoja pelaajat ovat käyttäneet, jolloin tiedoista voidaan muodostaa erilaisia kiinnostavia tilastoja. Myös mahdollisuus lisätä embed streamiin käynnissäoleville turnauksille ja videoita jo päättyneille olisi kiva.

En tiedä web-sovellusten toteuttamisesta tarpeeksi, että osaisin sanoa mitään järkevää teknisemmistä asioista. Aion toteuttaa järjestelmän ohjeiden mukaan PHPlla. PDFän teko on myös hakusessa, siksi md.


##Käyttäjäryhmät
####Kirjautumaton
Käyttäjä, joka ei ole kirjautunut järjestelmään.

####Kirjautunut
Käyttäjä, joka on rekisteröitynyt ja kirjautunut järjestelmään.

####Ylläpitäjä
Sivuston omistaja. Ylläpitäjä on myös kirjautunut.

####Turnauksen järjestäjä
Käyttäjä, jolla on turnauksen päivitysavain. Voi olla Kirjautumaton tai Kirjautunut.

##Käyttötapaukset

![Käyttötapaukset](https://github.com/Heliozoa/Tsoha-Bootstrap/blob/master/doc/k%C3%A4ytt%C3%B6kaavio.png)

####Kaikille tarjolla olevat käyttötapaukset

#####Turnausten selaus:
Voi selata ja hakea turnauksia eri kriteerein.

#####Muita käyttötapauksia:
rekisteröityminen, kirjautuminen

####Kirjautunut

#####Turnauksen luonti:
Voi luoda uuden turnauksen.

#####Turnauksen päivitys:
Voi muuttaa luomiaan turnauksia.

####Ylläpitäjä

#####Pelin lisääminen:
Voi lisätä uuden pelin järjestelmään.

#####Pelien muokkaaminen:
Voi muuttaa pelin tietoja.

#####Turnausten muokkaus:
Ylläpitäjä voi muokata kaikkia turnauksia, ei vain itse luomiaan.

#####Käyttäjien poisto:
Ylläpitäjä voi poistaa käyttäjän.


##Järjestelmän tietosisältö

![Käsitekaavio](temp)

####Tietokohde: Peli
Attribuutti|Arvojoukko|Kuvailu
----|----|----
Nimi|Merkkijono|Nimi
Tiedot|Merkkijono|Lyhyt kuvaus, julkaisuvuosi jne.

####Tietokohde: Turnaus
Attribuutti|Arvojoukko|Kuvailu
----|----|----
Nimi|Merkkijono|Nimi
Paikka|Merkkijono|Tapahtumapaikka
Aika|Aika|Tapahtuma-aika
Tulokset|Merkkijono?|Turnauksen loppusijoitukset, jotain muuta tilastoja?

####Tietokohde: Ottelu
Attribuutti|Arvojoukko|Kuvailu
----|----|----
Nimi|Merkkijono|Nimi
Pelaajat|Merkkijono|Ottelun osapuolet
Tulos|Merkkijono|Ottelun lopputulos

![Relaatiotietokantakaavio](temp)