# OIPA - Osnove izrade PHP aplikacija

Dobrodošli na vještinu **OIPA - osnove izrade PHP aplikacija**. Ovaj ćete repozitorij koristit kroz vještinu za eksperimentiranje i rješavanje zadaća.

## Docker

Kako bi vam olakšali radi s Docker okruženjem, dodana je skripta `docker/app`. Ona nudi par jednostavnih naredbi za najčešće korištene funkcionalnosti:

- `docker/app start` - pokreće kontejner ukoliko već nije pokrenut
- `docker/app stop` - zaustavlja kontejner ukoliko je pokrenut
- `docker/app status` - ispisuje jeli kontejner pokrenut ili nije
- `docker/app exec` - izvršava proizvoljnu naredbu unutar kontejnera koji je pokrenut (pokreće ga ukoliko nije)
- `docker/app php` - pokreće PHP CLI sučelje unutar kontejnera koji je pokrenut (pokreće ga ukoliko nije)
- `docker/app psysh` - pokreće interaktivnu konzolu [PsySH](http://psysh.org/) koju možete koristiti za istraživanje PHP-a

Kontejner se pokreće s opcijom `--rm` što znači da će po izlasku iz kontejnera on biti i uništen.

Direktorij `src` se ubacuje u kontejner na lokaciju `/app/src` što je ujedno i korjenski direktorij poslužitelja u kontejneru.

### Konfiguracija

Unutar `docker/.env.sample` imate primjer dodatnih konfiguracijskih opcija koje možete promijeniti po vašim potrebama.

Kako biste ih izmijenili, stvorite datoteku `docker/.env` i u njoj postavite potrebne vrijednosti.

Za sada su dostupne opcije:

- `OIPA_BACKEND_IMAGE_VERSION` - tag slike koja se koristi za stvaranje kontejnera. Kako će vještina napredovati, bit će dodavane nove stvari u slike i njihove će verzije rasti
- `OIPA_PUBLISHED_PORT` - ukoliko baš ne želite imati poslužitelj na portu `80`, možete ovdje izmjeniti tu vrijednost

## Korištenje

Pokrenite `docker/app start` kako biste pokrenuli kontejner. Nakon toga biste trebali na `http://127.0.0.1` informacije o PHP-u. Ukoliko ste promijenili port, morate ga dodati i u URL.

Jednom kada ste gotovi s radom, pokrenite `docker/stop` kako biste zaustavili aplikaciju.

## Izrada domaćih zadaća

Zadaće implementirate unutar `./src/dz/` direktorija i kod unutar tog direktorija možete pokretati preko `http://127.0.0.1/dz/` ili `http://localnost/dz/`.

Jednom, kada ste gotovi sa zadaćom, tagirate ju i šaljete na udaljeni repozitorij. Ovisno o tome koliko ćete puta `commitati` ovisi kojim ćete procesom raditi zadaće. 

Naša je preporuka da `commitate` smislene cjeline i da to radite relativno često, čim ste gotovi s nekim segmentom funkcionalnosti. U tom slučaju možete za svaku zadaću, iz `master` grane napraviti novu granu, tamo odraditi sve promjene i vratiti novokreiranu granu u `master`. Ukoliko niste zadovoljni promjenama, lakše ih je ignorirati.

Ukoliko nećete često `commitati`, ne morate raditi nove grane već možete sve direktno na `master` no tada morate koristiti druge metode za resetiranje promjena koje ipak ne želite.

Primjer jednog rješavanja zadaće može biti:

```
git checkout master

git branch dz-1
git checkout dz-1 # ova i prethodna naredba može kraće kao git checkout -b dz-1

# odradimo neke promjene
git commit -m 'Odradio sam neke male promjene'

# odradimo još neke promjene
git commit -m 'Ovo su druge promjene

# gotovi smo
git checkout master
git merge dz-1
git branch -d dz-1 # grana nam više ne treba

# šaljemo master
git push master

# tagiramo i šaljemo zadaću
git tag dz-1
git push origin dz-1
```
