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
    .song img {
            width: 50px;
            height: 50px;
            margin-right: 10px;
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
<script>

function renderTracks(tracks) {
  const container = document.getElementById("playlistContainer");
  container.innerHTML = "";

  tracks.forEach(function(track) {
    const card = document.createElement("div");
    card.classList.add("card", "d-flex", "align-items-center", "flex-row");
    card.innerHTML = `
      <img src="${track.album.images[0].url}" class="card-img-left img-thumbnail align-self-center" alt="${track.name}">
      <div class="card-body">
        <h4 style="font-size: 2.5rem; font-family: Barlow, sans-serif; font-weight: 700;" class="card-title">${track.name}</h4>
        <p style="font-size: 2.2rem; color: #cfcfcf; font-family: Barlow, sans-serif;" class="card-text">${track.artists[0].name}</p>
      </div>
    `;

    card.addEventListener('click', function() {
      console.log("Clicked Song Info:");
      console.log("Song ID:", track.id);
      console.log("Song Name:", track.name);
      console.log("Artist Name:", track.artists[0].name);
      console.log("Album Name:", track.album.name);
      console.log("Album Image URL:", track.album.images[0].url);

      // Send data to PHP
      sendToPHP(track);
    });

    container.appendChild(card);
  });
}


</script>
<body>
  <header class="container">
    <div class="left-content">
      <h1 style="font-weight: 700;">collab<span style="color: #4590e6;">.</span></h1>
    </div>
    <h2>Songs for Room: <span id="room_code"></span></h1>
    

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
      
          // Now you can use $roomCode in your code
      } else {
          // Handle the case when the room code is not set in the URL
          echo "Room code not found in the URL.";
          // You may want to redirect the user to an error page or take appropriate action here
      }
       // Validate the room code
       /*function isValidRoomCode($roomCode, $connection) {
        // Implement your validation logic here
        // For example, check if the room code exists in the database
        $query = "SELECT * FROM rooms WHERE room_code = '$roomCode'";
        $result = mysqli_query($connection, $query);
    
        // Check if the query returned any rows
        if ($result && mysqli_num_rows($result) > 0) {
            return true; // Room code is valid
        } else {
            return false; // Room code is invalid
        }
       }
       if (isValidRoomCode($roomCode, $connection)) {
        // Room code is valid, redirect user to party_room.php with the room code
        header("Location: party_room.php?room_code=$roomCode");
        exit();
       }*/

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

    <div style="margin: 0 auto; width: 90%;">
      <div class="row row-cols-1 mx-2" id="playlistContainer">
        <!-- Tracks will be dynamically added here -->
        </div>
    </div>

 
  <!-- Dock Menu -->
  <div class="dock">
    <ul>
      <li><i class="fa-solid fa-bars"></i></li>
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