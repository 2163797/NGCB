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
    <nav>
        <div class="nav-wrapper">
            <a href="#" data-activates="mobile-demo" class="button-collapse show-on-large"><i class="material-icons">menu</i></a>
            <h4 id="NGCB">New Golden City Builders</h4>
            <ul class="side-nav blue-grey lighten-2" id="mobile-demo">
                <li class="collection-item avatar">
                    <img src="../Images/pic.jpg" alt="" class="circle">
                    <span class="title">Jam Spica Rocafort</span>
                    <span class="title">Materials Engineer</span>
                    <!--DAPAT NAME NUNG ENGINEER LALABAS HERE-->

                    <!--DAPAT MATERIALS ENGINEER LALABAS DITO, DIKO SURE KUNG AHRD CODED-->

                </li>
                <li>
                    <div class="divider"></div>
                </li>
                <li><a href="dashboard.html">Dashboard</a></li>
                <li>
                    <div class="divider"></div>
                </li>
                <ul class="collapsible">
                    <li>
                        <a class="collapsible-header  waves-effect waves-blue white-text">Site<i class="material-icons right">keyboard_arrow_down</i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a class="waves-effect waves-blue" href="#">Projects</a></li>
                                <li><a class="waves-effect waves-blue" href="#">Site Materials</a></li>
                                <li><a class="waves-effect waves-blue" href="#">Category</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <li>
                    <div class="divider"></div>
                </li>
                <ul class="collapsible">
                    <li>
                        <a class="collapsible-header waves-effect waves-blue white-text">Hauling<i class="material-icons right">keyboard_arrow_down</i></a>
                        <div class="collapsible-body">
                            <ul>
                                <li><a class="waves-effect waves-blue" href="#">Fill out Hauling Form</a></li>
                                <li><a class="waves-effect waves-blue" href="#">View Hauled Materials</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <li>
                    <div class="divider"></div>
                </li>
                <li>Report</li>
                <li>
                    <div class="divider"></div>
                </li>
                <li>Logout</li>
            </ul>
        </div>
    </nav>

    <div class="row">
        <div class="col s12 right-align">
            <a href="#addcategoryModal" class="waves-effect waves-light btn modal-trigger">
                <i class="material-icons left">print</i>Generate Report</a>
        </div>
    </div>
    <div class="container">
    <div class="row">
        <div class="col s12 light-blue lighten-5">
            <table class="centered">
                <thead>
                    <tr>
                        <th>Particulars</th>
                        <th>Previous Material Stock</th>
                        <th>Delivered Material as of CURRENT DATE</th>
                        <th>Material Pulled out as of CURRENT DATE</th>
                        <th>Accumulate of Materials Delivered</th>
                        <th>Material on Site as of CURRENT DATE</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
    </div>
    



    <!--Import jQuery before materialize.js-->
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.2/js/materialize.js"></script>
    <script>
        $(document).ready(function() {
            $('.modal-trigger').leanModal();
        });

        // SIDEBAR
        $(document).ready(function() {
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