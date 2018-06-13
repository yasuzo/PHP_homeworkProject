
<h5>Dodaj kategoriju</h5>
<form action="dodaj_kat.php" method="post">
    <label for="ime">Ime</label>
    <input type="text" name="ime">
    <input type="submit" value="Dodaj">
</form>

<h5>Uredi kategoriju</h5>
<form action="uredi_kat.php" method="post">
    <label for="id">Id</label>
    <input type="text" name="id">
    <label for="ime">Ime</label>
    <input type="text" name="ime">
    <input type="submit" value="Uredi">
</form>

<h5>Obrisi kategoriju</h5>
<form action="uredi_kat.php" method="post">
    <label for="id">Id</label>
    <input type="text" name="id">
    <input type="submit" value="Obrisi">
</form>

<hr>

<h5>Dodaj clanak</h5>
<form action="dodaj_clanak.php" method="post">
    <label for="naslov">Naslov</label>
    <input type="text" name="naslov">
    <label for="sadrzaj">Sadrzaj</label>
    <textarea name="sadrzaj" cols="30" rows="10"></textarea>
    <label for="kategorija_id">Kategorija Id</label>
    <input type="number" name="kategorija_id">
    <input type="submit" value="Dodaj">
</form>

<h5>Uredi clanak</h5>
<form action="uredi_clanak.php" method="post">
    <label for="id">Id</label>
    <input type="text" name="id">
    <label for="naslov">Naslov</label>
    <input type="text" name="naslov">
    <label for="sadrzaj">Sadrzaj</label>
    <textarea name="sadrzaj" cols="30" rows="10"></textarea>
    <label for="kategorija_id">Kategorija Id</label>
    <input type="number" name="kategorija_id">
    <input type="submit" value="Uredi">
</form>

<h5>Obrisi clanak</h5>
<form action="obrisi_clanak.php" method="post">
    <label for="id">Id</label>
    <input type="text" name="id">
    <input type="submit" value="Obrisi">
</form>
