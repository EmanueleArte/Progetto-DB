<!DOCTYPE html>
<html>
<head>
  <!-- meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- icona + titolo -->
  <link rel="icon" href="">
  <title>Sito streaming - Crea Gruppo</title>
  <!-- fogli di stile esterni + bootstrap -->
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/custom_style.css">
</head>
<body>

  <?php
    include("check_session.php");
    include("db.php");
  ?>

  <!--script>
    function switchType(radio) {
      if(radio=="S") {
        document.getElementById("postVideo").style.display="none";
        document.getElementById("postScritto").style.display="block";
      } else {
        document.getElementById("postVideo").style.display="block";
        document.getElementById("postScritto").style.display="none";
      }
    }
  </script-->

  <div class="container-fluid pt-3">
    <!-- BOTTONI STANDARD -->
    <div class="row justify-content-center mb-3">
      <button type="button" class="btn btn-outline-dark" onclick="location.href='home.php'">Home</button>
    </div>
    <div class="row justify-content-center pb-3">
      <!-- TITOLO PAGINA -->
      <h2 class="titleText">Creazione gruppo</h2>
    </div>
    <form id="createGroupForm" method="post" action="createGroup.php">
      <input type="hidden" id="hiddenUsernames" name="usernames">
      <div class="row justify-content-center pb-3">
        <div class="pb-2 col-4">
          <!-- NOME GRUPPO -->
          <p class="ml-2 text-center">Nome del gruppo:</p>
          <div class="input-group">
            <input type="text" id="groupName" class="form-control" name="groupName" placeholder="Nome Gruppo" required>
          </div>
        </div>
      </div>
      <div class="row justify-content-center">
        <div class="pb-3 col-4">
          <!-- UTENTI -->
          <p class="ml-2 text-center">Partecipanti:</p>
          <div id="accountsListContainer">
            <input id="firstAccountSpace" type="text" class="accountSpace form-control mb-3" placeholder="Username" required>
          </div>
          <div class="row justify-content-center pb-3">
            <button type="button" class="btn btn-primary" onclick="addAccountListSpace()">+</button>
          </div>
        </div>
      </div>
      <div class="row justify-content-center pb-3">
        <button type="button" class="btn btn-primary" onclick="createGroup()">Crea Gruppo</button>
      </div>
    </form>
  </div>

  <script src="js/functions.js"></script>
  <script>
    //setInterval(additionalAccountSpace, 100);
  </script>
  
  <!-- js per bootstrap -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
