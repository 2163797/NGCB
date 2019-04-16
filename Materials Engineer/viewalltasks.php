<?php
    include "../db_connection.php";
    session_start();

    if(!isset($_SESSION['loggedin'])) {
      header('Location: http://127.0.0.1/NGCB/index.php');
    }
$mat_name = $_GET['mat_name'];

?>

<!DOCTYPE html>

<html>

<head>
    <title>NGCBDC</title>
    <link rel="icon" type="image/png" href="../Images/NGCB_logo.png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.2/css/materialize.css" rel="stylesheet">
    <link rel="stylesheet" text="type/css" href="../style.css">
</head>

<body>
    <nav>
        <div class="nav-wrapper">
            <button href="dashboard.php" name="" class="button-collapse show-on-large menu-icon back-btn"><i class="material-icons menuIcon">arrow_back</i></button>
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

                        <a class="dropdown-button" href="#!" data-activates="dropdown" data-beloworigin="true"><i class="material-icons dropdown-button">keyboard_arrow_down</i></a>
                    </li>

                </ul>
                <ul id="dropdown" class="dropdown-content collection">
                    <li><a class="waves-effect waves-blue" href="account.php">Account</a></li>
                    <li><a class="waves-effect waves-blue" href="../logout.php">Logout</a></li>

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
            </ul>
        </div>
    </nav>

    <div id="viewAllTask">
        <table class="striped centered view-tasks">
            <thead class="view-tasks-head">
                <tr class="task-headers">
                    <th>Date</th>
                    <th>Task</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="task-table-container">
                <?php 
                    $sql = "SELECT * FROM todo WHERE todo.todoOf = $account_id ORDER BY todo_date;";
                    $result = mysqli_query($conn, $sql);
                    while($row = mysqli_fetch_array($result)) {
                ?>
                <tr>
                    <td class="task-data-table1">
                        <?php echo $row[1] ;?>
                    </td>
                    <td class="task-data-table2">
                        <?php echo $row[2] ;?>
                    </td>
                    <td class="task-data-table">
                        <?php echo $row[3] ;?>
                    </td>
                    <td class="task-data-table">
                        <form action="../server.php" method="POST">
                            <?php
                                if(strcasecmp($row[3], 'in progress') == 0) {
                            ?>
                            <input type="hidden" name="todo_id" value="<?php echo $row[0] ;?>">
                            <input type="hidden" name="todo_status" value="<?php echo $row[3] ;?>">
                            <button class="waves-effect waves-light btn modal-trigger doneBtn"
                                href="#doneBtn<?php echo $row[0] ;?>">Done</button>
                            <div id="doneBtn<?php echo $row[0] ;?>" class="modal modal-fixed-footer">
                                <div class="modal-content">
                                    <span>Are you sure want to click done?</span>
                                </div>
                                <div class="modal-footer">
                                    <a class="modal-close waves-effect waves-red btn-flat no-btn">No</a>
                                    <button type="submit" name="todo_update"
                                        class="modal-close waves-effect waves-red btn-flat yes-btn">Yes</button>
                                </div>
                            </div>
                            <?php
                                } else {
                            ?>
                            <input type="hidden" name="todo_id" value="<?php echo $row[0] ;?>">
                            <input type="hidden" name="todo_status" value="<?php echo $row[3] ;?>">
                            <button class="waves-effect waves-light btn modal-trigger" href="#clearBtn<?php echo $row[0] ;?>"">Clear</button>
                            <div id="clearBtn<?php echo $row[0] ;?>" class="modal">
                                <div class="modal-content">
                                    <span>Are you sure want to clear this task</span>
                                </div>
                                <div class="modal-footer">
                                    <a class="modal-close waves-effect waves-red btn-flat">No</a>
                                    <button type="submit" name="todo_update"
                                        class="modal-close waves-effect waves-red btn-flat">Yes</button>
                                </div>
                            </div>
                            <?php
                                }
                            ?>
                        </form>
                    </td>
                </tr>
                <?php    
                    }
                ?>
            </tbody>
        </table>
    </div>

    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.2/js/materialize.js">
    </script>
    <script>
    
    </script>

</body>

</html>
