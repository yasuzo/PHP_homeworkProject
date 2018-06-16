N1j3_b1l0_t35k0_z4r_n3?

-Dekodirao sam Cezarov kod koji je bio u komentaru
-Proucio sam src projekta
-Napravio SQL injection preko username input fielda -> ") OR (admin=1 AND ""=") -> ulogiran sam kao admin
-Adminov token, ubacio u header s nazivom 'token', takodjer sam u header stavio cookie PHPSESSID da ostanem ulogiran 
te ubacio i 'authorization' polje za autorizaciju pri dolasku na stranicu
-Poslao post request s parametrom filter='| cat ../app/flag.txt' na http://oipa.tech:8080/?page=api-tmp-dir-content (prije toga sam prvo kao filter poslao '../' da bi izlistao foldere na serveru