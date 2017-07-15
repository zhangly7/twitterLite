<?php
    include("functions.php");

    // Validate Input
    if ($_GET['action'] == "loginSignup") {
        //    print_r($_POST); // for test
        $error = "";    //define err variable for later use

        if (!$_POST['email']) {
            $error = "Please enter your email address.";
        } else if (!$_POST['password']) {
            $error = "Enter Password!";
        } else if (filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) == false) {
            $error = "Oh, your email address is invalid";
        }

        if ($error != "") {
            echo $error;
            exit();
        }


        if ($_POST['loginActive'] == "0") {     // Sign user up

            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);

            $query = "SELECT * FROM users WHERE email = '" . $email . "' LIMIT 1";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {     // Already existed
                $error = "Sorry, the email address is already taken.";
            } else {
                $hashed_password = hash('sha512', $password);
                $query = "INSERT INTO users (email, password) VALUES ('" . $email . "', '" . $hashed_password . "')";
                if (mysqli_query($conn, $query)) {
                    $_SESSION['id'] = mysqli_insert_id($conn);
                    echo 1;     //Successfully SignUp
                } else {
                    $error = "Couldn't create user now, try again later";
                }
            }
        } else {    // Login with password and email
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);

            $query = "SELECT * FROM users WHERE email = '". $email . "'AND password = '" .hash('sha512', $password). "' LIMIT 1";
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            if (mysqli_num_rows($result) > 0) {
                $_SESSION['id'] = $row['id'];   // Assign Session ID
                echo 1;     //Return 1 if Successfully Login
            } else {
                $error = "wrong email/password";
            }
        }
        if ($error != "") {
            echo $error;
            exit();
        }
    }

    if ($_GET['action'] == "toggleFollow") {
        if ($_SESSION['id'] > 0) {
            $sanitizedSessionID = mysqli_real_escape_string($conn, $_SESSION['id']);
            $sanitizedPostID = mysqli_real_escape_string($conn, $_POST['userId']);
            $query = "SELECT * FROM isFollowing 
                  WHERE follower = " . $sanitizedSessionID . " AND isFollowing = " . $sanitizedPostID . " LIMIT 1";
            $result = mysqli_query($conn, $query);
            if (mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $sanitizedRowID = mysqli_real_escape_string($conn, $row['id']);
                $delQuery = "DELETE FROM isFollowing WHERE id = " . $sanitizedRowID . " LIMIT 1";
                mysqli_query($conn, $delQuery);
                echo "1";
            } else {
                $insertQuery = "INSERT INTO isFollowing (follower, isFollowing) 
                            VALUES (" . $sanitizedSessionID . "," . $sanitizedPostID . ")";
                mysqli_query($conn, $insertQuery);
                echo "2";
            }
        } else {
            echo "3";
        }
    }

    if ($_GET['action'] == 'postTweet') {
        if (!$_POST['tweetContent']) {
            echo "Empty, type something.";
        } else if (strlen($_POST['tweetContent']) > 140) {
            echo "Please make it shorter!";
        } else {
            $sanitizedSessionID = mysqli_real_escape_string($conn, $_SESSION['id']);
            $sanitizedPostID = mysqli_real_escape_string($conn, $_POST['userId']);
            $sanitizedTweetContent = mysqli_real_escape_string($conn, $_POST['tweetContent']);
            $insertQuery = "INSERT INTO tweets (tweet, userid, datetime) 
                            VALUES ('" . $sanitizedTweetContent . "'," . $sanitizedSessionID . ", NOW())";
            mysqli_query($conn, $insertQuery);
            echo "1";
        }
    }
?>