<?php
    include "../db_connection.php";
    session_start();

    if(!isset($_SESSION['loggedin'])) {
      header('Location: http://127.0.0.1/NGCB/index.php');
    }

    $projects_name = false;
    if(isset($_GET['projects_name'])) {
        $projects_name = $_GET['projects_name'];
    }
    $sql = "SELECT projects_status FROM projects WHERE projects_name = '$projects_name'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_row($result);
    $projects_status = $row[0];

    $output = '';
    if(isset ($_POST['search'])) {
        $searchq = $_POST['search'];
        $searchq = preg_replace("#[^0-9a-z]#i","",$searchq);
        $projects_name = $_GET['projects_name'];
        $sql = "SELECT
                            materials.mat_name, 
                            materials.mat_prevStock, 
                            materials.delivered_material, 
                            materials.pulled_out, 
                            materials.accumulated_materials,
                            materials.currentQuantity
                            FROM materials 
                            INNER JOIN projects ON materials.mat_project = projects.projects_id 
                            INNER JOIN categories ON materials.mat_categ = categories.categories_id
                            WHERE mat_name LIKE '%$searchq%' AND projects.projects_name = $projects_name";
                            $query = mysqli_query($conn, $sql);
                            $count = mysqli_num_rows($query);
                            if($count == 0) {
                                $output = 'There is no results.';
                            } else {
                                while ($row = mysqli_fetch_array($query)) {
                                    $matname = $row['mat_name'];
                                    $matprevstock = $row['mat_prevStock'];
                                    $matdelivered = $row['delivered_material'];
                                    $matpulledout = $row['pulled_out'];
                                    $mataccumulated = $row['accumulated_materials'];
                                    $matcurrentqty = $row['currentQuantity'];

                                    $output .= "<div>
                                    <td>".$matname."</td>
                                    <td>".$matprevstock."</td>
                                    <td>".$matdelivered."</td>
                                    <td>".$matpulledout."</td>
                                    <td>".$mataccumulated."</td>
                                    <td>".$matcurrentqty."</td>
                                    </div>";
                                }
                            }
    }
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

                <li>
                    <i class="material-icons left">dashboard</i><a class="waves-effect waves-blue"
                        href="projects.php">Projects</a>
                </li>

                <li>
                    <i class="material-icons left">receipt</i><a class="waves-effect waves-blue"
                        href="hauleditems.php">Hauled Materials</a>
                </li>

                <li>
                    <i class="material-icons left">receipt</i><a class="waves-effect waves-blue"
                        href="sitematerials.php">Site Materials</a>
                </li>
            </ul>
        </div>
    </nav>
        
    <div class="row">
        <h5 class="project-name-inventory">
            <?php echo $projects_name; ?>
        </h5>
        <div class="col view-inventory-slider">
        
            <ul class="tabs tabs-inventory">
                <li class="tab col s3"><a href="#sitematerials">Project Materials</a></li>
                <li class="tab col s3"><a href="#categories">Categories</a></li>
            </ul>
        </div>
    </div>

    <!--SITE MATERIALS-->
    <div id="sitematerials" class="col s12">
    <?php 
            if(strcmp($projects_status, "open") == 0) {
        ?>
        <div class="row">
            <div class="col ">
            <form action = "../server.php" method = "POST">
                    <input class="input search-bar" type="search" placeholder="Search...">
                    <input class="submit search-btn" type="submit" name = "search" value="SEARCH">
                    <?php
                     print("$output");
                ?>
                </form>
            </div>
            <div class="col">

            </div>
        </div>

        <?php 
            }
        ?>
         <div class="view-inventory-container">
            <table id = "sort" class="centered view-inventory">
                <thead class="view-inventory-head">
                        <tr>
                            <th onclick="sortTable(0)">Particulars</th>
                            <th onclick="sortTable(1)">Previous Material Stock</th>
                            <th onclick="sortTable(2)">Delivered Material as of
                                <?php echo date("F Y"); ?>
                            </th>
                            <th onclick="sortTable(3)">Material Pulled out as of
                                <?php echo date("F Y"); ?>
                            </th>
                            <th onclick="sortTable(4)">Accumulate of Materials Delivered</th>
                            <th onclick="sortTable(5)">Material on Site as of
                                <?php echo date("F Y"); ?>
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                    <?php 
                                // $projects_name = $_GET['projects_name'];
                                $sql_categ = "SELECT DISTINCT categories.categories_name FROM materials 
                            INNER JOIN categories ON materials.mat_categ = categories.categories_id
                            INNER JOIN projects ON materials.mat_project = projects.projects_id
                            WHERE projects.projects_name = '$projects_name'
                            ORDER BY categories.categories_name;";
                            $result = mysqli_query($conn, $sql_categ);
                            $categories = array();
                            while($row_categ = mysqli_fetch_assoc($result)){
                                $categories[] = $row_categ;
                            }

                            foreach($categories as $data) {
                            $categ = $data['categories_name'];
                        ?>
                        <!-- <tr>
                            <td colspan="10" class="td-category"> <b>
                                    <?php echo $categ; ?></b></td>
                        </tr> -->
                        <?php 
                            $sql = "SELECT
                            materials.mat_name, 
                            materials.mat_prevStock, 
                            materials.delivered_material, 
                            materials.pulled_out, 
                            materials.accumulated_materials,
                            materials.currentQuantity
                            FROM materials 
                            INNER JOIN projects ON materials.mat_project = projects.projects_id 
                            INNER JOIN categories ON materials.mat_categ = categories.categories_id
                            WHERE categories.categories_name = '$categ';";
                            $result = mysqli_query($conn, $sql);
                            while($row = mysqli_fetch_row($result)){
                        ?>

                        <tr>
                        <td>
                        <form action="../server.php" method="POST">
                                <input type="hidden" name="mat_name" value="<?php echo $row[0]?>">
                                <button class="waves-effect waves-light btn matname-btn" type="submit" name="open_stockcard">
                                    <?php echo $row[0] ?></button>
                            </form>
                        </td>

                            <td>
                                <?php echo $row[1] ?>
                            </td>
                            <td>
                                <?php echo $row[2] ?>
                            </td>
                            <td>
                                <?php echo $row[3] ?>
                            </td>
                            <td>
                                <?php echo $row[4] ?>
                            </td>
                            <td>
                                <?php echo $row[5] ?>
                            </td>
                            <?php 
                            }
                        ?>
                        </tr>
                        <?php    
                            }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!--MODAL-->
    <div id="modal1" class="modal modal-fixed-footer">
            <form action="../server.php" method="POST">
                <div class="modal- ">
                    <div class="content">
                        <div class="row">

                            <div class="col s12">
                                <h4>DELIVER IN</h4>
                                <table class="centered">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Quantity</th>
                                            <th>Unit</th>
                                            <th>Supplied By</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="date" name="dev_date"></td>
                                            <td><input type="text" name="dev_quantity"></td>
                                            <td><input type="text" name="unit"></td>
                                            <td><input type="text" name="dev_supp"></td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="col s12">
                                <h4>USAGE IN</h4>
                                <table class="centered">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Quantity</th>
                                            <th>Unit</th>
                                            <th>Pulled Out By</th>
                                            <th>Area of Usage</th>

                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="#!" class="modal-close waves-effect waves-green btn-flat">CANCEL</a>
                </div>
            </form>
        </div>

    <!--SITE CATEGORIES-->
    <div id="categories" class="col s12">
        <div class="row">
            <?php
        $sql = "SELECT categories.categories_id, categories.categories_name FROM  categories 
        INNER JOIN projects ON categories.categories_project = projects.projects_id 
        WHERE projects.projects_name = '$projects_name'
        ORDER BY categories.categories_name;";
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_array($result)) {
    ?>
            <div class="col s3 m3 category-container">
                <div class="card center">
                    <div class="card-content category-cards">
                        <span class="card-title category-title">
                            <?php echo $row[1] ;?>
                        </span>
                        <div class="row">
                            <form action="../server.php" method="POST">
                                <input type="hidden" name="categories_id" value="<?php echo $row[0]?>">
                                <input type="hidden" name="account_type" value="<?php echo $_SESSION['account_type']; ?>">
                                <button class="waves-effect waves-light btn view-inventory-btn" type="submit"
                                    name="view_category">View Inventory</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }
    ?>
        </div>
    </div>


    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.2/js/materialize.js">
    </script>
    <script>
        // SIDEBAR
        $(document).ready(function () {
            $('.button-collapse').sideNav({
                closeOnClick: false, // Closes side-nav on <a> clicks, useful for Angular/Meteor
            });
            $('.collapsible').collapsible();
            $('.modal-trigger').leanModal();
        });
        
            $(".add-row").click(function () {
                var quantity = $("#name").val();
                var unit = $("#email").val();
                var articles = $('#articles').val();
                var markup = "<tr>" +
                    "<td><input type=\"text\" name=\"category_name[]\"></td>" +
                    "</tr>;"
                $("table tbody").append(markup);
            });
        });
  function sortTable(n) {
  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("sort");
  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc"; 
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {
    //start by saying: no switching is done:
    switching = false;
    rows = table.rows;
    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 1; i < (rows.length - 1); i++) {
      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("TD")[n];
      y = rows[i + 1].getElementsByTagName("TD")[n];
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch = true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++;      
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
    </script>

</body>

</html>