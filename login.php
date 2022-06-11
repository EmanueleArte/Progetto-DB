<!DOCTYPE html>
<html>
<head>
  <!-- meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- icona + titolo -->
  <link rel="icon" href="">
  <title>Sito streaming</title>
  <!-- fogli di stile esterni + bootstrap -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/custom_style.css">
</head>

<body onload="refillFormLogin()">
  <!-- container form -->
  <center class="pl-3 pr-3 pb-5 pt-5">
    <h1 class="titleText" style="font-family: Helvetica neue">Sito streaming</h1>
    <div class="container align-items-center">
      <div class="row">
        <div class="col shadow p-3 mt-2" id="formContainer" style="background-color: white; border-radius: 10px 10px 10px 10px; margin: auto; max-width: 570px">
        <!-- LOGIN -->  
          <h2>Login</h2>
          <div class="row pt-2">
            <div class="col">
              <form method="POST" id="formLogin" style="width: 70%" action="caricamento.php">
                <!-- USERNAME -->
                <div class="form-group">
                  <input type="text" id="usernameLogin" class="form-control" name="username" placeholder="Username" required>
                </div>
                <!-- PASSWORD -->
                <div class="input-group">
                  <input type="password" id="pwLogin" class="form-control" name="password" placeholder="Password" required>
                  <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="button" style="width: 50px" onclick="mostraPw(1)"><i id="iconaPwLogin" class="far fa-eye"></i></button>
                  </div>
                </div>
                <div class="pb-3 pt-3 pl-1" style="text-align: left"><a href="#collapseReg" data-toggle="collapse" aria-expanded="false" aria-controls="collapseReg">Non hai ancora un account? Registrati</a></div>
                <button disabled id="bottoneLogin" class="btn btn-primary" value="log" name="login">Accedi</button>
              </form>
            </div>
          </div>
          <!-- REGISTRAZIONE -->
          <div class="row collapse" id="collapseReg">
            <div class="col pt-3" id="registrazione">
              <h2>Registrazione</h2>
              <form method="POST" id="formRegistrazione" style="width: 70%" action="registrazione.php">
                <!-- USERNAME -->
                <div class="form-group">
                  <input type="text" id="usernameReg" class="form-control" name="username" placeholder="Username" required>
                </div>
                <!-- MAIL -->
                <div class="form-group">
                  <input type="text" id="mailReg" class="form-control" name="mail" placeholder="Mail" required>
                </div>
                <!-- PASSWORD -->
                <div class="input-group pb-3">
                  <input type="password" class="form-control" id="pwRegistrazione" name="password" placeholder="Nuova password" required>
                  <div class="input-group-append">
                    <button class="btn btn-outline-primary" type="button" style="width: 50px" onclick="mostraPw(2)"><i id="icona1" class="far fa-eye"></i></button>
                  </div>
                </div>
                <!-- RIPETI PASSWORD -->
                <div class="input-group" id="formRipetiPw">
                  <input type="password" class="form-control" id="CpwRegistrazione" placeholder="Ripeti password" required>
                </div>
                <!-- informative -->
                <small id="smallPw" class="form-text text-muted pb-2" style="opacity: 1;">La password deve essere lunga almeno 8 caratteri e deve contenere maiuscole, minuscole e numeri</small>
                <small><div class="custom-control custom-checkbox" id="Privacy" style="opacity: 1;">
                  <input type="checkbox" class="custom-control-input" id="privacy">
                  <label class="custom-control-label" for="privacy">Accetto le policy sulla privacy.</label>
                </div></small>
                <div class="pt-3"><button disabled type="submit" id="bottoneReg" class="btn btn-primary" value="reg" name="login">Registrati</button></div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </center>

  <script src="js/functions.js"></script>
  <script src="js/login.js"></script>
  <!-- js per bootstrap -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
