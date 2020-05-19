<?php include('server.php') ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Luo Käyttäjä</title>

    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <nav class="navbar navbar-default navbar-expand-lg navbar-light scrolling-navbar fixed-top">
        <div class="navbar-header d-flex col-1 justify-content-start">
            <a class="navbar-brand" href="./index"><b>Pizzapaikka</b></a>
            <button type="button" data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle navbar-toggler mr-auto">
                <span class="navbar-toggler-icon"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <?php  if (isset($_SESSION['username'])) : ?>
                <li class="nav-item"><a class="nav-item nav-link" href="pizzat">Pizzat</a></li>
                <li class="nav-item"><a class="nav-item nav-link" href="omattilaukset">Omat tilaukset</a></li>
                <?php endif ?>

            </ul>
            <ul class="nav navbar-nav navbar-right ml-auto">
                <?php  if (isset($_SESSION['username'])) : ?>
                <li class="nav-item"><a class="nav-item nav-link" id="welcomeUser">Tervetuloa <?php echo $_SESSION["username"] ?>!</a></li>
                <li class="nav-item"><a class="nav-item nav-link" href="index?logout='1'" style="color:rgb(52, 235, 113)">Kirjaudu Ulos</a></li>
                <?php else : ?>
                <li class="nav-item"><a class="nav-item nav-link" href="login">Kirjaudu Sisään</a></li>
                <li class="nav-item"><a class="nav-item nav-link" href="register" style="color:rgb(52, 235, 113)"><b>Luo Käyttäjä!</b></a></li>
                <?php endif ?>

            </ul>
        </div>
    </nav>



    <div class="login-form-1">
        <div class="">
            <h3>Luo Käyttäjä</h3>
            <form action="register.php" method="post">
                <div class="container">
                    <p style="font-size:18px"><b>Toimitukseen tarvittavat tiedot</b></p>
                    <div class="row" style="padding-bottom:5px">
                        <div class="col-md-6">
                            <label for="">Etunimi</label>
                            <input type="text" class="form-control" placeholder="Etunimi" name="etunimi" value="" />
                        </div>
                        <div class="col-md-6">
                            <label for="">Sukunimi</label>
                            <input type="text" class="form-control" placeholder="Sukunimi" name="sukunimi" value="" />
                        </div>

                    </div>
                    <div class="row" style="padding-bottom:5px">
                        <div class="col-md-12">
                            <input type="text" class="form-control" placeholder="Osoite" name="lahiosoite" value="" />

                        </div>
                    </div>
                    <div class="row" style="padding-bottom:5px">
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Postinumero" name="postinro" value="" />
                        </div>
                        <div class="col-md-6">
                            <input type="text" class="form-control" placeholder="Postitoimipaikka" name="postitoimipaikka" value="" />

                        </div>
                    </div>
                    <div class="row" style="padding-bottom:5px">
                        <div class="col-md-12">
                            <input type="text" class="form-control" placeholder="Puhelinnumero" name="puhelin" value="" />

                        </div>
                    </div>
                    <p style="font-size:18px"><b>Kirjautumiseen tarvittavat tiedot</b></p>
                    <div class="row" style="padding-bottom:5px">
                        <div class="col-md-12">
                            <input type="text" class="form-control" placeholder="Sähköpostiosoite" name="email" value="" />
                        </div>
                    </div>
                    <div class="row" style="padding-bottom:5px">
                        <div class="col-md-6">
                            <input type="password" class="form-control" placeholder="Salasana" name="password_1" value="" />
                        </div>
                        <div class="col-md-6">
                            <input type="password" class="form-control" placeholder="Salasanan vahvistus" name="password_2" value="" />

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <input type="submit" class="btnSubmit btn-block" name="reg_user" value="Rekisteröi Käyttäjä" />
                        </div>
                    </div>
                    <?php include('errors.php'); ?>
                    </table>
                    <a href="./login" class="newUser">On jo käyttäjä?</a>
                    <p style="font-size:12px"><b style="font-size:16px">Huom!</b> <br><br>Sähköpostiosoitteen pitää olla yksilöllinen ja salasanan pitää olla vähintään 15 merkkiä pitkä!</p>
                </div>
            </form>
        </div>
    </div>




</html>
