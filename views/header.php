<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Twitter PHP</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <!-- Customized CSS file-->
    <link rel="stylesheet" href="styles.css">

      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>

  </head>
  <body>
  <nav class="navbar navbar-default">
      <div class="container-fluid">
          <div class="navbar-header">
              <a class="navbar-brand" href="http://13.58.86.5/twitterPHP/">Twitter Lite</a>
          </div>


          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav">
                  <li><a href="?page=timeline">Your Timeline</a></li>
                  <li><a href="?page=yourtweets">Your tweets</a></li>
                  <li><a href="?page=publicprofiles">Public Profiles</a></li>
              </ul>
              <div class="navbar-form navbar-right">
                  <?php if ($_SESSION['id']) { ?>
                      <a class="btn btn-info" href="?function=logout">Logout</a>
                      <?php } else { ?>
                  <?php ?>
                      <button type="button" class="btn btn-info" id="login"
                              data-toggle="modal" data-target="#myModal">Login / Signup</button>
                  <?php }?>

              </div>

          </div>
      </div>
  </nav>