<?php

include_once( __DIR__ . '/Db.php' );

class User {
    private $id;
    private $email;
    private $firstName;
    private $lastName;
    private $password;
    private $securityQuestion;
    private $securityAwnser;
    private $currentAwnser;
    private $currentEmail;
    private $currentFirstName;
    private $currentLastName;
    private $currentPassword;
    private $tags;
    private $music;
    private $movies;
    private $games;
    private $books;
    private $tvShows;
    private $buddy;
    private $userId;
    private $buddyId;
    private $messageText;
    private $reason;
    private $description;
    private $oldEmail;
    private $newEmail;
    private $newEmailCheck;
    private $newPassword;
    private $oldPassword;
    private $passwordCheck;
    private $avatarUpload;
    private $fileName;

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail( $email )
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare( 'SELECT * FROM users WHERE email=? ' );
        $statement->execute( [$email] );

        $users = $statement->fetch();

        if ( empty( $email ) ) {
            throw new Exception( 'Email cannot be empty' );
        } else if ( !preg_match( '|@student.thomasmore.be$|', $email ) ) {
            throw new Exception( 'Email must end with @student.thomasmore.be' );
        }

        $this->email = $email;

        return $this;
    }

    public function getFirstName()
    {
        return $this->firstName;
    }

    public function setFirstName( $firstName )
    {
        if ( empty( $firstName ) ) {
            throw new Exception( 'First name cannot be empty' );
        }

        $number = preg_match( '@[0-9]@', $firstName );
       
        if ( $number ) {
            throw new Exception( 'First name cannot include numbers' );
        }

        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName()
    {
        return $this->lastName;
    }

    public function setLastName( $lastName )
    {
        if ( empty( $lastName ) ) {
            throw new Exception( 'Last name cannot be empty' );
        }

        $number = preg_match( '@[0-9]@', $lastName );

        if ( $number ) {
            throw new Exception( 'last name cannot include numbers' );
        }
        $this->lastName = $lastName;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword( $password )
    {
        if ( empty( $password ) ) {
            throw new Exception( 'password cannot be empty' );
        }

        $upper = preg_match( '@[A-Z]@', $password );
        $lower = preg_match( '@[a-z]@', $password );
        $number = preg_match( '@[0-9]@', $password );

        if ( !$upper ) {
            throw new Exception( 'password must include an uppercase' );
        }
        if ( !$lower ) {
            throw new Exception( 'password must include a lowercase' );
        }
        if ( !$number ) {
            throw new Exception( 'password must include a number' );
        }

        $password = password_hash( $password, PASSWORD_DEFAULT, ['cost'=>16] );

        $this->password = $password;

        return $this;
    }

    public function getDescription() 
    {
        return $this->description;
    }

    public function setDescription( $description ) 
    {
        $this->description = $description;

        return $this;
    }

    public function getCurrentEmail()
    {
        return $this->currentEmail;
    }

    public function setCurrentEmail( $currentEmail )
    {
        if ( empty( $currentEmail ) ) {
            throw new Exception( 'Email cannot be empty' );
        }

        $this->currentEmail = $currentEmail;

        return $this;
    }

    public function getCurrentFirstName()
    {
        return $this->currentFirstName;
    }

    public function setCurrentFirstName( $currentFirstName )
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare( 'SELECT * FROM users WHERE id = :id' );
        $statement->bindValue( ':id', $currentFirstName );
        $statement->execute();
        $currentFirstName = $statement->fetch( PDO::FETCH_ASSOC );
        
        $this->currentFirstName = $currentFirstName;

        return $this;
    }

    public function getCurrentLastName()
    {
        return $this->currentLastName;
    }

    public function setCurrentLastName( $currentLastName )
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare( 'SELECT * FROM users WHERE id = :id' );
        $statement->bindValue( ':id', $currentLastName );
        $statement->execute();
        $currentLastName = $statement->fetch( PDO::FETCH_ASSOC );
        
        $this->currentLastName = $currentLastName;

        return $this;
    }

    public function getCurrentPassword()
    {
        return $this->currentPassword;
    }

    public function setCurrentPassword( $currentPassword )
    {
        if ( empty( $currentPassword ) ) {
            throw new Exception( 'Password cannot be empty' );
        }

        $this->currentPassword = $currentPassword;

        return $this;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function setTags( $tags, $email )
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare( 'SELECT * FROM `users` WHERE `email` = :email' );
        $statement->bindValue( 'email', $email );
        $statement->execute();
        $tags = $statement->fetch( PDO::FETCH_ASSOC );
        $this->tags = $tags;

        return $this;
    }

    public function getMusic()
    {
        return $this->music;
    }

    public function setMusic( $music )
    {
        $this->music = $music;

        return $this;
    }

    public function getMovies()
    {
        return $this->movies;
    }

    public function setMovies( $movies )
    {
        $this->movies = $movies;

        return $this;
    }

    public function getGames()
    {
        return $this->games;
    }

    public function setGames( $games )
    {
        $this->games = $games;

        return $this;
    }

    public function getBooks()
    {
        return $this->books;
    }

    public function setBooks( $books )
    {
        $this->books = $books;

        return $this;
    }

    public function getTvShows()
    {
        return $this->tvShows;
    }

    public function setTvShows( $tvShows )
    {
        $this->tvShows = $tvShows;

        return $this;
    }

    public function getBuddy()
    {
        return $this->buddy;
    }

    public function setBuddy( $buddy )
    {
        if ( $buddy == 'Make a choice' ) {
            throw new Exception( 'Choose what kind of buddy you want to be' );
        }
        $this->buddy = $buddy;

        return $this;
    }

    public function getOldEmail() 
    {
        return $this->oldEmail;
    }

    public function setOldEmail( $oldEmail ) 
    {
        $this->oldEmail = $oldEmail;

        return $this;
    }

    public function getNewEmail() 
    {
        return $this->newEmail;
    }

    public function setNewEmail( $newEmail ) 
    {
        $this->newEmail = $newEmail;

        return $this;
    }

    public function getNewEmailCheck() 
    {
        return $this->newEmailCheck;
    }

    public function setNewEmailCheck( $newEmailCheck ) 
    {
        $this->newEmailCheck = $newEmailCheck;
    
        return $this;
    }

    public function getSecurityQuestion() 
    {
        return $this->securityQuestion;
    }

    public function setSecurityQuestion( $securityQuestion ) 
    {
        $this->securityQuestion = $securityQuestion;

        return $this;
    }

    public function getSecurityAwnser() 
    {
        return $this->securityAwnser;
    }

    public function setSecurityAwnser( $securityAwnser ) 
    {
        $this->securityAwnser = $securityAwnser;

        return $this;
    }

    public function getCurrentAwnser() 
    {
        return $this->currentAwnser;
    }

    public function setCurrentAwnser( $currentAwnser ) 
    {
        $this->currentAwnser = $currentAwnser;

        return $this;
    }

    public function getNewPassword() 
    {
        return $this->newPassword;
    }

    public function setNewPassword( $newPassword ) 
    {
        $this->newPassword = $newPassword;

        return $this;
    }

    public function getOldPassword() 
    {
        return $this->oldPassword;
    }

    public function setOldPassword( $oldPassword ) 
    {
        $this->oldPassword = $oldPassword;

        return $this;
    }

    public function getPasswordCheck() 
    {
        return $this->passwordCheck;
    }

    public function setPasswordcheck( $passwordCheck ) 
    {
        $this->passwordCheck = $passwordCheck;

        return $this;
    }

    public function getAvatarUpload() 
    {
        return $this->avatarUpload;
    }

    public function setAvatarUpload( $avatarUpload ) 
    {
        $this->avatarUpload = $avatarUpload;

        return $this;
    }

    public function setFileName() 
    {
        return $this->fileName;
    }

    public function getFileName( $fileName ) 
    {
        $this->fileName = $fileName;

        return $this;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function setUserId()
    {
        try {
            $conn = Db::getConnection();
            $statement = $conn->prepare( 'SELECT id FROM users WHERE email = :email' );
            $statement->bindValue( ':email', $_SESSION['user'] );
            $statement->execute();
            $user = $statement->fetch( PDO::FETCH_ASSOC );

            $this->userId = $user['id'];

            return $this;
        } catch ( \Throwable $th ) {
            $error = $th->getMessage();
        }
    }

    public function getBuddyId()
    {
        return $this->buddyId;
    }

    public function setBuddyId( $buddyId )
    {
        $this->buddyId = $buddyId;

        return $this;
    }

    public function save() 
    {
        try {
            $conn = Db::getConnection();
            $statement = $conn->prepare( 'INSERT INTO users (email, firstName, lastName, password, description, avatar, securityQuestion, securityAwnser) VALUES (:email, :firstName, :lastName, :password, :description, :avatar, :securityQuestion, :securityAwnser )' );
            $email = $this->getEmail();
            $firstName = $this->getFirstName();
            $lastName = $this->getLastName();
            $password = $this->getPassword();
            $securityQuestion = $this->getSecurityQuestion();
            $securityAwnser = $this->getSecurityAwnser();
            $secAsnwerHash = password_hash($securityAwnser, PASSWORD_DEFAULT);
            $description = "here comes your description";
            $avatar = "uploads/standard.png";
      

        
            
        
            $statement->bindValue(":email", $email);
            $statement->bindValue(":firstName", $firstName);
            $statement->bindValue(":lastName", $lastName);
            $statement->bindValue(":password", $password);
            $statement->bindValue(":securityQuestion", $securityQuestion);
            $statement->bindValue(":securityAwnser", $secAsnwerHash);
            $statement->bindValue(":description", $description);
            $statement->bindValue(":avatar", $avatar);


            $result = $statement->execute();

            return $result;

        } catch ( PDOException $e ) {
            print 'Error!: ' . $e->getMessage() . '<br/>';
            die();
        }
    }

    public static function getAll() 
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare( 'select * from users' );
        $statement->execute();
        $users = $statement->fetchAll( PDO::FETCH_ASSOC );

        return $users;

    }

    public function viewEmail( $email ) 
    {
        try {
            $conn = Db::getConnection();
            $statement = $conn->prepare( 'SELECT email FROM users WHERE email = :yourEmail' );
            $statement->bindValue( 'yourEmail', $email );
            $statement->execute();
            while( $row = $statement->fetch() ) {
                $activeEmail = $row['email'];

                return $activeEmail;
            }
        } catch ( PDOException $e ) {
            print 'Error: '.$e->getMessage().'<br>';
        }
    }

    public function viewDescription( $email ) 
    {
        try {
            $conn = Db::getConnection();
            $statement = $conn->prepare( 'SELECT description FROM users WHERE email = :currentEmail' );
            $statement->bindValue( ':currentEmail', $email );
            $statement->execute();
            while( $row = $statement->fetch() ) {
                $activeDescription = $row['description'];

                return $activeDescription;
            }
        } catch ( PDOException $e ) {
            print 'Error: '.$e->getMessage().'<br>';
        }
    }

    public function editDescription( $email ) 
    {
        try {
            $conn = Db::getConnection();
            $updateDesStmt = $conn->prepare( 'UPDATE users SET description=:description WHERE email = :email' );
            $description = $this->getDescription();
            $updateDesStmt->bindValue( ':description', $description );
            $updateDesStmt->bindValue( ':email', $email );
            $descrResult = $updateDesStmt->execute();

            return $descrResult;
        } catch ( PDOException $e ) {
            print 'Error: '.$e->getMessage().'<br>';
        }
    }

    public function editEmail( $email ) {
        try {
            $conn = Db::getConnection();
            $mailUpdateStmt = $conn->prepare( 'UPDATE users SET email=:newEmail WHERE email=:email' );
            $oldEmail = $this->getOldEmail();
            $newEmail = $this->getNewEmail();
            $newEmailCheck = $this->getNewEmailCheck();

            if ( $email === $oldEmail ) {
                if ( $newEmail === $newEmailCheck ) {
                    if ( preg_match( '|@student.thomasmore.be$|', $newEmail ) ) {
                        $mailUpdateStmt->bindValue( ':newEmail', $newEmail );
                        $mailUpdateStmt->bindValue( ':email', $email );
                        $updateEmailRes = $mailUpdateStmt->execute();
                        $_SESSION['user'] = $newEmail;

                        return $updateEmailRes;
                    } else {
                        throw new Exception( 'Email must end with @student.thomasmore.be' );
                    }
                } else {
                    throw new Exception( 'you did not repeat the correct email adress' );
                }
            } else {
                throw new Exception( 'this email does not exist in our database' );
            }
        } catch( PDOException $e ) {
            print 'Error: '.$e->getMessage().'<br>';
        }
    }

    public function changePassword( $email ) 
    {
        $conn = Db::getConnection();
        $selectPassword = $conn->prepare( 'SELECT password FROM users WHERE email=:email' );
        $selectPassword->bindValue( ':email', $email );
        $selectPassword->execute();

        while( $row = $selectPassword->fetch() ) {
            $dbPassword = $row['password'];
            $newPassword = $this->getNewPassword();
            $passwordCheck = $this->getPasswordCheck();
            $updatePassword = $conn->prepare( 'UPDATE users SET password=:password WHERE email=:email' );

            if ( $newPassword === $passwordCheck ) {
                $upper = preg_match( '@[A-Z]@', $newPassword );
                $lower = preg_match( '@[a-z]@', $newPassword );
                $number = preg_match( '@[0-9]@', $newPassword );

                if ( $upper ) {
                    if ( $lower ) {
                        if ( $number ) {
                            $oldPassword = $this->getOldPassword();
                            if ( password_verify( $oldPassword, $dbPassword ) ) {
                                $newpasswordHash = password_hash( $newPassword, PASSWORD_DEFAULT, ['cost'=>16] );
                                $updatePassword->bindvalue( ':password', $newpasswordHash );
                                $updatePassword->bindValue( ':email', $email );
                                $passresult = $updatePassword->execute();
                        
                                return $passresult;
                            } else {
                                throw new Exception( 'wrong password' );
                            }
                        } else {
                            throw new Exception( 'password must include a number' );
                        }
                    } else {
                        throw new Exception( 'password must include a lowercase' );
                    }
                } else {
                    throw new Exception( 'password must include an uppercase' );
                }
            }
        }
    }

    public function changeAvatar( $email, $fileName, $fileSize, $fileTmpName, $file ) 
    {
        $conn = Db::getConnection();
        $profileStatement = $conn->prepare( 'UPDATE users SET avatar=:avatar WHERE email=:email' );
        $fileName = $fileName;
        $fileSize = $fileSize;
        $fileTmpName = $fileTmpName;
        $file = $file;
        $fileExt = explode( '.', $fileName );
        $fileExtention = strtolower( end( $fileExt ) );
        $allowedFiles = array( 'jpg', 'jpeg', 'png' );

        if ( in_array( $fileExtention, $allowedFiles ) ) {
            if ( $fileSize < 1000000 ) {
                $fileNewName = uniqid( '', true ).'.'.$fileExtention;
                $fileDestination = 'uploads/'.$fileNewName;
                move_uploaded_file( $fileTmpName, $fileDestination );
                $profileStatement->bindValue( ':avatar', $fileDestination );
                $profileStatement->bindValue( ':email', $email );
                $profileStatement->execute();
            } else {
                throw new Exception( 'filesize is to big!' );
            }
        } else {
            throw new Exception( 'this image type is not supported by Buddy' );
        }
    }

    public function showAvatar( $email ) 
    {
        $conn = Db::getConnection();
        $avatarstmt = $conn->prepare( 'SELECT avatar FROM users WHERE email=:email' );
        $avatarstmt->bindValue( ':email', $email );
        $avatarstmt->execute();

        while( $row = $avatarstmt->fetch() ) {
            $showAvatar = $row['avatar'];

            return $showAvatar;
        }
    }

    public function canLogin() 
    {
        $currentEmail = $this->getCurrentEmail();
        $currentPassword = $this->getCurrentPassword();
        $conn = Db::getConnection();
        $statement = $conn->prepare( 'SELECT * FROM users WHERE email = :currentEmail' );
        $statement->bindValue( ':currentEmail', $currentEmail );
        $statement->execute();
        $user = $statement->fetch( PDO::FETCH_ASSOC );

        if ( password_verify( $currentPassword, $user['password'] ) ) {
            return true;
        } else {
            return false;
        }
    }

    function checkComplete() 
    {
        $email = $this->getCurrentEmail();
        $conn = Db::getConnection();
        $statement = $conn->prepare( 'SELECT * FROM `users` WHERE `email` = :email ' );
        $statement->bindValue( ':email', $email );
        $statement->execute();
        $result = $statement->fetch( PDO::FETCH_ASSOC );
        $number = array_count_values( $result );

        if ( isset( $number['Make a choice'] ) ) {
            if ( $number['Make a choice'] > 4 ) {
                return false;
            } else {
                return true;
            }
        } else {
            return true;
        }
    }

    public function login( $complete ) 
    {
        session_start();
        $_SESSION['user'] = $this->getCurrentEmail();
        if ( $complete ) {
            header( 'Location: match.php' );

        } else {
            header( 'Location: profile.php' );
        }
    }

    public function updateTags( $email )
    {
        try {
            $music = $this->getMusic();
            $movies = $this->getMovies();
            $games = $this->getGames();
            $books = $this->getBooks();
            $tvShows = $this->getTvShows();
            $buddy = $this->getBuddy();
            $conn = Db::getConnection();
            $statement = $conn->prepare( 'UPDATE `users` SET `music`= :music,`movies`= :movies,`games`= :games,`books`= :books,`tvShows`= :tvShows, `buddy` = :buddy WHERE `email` = :email' );
            $statement->bindValue( 'email', $email );
            $statement->bindValue( ':music', $music );
            $statement->bindValue( ':movies', $movies );
            $statement->bindValue( ':games', $games );
            $statement->bindValue( ':books', $books );
            $statement->bindValue( ':tvShows', $tvShows );
            $statement->bindValue( ':buddy', $buddy );
            $statement->execute();

            header( 'Location: profile.php' );
        } catch ( PDOException $e ) {
            print 'Error!: ' . $e->getMessage() . '<br/>';
            die();
        }
    }

    public function findCurrentUser( $email ) 
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare( 'SELECT * FROM users where email = :email' );
        $statement->bindValue( ':email', $email );
        $statement->execute();
        $result = $statement->fetch( PDO::FETCH_ASSOC );

        return $result;
    }

    public function findPerfectMatch( $info ) 
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare( 'SELECT * FROM users WHERE email != :email && buddy != :buddy && music = :music && movies = :movies && games = :games && books = :books && tvShows = :tvShows' );
        $statement->bindValue( ':email', $info['email'] );
        $statement->bindValue( ':buddy', $info['buddy'] );
        $statement->bindValue( ':music', $info['music'] );
        $statement->bindValue( ':movies', $info['movies'] );
        $statement->bindValue( ':games', $info['games'] );
        $statement->bindValue( ':books', $info['books'] );
        $statement->bindValue( ':tvShows', $info['tvShows'] );
        $statement->execute();
        $perfectMatch = $statement->fetchAll( PDO::FETCH_ASSOC );

        return $perfectMatch;
    }

    public function findBuddyMatch( $info ) 
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare( 'SELECT * FROM users WHERE email != :email && buddy != :buddy' );
        $statement->bindValue( ':email', $info['email'] );
        $statement->bindValue( ':buddy', $info['buddy'] );
        $statement->execute();
        $buddyMatch = $statement->fetchAll( PDO::FETCH_ASSOC );

        return $buddyMatch;
    }

    public function findMusicMatch( $info ) 
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare( 'SELECT * FROM users WHERE email != :email && buddy != :buddy && music = :music' );
        $statement->bindValue( ':email', $info['email'] );
        $statement->bindValue( ':buddy', $info['buddy'] );
        $statement->bindValue( ':music', $info['music'] );
        $statement->execute();
        $musicMatch = $statement->fetchAll( PDO::FETCH_ASSOC );

        return $musicMatch;
    }

    public function findMoviesMatch( $info ) 
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare( 'SELECT * FROM users WHERE email != :email && buddy != :buddy && movies = :movies' );
        $statement->bindValue( ':email', $info['email'] );
        $statement->bindValue( ':buddy', $info['buddy'] );
        $statement->bindValue( ':movies', $info['movies'] );
        $statement->execute();
        $moviesMatch = $statement->fetchAll( PDO::FETCH_ASSOC );

        return $moviesMatch;
    }

    public function findGamesMatch( $info ) 
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare( 'SELECT * FROM users WHERE email != :email && buddy != :buddy && games = :games' );
        $statement->bindValue( ':email', $info['email'] );
        $statement->bindValue( ':buddy', $info['buddy'] );
        $statement->bindValue( ':games', $info['games'] );
        $statement->execute();
        $gamesMatch = $statement->fetchAll( PDO::FETCH_ASSOC );

        return $gamesMatch;
    }

    public function findBooksMatch( $info ) 
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare( 'SELECT * FROM users WHERE email != :email && buddy != :buddy && books = :books' );
        $statement->bindValue( ':email', $info['email'] );
        $statement->bindValue( ':buddy', $info['buddy'] );
        $statement->bindValue( ':books', $info['books'] );
        $statement->execute();
        $booksMatch = $statement->fetchAll( PDO::FETCH_ASSOC );

        return $booksMatch;
    }

    public function findTvShowsMatch( $info ) 
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare( 'SELECT * FROM users WHERE email != :email && buddy != :buddy && tvShows = :tvShows' );
        $statement->bindValue( ':email', $info['email'] );
        $statement->bindValue( ':buddy', $info['buddy'] );
        $statement->bindValue( ':tvShows', $info['tvShows'] );
        $statement->execute();
        $tvShowsMatch = $statement->fetchAll( PDO::FETCH_ASSOC );

        return $tvShowsMatch;
    }

    public function hasBuddy( $id ) 
    {
        try {
            $conn = Db::getConnection();
            $statement = $conn->prepare( 'SELECT id, buddyId FROM users WHERE email = :email AND buddyId = :buddyId' );
            $statement->bindValue( ':email', $_SESSION['user'] );
            $statement->bindValue( ':buddyId', $id );
            $statement->execute();
            $buddy = $statement->fetch( PDO::FETCH_ASSOC );

            return $buddy;
        } catch ( \Throwable $th ) {
            $error = $th->getMessage();
        }
    }

    public function sentRequest( $userId, $id ) 
    {
        try {
            $conn = Db::getConnection();
            $statement = $conn->prepare( 'SELECT sender, receiver FROM requests WHERE sender = :sender AND receiver = :receiver AND active = 1' );
            $statement->bindValue( ':sender', $userId );
            $statement->bindValue( ':receiver', $id );
            $statement->execute();
            $request = $statement->fetch( PDO::FETCH_ASSOC );

            return $request;
        } catch ( \Throwable $th ) {
            $error = $th->getMessage();
        }
    }

    public function receivedRequest( $userId, $id ) 
    {
        try {
            $conn = Db::getConnection();
            $statement = $conn->prepare( 'SELECT sender, receiver FROM requests WHERE sender = :sender AND receiver = :receiver AND active = 1' );
            $statement->bindValue( ':sender', $id );
            $statement->bindValue( ':receiver', $userId );
            $statement->execute();
            $request = $statement->fetch( PDO::FETCH_ASSOC );

            return $request;
        } catch ( \Throwable $th ) {
            $error = $th->getMessage();
        }
    }

    public function saveMessage() 
    {
        try {
            $conn = Db::getConnection();
            $statement = $conn->prepare( 'INSERT INTO chat (sender, receiver, message) values (:sender, :receiver, :message)' );
            $sender = $this->getUserId();
            $receiver = $this->getBuddyId();
            $message = $this->getMessageText();
            $statement->bindValue( ':sender', $sender );
            $statement->bindValue( ':receiver', $receiver );
            $statement->bindValue( ':message', $message );
            $result = $statement->execute();

            return $result;
        } catch ( \Throwable $th ) {
            $error = $th->getMessage();
        }
    }

    public static function getAllMessages( $sender, $receiver ) 
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare( 'SELECT * FROM chat WHERE (sender = :sender AND receiver = :receiver) OR (sender = :receiver AND receiver = :sender) ORDER BY timestamp' );
        $statement->bindValue( ':sender', $sender );
        $statement->bindValue( ':receiver', $receiver );
        $result = $statement->execute();

        return $statement->fetchAll( PDO::FETCH_ASSOC );
    }

    public function getMessageText()
    {
        return $this->messageText;
    }

    public function setMessageText( $messageText )
    {
        if ( empty( $messageText ) ) {
            throw new Exception( 'Message cannot be empty' );
        }
        $this->messageText = $messageText;

        return $this;
    }

    public function messageRead( $receiver ) 
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare( 'SELECT * FROM chat WHERE receiver = :receiver AND `read` = 0' );
        $statement->bindValue( ':receiver', $receiver );
        $statement->execute();

        return $statement->fetchAll( PDO::FETCH_ASSOC );
    }

    public function messageSenders( $receiver, $sender ) 
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare( 'SELECT receiver FROM chat WHERE receiver = :receiver AND `read` = 0 AND sender = :sender' );
        $statement->bindValue( ':receiver', $receiver );
        $statement->bindValue( ':sender', $sender );
        $statement->execute();

        return $statement->fetch( PDO::FETCH_ASSOC );
    }

    public function userReadMessage() 
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare( 'UPDATE chat SET `read` = 1 WHERE receiver = :receiver AND sender = :sender' );
        $statement->bindValue( ':receiver', $this->getUserId() );
        $statement->bindValue( ':sender', $_GET['messageid'] );
        $result = $statement->execute();

        return $result;
    }

    public function matchType( $info ) 
    {
        $musicMatch = $this->findMusicMatch( $info );
        foreach ( $musicMatch as $m ) {
            if ( $m['id'] === $_GET['messageid'] ) {
                return $matchType = 'You match with '. $m['firstName'] . ' because you have a similar taste in music';
            }
        }

        $moviesMatch = $this->findMoviesMatch( $info );
        foreach ( $moviesMatch as $m ) {
            if ( $m['id'] === $_GET['messageid'] ) {
                return $matchType = 'You match with '. $m['firstName'] . ' because you have a similar movie taste';
            }
        }

        $gamesMatch = $this->findGamesMatch( $info );
        foreach ( $gamesMatch as $m ) {
            if ( $m['id'] === $_GET['messageid'] ) {
                return $matchType = 'You match with '. $m['firstName'] . ' because you like similar games';
            }
        }

        $booksMatch = $this->findBooksMatch( $info );
        foreach ( $booksMatch as $m ) {
            if ( $m['id'] === $_GET['messageid'] ) {
                return $matchType = 'You match '. $m['firstName'] . ' because you like similar books';
            }
        }

        $tvShowsMatch = $this->findTvShowsMatch( $info );
        foreach ( $tvShowsMatch as $m ) {
            if ( $m['id'] === $_GET['messageid'] ) {
                return $matchType = 'You matched '. $m['firstName'] . ' because you like similar TV shows';
            }
        }
    }

    public function sendRequest() 
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare( 'SELECT sender FROM requests WHERE sender = :sender' );
        $sender = $this->getUserId();
        $statement->bindValue( ':sender', $sender );
        $statement->execute();
        $result = $statement->fetch( PDO::FETCH_ASSOC );

        return $result;
    }

    public function sendRequestFalse() 
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare( 'INSERT INTO requests (sender, receiver) VALUES (:sender, :receiver)' );
        $sender = $this->getUserId();
        $receiver = $this->getBuddyId();
        $statement->bindValue( ':sender', $sender );
        $statement->bindValue( ':receiver', $receiver );
        $result = $statement->execute();

        return $result;
    }

    public function sendRequestTrue() 
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare( 'UPDATE requests SET receiver = :receiver, active = 1 WHERE sender = :sender' );
        $sender = $this->getUserId();
        $receiver = $this->getBuddyId();
        $statement->bindValue( ':sender', $sender );
        $statement->bindValue( ':receiver', $receiver );
        $result = $statement->execute();

        return $result;
    }

    public function cancelRequest() 
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare( 'DELETE FROM requests WHERE sender = :sender' );
        $sender = $this->getUserId();
        $statement->bindValue( ':sender', $sender );
        $result = $statement->execute();

        return $result;
    }

    public function removeBuddy() 
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare( 'UPDATE users SET buddyId = CASE WHEN id = :id THEN 0 WHEN id = :buddyId THEN 0 ELSE buddyId END' );
        $id = $this->getUserId();
        $buddyId = $this->getBuddyId();
        $statement->bindValue( ':id', $id );
        $statement->bindValue( ':buddyId', $buddyId );
        $result = $statement->execute();

        return $result;
    }

    public function acceptRequest() 
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare( 'UPDATE users SET buddyId = CASE WHEN id = :id THEN :buddyId WHEN id = :buddyId THEN :id ELSE buddyId END' );
        $id = $this->getUserId();
        $buddyId = $this->getBuddyId();
        $statement->bindValue( ':id', $id );
        $statement->bindValue( ':buddyId', $buddyId );
        $result = $statement->execute();

        return $result;
    }

    public function getReason()
    {
        return $this->reason;
    }

    public function setReason( $reason )
    {
        $this->reason = $reason;

        return $this;
    }

    public function ignoreRequest() 
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare( 'UPDATE requests SET active = 0, reason = :reason WHERE sender = :sender' );
        $sender = $this->getBuddyId();
        $reason = $this->getReason();
        $statement->bindValue( ':sender', $sender );
        $statement->bindValue( ':reason', $reason );
        $result = $statement->execute();

        return $result;
    }

    public function findBuddyId( $email ) 
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare( 'SELECT buddyId FROM users where email = :email' );
        $statement->bindValue( ':email', $email );
        $statement->execute();
        $result = $statement->fetch( PDO::FETCH_ASSOC );
        $buddyId = $result['buddyId'];

        return $buddyId;
    }

    public function showBuddy( $buddyId ) 
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare( 'SELECT * FROM users WHERE id = :buddyId' );
        $statement->bindValue( ':buddyId', ( int )$buddyId );
        $statement->execute();
        $result = $statement->fetch( PDO::FETCH_ASSOC );

        return $result;
    }

    public function findReceiverEmail( $receiver ) 
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare( 'SELECT email FROM users INNER JOIN requests ON users.id = requests.receiver WHERE requests.receiver = :receiver' );
        $receiver = $this->getBuddyId();
        $statement->bindValue( ':receiver', ( int )$receiver );
        $statement->execute();
        $result = $statement->fetch( PDO::FETCH_ASSOC );

        return $result['email'];
    }

    public function isReasonSet( $receiver ) 
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare( "SELECT * FROM requests WHERE receiver = :receiver AND reason != '' AND sender = :sender AND active = 0" );
        $sender = $this->getUserId();
        $statement->bindValue( ':sender', $sender );
        $statement->bindValue( ':receiver', $receiver );
        $statement->execute();
        $result = $statement->fetch( PDO::FETCH_ASSOC );

        if ( $result ) {
            $this->setReason( $result['reason'] );
        }
        return $result;
    }

    public static function getNumberAccept() 
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare( 'SELECT * FROM `users` WHERE `buddyId` != 0' );
        $statement->execute();
        $users = $statement->fetchAll( PDO::FETCH_ASSOC );

        return $users;
    }

    public function makeModerator( $email ) 
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare( 'UPDATE `users` SET `moderator`=1 WHERE email = :email' );
        $statement->bindValue( ':email', $email );
        $statement->execute();
        $result = $statement->fetch( PDO::FETCH_ASSOC );

        return $result;
    }

    public function undoModerator( $email ) 
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare( 'UPDATE `users` SET `moderator`=0 WHERE email = :email' );
        $statement->bindValue( ':email', $email );
        $statement->execute();
        $result = $statement->fetch( PDO::FETCH_ASSOC );

        return $result;
    }

    public function moderator( $email ) 
    {
        $conn = DB::getConnection();
        $statement = $conn->prepare( 'SELECT * FROM `users` WHERE `email` = :email' );
        $statement->bindValue( ':email', $email );
        $statement->execute();
        $result = $statement->fetch( PDO::FETCH_ASSOC );
       
        return $result;
    }

    public function checkEmail( $email )
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare( 'SELECT * FROM users WHERE email= :email' );
        $statement->bindValue( ':email', $email );
        $statement->execute();
        $result = $statement->fetch( PDO::FETCH_ASSOC );

        if ( $result === false ) {
            return true;
            //not taken
        } else {
            return false;
            //taken
        }
    }

    public function publicInfo( $id ) 
    {
        $conn = Db::getConnection();
        $stmt = $conn->prepare( 'SELECT * FROM users WHERE id=:id' );
        $stmt->bindValue( ':id', $id );
        $stmt->execute();
        $return = $stmt->fetchAll( PDO::FETCH_ASSOC );

        return $return;
    }

    public function cannotLogin( $CEmail ) 
    {
        $conn = Db::getConnection();
        $getStatement = $conn->prepare( 'select failedAttempts from users where email = :email' );
        $CEmail = $CEmail;
        $getStatement->bindValue( ':email', $CEmail );
        $getStatement->execute();
        $failedAtt = $getStatement->fetch( PDO::FETCH_ASSOC );
        $value = $failedAtt['failedAttempts'];
        $newValue = $value + 1;
        $updateStatement = $conn->prepare( 'update users set failedAttempts = :failedAttempts where email= :email' );
        $updateStatement->bindValue( ':failedAttempts', $newValue );
        $updateStatement->bindValue( ':email', $CEmail );
        $updateStatement->execute();

        return $newValue;
    }

    public function secQuestion() 
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare( 'select securityQuestion from users where email = :email' );
        $email = $this->getCurrentEmail();
        $statement->bindValue( ':email', $email );
        $statement->execute();
        $question_array = $statement->fetch( PDO::FETCH_ASSOC );
        $question = $question_array['securityQuestion'];

        return $question;
    }

    public function awnserCheck( $awnser ) 
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare( 'select securityAwnser from users where email= :email' );
        $email = $this->getCurrentEmail();
        $currentAwnser = $awnser;
        $statement->bindValue( ':email', $email );
        $statement->execute();
        $correctAwnser_array = $statement->fetch( PDO::FETCH_ASSOC );
        $correctAwnser = $correctAwnser_array['securityAwnser'];
        
        if ( password_verify( $currentAwnser, $correctAwnser ) ) {
            return true;
        } else {
            return false;
        }
    }

    public function currentAttempts() 
    {
        $conn = Db::getConnection();
        $statement = $conn->prepare( 'select failedAttempts from users where email = :email' );
        $email = $this->getCurrentEmail();
        $statement->bindValue( ':email', $email );
        $statement->execute();
        $current_array = $statement->fetch( PDO::FETCH_ASSOC );
        $current = $current_array['failedAttempts'];

        return $current;
    }

    public function getBuddyName( $buddyId ) 
    {
        $conn = Db::getConnection();
        $stmt = $conn->prepare( 'SELECT id, firstName, lastName FROM users WHERE id=:id' );
        $stmt->bindValue( ':id', $buddyId );
        $stmt->execute();
        $return = $stmt->fetchAll( PDO::FETCH_ASSOC );

        return $return;
    }
}