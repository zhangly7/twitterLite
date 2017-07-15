<div class="container mainContainer">
    <div class="row">
        <div class="tweet-area col-md-8">
            <h2>Your Tweets</h2>
            <?php displayTweets('yourtweets'); ?>   <!--refer to the functions.php-->
        </div>
        <div class="col-md-4">
            <?php displaySearch(); ?><hr>
            <?php displayTweetBox(); ?>
        </div>
    </div>
</div>