<?php
    include "../db_connection.php";
    session_start();

    if(!isset($_SESSION['loggedin'])) {
      header('Location: http://127.0.0.1/NGCB/index.php');
    }
?>

<!DOCTYPE html>

<html>

<head>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="../materialize/css/materialize.min.css" media="screen,projection" />
    <link rel="stylesheet" text="type/css" href="../style.css">
    <!--Import Google Icon Font-->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!--Import materialize.css-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.2/css/materialize.css" rel="stylesheet">
</head>

<body>
    <nav>
        <div class="nav-wrapper">
            <a href="#" data-activates="navigation" class="button-collapse show-on-large menu-icon"><i
                    class="material-icons menuIcon">menu</i></a>
            <span id="NGCB">NEW GOLDEN CITY BUILDERS AND DEVELOPMENT CORPORATION</span>
            <?php 
                            if(isset($_SESSION['username'])) {
                            $username = $_SESSION['username'];
                            $sql = "SELECT * FROM accounts WHERE accounts_username = '$username'";
                            $result = mysqli_query($conn, $sql);
                            $row = mysqli_fetch_row($result);
                        ?>
            <span id="acName">
                <ul>
                    <?php echo $row[1]." ".$row[2]; ?>
                    <li class="down-arrow">

                        <a class="dropdown-button" href="#!" data-activates="dropdown" data-beloworigin="true"><i
                                class="material-icons dropdown-button">keyboard_arrow_down</i></a>
                    </li>

                </ul>
                <ul id="dropdown" class="dropdown-content collection">
                    <li><a class="waves-effect waves-blue" href="account.php">Account</a></li>
                    <li><a class="waves-effect waves-blue" href="logout.php">Logout</a></li>

                </ul>
            </span>
            <ul class="side-nav" id="navigation">
                <li class="icon-container">
                    <img src="../Images/NGCB_logo.png" class="sidenav-logo">
                </li>
                <h3 id="account-type">
                    <?php 
                        if(strcmp($row[5], "MatEng") == 0 ) {
                            echo "Materials Engineer";
                        } else if(strcmp($row[5], "ViewOnly") == 0 ) {
                            echo "View Only";
                        } else {
                            echo "Admin";
                        }
                        }
                    ?>
                </h3>

                <li>
                    <i class="material-icons left">dashboard</i><a class="waves-effect waves-blue"
                        href="admindashboard.php">Dashboard</a>
                </li>


                <ul class="collapsible">
                    <li>
                        <i class="material-icons left">supervisor_account</i><a
                            class="collapsible-header waves-effect waves-blue">Accounts<i
                                class="material-icons right">keyboard_arrow_down</i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a class="waves-effect waves-blue" href="accountcreation.php">Create Account</a>
                                </li>
                                <li><a class="waves-effect waves-blue" href="listofaccounts.php">List of Accounts</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <li>
                    <i class="material-icons left">insert_drive_file</i><a class="waves-effect waves-blue"
                        href="projects.php">Projects</a>
                </li>
                <li>
                    <i class="material-icons left">folder</i><a class="waves-effect waves-blue"
                        href="report.php">Logs</a>
                </li>
                <li>
                    <i class="material-icons left">receipt</i><a class="waves-effect waves-blue"
                        href="report.php">Report</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <form action="../server.php" method="POST">
            <h2 class="header header-two">Create an Account</h2>
            <div class="row">
                <div class="input-field col s12 m10 offset-m1">
                    <input id="firstname" name="firstname" type="text" class="validate" pattern="[A-Za-z]*"
                        title="Input only letters" required>
                    <label for="firstname">First Name</label>
                </div>

                <div class="input-field col s12 m10 offset-m1">
                    <input id="lastname" name="lastname" type="text" class="validate" pattern="[A-Za-z]*"
                        title="Input only letters" required>
                    <label for="lastname">Last Name</label>
                </div>

                <div class="input-field col s12 m10 offset-m1">
                    <input id="username" name="username" type="text" class="validate" pattern="[A-Za-z0-9]*"
                        title="Input only letters" required>
                    <label for="username">Username</label>
                </div>

                <div class="input-field col s12 m10 offset-m1">
                    <input id="email" name="email" type="text" class="validate"
                        pattern="[A-Za-z0-9]*@[A-Za-z]*\.[A-Za-z]*" title="Follow the format. Example: email@email.com"
                        required>
                    <label for="email">Email</label>
                </div>

                <div class="input-field col s12 m10 offset-m1">
                    <input id="password" name="password" type="password" class="validate" minlength="6" maxlength="12"
                        title="Alphanumeric only" required>
                    <label for="password">Password</label>
                </div>

                <div class="col s12 m10 offset-m1">
                    <span>Account Type</span>
                    <div class="row">
                        <form>
                            <p>
                                <label>
                                    <input class="with-gap" value="MatEng" type="radio" />
                                    <span>Materials Engineer</span>
                                </label>
                            </p>
                            <p>
                                <label>
                                    <input class="with-gap" value="ViewOnly" type="radio" />
                                    <span>View-Only</span>
                                </label>
                            </p>
                        </form>
                    </div>

                </div>

                <div class="row center">
                    <button class="btn waves-effect waves-light create-account-btn" type="submit"
                        name="create_account">Create
                        An Account</button>
                </div>
            </div>
        </form>
    </div>

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.2/js/materialize.js">
    </script>
    <script>
        // SIDEBAR
        $(document).ready(function () {
            $('.button-collapse').sideNav({
                menuWidth: 300, // Default is 300
                edge: 'left', // Choose the horizontal origin
                closeOnClick: false, // Closes side-nav on <a> clicks, useful for Angular/Meteor
                draggable: true // Choose whether you can drag to open on touch screens
            });
            // START OPEN
            $('.button-collapse').sideNav('show');
        });
    </script>

</body>

</html>