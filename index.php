<!DOCTYPE html>
<html>
<head>
  <title>prehravac</title>
  <!--<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests"> potřebuju jen u zubronetu-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="../apicko/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.0.4/howler.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
    <a class="navbar-brand" href="#">Menu</a>
    <a class="navbar-brand" href="#">Menu1</a>

  </div>
</nav>

  <div class="jumbotron">
    <h1 id="takeMeBack">"audio streamer"<h1>
    </div>
    <div class="container">
      <div id="display">
        <div class="displayMenu">
          <div class="row">
            <div class="col-md">
              <span id="h3author"> Interpreti </span>
            </div>
            <div class="col-md">
              <span  id="h3album"> Alba </span>
            </div>
            <div class="col-md">
              <span id="h3song"> Písničky </span>
            </div>
          </div>
        </div>
      </div>
    </div>

      <div class="footer">
        <div class="row">
          <img  src="../apicko/img/photo.png" class="img-responsive col-lg-1">
          <div class="col-lg-6">
            <span class="songName col-lg-1"></span>
            <br>
            <span class="songAuthor col-lg-3"></span>
            <br>
            <div class="playStop col-lg-1">
            <span id="playBtn" class="fa fa-pause" style="display: block" aria-hidden="true"></span>
            <span id="pauseBtn" class="fa fa-play" style="display: none" aria-hidden="true"></span>
            </div>
            <div class="everythingAboutSlider col-lg-12">
              <span id="timer">0:00 </span>
              <input type="range" min="1" max="100" value="1" class="slider col-lg-10" id="myRange">
              <span id="duration">0:00</span>
            </div>
          </div>
        </div>
      </div>

      <script type="text/javascript" src="../apicko/script.js"></script>
</body>
</html>
