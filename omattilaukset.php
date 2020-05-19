<!-- Näytä omat tilaukset -->
<!-- Näytä kaikki mahdolliset pizzat -->
<?php include('server.php') ?>

<?php
$query = "SELECT * FROM Pizzat";
$results = mysqli_query($db, $query);
$hawaii = mysqli_fetch_array($results);
$margarita = mysqli_fetch_array($results);
$pepperoni = mysqli_fetch_array($results);
$weggie = mysqli_fetch_array($results);
/*
pizza[0] = pizzaId
pizza[1] = pizzaNimi
pizza[2] = pizzaHinta
pizza[3] = pizzaTaytteet
*/
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pizzapaikka</title>

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
                <li class="nav-item active"><a class="nav-item nav-link" href="omattilaukset">Omat tilaukset</a></li>
                <li class="nav-item"><a class="nav-item nav-link" href="user">Omat Tiedot</a></li>
                <?php endif ?>

            </ul>
            <ul class="nav navbar-nav navbar-right ml-auto">
                <?php  if (isset($_SESSION['email'])) : ?>
                <li class="nav-item"><a class="nav-item nav-link" href="tilaus">Ostoskori</a></li>
                <li class="nav-item"><a class="nav-item nav-link" href="index?logout='1'" style="color:rgb(52, 235, 113)">Kirjaudu Ulos</a></li>
                <?php else : ?>
                <li class="nav-item"><a class="nav-item nav-link" href="login">Kirjaudu Sisään</a></li>
                <li class="nav-item"><a class="nav-item nav-link" href="register" style="color:rgb(52, 235, 113)"><b>Luo Käyttäjä!</b></a></li>
                <?php endif ?>

            </ul>
        </div>
    </nav>
    <div class="login-container text-center">
        <div class="login-form-1">
            <h1>Omat Tilaukset</h1>
            <hr>
            <div class="container ">

                <?php
                    $query = "SELECT * FROM orders WHERE email = '".$_SESSION['email']."'";
                    $result =  mysqli_query($db, $query) or die("Error: ". mysql_error(). " with query ");;
                    $result_amount = mysqli_num_rows($result);
                ?>
                <?php
               while($row = mysqli_fetch_array($result)){
                 ?>
                 <div class="row pizzaRow">
                     <div class="col-md-3">
                         <h3>Hinta:</h3>
                         <p><?php echo $row['hinta']?>€</p>
                     </div>
                     <div class="col-md-3">
                         <h3>Pizza(t):</h3>
                         <p><?php echo $row['pizza']?></p>
                     </div>
                     <div class="col-md-3">
                         <h3>Osoite:</h3>
                         <p><?php echo $row['osoite']?></p>
                     </div>
                     <div class="col-md-3">
                         <h3>Aika:</h3>
                         <p><?php echo $row['aika']?></p>
                     </div>
                 </div>
                 <?php
                } /* Lopetetaan while silmukka*/
             ?>
            </div>
        </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js">

    </script>
    <script src="index.js"></script>

</body>

</html>
