<div class="container mainContainer">
    <div class="row">
        <div class="tweet-area col-md-8">
            <h2>Recents tweets</h2>
            <?php displayTweets('public'); ?>   <!--refer to the functions.php-->
        </div>
        <div id="searchBox" class="col-md-4">
            <?php displaySearch(); ?><hr>
            <?php displayTweetBox(); ?>
        </div>
    </div>
</div>
