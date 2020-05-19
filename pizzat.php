<!-- Näytä kaikki mahdolliset pizzat -->
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
                <li class="nav-item active"><a class="nav-item nav-link" href="pizzat">Pizzat</a></li>
                <li class="nav-item"><a class="nav-item nav-link" href="omattilaukset">Omat tilaukset</a></li>
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
    <div class="login-container">
        <div class="login-form-1">
            <div class="">
                <div class="text-center"> <!-- Header Text -->
                    <h1>Pizzat</h1>
                </div>



                <div class="container text-center"> <!-- Pizza Table -->
                    <div class="row pizzaRow" style="padding-bottom:5px">
                        <div class="col-md-4">
                            <img src="./images/hawaii.jpg" alt="hawaii" width="140" height="100" style="margin-top:35px">
                        </div>
                        <div class="col-md-4">
                            <h3>Hawaii</h3>
                            <h4 id="hawaiiHinta">Hinta: <?php echo $hawaii[2]?>€</h3>
                            <div class="textBox">
                                <h3>Sisältää:</h3>
                                <p id="hawaiiSisaltaa"><?php echo $hawaii[3]?></p>
                            </div>

                        </div>
                        <div class="buttons" style="padding-top:45px">
                            <button class="btn btn-default btn-success" onclick="uusiPizza('Hawaii', '<?php echo $hawaii[2]?>', '<?php echo $hawaii[1]?>')">Lisää Koriin</button>
                            <br>
                            <div class="dropdown">
                              <button class="btn btn-default dropdown-toggle" type="button"
                                      id="dropdownMenu1" data-toggle="dropdown"
                                      aria-haspopup="true" aria-expanded="true">
                                <span class="caret"></span>
                                Lisukkeet
                              </button>
                              <ul class="dropdown-menu checkbox-menu allow-focus" aria-labelledby="dropdownMenu1">
                                  <?php
                                  $query = "SELECT * FROM taytteet";
                                  $result =  mysqli_query($db, $query) or die("Error: ". mysql_error(). " with query ");
                                  $result_amount = mysqli_num_rows($result);
                                  ?>
                                  <?php
                                  while($row2 = mysqli_fetch_array($result)){
                                  ?>
                                  <div class="checkbox">
                                      <label class="checkbox-inline"><input class="form-check-input" id="<?php echo $row2['tayteNimi']; ?>" value="<?php echo $row2['tayteHinta']?>" onclick="balance(this)" title="<?php echo $hawaii[1]?>" type="checkbox"><?php echo $row2['tayteNimi']; ?></label>
                                  </div>
                                  <?php
                                  } /* Lopetetaan while silmukka*/
                                  ?>

                              </ul>
                            </div>
                        </div>

                    </div>
                    <div class="row pizzaRow" style="padding-bottom:5px">
                        <div class="col-md-4">
                            <img src="./images/margarita.jpg" alt="hawaii" width="140" height="100" style="margin-top:35px">
                        </div>
                        <div class="col-md-4">
                            <h3>Margarita</h3>
                            <h4 id="margaritaHinta">Hinta: <?php echo $margarita[2]?>€</h3>
                                <div class="textBox">
                                    <h3>Sisältää:</h3>
                                    <p id="margaritaSisaltaa"><?php echo $margarita[3]?></p>
                                </div>
                        </div>
                        <div class="buttons" style="padding-top:45px">
                            <button type="button" class="btn btn-md btn-success text-center" onclick="uusiPizza('Margarita', '<?php echo $margarita[2]?>', '<?php echo $margarita[1]?>')" name="button">Lisää Koriin</button>
                            <br>
                            <div class="dropdown">
                              <button class="btn btn-default dropdown-toggle" type="button"
                                      id="dropdownMenu1" data-toggle="dropdown"
                                      aria-haspopup="true" aria-expanded="true">
                                <span class="caret"></span>
                                Lisukkeet
                              </button>
                              <ul class="dropdown-menu checkbox-menu allow-focus" aria-labelledby="dropdownMenu1">
                                  <?php
                                  $query = "SELECT * FROM taytteet";
                                  $result =  mysqli_query($db, $query) or die("Error: ". mysql_error(). " with query ");
                                  $result_amount = mysqli_num_rows($result);
                                  ?>
                                  <?php
                                  while($row2 = mysqli_fetch_array($result)){
                                  ?>
                                  <div class="checkbox">
                                      <label class="checkbox-inline"><input class="form-check-input" id="<?php echo $row2['tayteNimi']; ?>" value="<?php echo $row2['tayteHinta']?>" onclick="balance(this)" title="<?php echo $margarita[1]?>" type="checkbox"><?php echo $row2['tayteNimi']; ?></label>
                                  </div>
                                  <?php
                                  } /* Lopetetaan while silmukka*/
                                  ?>

                              </ul>
                            </div>
                        </div>

                    </div>
                    <div class="row pizzaRow" style="padding-bottom:5px">
                        <div class="col-md-4">
                            <img src="./images/pepperoni.jpg" alt="hawaii" width="140" height="100" style="margin-top:35px">
                        </div>
                        <div class="col-md-4">
                            <h3>Pepperoni</h3>
                            <h4 id="pepperoniHinta">Hinta: <?php echo $pepperoni[2]?>€</h3>
                                <div class="textBox">
                                    <h3>Sisältää:</h3>
                                    <p id="pepperoniSisaltaa"><?php echo $pepperoni[3]?></p>
                                </div>
                        </div>
                        <div class="col-md-2">
                        </div>
                        <div class="buttons" style="padding-top:45px">
                            <button type="button" class="btn btn-md btn-success" onclick="uusiPizza('Pepperoni', '<?php echo $pepperoni[2]?>', '<?php echo $pepperoni[1]?>')" name="button">Lisää Koriin</button>
                            <br>
                            <div class="dropdown">
                              <button class="btn btn-default dropdown-toggle" type="button"
                                      id="dropdownMenu1" data-toggle="dropdown"
                                      aria-haspopup="true" aria-expanded="true">
                                <span class="caret"></span>
                                Lisukkeet
                              </button>
                              <ul class="dropdown-menu checkbox-menu allow-focus" aria-labelledby="dropdownMenu1">
                                  <?php
                                  $query = "SELECT * FROM taytteet";
                                  $result =  mysqli_query($db, $query) or die("Error: ". mysql_error(). " with query ");
                                  $result_amount = mysqli_num_rows($result);
                                  ?>
                                  <?php
                                  while($row2 = mysqli_fetch_array($result)){
                                  ?>
                                  <div class="checkbox">
                                      <label class="checkbox-inline"><input class="form-check-input" id="<?php echo $row2['tayteNimi']; ?>" value="<?php echo $row2['tayteHinta']?>" onclick="balance(this)" title="<?php echo  $pepperoni[1]?>" type="checkbox"><?php echo $row2['tayteNimi']; ?></label>
                                  </div>
                                  <?php
                                  } /* Lopetetaan while silmukka*/
                                  ?>

                              </ul>
                            </div>
                        </div>

                    </div>
                    <div class="row pizzaRow" style="padding-bottom:5px">
                        <div class="col-md-4">
                            <img src="./images/weggie.jpg" alt="hawaii" width="140" height="100" style="margin-top:35px">
                        </div>
                        <div class="col-md-4">
                            <h3>Weggie</h3>
                            <h4 id="weggieHinta">Hinta: <?php echo $weggie[2]?>€</h3>
                                <div class="textBox">
                                    <h3>Sisältää:</h3>
                                    <p id="weggieSisaltaa"><?php echo $weggie[3]?></p>
                                </div>
                        </div>
                        <div class="buttons" style="padding-top: 45px">
                            <button type="button" class="btn btn-md btn-success" onclick="uusiPizza('Weggie', '<?php echo $weggie[2]?>', '<?php echo $weggie[1]?>')" name="button">Lisää Koriin</button>
                            <br>
                            <div class="dropdown">
                              <button class="btn btn-default dropdown-toggle" type="button"
                                      id="dropdownMenu1" data-toggle="dropdown"
                                      aria-haspopup="true" aria-expanded="true">
                                <span class="caret"></span>
                                Lisukkeet
                              </button>
                              <ul class="dropdown-menu checkbox-menu allow-focus" aria-labelledby="dropdownMenu1">
                                  <?php
                                  $query = "SELECT * FROM taytteet";
                                  $result =  mysqli_query($db, $query) or die("Error: ". mysql_error(). " with query ");
                                  $result_amount = mysqli_num_rows($result);
                                  ?>
                                  <?php
                                  while($row2 = mysqli_fetch_array($result)){
                                  ?>
                                  <div class="checkbox">
                                      <label class="checkbox-inline"><input class="form-check-input" id="<?php echo $row2['tayteNimi']; ?>" value="<?php echo $row2['tayteHinta']?>" onclick="balance(this)" title="<?php echo $weggie[1]?>" type="checkbox"><?php echo $row2['tayteNimi']; ?></label>
                                  </div>
                                  <?php
                                  } /* Lopetetaan while silmukka*/
                                  ?>

                              </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js">

    </script>
    <script src="index.js"></script>
    <script type="text/javascript">
        $(document).on('click', '.allow-focus', function (e) {
            e.stopPropagation();
            });

        function addIngredient(arrString, ing){
            arr = arrString.split(', ')
            arr.push(ing)
            arrString = arr.join(', ')
            return arrString
        }

        function removeIngredient(arrString, ing){
            arr = arrString.split(', ')
            let fArr = arr.filter(function(e) { return e !== ing })
            arrString = fArr.join(', ')
            return arrString

        }

        function balance(t){
            var hintaEl = document.getElementById(t.title+"Hinta")
            var sisaltaaEl = document.getElementById(t.title+"Sisaltaa")
            hinta = hintaEl.innerHTML.replace(/[^0-9]/g, "")
            hinta = parseInt(hinta)
            if (t.checked == true){
                hinta += parseInt(t.value)
                sisaltaaEl.innerHTML = addIngredient(sisaltaaEl.innerHTML, t.id)
                hintaEl.innerHTML = `Hinta: ${hinta}€`
            }else{
                if(hinta == 10){
                    sisaltaaEl.innerHTML = removeIngredient(sisaltaaEl.innerHTML, t.id)

                }else {
                    sisaltaaEl.innerHTML = removeIngredient(sisaltaaEl.innerHTML, t.id)
                    hinta -= parseInt(t.value)
                    hintaEl.innerHTML = `Hinta: ${hinta}€`
                }
            }
        }
    </script>
</body>

</html>
