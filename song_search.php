<?php
// Include database connection parameters
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'djapp');

// Establish a database connection
$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

// Check if the connection was successful
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Ensure room code is available from GET parameters
if (isset($_GET['room_code'])) {
  $roomCode = $_GET['room_code'];
} else {
  die("Room code not provided in the URL.");
}

// Query to fetch the room details from `rooms`
$room_query = "SELECT room_id FROM rooms WHERE room_code = '$roomCode'";
$room_result = mysqli_query($connection, $room_query);

if ($room_result && mysqli_num_rows($room_result) > 0) {
    $room_data = mysqli_fetch_assoc($room_result);
    $room_id = $room_data['room_id']; // Get room_id for referencing
} else {
    die("Room not found.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['room_code'])) {
    $roomCode = $_POST['room_code'];
    // Get room ID
    $room_query = "SELECT room_id FROM rooms WHERE room_code = '$roomCode'";
    $room_result = mysqli_query($connection, $room_query);

    if ($room_result && mysqli_num_rows($room_result) > 0) {
      $room_data = mysqli_fetch_assoc($room_result);
      $room_id = $room_data['room_id'];
    } else {
      die("Room not found.");
    }
  } else {
    die("Room code not provided.");
  }

  if (isset($_POST['song_name'], $_POST['artist_name'], $_POST['album_image'])) {
    $song_name = $_POST['song_name'];
    $artist_name = $_POST['artist_name'];
    $album_image = $_POST['album_image'];

    $query = "INSERT INTO song_queue (song_name, artist_name, album_image) 
              VALUES ('$song_name', '$artist_name', '$album_image')";

    if (mysqli_query($connection, $query)) {
      echo "Song added successfully";
    } else {
      echo "Error adding song: " . mysqli_error($connection);
    }
  } else {
    echo "Invalid data.";
  }
}

// Close the database connection
mysqli_close($connection);
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
  <script>
    // Assign the value of $room_code directly to roomCode
    const roomCode = <?php echo json_encode($roomCode); ?>;
  </script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</body>

</html>