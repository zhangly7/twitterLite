<?php
    session_start();
    $conn = mysqli_connect("localhost", "root", "335506mysql", "twitterPHP");

    if (mysqli_connect_errno()) {
        print_r(mysqli_connect_error());
        exit();
    }

    if ($_GET['function'] == "logout") {
        session_unset();
    }

    function time_since($since) {
        $chunks = array(
            array(60 * 60 * 24 * 365 , 'year'),
            array(60 * 60 * 24 * 30 , 'month'),
            array(60 * 60 * 24 * 7, 'week'),
            array(60 * 60 * 24 , 'day'),
            array(60 * 60 , 'hour'),
            array(60 , 'min'),
            array(1 , 'sec')
        );

        for ($i = 0, $j = count($chunks); $i < $j; $i++) {
            $seconds = $chunks[$i][0];
            $name = $chunks[$i][1];
            if (($count = floor($since / $seconds)) != 0) {
                break;
            }
        }

        $print = ($count == 1) ? '1 '.$name : "$count {$name}s";
        return $print;
    }

    function displayTweets($type) {
        global $conn;   // make variable $conn be global
        $sanitizedUserID = mysqli_real_escape_string($conn, $_SESSION['id']);
        if ($type == 'public') {
            $whereClause = '';
        } else if ($type == 'isFollowing') {

            $query = "SELECT * FROM isFollowing WHERE follower = ".$sanitizedUserID;
            $result = mysqli_query($conn, $query);
            $whereClause = '';
            while ($row = mysqli_fetch_assoc($result)) {
                if ($whereClause == "") $whereClause = "WHERE";
                else $whereClause.= " OR";
                $whereClause.= " userid = ".$row['isFollowing'];
            }
            if ($whereClause == "") $whereClause = "WHERE userid = -1";
        } else if ($type == 'yourtweets') {
            $whereClause = "WHERE userid = ". $sanitizedUserID;
        } else if ($type == 'search') {
            $sanitizedQ = mysqli_real_escape_string($conn, $_GET['q']);
            echo '<p>Showing Results for "'.$sanitizedQ.'"</p>';
            $whereClause = "WHERE tweet LIKE '%". $sanitizedQ . "%'";
        } else if (is_numeric($type)) {
            $whereClause = "WHERE userid = ". $type;
            $user = getUser($type);
            echo "<h2>". $user['email']. "'s Tweets </h2>";
        }

        $query = "SELECT * FROM tweets ".$whereClause." ORDER BY datetime DESC LIMIT 10";
        $result = mysqli_query($conn, $query);
        if (mysqli_num_rows($result) == 0) {
            echo "Oops, no tweet...";
        } else {
            while ($row = mysqli_fetch_assoc($result)) {
                $user = getUser($row['userid']);

                echo "<div class='tweetDisplay'><p><a href='?page=publicprofiles&userid=".$user['id']."'>".$user['email']."</a>"." <span class='time'>".time_since(time() - strtotime($row['datetime']))." ago</span></p>";
                echo "<p>".$row['tweet']."</p>";
                echo "<a class='toggleFollow' role='button' data-userId='".$row['userid']."'>";
                $isFollowingQuery = "SELECT * FROM isFollowing 
                          WHERE follower =".$sanitizedUserID. " AND isFollowing =".$row['userid'];
                $isFollowingReslut = mysqli_query($conn,$isFollowingQuery);
                if (mysqli_num_rows($isFollowingReslut) > 0) {
                    echo "Unfollow";
                } else {
                    echo "Follow";
                }
                echo "</a></div>";
            }
        }
    }

    function displaySearch() {
        echo '<form class="form-inline">
                <div class="form-group">
                <input type="hidden" name="page" value="search">    
                <input type="text" name="q" class="form-control" id="search" placeholder="Search">
                </div>
                <!--click will submit page=search q=content-->
                <button type="submit" class="btn btn-info">Search Tweets</button>
              </form>';
    }

    function displayTweetBox() {       // Render the textbox to post tweet
        //print_r($_SESSION);   //For Debugging
        if ($_SESSION['id'] > 0) {
            echo '<div id="tweetSuccess" class="alert alert-success">Posted successfully.</div>
                   <div id="tweetFail" class="alert alert-danger"></div>
                   <div class="form">
                    <div class="form-group">
                    <textarea class="form-control" id="tweetContent"></textarea>
                    </div>
                    <button id="postTweetButton" class="btn btn-info">Post Tweet</button>
                   </div>';
        }
    }

    function displayUsers() {
        global $conn;
        $query = "SELECT * FROM users LIMIT 10";
        $result = mysqli_query($conn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<p><a href='?page=publicprofiles&userid=" .$row['id']. "'>". $row['email']. "</a></p>";
        }
    }
    function getUser ($userid) {
        global $conn;
        $userQuery = "SELECT * FROM users 
                                WHERE id =".mysqli_real_escape_string($conn, $userid)." LIMIT 1";
        $userQueryResult = mysqli_query($conn, $userQuery);
        $user = mysqli_fetch_assoc($userQueryResult);
        return $user;
    }

    /*Debugging Code*/
    /*
        $email = "zhangly7@163.com";
        $password = "321";
        $query = "INSERT INTO users (email, password) VALUES ('" . $email . "', '" . $password . "')";
        if (mysqli_query($conn, $query)) {
            echo 1;
        } else {
            echo 2;
        }
    */
?>