<?php

session_start();

if ( !isset ( $_SESSION['user'] ) ) {
        header("Location: logout.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" />
    <title>Room</title>
</head>

<body class="place">
    <?php include("app/frontend/includes/navbar.php") ?>
    <h1>Room location</h1>
    <form action="" class="form-group">
        <div class="container">
            <div class="row">
                <div class="col">
                    <input id="campus" class="room form-control" type="text" maxlength="1" size="1" placeholder="Z">
                </div>
                <div class="col">
                    <input id="floor" class="room form-control" type="number" min="0" max="9" placeholder="2">
                </div>
                <p style="font-weight: bold">.</p>
                <div class="col">
                    <input id="room" class="room form-control" type="number" min="0" max="9" placeholder="0">
                </div>
                <div class="col">
                    <input id="room" class="room form-control" type="number" min="0" max="9" placeholder="4">
                </div>
            </div>
        </div>
        <p id="result" style="font-weight: bold; text-align: center">Room Z2.04 is located on the 2nd floor in Campus De
            Ham</p>
        <a id="map" style="text-align: center" target="_blank"
            href="https://maps.google.com/?q=Thomas More Mechelen - Campus De Ham">View on Google Maps</a>
    </form>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <script src="js/room.js"></script>
</body>

</html>