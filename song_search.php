<?php


?>

<!DOCTYPE html>
<html>

<head>
  <title>Spotify Search</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body style="background: #222339;">
  <div class="App">
    <div style="margin: 0 auto; width: 90%;">
      <div class="input-group mb-3">
        <input id="searchInput" type="text" class="form-control" placeholder="Search a Song">
        <button id="button-search" class="btn btn-primary">Search</button>
      </div>
    </div>
    <div style="margin: 0 auto; width: 90%;">
      <div class="row row-cols-1 mx-2" id="tracksContainer">
        <!-- Tracks will be dynamically added here -->
      </div>

    </div>
  </div>

  <script src="script.js"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</body>

</html>
