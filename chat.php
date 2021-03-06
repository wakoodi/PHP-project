<?php

session_start();
include_once( __DIR__ . '/classes/User.php' );

try{
    if (isset($_SESSION['user'])) {
        $user = new User;
        $user->setUserId();
        $allMessages = User::getAllMessages($user->getUserId(), $_GET['messageid']);
        $user->userReadMessage();
        $email = $_SESSION['user'];
        $_SESSION['reportid'] = $_GET['messageid'];
        $info = $user->findCurrentUser($email);
        $matchType = $user->matchType($info);
    } else {
        header("Location: logout.php");
    }
} catch (\Throwable $th) {
    $error = $th->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css" />
    <title>chat</title>
</head>
<body>
    <?php include("app/frontend/includes/navbar.php") ?>
    <?php $user->setCurrentFirstName($_GET['messageid']) ?>
    <?php $user->setCurrentLastName($_GET['messageid']) ?>
    <h1><?php echo htmlspecialchars( $user->getCurrentFirstName()["firstName"]) .' '. htmlspecialchars($user->getCurrentLastName()["lastName"])?></h1>
    <p><?php if(isset($matchType)){echo htmlspecialchars($matchType);} ?></p>
    <div class="container d-flex flex-column justify-content-center" id="messages">
        <?php foreach ($allMessages as $m): ?>
        <?php $user->setCurrentFirstName($m['sender']); ?>
        <div class=text-center ><?php echo htmlspecialchars($user->getCurrentFirstName()["firstName"]) . ": " . htmlspecialchars($m['message']); ?></div>
        <?php endforeach; ?>
    </div>
    <div class="d-flex justify-content-center">
    <input type="text" placeholder="type a message" id="inputMessage">
    <a class="btn btn-success ml-3" href="#" id="btnSendMessage">Send</a>
    <a class="btn btn-danger ml-1" href="report.php" id="btnReport">❗</a>
    </div>
    <script src="js/app.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>