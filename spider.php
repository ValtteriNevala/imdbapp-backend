<?php

//funktiot käyttöön
require('functions.php');

try {
//tietokantayhteys
$dbcon = createDbConnection();
//muodostetaan sql-lause, joka hakee otsikot vuodet kestot ja arvostelut.
// Etsitään julkaisut, joissa esiintyy Spider-Man 
//järjestetään laskevaan järjestykseen arvosanan mukaan
selectAsJson($dbcon, 'SELECT titles.title_id, primary_title, start_year, average_rating 
    FROM titles, had_role, title_ratings
    WHERE titles.title_id = had_role.title_id AND role_ LIKE "%Spider-Man%" AND titles.title_id =title_ratings.title_id
    group BY titles.title_id 
    order by average_rating DESC
    LIMIT 10');
  }  catch (PDOException $pdoex) {
        returnError($pdoex);
    }
