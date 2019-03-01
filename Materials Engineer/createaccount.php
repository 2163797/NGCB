<!DOCTYPE html>

<html>

<head>
    <link rel="stylesheet" text="type/css" href="../materialize/css/materialize.css">
    <link rel="stylesheet" text="type/css" href="../materialize/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" text="type/css" href="../style.css">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.2/css/materialize.css" rel="stylesheet">

    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col s12 m6 offset-m3">
                <div class="card white darken-1">
                    <div class="card-content black-text">
                        <h2 class="card-title center-align">New Golden City Builders</h2>
                        <h2 class="card-title center-align">Create Account</h2>
                        <div class="row">
                            <div class="input-field col s12 m10 offset-m1">
                                <input id="firstname" name="first name" type="text" class="validate">
                                <label for="firstname">First Name</label>
                            </div>

                            <div class="input-field col s12 m8 offset-m1">
                                <input id="lastname" name="lastname" type="text" class="validate">
                                <label for="lastname">Last Name</label>
                            </div>

                            <div class="input-field col s12 m10 offset-m1">
                                <input id="username" name="username" type="text" class="validate">
                                <label for="username">Username</label>
                            </div>

                            <div class="input-field col s12 m10 offset-m1">
                                <input id="email" name="email" type="text" class="validate">
                                <label for="email">Email</label>
                            </div>

                            <div class="input-field col s12 m10 offset-m1">
                                <input id="password" name="password" type="text" class="validate">
                                <label for="password">Password</label>
                            </div>
                            
                           <!--ETO VINCENT-->
                           <div class="col s12 m10 offset-m1">
                                <form action="#">
                                    <p>
                                        <span>Account Type</span>
                                        <label>
                                            <input class="with-gap" name="group1" type="radio" checked />
                                            <span>Materials Engineer</span>
                                            <input class="with-gap" name="group1" type="radio" checked />
                                            <span>View Only</span>
                                        </label>
                                    </p>
                                </form>
                            </div>


                            <!--HANGGANG HERE-->
                            
                            <div class="row center">
                                <a class="btn waves-effect waves-light" type="submit" name="action" href="createaccount.html">Create
                                    An Account</a>
                                    <a class="waves-effect waves-light btn" type="submit" name="action" href="loginpage.html">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="confirmationModal" class="modal">
        <div class="modal-content">
            <p>Your password reset has been sent. Kindly wait for the confirmation of your request. Please check your
                email for updates</p>>
        </div>
        <div class="modal-footer">
            <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">OK</a>
        </div>
    </div>
    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.2/js/materialize.js"></script>
    <script>
        $(document).ready(function () {
            $('.modal-trigger').leanModal();
        });
    </script>
</body>

</html>