<?php
	require_once('auth.php');
?>
<html>
<head>
<link href="css/style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="febe/style.css" type="text/css" media="screen" charset="utf-8">
<link rel="icon" type="image/png" href="../admin/img/logo.png" />
<title>Admin-Dashboard</title>
<script src="argiepolicarpio.js" type="text/javascript" charset="utf-8"></script>
<script src="js/application.js" type="text/javascript" charset="utf-8"></script>	
<!--sa poip up-->
<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="lib/jquery.js" type="text/javascript"></script>
<script src="src/facebox.js" type="text/javascript"></script>
<script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox({
        loadingImage : 'src/loading.gif',
        closeImage   : 'src/closelabel.png'
      })
    })
</script>
<style>
    /* Add custom CSS here */
    body {
        background: url('../admin/img/background-image.jpg') no-repeat center center fixed;
        background-size: cover;
    }
    
    
    
    #adminbar {
        position: relative;
    }
    
    #logo-right {
        position: left;
        top: 10px;
        left: 8px;
        width: 8%;
        length:2%;
    }

    #panel {
        font-weight: bold; /* Makes the font bold */
        
        
        padding: 30px;
        border-radius: 40px;
    }
    
    #main-menu li a {
        font-weight: bold;
        color: green; /* Change text color */
    }
    
    #main-menu li a:hover {
        color: green; /* Change color on hover */
    }
    
    #resultTable {
        width: 100%;
        border-collapse: collapse;
    }
    
    #resultTable th, #resultTable td {
        border: 1px solid #fff;
        padding: 8px;
    }
    
    #resultTable th {
        background-color: #f4f4f4;
    }
    
    #footer {
        background-color: #333;
        color: #000000;
        text-align: left;
        padding: 100px;
    }
</style>
</head>
<body>
	<div id="container">
        <div id="adminbar-outer" class="radius-bottom">
            <div id="adminbar" class="radius-bottom">
                <a id="logos" href="dashboard.php"></a>
                <img id="logo-right" src="../admin/img/logo.png" alt="Logo">
                <div id="details">
                    
                    <div class="tcenter">
                   
                    <strong>Admin</strong><br>
                    
                  
                    <a class="alightred" href="../index.php">Logout</a>
                    </div>
                </div>
            </div>
        </div>
        <div id="panel-outer" class="radius" style="opacity: 1;">
            <div id="panel" class="radius">
                <ul class="radius-top clearfix" id="main-menu">
                    <li>
                        <a class="active" href="dashboard.php">
                            <img alt="Dashboard" src="../admin/img/admin-panel.png">
                            <span>Dashboard</span>
                        </a>
                    </li>
                    
                    <li>
                        <a href="route.php">
                            <img alt="Statistics" src="../admin/img/bus.png">
                            <span>Bus</span>
                        </a>
                    </li>
                    <li>
                        <a href="setinventory.php">
                            <img alt="Statistics" src="../admin/img/seat.jpg">
                            <span>Seat Inventory</span>
                        </a>
                    </li>
                    <div class="clearfix"></div>
                </ul>
                <div id="content" class="clearfix">
                    <label for="filter">Filter</label> <input type="text" name="filter" value="" id="filter" />
                    <table cellpadding="1" cellspacing="1" id="resultTable">
                        <thead>
                            <tr>
                                <th> Firstname </th>
                                <th> Lastname </th>
                                <th> Address </th>
                                <th> Contact </th>
                                <th> Route </th>
                                <th> Bus Type </th>
                                <th> Time </th>
                                <th> Seat Number </th>
                                <th> Payable </th>
                                <th> Status </th>
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            include('../db.php');
                            $result = mysqli_query($conn,"SELECT * FROM customer");
                            while($row = mysqli_fetch_array($result))
                                {
                                    echo '<tr class="record">';
                                    echo '<td style="border-left: 1px solid #C1DAD7;">'.$row['fname'].'</td>';
                                    echo '<td><div align="right">'.$row['lname'].'</div></td>';
                                    echo '<td><div align="right">'.$row['address'].'</div></td>';
                                    echo '<td><div align="right">'.$row['contact'].'</div></td>';
                                    $rrad=$row['bus'];
                                    $dddd=$row['transactionum'];
                                    $results = mysqli_query($conn,"SELECT * FROM route WHERE id='$rrad'");
                                    while($rows = mysqli_fetch_array($results))
                                        {
                                    echo '<td><div align="right">'.$rows['route'].'</div></td>';
                                    echo '<td><div align="right">'.$rows['type'].'</div></td>';
                                    echo '<td><div align="right">'.$rows['time'].'</div></td>';
                                        }
                                    $resulta = mysqli_query($conn,"SELECT * FROM reserve WHERE transactionnum='$dddd'");
                                    while($rowa = mysqli_fetch_array($resulta))
                                        {
                                    echo '<td><div align="right">'.$rowa['seat'].'</div></td>';
                                        }
                                    
                                    echo '<td><div align="right">'.$row['payable'].'</div></td>';
                                    echo '<td><div align="right">'.$row['status'].'</div></td>';
                                    echo '<td><div align="center"><a rel="facebox" href="editstatus.php?id='.$row['id'].'">edit</a> | <a href="#" id="'.$row['transactionum'].'" class="delbutton" title="Click To Delete">delete</a></div></td>';
                                    echo '</tr>';
                                }
                            ?> 
                        </tbody>
                    </table>
                </div>
                <div id="footer" class="radius-bottom">
                <a class="afooter-link" href="#"> 2024-25 &copy;</a>
                    <a class="afooter-link" href="">Selam Bus Reservation System by CS Weekend Students</a>
                
                   
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="clearfix"></div>
    </div>
    <script src="js/jquery.js"></script>
    <script type="text/javascript">
        $(function() {
            $(".delbutton").click(function(){
                var element = $(this);
                var del_id = element.attr("id");
                var info = 'id=' + del_id;
                if(confirm("Sure you want to delete this update? There is NO undo!"))
                {
                    $.ajax({
                        type: "GET",
                        url: "deleteres.php",
                        data: info,
                        success: function(){
                            // success callback
                        }
                    });
                    $(this).parents(".record").animate({ backgroundColor: "#fbc7c7" }, "fast")
                        .animate({ opacity: "hide" }, "slow");
                }
                return false;
            });
        });
    </script>
</body>
</html>