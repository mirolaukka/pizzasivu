<?php include('server.php') ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Kirjaudu Sisään</title>

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

    <div class="container login-container">
        <div class="row login-form-1">
            <h3>Kirjaudu Sisään</h3>
            <form action="login.php" method="post">
                <div class="form-group">
                    <?php include('errors.php'); ?>
                </div>
                <div class="form-group">
                    <label for="">Sähköpostiosoite</label>
                    <input type="text" class="form-control" placeholder="Esim. käyttäjä@info.com" name="email" value="" />
                </div>
                <div class="form-group">
                    <label for=""> Salasana</label>
                    <input type="password" class="form-control" placeholder="Salasana" name="password" value="" />
                </div>
                <div class="form-group">
                    <input type="submit" class="btnSubmit" name="login_user" value="Kirjaudu Sisään" />
                </div>
                <div class="form-group">
                    <a href="./register" class="newUser">Ei ole käyttäjää?</a>
                </div>
            </form>
        </div>
    </div>

</html>
