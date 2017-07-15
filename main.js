$("#toggleLogin").click(
    function () {
        if ($("#loginActive").val() === "1") {
            $("#loginActive").val("0");
            $("#loginModalTitle").html("Sign Up");
            $("#loginSignupButton").html("Sign Up");
            $("#toggleLogin").html("Login");

        } else {
            $("#loginActive").val("1");
            $("#loginModalTitle").html("Login");
            $("#loginSignupButton").html("Login");
            $("#toggleLogin").html("Sign Up");
        }
    }
);

$("#loginSignupButton").click(function () {
    $.ajax({
        type: "POST",
        url: "actions.php?action=loginSignup",
        data: "email=" + $("#email").val() +
        "&password=" + $("#password").val() +
        "&loginActive=" + $("#loginActive").val(),
        success: function(result) {
            if (result === "1") {   // It's "1", NOT 1
                //Go to home page after Successful Login
                window.location.assign("http://13.58.86.5/twitterPHP/")
            } else {
                $("#loginAlert").html(result).show();
            }
        }
    })
});

$(".toggleFollow").click(function() {
        // alert($(this).attr("data-userId"));  FOR DEBUGGING
        var id = $(this).attr("data-userId");
        $.ajax({
            type: "POST",
            url: "actions.php?action=toggleFollow",
            data: "userId=" + id,
            success: function(result) {
                if (result === "1") {
                    $("a[data-userId='" + id +"']").html("Follow");
                } else if (result === "2") {
                    $("a[data-userId='" + id +"']").html("Unfollow");
                } else if (result === "3") {
                    $("#login").trigger('click');
                }
            }
        })
    }
);

$("#postTweetButton").click(function() {
        //alert($("#tweetContent").val());     // For Test
        $.ajax({
            type: "POST",
            url: "actions.php?action=postTweet",
            data: "tweetContent=" + $("#tweetContent").val(),
            success: function(result) {
                // alert(result);  //for test
                if (result === "1") {
                    $("#tweetSuccess").show();  // refer to displayTweetBox()
                    $("#tweetFail").hide();
                } else if (result !== "") {
                    $("#tweetFail").html(result).show();
                    $("#tweetSuccess").hide();
                }
            }
        })
    }
);