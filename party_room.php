<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Room</title>
  <link href="main.css" rel="stylesheet" type="text/css" />
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Barlow:wght@600;900&display=swap" rel="stylesheet">
</head>

<body>
  <div class="header_text">
    <?php
    // Retrieve room code from URL parameter
    $roomCode = $_GET['room_code'];

    // Include database connection parameters
    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', '');
    define('DB_NAME', 'djapp');

    // Establish a database connection
    $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    // Check if the connection was successful
    if ($connection) {
        // Query to retrieve room details based on the provided room code
        $query = "SELECT * FROM rooms WHERE room_code = '$roomCode'";
        $result = mysqli_query($connection, $query);

        // Check if the query returned any rows
        if ($result && mysqli_num_rows($result) > 0) {
            // Fetch room details
            $row = mysqli_fetch_assoc($result);
            $roomName = $row['party_name'];
            $theme = $row['theme'];

            // Display room name and theme
            echo "<h1 style='font-size: 2.5rem;' class='text-banner barlow-semibold'>$roomName</h1>";
            echo "<h2 style='font-size: 1rem;' class='rectangle text-banner barlow-semibold'>#$roomCode - $theme</h2>";
        } else {
            // Room not found or query failed
            echo "<h1 style='font-size: 2.5rem;' class='text-banner barlow-semibold'>Room Not Found</h1>";
        }

        // Close the database connection
        mysqli_close($connection);
    } else {
        // Failed to connect to the database
        echo "<h1 style='font-size: 2.5rem;' class='text-banner barlow-semibold'>Failed to Connect to the Database</h1>";
    }
    ?>
    <a href="index.html"><button type="button" class=back-arrow></button></a>
  </div>

  <h4 style="font-size: 1.5rem;" class="song_player barlow-semibold">SONG NAME <br><span style="color: #b3b3b3;">SONG
      ARTIST</span></h4>

  <div class="barlow-semibold"
    style="font-size: 1.4rem; color: white; margin-top: 5vh; width: 350px; margin-left: auto; margin-right: auto;">

    <div class="settings-boxes">
      <p>Request a Song</p>
      <a class="silly-button1">
        <image style="height: 6vh" src="images/request.svg">
      </a>
    </div>

    <div class="settings-boxes">
      <p>Vote Skip</p>
      <a class="silly-button1">
        <image style="height: 6vh" src="images/skip.svg">
      </a>
    </div>

    <div class="settings-boxes">
      <p>Tip the DJ</p>
      <a class="silly-button1">
        <image style="height: 6vh" src="images/tip_dj.svg">
      </a>
    </div>

    <div class="settings-boxes">
      <p>View Queue</p>
      <a class="silly-button1">
        <image style="height: 6vh" src="images/view_queue.svg">
      </a>
    </div>
    <a href="join_room.php"> <button class="leave_button barlow-semibold">Leave</button></a>

  </div>

</body>

</html>
