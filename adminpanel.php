<?php include('server.php') ?>
<?php
  if (!(isset($_SESSION['email']))) {
  	session_destroy();
  	unset($_SESSION['email']);
  	header("location: index.php");
  }
?>
<?php
$query = "SELECT * FROM Pizzat";
$results = mysqli_query($db, $query);
$hawaii = mysqli_fetch_array($results);
$margarita = mysqli_fetch_array($results);
$pepperoni = mysqli_fetch_array($results);
$weggie = mysqli_fetch_array($results);

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin Paneeli</title>

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
                <li class="nav-item"><a class="nav-item nav-link" href="user">Omat Tiedot</a></li>
                <li class="nav-item active"><a class="nav-item nav-link" href="adminpanel">Järjestelmävalvojan paneeli</a></li>

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

    <!-- Login to get access to panel -->
    <div id="adminPassword" class="container login-container adminPanelPassword">
        <div class="row login-form-1">
            <h3>Järjestelmävalvojan Paneeli kirjautuminen</h3>
            <hr>
            <div class="form-group">
                <label for=""> Salasana</label>
                <input type="password" class="form-control" placeholder="se on 'admin'" id="password" onkeydown='"Enter"===event.key&&("admin"===document.getElementById("password").value?(document.getElementById("adminPanel").style.display="block",document.getElementById("adminPassword").style.display="none"):window.location.href="index");' value="" />
            </div>
            <div class="form-group">
                <input type="button" class="btnSubmit" onclick='if(document.getElementById("password").value === "admin"){document.getElementById("adminPanel").style.display="block"; document.getElementById("adminPassword").style.display="none"}else{window.location.href="index"}' value="Kirjaudu Sisään" />
            </div>
        </div>
    </div>

    <div id="adminPanel" class="login-container adminPanel">
        <div class="container">
            <h1 style="font-size:48px" class="text-center">Järjestelmävalvojan Paneeli</h1>
            <hr>
            <div class="container text-center">
                <!-- Pizza Table -->
                <form action="adminpanel.php" method="post">
                    <div class="row pizzaRow" style="padding-bottom:5px">
                        <div class="col-md-4">
                            <img src="./images/hawaii.jpg" alt="hawaii" width="140" height="100" style="margin-top:85px">
                        </div>
                        <div class="col-md-6">
                            <h3>Hawaii</h3>
                            <label>Hinta:</label>
                            <input class="input-sm"type="text" name="hawaiiHinta" value="<?php echo $hawaii[2]?>">
                            <span class="help-block">Ei saa sisältää muuta kuin numeroita</span>

                            <div class="textBox">
                                <h3>Sisältää:</h3>
                                <input class="input-lg" type="text" name="hawaiiSisaltaa" value="<?php echo $hawaii[3] ?>">
                                <span class="help-block">Kaikki päälliset pitää olla eroiteltu ", " merkeillä. Eli pilkulla ja yhdellä välilyönillä</span>

                            </div>
                        </div>
                    </div>
                    <div class="row pizzaRow" style="padding-bottom:5px">
                        <div class="col-md-4">
                            <img src="./images/margarita.jpg" alt="hawaii" width="140" height="100" style="margin-top:85px">
                        </div>
                        <div class="col-md-6">
                            <h3>Margarita</h3>
                            <label>Hinta:</label>
                            <input class="input-sm"type="text" name="margaritaHinta" value="<?php echo $margarita[2]?>">
                            <span class="help-block">Ei saa sisältää muuta kuin numeroita</span>

                            <div class="textBox">
                                <h3>Sisältää:</h3>
                                <input class="input-lg" type="text" name="margaritaSisaltaa" value="<?php echo $margarita[3] ?>">
                                <span class="help-block">Kaikki päälliset pitää olla eroiteltu ", " merkeillä. Eli pilkulla ja yhdellä välilyönillä</span>

                            </div>
                        </div>

                    </div>
                    <div class="row pizzaRow" style="padding-bottom:5px">
                        <div class="col-md-4">
                            <img src="./images/pepperoni.jpg" alt="hawaii" width="140" height="100" style="margin-top:85px">
                        </div>
                        <div class="col-md-6">
                            <h3>Pepperoni</h3>
                            <label>Hinta:</label>
                            <input class="input-sm"type="text" name="pepperoniHinta" value="<?php echo $pepperoni[2]?>">
                            <span class="help-block">Ei saa sisältää muuta kuin numeroita</span>

                            <div class="textBox">
                                <h3>Sisältää:</h3>
                                <input class="input-lg" type="text" name="pepperoniSisaltaa" value="<?php echo $pepperoni[3] ?>">
                                <span class="help-block">Kaikki päälliset pitää olla eroiteltu ", " merkeillä. Eli pilkulla ja yhdellä välilyönillä</span>

                            </div>
                        </div>

                    </div>
                    <div class="row pizzaRow" style="padding-bottom:5px">
                        <div class="col-md-4">
                            <img src="./images/weggie.jpg" alt="hawaii" width="140" height="100" style="margin-top:85px">
                        </div>
                        <div class="col-md-6">
                            <h3>Weggie</h3>
                            <label>Hinta:</label>
                            <input class="input-sm"type="text" name="weggieHinta" value="<?php echo $weggie[2]?>">
                            <span class="help-block">Ei saa sisältää muuta kuin numeroita</span>

                            <div class="textBox">
                                <h3>Sisältää:</h3>
                                <input class="input-lg" type="text" name="weggieSisaltaa" value="<?php echo $weggie[3] ?>">
                                <span class="help-block">Kaikki päälliset pitää olla eroiteltu ", " merkeillä. Eli pilkulla ja yhdellä välilyönillä</span>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">

                        </div>
                        <div class="col-md-8">
                            <input type="submit" class="btn btn-success btn-block" name="updatePizzat" value="Tallenna muutokset">
                        </div>
                        <div class="col-md-2">

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>

</body>

</html>
