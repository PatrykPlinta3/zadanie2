<?php
// KONTROLER strony kalkulatora
require_once dirname(__FILE__).'/../config.php';

// W kontrolerze niczego nie wysyła się do klienta.
// Wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy przez zmienne.

//ochrona kontrolera - poniższy skrypt przerwie przetwarzanie w tym punkcie gdy użytkownik jest niezalogowany
include _ROOT_PATH.'/app/security/check.php';

// 1. pobranie parametrów

$kwota = $_REQUEST ['kwota'];
$lata = $_REQUEST ['lata'];
$oprocentowanie = $_REQUEST ['oprocentowanie'];

// 2. walidacja parametrów z przygotowaniem zmiennych dla widoku

// sprawdzenie, czy parametry zostały przekazane
if ( isset($kwota) && isset($lata) && isset($oprocentowanie)) {
    // sprawdzenie, czy potrzebne wartości zostały przekazane
    if ( $kwota == "") {
        $messages [] = 'Nie podano kwoty';
    }
    if ( $lata == "") {
        $messages [] = 'Nie podano raty';
    }
    if ( $oprocentowanie == "") {
        $messages [] = 'Nie podano oprocentowania';
    }

    //nie ma sensu walidować dalej gdy brak parametrów
    if (empty( $messages )) {

        // sprawdzenie, czy $x i $y są liczbami całkowitymi
        if (! is_numeric( $kwota )) {
            $messages [] = 'Podana kwota nie jest liczbą całkowitą';
        }

        if (! is_numeric( $lata )) {
            $messages [] = 'Podana ilość lat nie jest liczbą całkowitą';
        }

        if (! is_numeric( $oprocentowanie )) {
            $messages [] = 'Podane oprocentowanie nie jest liczbą całkowitą';
        }

        global $role;
        if ($role != 'admin'){
            $messages [] = 'Tylko administrator może obliczac ratę kredytu !';
        }
    }

    // 3. wykonaj zadanie jeśli wszystko w porządku

    if (empty ( $messages )) { // gdy brak błędów

        //konwersja parametrów na int
        $kwota = intval($kwota);
        $lata = intval($lata);
        $oprocentowanie = intval($oprocentowanie);

        //wykonanie operacji
        $ilosc_rat = ($lata * 12);
        $kwota_kredytu = $kwota * pow(1 + ($oprocentowanie / 100), $lata);
        $kwota_kredytu_zaokr = round($kwota_kredytu, 2);
        $rata_zaokr = round($kwota_kredytu / $ilosc_rat, 2);
        $result = "Rata miesięczna wynosi: " . $rata_zaokr . " zł, a cała kwota kredytu to: " . $kwota_kredytu_zaokr . " zł";
    }
}

// 4. Wywołanie widoku z przekazaniem zmiennych
// - zainicjowane zmienne ($messages,$x,$y,$operation,$result)
//   będą dostępne w dołączonym skrypcie
include 'kredyt_view.php';