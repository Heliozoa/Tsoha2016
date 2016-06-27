##Johdanto
Taistelupelien turnauspalvelussa voi seurata sekä tämänhetkisiä että jo menneitä turnauksia. Sivustolla voi selata pelitapahtumia jotka koostuvat yhdestä tai useammasta turnauksesta. Turnaus liittyy aina johonkin peliin ja koostuu otteluista. Live-tapahtumien sivuilla on linkit stream-sivuille, kun taas vanhojen tapahtumien ottelusivuilla on video ottelusta. Työ on toteutettu ohjeiden mukaisesti PHP:llä ilman mitään ylimääräisiä systeemeitä.

Työ on vielä work-in-progress siinä mielessä, että esim. päivitysavaimiin tai turnauksen tuloksiin liittyvää toimintaa ei ole toteutettu. Kuitenkin uskoisin että kaikki oleellinen toiminta on toteutettu ja projektin kannalta työ on valmis.



##Yleiskuva järjestelmästä

###Käyttötapaukset
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


###Käyttäjäryhmät

####Kirjautumaton
Käyttäjä, joka ei ole kirjautunut järjestelmään.

####Kirjautunut
Käyttäjä, joka on rekisteröitynyt ja kirjautunut järjestelmään.

####Ylläpitäjä
Sivuston omistaja. Ylläpitäjä on myös kirjautunut.

####Turnauksen järjestäjä
Käyttäjä, jolla on turnauksen päivitysavain. Voi olla Kirjautumaton tai Kirjautunut.



##Järjestelmän tietosisältö

![Käsitekaavio](https://github.com/Heliozoa/Tsoha-Bootstrap/blob/master/doc/k%C3%A4sitekaavio.png)

####Tietokohde: Game
Attribuutti|Arvojoukko|Kuvailu
----|----|----
Name|Merkkijono|Nimi
Info|Merkkijono|Lyhyt kuvaus, julkaisuvuosi jne.
Taistelupeli, jota pelataan turnauksissa.

####Tietokohde: Event
Attribuutti|Arvojoukko|Kuvailu
----|----|----
Name|Merkkijono|Nimi
Location|Merkkijono|Tapahtumapaikka
Start date|Date|Päivä jona turnaus alkaa
End date|Date|Päivä jona turnaus loppuu
Live|Boolean|Onko turnauksesta käynnissä stream
Stream URLS|Merkkijono|Streamien osoitteet
Update key|Merkkijono|Avain, jonka omaava käyttäjä voi päivittää turnauksen tuloksia.
Tapahtuma, jossa voidaan pelata turnauksia yhdestä tai useammasta pelistä.

####Tietokohde: Tournament
Attribuutti|Arvojoukko|Kuvailu
----|----|----
Name|Merkkijono|Turnauksen nimi
Results|Merkkijonotaulukko|Turnauksen loppusijoitukset
Yksittäiseen peliin liittyvä turnaus, joka on osa jotain turnaustapahtumaa. Turnauksen jälkeen tiedetään sen loppusijoitukset. Toimii myös liitostauluna. Turnauksen nimi on vapaaehtoinen ja on olemassa, jotta mahdolliset saman tapahtuman saman pelin turnaukset voidaan erotella.

####Tietokohde: Fight
Attribuutti|Arvojoukko|Kuvailu
----|----|----
Name|Merkkijono|Ottelun nimi, esim. 'Grand Finals', 'Winners Finals' tai 'Top 32'
Player1|Merkkijono|Ottelun osapuoli
P1score|Luku|Player1:n pisteet
Player2|Merkkijono|Ottelun osapuoli
P2score|Luku|Player2:n pisteet
Winner1|Boolean|Voittiko pelaaja 1
Ordering|Luku|Luku, joka kertoo missä järjestyksessä ottelut tulee näyttää (Finaalit viimeisenä, semifinaalit toiseksiviimeisenä, jne.)
Video URL|Merkkijono|Linkki videoon tai streamiin ottelusta.
Timecode|Luku|Aika sekunneissa, jolloin videon tulee alkaa.
Yksittäinen ottelu, joka on osa jotakin turnausta.



##Relaatiotietokantakaavio
![Relaatiotietokantakaavio](https://github.com/Heliozoa/Tsoha-Bootstrap/blob/master/doc/relaatiotietokantakaavio.png)



##Järjestelmän yleisrakenne
Sovellus noudattaa MVC-mallia. Kontrollerit, näkymät ja mallit sijaitsevat hakemistoissa app/controllers, app/views ja app/models.



##Käyttöliittymä ja järjestelmän komponentit
![Käyttöliittymä ja järjestelmän komponentit](https://github.com/Heliozoa/Tsoha-Bootstrap/blob/master/doc/kayttoliittyma_ja_jarjestelman_komponentit.png)

Sivustolla on navigaatiopalkki jolla pääsee tapahtumien listaukseen, pelien listaukseen ja kirjautumissivulle. Kaikilta ottelusivuilta pääsee vastaaviin turnauksen ja tapahtuman esittelysivuihin, samoin kaikilta turnaussivuilta pääsee vastaavan tapahtuman esittelysivuun.



##Asennustiedot
Palvelu käyttää PostgreSQL-tietokantaa.

##Käynnistys- / käyttöohje
Työ löytyy osoitteesta ![madamada.users.cs.helsinki.fi/tournaments/](http://madamada.users.cs.helsinki.fi/tournaments/)

####Käyttäjät:
Tyyppi|Käyttäjänimmi|Salasana
----|----|----
Admin|super|super
Tavallinen käyttäjä|basic|basic
    
    

