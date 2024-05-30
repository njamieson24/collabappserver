<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>collab.</title>
  <link href="style.css" rel="stylesheet" type="text/css" />
  <meta name="theme-color" content="#343a53">

  <style>
    .container {
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .song {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
    }


    .left-content {
      display: flex;
      align-items: center;
    }

    .controls-container {
      display: flex;
      flex-direction: column;
      align-items: center;
    }

    .section_header {
      margin: 0;
      padding: 8px 0 8px 0;
    }

    .music_player {
      margin-top: 2vh;
    }

    .settings-boxes {
      margin-bottom: 10px;
    }

    .card {
      width: 100%;
      display: flex;
      align-items: center;
      margin-bottom: 10px;
      padding: 10px;
      background-color: red;
      border: none;
    }

    .card img {
      width: 60px;
      height: 60px;
      margin-right: 15px;
      border-radius: 15px;
    }

    .card-body {
      display: flex;
      flex-direction: column;
    }

    .card-title {
      font-size: 1.25rem;
      font-weight: 700;
      margin: 0;
    }

    .card-text {
      font-size: 1.2rem;
      color: #9c9c9c;
      margin: 0;
    }
    
   

  </style>
</head>

<body>
  <header class="container">
    <div class="left-content">
      <h1 style="font-weight: 700;">collab<span style="color: #4590e6;">.</span></h1>
    </div>
    <div class="party-info">
    <?php
      // Include database connection parameters
      define('DB_SERVER', 'localhost');
      define('DB_USERNAME', 'root');
      define('DB_PASSWORD', '');
      define('DB_NAME', 'djapp');

      // Establish a database connection
      $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

      // Check if the connection was successful
      if ($connection) {
        if (isset($_GET['room_code'])) {
          // Retrieve the room code from the URL
          $roomCode = $_GET['room_code'];
        } else {
          // Handle the case when the room code is not set in the URL
          echo "Room code not found in the URL.";
          // You may want to redirect the user to an error page or take appropriate action here
          exit;
        }

        // Query to retrieve room details based on the provided room code
        $query = "SELECT * FROM rooms WHERE room_code = '$roomCode'";
        $result = mysqli_query($connection, $query);

        // Check if the query returned any rows
        if ($result && mysqli_num_rows($result) > 0) {
          // Fetch room details
          $row = mysqli_fetch_assoc($result);
          $roomName = $row['party_name'];
          $partyRoomCode = $row['room_code'];
          $theme = $row['theme']; // Assuming there's a 'theme' column in the 'rooms' table

          // Display room name, party room code, and theme
          echo "<p>$roomName <br> #$partyRoomCode</p>";
         
        } else {
          // Room not found or query failed
          echo "<p>Room Not Found</p>";
        }

        // Query to retrieve songs based on the provided room code
        $songQuery = "SELECT * FROM song_queue WHERE room_code = '$roomCode'";
        $songResult = mysqli_query($connection, $songQuery);

        // Check if the query returned any rows
        if ($songResult && mysqli_num_rows($songResult) > 0) {
          $songs = [];
          while ($songRow = mysqli_fetch_assoc($songResult)) {
            $songs[] = $songRow;
          }
        } else {
          echo "<p>No songs found for this room.</p>";
        }

        // Close the database connection
        mysqli_close($connection);
      } else {
        // Failed to connect to the database
        echo "<p>Failed to Connect to the Database</p>";
      }
      ?>
    </div>
  </header>

  <!-- Original HTML content continues here -->
  <div style="margin-top: 4vh; display: flex; justify-content: space-between;" class="container">
    <p style="margin: 0; padding: 8px 0 8px 0;" class="section_header">Now Playing</p>
    <p
      style="font-weight: 700; font-size: 1rem; background-color: rgb(0, 0, 0, 0.2); padding: 8px 20px; text-transform: uppercase; border-radius: 13px; align-self: center;">
      <?php echo $theme; ?></p>
  </div>

  <!-- The song that is playing and the song that is queued next -->

<div style="margin: 0 auto; width: 95%">
  <div class="row row-cols-1 mx-2" id="playlistContainer">
  <!-- Tracks will be dynamically added here -->
  <?php if (!empty($songs)): ?>
    <?php $firstSong = $songs[0]; ?>
    <div class="card d-flex align-items-center flex-row">
      <img src="<?php echo htmlspecialchars($firstSong['album_image']); ?>" class="card-img-left img-thumbnail align-self-center" alt="<?php echo htmlspecialchars($firstSong['song_name']); ?>">
      <div class="card-body">
        <h4 class="card-title"><?php echo htmlspecialchars($firstSong['song_name']); ?></h4>
        <p class="card-text"><?php echo htmlspecialchars($firstSong['artist_name']); ?></p>
      </div>
    </div>
  <?php endif; ?>
</div>

<div style="margin-top: 4vh; display: flex; justify-content: space-between;" class="container">
  <p style="margin: 0; padding: 8px 0 8px 0;" class="section_header">Next Up</p>
  </div>


<div style="opacity: 0.5;" class="row row-cols-1 mx-2" id="playlistContainer">
  <!-- Tracks will be dynamically added here -->
  <?php if (!empty($songs)): ?>
    <?php $firstSong = $songs[1]; ?>
    <div class="card d-flex align-items-center flex-row">
      <img src="<?php echo htmlspecialchars($firstSong['album_image']); ?>" class="card-img-left img-thumbnail align-self-center" alt="<?php echo htmlspecialchars($firstSong['song_name']); ?>">
      <div class="card-body">
        <h4 class="card-title"><?php echo htmlspecialchars($firstSong['song_name']); ?></h4>
        <p class="card-text"><?php echo htmlspecialchars($firstSong['artist_name']); ?></p>
      </div>
    </div>
  <?php endif; ?>
</div>
  </div>
 

  <!-- Party Controls -->
  <div class="container">
    <p style="margin: 0; padding: 8px 0 8px 0;" class="section_header">Party Controls</p>
  </div>

  <div class="container">
    <div class="settings-boxes">
      <p style="font-size: 1.4rem;">Vote Skip</p>
      <a class="silly-button1">
        <image style="height: 6vh" src="">
      </a>
    </div>
    <div class="settings-boxes">
      <p style="font-size: 1.4rem;">Tip DJ</p>
      <a class="silly-button1">
        <image style="height: 6vh" src="">
      </a>
    </div>
  </div>
  <!-- Dock Menu -->
  <div class="dock">
    <ul>
      <li><a href="view-queue.php?room_code=<?php echo $roomCode; ?>"><i class="fa-solid fa-bars"></i></a></li>
      <li><a href="song_search.php?room_code=<?php echo $roomCode; ?>"><i class="fa-solid fa-plus"></i></a></li>
      <li><a href="join_room.php"><i class="fa-solid fa-arrow-right-from-bracket"></i></a></li>
    </ul>
  </div>

  <script src="script.js"></script>
  <script src="https://kit.fontawesome.com/cd3c1c5855.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous"></script>
</body>

</html>