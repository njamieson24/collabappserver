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
        // Retrieve room code from URL parameter
        $roomCode = $_GET['room_code'];

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

  <div style="margin-top: 2vh; display: flex;" class="container music_player">
    <div style="width: 65px; height: 65px; background-color: grey; border-radius: 20px;"></div>
    <div style="margin-left: 2vh; display: flex; flex-direction: column; justify-content: center;">
      <p style="font-weight: 700;">Can't Say</p>
      <p style="font-weight: 400;">TRAVIS SCOTT</p>
    </div>
    <p
      style="font-size: 0.8rem; margin-left: auto; background-color: rgba(41,132,96); padding: 8px 20px; text-transform: uppercase; border-radius: 13px; align-self: center;">
      Playing</p>
  </div>
  <div style="margin-top: 2vh; display: flex; opacity: 0.5" class="container music_player">
    <div style="width: 65px; height: 65px; background-color: grey; border-radius: 20px;"></div>
    <div style="margin-left: 2vh; display: flex; flex-direction: column; justify-content: center;">
      <p style="font-weight: 700;">90210</p>
      <p style="font-weight: 400;">TRAVIS SCOTT</p>
    </div>
    <p
      style="font-size: 0.8rem; margin-left: auto; background-color: rgba(85,85,85); padding: 8px 20px; text-transform: uppercase; border-radius: 13px; align-self: center;">
      Up Next</p>
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
      <li><i class="fa-solid fa-bars"></i></li>
      <li><a href="song_search.php"><i class="fa-solid fa-plus"></i></a></li>
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
