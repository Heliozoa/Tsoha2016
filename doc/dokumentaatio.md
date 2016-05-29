##Johdanto
Taistelupelien turnauspalvelussa (Hiihtokisojen tulospalvelu) voi seurata eri taistelupelien turnausten kulkua ja tuloksia.

Sivustolla voi selata joko tällä hetkellä käynnissä olevia turnauksia, viimeisimpiä tuloksia tai esim. valita pelin, jonka turnauksia haluaa tarkastella. Rekisteröityneet käyttäjät voivat lisätä omia turnauksia, mutta vain ylläpitäjä voi lisätä uusia pelejä.

Turnauksen luoja saa avaimen, jota käyttämällä myös muut järjestäjät voivat kirjautumatta ylläpitää tuloksia. Ainoastaan turnauksen luoja voi tehdä isompia muutoksia, esim. muuttaa virheellisiä tietoja. Pelkkien tulosten lisäksi palveluun kirjataan myös, mitä hahmoja pelaajat ovat käyttäneet, jolloin tiedoista voidaan muodostaa erilaisia kiinnostavia tilastoja. Käynnissä oleviin turnauksiin voi lisätä stream-embedin ja loppuneille videon.

En tiedä web-sovellusten toteuttamisesta tarpeeksi, että osaisin sanoa mitään järkevää teknisemmistä asioista. Aion toteuttaa järjestelmän ohjeiden mukaan PHPlla. PDFän teko on myös hakusessa, siksi md. **Fokus siirtyi viikolla 2 enemmän turnausten katsomiseen jälkeenpäin videoiden avulla.**


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

![Käsitekaavio](https://github.com/Heliozoa/Tsoha-Bootstrap/blob/master/doc/k%C3%A4sitekaavio.png)

####Tietokohde: Peli
Attribuutti|Arvojoukko|Kuvailu
----|----|----
Nimi|Merkkijono|Nimi
Tiedot|Merkkijono|Lyhyt kuvaus, julkaisuvuosi jne.
Taistelupeli, jota pelataan turnauksissa.

####Tietokohde: Turnaustapahtuma
Attribuutti|Arvojoukko|Kuvailu
----|----|----
Nimi|Merkkijono|Nimi
Paikka|Merkkijono|Tapahtumapaikka
Aloituspäivä|Date|Päivä jona turnaus alkaa
Lopetuspäivä|Date|Päivä jona turnaus loppuu
Live|Boolean|Onko turnauksesta käynnissä stream
Stream URLS|Array String|Streamien osoitteet
Päivitysavain|Merkkijono|Avain, jonka omaava käyttäjä voi päivittää turnauksen tuloksia.
Tapahtuma, jossa voidaan pelata turnauksia yhdestä tai useammasta pelistä.

####Tietokohde: Turnaus
Attribuutti|Arvojoukko|Kuvailu
----|----|----
Tulokset|String Array|Turnauksen loppusijoitukset
Yksittäiseen peliin liittyvä turnaus, joka on osa jotain turnaustapahtumaa. Turnauksen jälkeen tiedetään sen loppusijoitukset. Toimii myös liitostauluna.

####Tietokohde: Ottelu
Attribuutti|Arvojoukko|Kuvailu
----|----|----
Nimi|Merkkijon|Ottelun nimi, esim. 'Grand Finals', 'Winners Finals' tai 'Top 32'
Pelaaja1|Merkkijono|Ottelun osapuoli
Pelaaja2|Merkkijono|Ottelun osapuoli
Voittaja1|Boolean|Voittiko pelaaja 1
Tulos|Merkkijono|Ottelun lopputulos, esim. 3-2
Järjestys|Luku|Luku, joka kertoo missä järjestyksessä ottelut tulee näyttää (Finaalit viimeisenä, semifinaalit toiseksiviimeisenä, jne.)
Video URL|Merkkijono|Linkki videoon tai streamiin ottelusta.
Yksittäinen ottelu, joka on osa jotakin turnausta.

![Relaatiotietokantakaavio](https://github.com/Heliozoa/Tsoha-Bootstrap/blob/master/doc/relaatiotietokantakaavio.png)