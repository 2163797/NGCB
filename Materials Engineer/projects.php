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
    <title>NGCB</title>
    <link rel="icon" type="image/png" href="../Images/NGCB_logo.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.2/css/materialize.css" rel="stylesheet">
    <link rel="stylesheet" text="type/css" href="../style.css">
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
                                class="material-icons right">keyboard_arrow_down</i></a>
                    </li>

                </ul>
                <ul id="dropdown" class="dropdown-content collection">
                    <li><a class="waves-effect waves-blue" href="account.php">Account</a></li>
                    <li><a class="waves-effect waves-blue" href="../logout.php">Logout</a></li>

                </ul>
            </span>
            <ul class="side-nav" id="navigation">
                <li class="icon-container">
                    <ul>
                        <li class="acType">
                            <img src="../Images/NGCB_logo.png" class="sidenav-logo">
                        </li>
                    </ul>
                </li>
                <h3 id="account-type"><?php echo $row[5]; }?></h3>

                <li>
                    <i class="material-icons left">dashboard</i><a class="waves-effect waves-blue"
                        href="dashboard.php">Dashboard</a>
                </li>


                <ul class="collapsible">
                    <li>
                        <i class="material-icons left">place</i><a
                            class="collapsible-header waves-effect waves-blue">Site<i
                                class="material-icons right">keyboard_arrow_down</i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a class="waves-effect waves-blue" href="projects.php">Projects</a></li>
                                <li><a class="waves-effect waves-blue" href="sitematerials.php">Site Materials</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
                

                
                <ul class="collapsible">
                    <li>
                        <i class="material-icons left">local_shipping</i><a
                            class="collapsible-header waves-effect waves-blue">Hauling<i
                                class="material-icons right">keyboard_arrow_down</i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li>
                                    <a class="waves-effect waves-blue" href="hauling.php">Fill out Hauling Form</a>
                                </li>
                                <li>
                                    <a class="waves-effect waves-blue" href="hauled%20items.php">View Hauled
                                        Materials</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>



                <li>
                    <i class="material-icons left">receipt</i><a class="waves-effect waves-blue"
                        href="report.php">Report</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col s12">
                <ul class="tabs">
                    <li class="tab col s3"><a href="#ongoing">Ongoing</a></li>
                    <li class="tab col s3"><a href="#closed">Closed</a></li>
                </ul>
            </div>
            <!--ONGOING TAB-->
            <div id="ongoing" class="col s12">
                <div class="row">
                    <?php
                        $sql = "SELECT projects_name, projects_address, projects_sdate, projects_edate FROM projects
                        WHERE projects_mateng =  (SELECT accounts_id FROM accounts WHERE accounts_username = '$username')
                        && projects_status = 'open';";
                        $result = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_row($result)){
                    ?>
                    <div class="col s12 m6">
                        <div class="card blue-grey darken-1 center">
                            <div class="card-content white-text">
                                <span class="card-title"><?php echo $row[0] ?></span>
                                <p>
                                    <?php echo $row[1] ?>
                                </p>
                                <p>
                                    <span>
                                        start date
                                    </span>
                                    <?php echo $row[2] ?>
                                </p>
                                <p>
                                    <span>
                                        end date
                                    </span><?php echo $row[3] ?>
                                </p>
                                <div class="row">
                                    <form action="../server.php" method="POST">
                                        <input type="hidden" name="projects_name" value="<?php echo $row[0] ?>">
                                        <input type="hidden" name="account_type" value="<?php echo $_SESSION['account_type']; ?>">
                                        <div class="row">
                                            <button class="waves-effect waves-light btn viewinventory-btn" type="submit"
                                                name="view_inventory">View Inventory</button>
                                        </div>
                                    </form>
                                </div>
                                <?php 
                                    if (strtotime($row[2]) > strtotime ($row[3])) {
                                        ?>
                                            <div class="row">
                                                <a href="#closeModal" class="waves-effect waves-light btn red modal-trigger">Close
                                                    Project</a>
                                            </div>
                                        <?php
                                    }
                                ?>
                            </div>
                        </div>
                    </div>

                    <div id="closeModal" class="modal modal-fixed-footer">
                        <div class="modal-content">
                            <h4>Close Project?</h4>
                            <p>Are you sure you want to close this project?</p>
                        </div>
                        <div class="modal-footer">
                            <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">No</a>
                            <form action="../server.php" method="POST">
                                <input type="hidden" name="project_name" value='<?php echo $row[0] ?>'>
                                <button type="submit" name="close_project"
                                    class="modal-action modal-close waves-effect waves-green btn-flat">Yes</button>
                            </form>
                        </div>
                    </div>
                    <?php 
                        }
                    ?>
                </div>
            </div>

            <div id="closed" class="col s12">
                <div class="row">
                    <?php
                        $sql = "SELECT projects_name, projects_address, projects_sdate, projects_edate FROM projects
                        WHERE projects_mateng =  (SELECT accounts_id FROM accounts WHERE accounts_username = '$username')
                        && projects_status = 'closed';";
                        $result = mysqli_query($conn, $sql);
                        while($row = mysqli_fetch_row($result)){
                    ?>
                    <div class="col s12 m6">
                        <div class="card blue-grey darken-1 center">
                            <div class="card-content white-text">
                                <span class="card-title">
                                    <?php echo $row[0] ?>
                                </span>
                                <p>
                                    <?php echo $row[1]?>
                                </p>
                                <p><?php echo $row[2]?>
                                </p>
                                <p><?php echo $row[3]?>
                                </p>
                                <div class="row">
                                    <a href="#reopenModal"
                                        class="waves-effect waves-light btn reopen-btn modal-trigger">Re-open
                                        Project</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="reopenModal" class="modal modal-fixed-footer">
                        <div class="modal-content">
                            <h4>Re-open Project?</h4>
                            <p>Are you sure you want to re-open this project?</p>
                        </div>
                        <div class="modal-footer">
                            <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">No</a>
                            <form action="../server.php" method="POST">
                                <input type="hidden" name="project_name" value='<?php echo $row[0] ?>'>
                                <button type="submit" name="reopen_project"
                                    class=" modal-action modal-close waves-effect waves-green btn-flat">Yes</button>
                            </form>
                        </div>
                    </div>
                    <?php 
                        }
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.2/js/materialize.js">
    </script>
    <script>
        $(document).ready(function () {
            $('.modal-trigger').leanModal();
        });

        $(document).ready(function () {
            $('.button-collapse').sideNav({
                menuWidth: 300,
                edge: 'left',
                closeOnClick: false,
                draggable: true
            });
            $('.button-collapse').sideNav('show');
        });
    </script>
</body>

</html>
