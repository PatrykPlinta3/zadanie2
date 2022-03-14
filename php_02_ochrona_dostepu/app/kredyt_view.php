<?php require_once dirname(__FILE__) .'/../config.php';?>
<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
    <meta charset="utf-8" />
    <title>Kalkulator kredytowy</title>
    <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.6.0/pure-min.css">
</head>

<div style="width:90%; margin: 2em auto;">
    <a href="<?php print(_APP_ROOT); ?>/app/inna_chroniona.php" class="pure-button">kolejna chroniona strona</a>
    <a href="<?php print(_APP_ROOT); ?>/app/kredyt.php" class="pure-button">Kalkulator kredytowy</a>
    <a href="<?php print(_APP_ROOT); ?>/app/security/logout.php" class="pure-button pure-button-active">Wyloguj</a>
</div>

<div style="width:90%; margin: 2em auto;">

<form action="<?php print(_APP_ROOT);?>/app/kredyt.php" method="post" class="pure-form pure-form-stacked">
    <label for="id_kwota">Kwota: </label>
    <input id="id_kwota" type="text" name="kwota" value="<?php print($kwota); ?>" /><br />
    <label for="id_lata">Ile lat: </label>
    <input id="id_lata" type="text" name="lata" value="<?php print($lata); ?>" /><br />
    <label for="id_oprocentowanie">Oprocentowanie: </label>
    <input id="id_oprocentowanie" type="text" name="oprocentowanie" value="<?php print($oprocentowanie); ?>" /><br />
    <input type="submit" value="Oblicz" />
</form>

<?php
//wyświeltenie listy błędów, jeśli istnieją
if (isset($messages)) {
    if (count ( $messages ) > 0) {
        echo '<ol style="margin: 20px; padding: 10px 10px 10px 30px; border-radius: 5px; background-color: #f88; width:300px;">';
        foreach ( $messages as $key => $msg ) {
            echo '<li>'.$msg.'</li>';
        }
        echo '</ol>';
    }
}
?>

<?php if (isset($result)){ ?>
    <div style="margin: 20px; padding: 10px; border-radius: 5px; background-color: #ff0; width:300px;">
        <?php echo 'Wynik: '.$result; ?>
    </div>
<?php } ?>
</div>
</body>
</html>