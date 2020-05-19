<?php include('server.php') ?>
<?php
  if (!(isset($_SESSION['email']))) {
  	session_destroy();
  	unset($_SESSION['email']);
  	header("location: index.php");
  }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Omat Tiedot</title>

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
                <?php  if (isset($_SESSION['email'])) : ?>
                <li class="nav-item"><a class="nav-item nav-link" href="pizzat">Pizzat</a></li>
                <li class="nav-item"><a class="nav-item nav-link" href="omattilaukset">Omat tilaukset</a></li>
                <li class="nav-item active"><a class="nav-item nav-link" href="user">Omat Tiedot</a></li>
                <?php endif ?>

            </ul>
            <ul class="nav navbar-nav navbar-right ml-auto">
                <?php  if (isset($_SESSION['email'])) : ?>
                <li class="nav-item"><a class="nav-item nav-link" href="index?logout='1'" style="color:rgb(52, 235, 113)">Kirjaudu Ulos</a></li>
                <?php else : ?>
                <li class="nav-item"><a class="nav-item nav-link" href="login">Kirjaudu Sisään</a></li>
                <li class="nav-item"><a class="nav-item nav-link" href="register" style="color:rgb(52, 235, 113)"><b>Luo Käyttäjä!</b></a></li>
                <?php endif ?>

            </ul>
        </div>
    </nav>
    <div class="login-container ">
        <div class="container login-form-1">
            <h1 style="font-size:48px" class="text-center pb-5">Omat Tiedot</h1>
            <form action="user.php" method="POST">
                <div class="row" style="padding-bottom:5px">
                    <div class="col-md-6">
                        <label for="">Etunimi</label>
                        <input type="text" class="form-control" placeholder="Etunimi" name="etunimi" value="<?php echo $_SESSION['etunimi'] ?>" />
                    </div>
                    <div class="col-md-6">
                        <label for="">Sukunimi</label>
                        <input type="text" class="form-control" placeholder="Sukunimi" name="sukunimi" value="<?php echo $_SESSION['sukunimi'] ?>" />
                    </div>

                </div>
                <div class="row" style="padding-bottom:5px">
                    <div class="col-md-12">
                        <label>Osoite</label>
                        <input type="text" class="form-control" placeholder="Osoite" name="lahiosoite" value="<?php echo $_SESSION['lahiosoite'] ?>" />

                    </div>
                </div>
                <div class="row" style="padding-bottom:5px">
                    <div class="col-md-6">
                        <label>Postinumero</label>
                        <input type="text" class="form-control" placeholder="Postinumero" name="postinro" value="<?php echo $_SESSION['postinro'] ?>" />
                    </div>
                    <div class="col-md-6">
                        <label>Postitoimipaikka</label>
                        <input type="text" class="form-control" placeholder="Postitoimipaikka" name="postitoimipaikka" value="<?php echo $_SESSION['postitoimipaikka'] ?>" />

                    </div>
                </div>
                <div class="row" style="padding-bottom:5px">
                    <div class="col-md-12">
                        <label>Puhelinnumero</label>
                        <input type="text" class="form-control" placeholder="Puhelinnumero" name="puhelin" value="<?php echo $_SESSION['puhelin'] ?>" />
                    </div>
                </div>
                <div class="row" style="padding-bottom:5px">
                    <div class="col-md-12">
                        <label>Sähköpostiosoite</label>
                        <input type="text" class="form-control" placeholder="Sähköpostiosoite" name="email" value="<?php echo $_SESSION['email'] ?>" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button href="tilaus" type="submit" class="btn btn-primary btn-lg aloitaButton btn-block" name="update_info" style="border-radius:30px; font-size:30px;">Tallenna Tiedot</button>
                    </div>
                </div>
                <?php include('errors.php'); ?>

            </form>
        </div>


    </div>




    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

</body>

</html>
