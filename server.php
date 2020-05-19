<?php
session_start();


$username = "";
$errors = array();

// Yhdistetään tietokantaan

// Rekisteröinti systeemi
if (isset($_POST['reg_user'])) {
  // Otetaan kaikki muuttujat formista
  $etunimi = mysqli_real_escape_string($db, $_POST['etunimi']);
  $sukunimi = mysqli_real_escape_string($db, $_POST['sukunimi']);
  $lahiosoite = mysqli_real_escape_string($db, $_POST['lahiosoite']);
  $postinro = mysqli_real_escape_string($db, $_POST['postinro']);
  $postitoimipaikka = mysqli_real_escape_string($db, $_POST['postitoimipaikka']);
  $puhelin = mysqli_real_escape_string($db, $_POST['puhelin']);

  // Käytetään kirjautumiseen
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // Katotaan että kaikissa on teksti
  if (empty($etunimi)) { array_push($errors, "Etunimi on pakollinen!"); }
  if (empty($password_1)) { array_push($errors, "Salasana on pakollinen!"); }
  if (strlen($password_1) < 15) { array_push($errors, "Salasanan pitää olla vähintään 15 merkkiä!");}
  if ($password_1 != $password_2) {
	array_push($errors, "Salasanat eivät ole samat!");
  }

  if(empty($sukunimi)) { array_push($errors, "Sukunimi on pakollinen!"); }
  if(empty($lahiosoite)) { array_push($errors, "Osoite on pakollinen!"); }
  if(empty($postinro)) { array_push($errors, "Postinumero on pakollinen!"); }
  if(empty($postitoimipaikka)) { array_push($errors, "Postitoimipaikka on pakollinen!"); }
  if(empty($puhelin)) { array_push($errors, "Puhelinnumero on pakollinen!"); }
  if(empty($email)) { array_push($errors, "Sähköposti on pakollinen!"); }

  // Tarkistetaan että onko tietokannassa samalla sähköpostilla oleva käyttäjä
  $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);

  // Jos käyttäjä löytyy
  if ($user) {
     array_push($errors, "Sähköposti on käytössä toisella käyttäjätilillä!");

 }

  // Jos ei ole mitään virheitä, rekisteröidään käyttäjä
  if (count($errors) == 0) {
  	$password = md5($password_1); // Encryptataan salasana, jotta ei tallenneta salasanaa suoraan

  	$query = "INSERT INTO users(userId, etunimi, sukunimi, lahiosoite, postinro, postitoimipaikka, puhelin, email, pasword)
    VALUES('0', '$etunimi', '$sukunimi', '$lahiosoite', '$postinro', '$postitoimipaikka', '$puhelin', '$email', '$password');";
  	mysqli_query($db, $query);
    /*
    $_SESSION['etunimi'] = $etunimi;
    $_SESSION['sukunimi'] = $sukunimi;
    $_SESSION['lahiosoite'] = $lahiosoite;
    $_SESSION['postinro'] = $postinro;
    $_SESSION['postitoimipaikka'] = $postitoimipaikka;
    $_SESSION['puhelin'] = $puhelin;
    */
  	$_SESSION['email'] = $email;
  	$_SESSION['success'] = "Kirjauduttu sisään!";
  	header('location: index.php');
  }
}

// Kirjautumis systeemi
if (isset($_POST['login_user'])) {
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($email)) {
  	array_push($errors, "Sähköpostiosoite on pakollinen!");
  }
  if (empty($password)) {
  	array_push($errors, "Salasana on pakollinen!");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
        $set = mysqli_fetch_array($results);
        $_SESSION['userinfo'] = $set;
        $_SESSION['userid'] = $set['userId'];
        $_SESSION['etunimi'] = $set['etunimi'];
        $_SESSION['sukunimi'] = $set['sukunimi'];
        $_SESSION['lahiosoite'] = $set['lahiosoite'];
        $_SESSION['postinro'] = $set['postinro'];
        $_SESSION['postitoimipaikka'] = $set['postitoimipaikka'];
        $_SESSION['puhelin'] = $set['puhelin'];
  	    $_SESSION['email'] = $email;
  	    $_SESSION['success'] = "Kirjauduttu sisään!";
  	  header('location: index.php');
  	}else {
  		array_push($errors, "Käyttäjätunnus tai salasana on väärä!");
  	}
  }
}

// Päivitetään käyttäjän tiedot
if (isset($_POST['update_info'])) {
    if(isset($_SESSION['email'])) {

        $etunimi = mysqli_real_escape_string($db, $_POST['etunimi']);
        $sukunimi = mysqli_real_escape_string($db, $_POST['sukunimi']);
        $lahiosoite = mysqli_real_escape_string($db, $_POST['lahiosoite']);
        $postinro = mysqli_real_escape_string($db, $_POST['postinro']);
        $postitoimipaikka = mysqli_real_escape_string($db, $_POST['postitoimipaikka']);
        $puhelin = mysqli_real_escape_string($db, $_POST['puhelin']);
        $email = mysqli_real_escape_string($db, $_POST['email']);



        // Jos käyttäjä löytyy
        if(!$email == $_SESSION['email']){
            // Tarkistetaan että onko tietokannassa samalla sähköpostilla oleva käyttäjä
            $user_check_query = "SELECT * FROM users WHERE email='$email' LIMIT 1";
            $result = mysqli_query($db, $user_check_query);
            $user = mysqli_fetch_assoc($result);
            if ($user) {
               array_push($errors, "Sähköposti on käytössä toisella käyttäjätilillä!");
            }
        }


        if (count($errors) == 0) {
            $query = "UPDATE users SET etunimi = '$etunimi', sukunimi = '$sukunimi', lahiosoite = '$lahiosoite', postinro = '$postinro', postitoimipaikka = '$postitoimipaikka', puhelin = '$puhelin', email = '$email' WHERE userId = '".$_SESSION['userId']."' ";
            $results = mysqli_query($db, $query) or die("Error: ". mysql_error(). " with query ");
            $_SESSION['etunimi'] = $etunimi;
            $_SESSION['sukunimi'] = $sukunimi;
            $_SESSION['lahiosoite'] = $lahiosoite;
            $_SESSION['postinro'] = $postinro;
            $_SESSION['postitoimipaikka'] = $postitoimipaikka;
            $_SESSION['puhelin'] = $puhelin;
      	    $_SESSION['email'] = $email;
            header('location: index.php');

        }

    }
}

// Uusi tilaus systeemi
if (isset($_POST['new_order'])) {
    if(isset($_SESSION['email'])){
        $pizza = mysqli_real_escape_string($db, $_POST['pizzatHidden']);
        $hinta = mysqli_real_escape_string($db, $_POST['hintaHidden']);
        $email = $_SESSION['email'];
        $lahiosoite = $_SESSION['lahiosoite'];
        $postinro = $_SESSION['postinro'];
        $postitoimipaikka = $_SESSION['postitoimipaikka'];

        $query = "INSERT INTO orders(tilausId, pizza, hinta, email, osoite, postinro, postitoimipaikka, aika) VALUES ('0', '$pizza', '$hinta', '$email', '$lahiosoite', '$postinro', '$postitoimipaikka', now())";
        $results = mysqli_query($db, $query) or die("Error: ". mysql_error(). " with query ");
        header('location: omattilaukset.php');

    }

}

if (isset($_POST['updatePizzat'])) {
    // hawaii
    $hawaiiHinta = mysqli_real_escape_string($db, $_POST['hawaiiHinta']);
    $hawaiiSisaltaa = mysqli_real_escape_string($db, $_POST['hawaiiSisaltaa']);

    $query = "UPDATE Pizzat SET pizzaHinta = '$hawaiiHinta', pizzaTaytteet = '$hawaiiSisaltaa' WHERE pizzaNimi = 'hawaii'";
    $results = mysqli_query($db, $query) or die("Error: ". mysql_error(). " with query ");

    // margarita
    $margaritaHinta = mysqli_real_escape_string($db, $_POST['margaritaHinta']);
    $margaritaSisaltaa = mysqli_real_escape_string($db, $_POST['margaritaSisaltaa']);

    $query = "UPDATE Pizzat SET pizzaHinta = '$margaritaHinta', pizzaTaytteet = '$margaritaSisaltaa' WHERE pizzaNimi = 'margarita'";
    $results = mysqli_query($db, $query) or die("Error: ". mysql_error(). " with query ");

    // pepperoni
    $pepperoniHinta = mysqli_real_escape_string($db, $_POST['pepperoniHinta']);
    $pepperoniSisaltaa = mysqli_real_escape_string($db, $_POST['pepperoniSisaltaa']);

    $query = "UPDATE Pizzat SET pizzaHinta = '$pepperoniHinta', pizzaTaytteet = '$pepperoniSisaltaa' WHERE pizzaNimi = 'pepperoni'";
    $results = mysqli_query($db, $query) or die("Error: ". mysql_error(). " with query ");

    // weggie
    $weggieHinta = mysqli_real_escape_string($db, $_POST['weggieHinta']);
    $weggieSisaltaa = mysqli_real_escape_string($db, $_POST['weggieSisaltaa']);

    $query = "UPDATE Pizzat SET pizzaHinta = '$weggieHinta', pizzaTaytteet = '$weggieSisaltaa' WHERE pizzaNimi = 'weggie'";
    $results = mysqli_query($db, $query) or die("Error: ". mysql_error(). " with query ");

    header('location pizzat.php');
}
?>
