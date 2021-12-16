<?php


//funktiot käyttöön
require('functions.php');

try {
// tietokantayhteys
$dbcon = createDbConnection();
// haetaan tiedot tietokannasta sql-lauseella
// catch tehty virhetilanteita varten
// haetaan Suomessa julkaistuja kestoltaan pisimpiä julkaisuja, jotka kuuluvat Comedy-kategoriaan ja ovat tyypiltään MOVIE
// keston pitää olla suurempi kuin 0 ja tulostusjärjestys on keston perusteella laskeva. Tulostuksesta tulee kymmenen pisintä julkaisua
selectAsJson($dbcon, 'SELECT titles.title_id, primary_title, start_year, runtime_minutes
    FROM titles, aliases, title_genres
    WHERE titles.title_id = aliases.title_id AND titles.title_id = title_genres.title_id 
    AND title_type = "movie" AND runtime_minutes > 0 AND genre = "Comedy\r" AND region = "FI"
    group BY titles.title_id 
    order by runtime_minutes DESC
    LIMIT 10');
}catch (PDOException $pdoex) {
        returnError($pdoex);
}