<?php

// Renvoie un nombre d'etaoile en fonction du mot choisi
function word2dots($word)
{
    $wordlength = strlen($word);
    $dotWord = "";
    for ($i = 0; $i < $wordlength; $i++) {
        $dotWord = "" . $dotWord . ".";
    }
    return $dotWord;
}

// La fonction suivante ouvre le fichier, et renvoie un mot aléatoire.
function getWord()
{

    // Lecture du fichier
    $filename = "words.txt";

    $filehandle = fopen($filename, "r");
    $filecontent = fread($filehandle, filesize($filename));
    fclose($filehandle);

    if (!$filehandle) {
        echo 'Erreur de lecture du fichier';
    }

    // Découpage de $word en tableau
    $words = explode("\|", $filecontent);
    $words_amount = count($words);

    // Generer un nombre aleatoire
    $random_number = mt_rand(0, $words_amount);

    // Retour d'un mot
    $theWord2 = $words[$random_number];

    return $theWord2;
}

$theWord = getWord();

// Remplir les tableaux 
for ($d = 0; $d < strlen($theWord); $d++) {
    $theWordArray[$d] = substr($theWord, $d, 1);
    $guessWordArray[$d] = substr($guessWord, $d, 1);
}

// Verification de l'occurencex de la lettre
$letterOccured = false;
for ($f = 0; $f < strlen($theWord); $f++) {
    if ($theWordArray[$f] == $letter) {
        $letterOccured = true;
        $guessWordArray[$f] = $theWordArray[$f];
    }
}

// Update word 
$guessWord = "";
for ($r = 0; $r < strlen($theWord); $r++) {
    $guessWord = "" . $guessWord . "" . $guessWordArray[$r] . "";
}

if ($guessWord == $theWord) {
    $message = "Vous avez gagnez !!!";
    $theWord = "";
    $guessWord = "";
    $endGame = true;
    $guessWord = $theWord;
}

if ($letterOccured == false) {
    $error_amount++;
    // if le nombre d'erreur a atteint 9 player lose
    if ($error_amount > 9) {
        $message = "Vous avez perdu !!!";
        $guessWord = "";
        $endGame = true;
        $guessWord = $theWord;
    }
} else {
    // Afficher un msg
    if (preg_match("/[A-Z\s_]/i", $letter) < 0) {
        $message = "Donnees incorrect";
    } else {
        $message = "Enter a letter!";
    }
}

$guessWord = word2dots($theWord);