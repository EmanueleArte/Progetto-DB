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
<body>

  <?php
    include("check_session.php");
    include("db.php");
    include("check_canale.php");

    if(!$canale) {
      header("Location: home.php");
    }
  ?>

  <script>
    function switchType(radio) {
      if(radio=="S") {
        document.getElementById("postVideo").style.display="none";
        document.getElementById("postScritto").style.display="block";
      } else {
        document.getElementById("postVideo").style.display="block";
        document.getElementById("postScritto").style.display="none";
      }
    }
  </script>


  <div class="container-fluid pt-3">
    <!-- BOTTONI STANDARD -->
    <div class="row justify-content-center mb-3">
      <button type="button" class="btn btn-outline-dark" onclick="location.href='home.php'">Home</button>
    </div>
    <div class="row justify-content-center pb-3">
      <!-- TITOLO PAGINA -->
      <h2 class="titleText">Creazione post</h2>
    </div>
    <div class="row justify-content-center pb-3">
      <!-- SCELTA TIPO POST -->
      <div class="form-check mr-3">
        <input id="checkScritto" class="form-check-input" type="radio" name="flexRadioDefault" value="S" onclick="switchType(this.value)" checked>
        <label class="form-check-label" for="flexRadioDefault1">
          Post scritto
        </label>
      </div>
      <div class="form-check ml-3">
        <input id="checkVideo" class="form-check-input" type="radio" name="flexRadioDefault" value="V" onclick="switchType(this.value)">
        <label class="form-check-label" for="flexRadioDefault2">
          Post video
        </label>
      </div>
    </div>
    <div class="row justify-content-center">
      <!-- POST SCRITTO -->
      <div id="postScritto" class="col-4 pt-3">
        <form method="POST" class="row justify-content-center" action="written_post.php">
          <!-- TITOLO -->
          <div class="input-group pb-3">
            <input type="text" id="titoloPost" class="form-control" name="titolo" placeholder="Titolo post" required>
          </div>
          <!-- TESTO -->
          <div class="input-group pb-3 pt-1">
            <textarea id="testoPost" class="form-control" name="testo" rows="5" placeholder="Testo post" required></textarea>
          </div>
          <button id="btnPostS" class="btn btn-primary mt-2">Pubblica</button>
        </form>
      </div>
      <!-- POST VIDEO -->
      <div id="postVideo" class="col-4 pt-3" style="display: none">
        <form method="POST" class="row justify-content-center" action="video_post.php">
          <!-- TITOLO -->
          <div class="input-group pb-3">
            <input type="text" id="titoloPost" class="form-control" name="titolo" placeholder="Titolo video" required>
          </div>
          <!-- LINK VIDEO -->
          <div class="input-group pb-3 pt-1">
            <input type="text" id="linkVideo" class="form-control" name="link" placeholder="Id link video" required>
          </div>
          <button id="btnPostV" class="btn btn-primary mt-2">Pubblica</button>
        </form>
      </div>
    </div>
  </div>

  <script src="js/functions.js">
    function switchType(radio) {
      alert("click");
      /*if(radio=="S") {
        document.getElementById("postVideo").style.display="none";
        document.getElementById("postScritto").style.display="block";
      } else {
        document.getElementById("postVideo").style.display="block";
        document.getElementById("postScritto").style.display="none";
      }*/
    }
  </script>
  
  <!-- js per bootstrap -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>
</html>
