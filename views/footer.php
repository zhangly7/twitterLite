    <footer class="footer">
        <div class="container">
            <p>a PHP Practice Project</p>
        </div>
    </footer>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalTitle">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" id = "loginAlert"></div>    <!--Handle Login Failure-->
                    <form>
                        <input type="hidden" id="loginActive" name="loginActive" value="1">  <!--hidden; used to switch-->
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" placeholder="Email address">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" placeholder="Password">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <a id="toggleLogin">Sign up</a>
                    <button type="button" class="btn btn-info" data-dismiss="modal">Close</button>
                    <button type="button" id="loginSignupButton" class="btn btn-info">Login</button>
                </div>
            </div>
        </div>
    </div><!--End of Modal-->
    <script src="main.js"></script>
  </body>
</html>