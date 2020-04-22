<?php
    session_start();
    include_once(__DIR__ . "/classes/User.php");
    if(isset($_SESSION['user'])){
        $question = new user;
        $noPin = $question->getAllQuestions(0);
        $pinned = $question->getAllQuestions(1);      

        if(!empty($_POST['question'])){
            $question = $_POST['ask'];
            $email = $_SESSION['user'];
            $ask = new user;
            $ask->askQuestion($question);
        }

    } else {
        header("Location: logout.php");
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questions</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="./../../css/style.css" />
</head>
<body>
    <form action="" method="post">
        <div class="form-group">
            <input type="text" name="question" class="form-control" placeholder="Ask a question">
            <input type="submit" name="ask" value="ask" class="btn btn-primary">
        </div>
    </form>
    <div>
        <?php if(!empty($pinned)): ?>
            <?php foreach($pinned as $p): ?>
                <p><?php echo $p['question'] ?></p>
            <?php endforeach; ?>
        <?php else: ?>
            <?php echo '<h3>Pinned questions are shown here!</h3>' ?>
        <?php endif; ?>
    </div>

    <div>
        <?php if(!empty($noPin)): ?>
            <?php foreach($noPin as $np): ?>
                <p><?php echo $np['question'] ?></p>
            <?php endforeach; ?>
        <?php else: ?>
            <?php echo '<h3>Be the first to ask a question!</h3>' ?>
        <?php endif; ?>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>