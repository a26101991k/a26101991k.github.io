<?php
date_default_timezone_set ("Asia/Tokyo");
$userstr = ' (Guest)';
if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $loggedin = TRUE;
    $userstr = " ($user)";
}
else $loggedin = FALSE;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Good day</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function(){
            $(".tab-link").click(function(){
                $(this).tab('show');
            });
        });
    </script>
    <style>
        body {
            background-color: #cccccc;
        }
        .img {
            border-bottom: 1px solid white;
        }
        #titleimg {
            height: 100px;
        }
        #egd, #mgd {
            padding-top: 40%;
            position: relative;
        }
        #egd-content, #mgd-content {
            position: absolute;
            top: 0;
            left: 0;
            bottom: 0;
            right: 0;
            text-align: justify;
            padding: 10px;
        }
        .leftnav {
            border-bottom: 1px solid white;
        }
        .nav-link:hover {
            color: #ccffff;
        }
        #egd-button {
            border-bottom-color: #ccffff;
        }
        #mgd-button {
            border-bottom-color: #ffcccc;
        }
        #egd, #egd-button {
            background-color: #ccffff;
            color: #cccccc;
        }
        #mgd, #mgd-button {
            background-color: #ffcccc;
        }
        footer {
            border-top:1px solid white;
            color: white;
            padding: 1px;
            text-align: center;
        }
        .text, #mgd-button, #mgd-content {
            color: white;
        }
    </style>
</head>
<body>
<div class="container-fluid img">
    <img class="img-fluid mx-auto d-block" id="titleimg" src="heading1.png" alt="title">
</div>
<div class="row container-fluid">

    <div class="col-xl-2">
        <nav class="navbar bg-grey">
            <ul class="navbar-nav">
                <li class="nav-item leftnav">
                    <a class="nav-link text" href="goodday-index.php">Top</a>
                </li>
                <li class="nav-item leftnav">
                    <?php
                    if ($loggedin) {
                        echo '<a class="nav-link text" href="goodday-mypage.php">My GOOD DAYs' . $userstr . '</a>';
                    }
                    else {
                        echo '<a class="nav-link text" href="goodday-login.php">My GOOD DAYs' . $userstr . '</a>';
                    }
                    ?>
                </li>
            </ul>
        </nav>
    </div>

    <div class="col-xl-10">
        <ul class="nav nav-tabs nav-justified">
            <li class="nav-item">
                <a class="nav-link active tab-link" id="egd-button" href="#egd">Everybody's GOOD DAY</a>
            </li>
            <li class="nav-item">
                <a class="nav-link tab-link" id="mgd-button" href="#mgd">My GOOD DAY</a>
            </li>
        </ul>

        <div class="tab-content">
            <div class="container tab-pane active" id="egd">
                <div id="egd-content">
                <?php
                $month = date("m");
                switch ($month) {
                    case "01":
                        require_once 'goodday-january.php';
                        break;
                    case "02":
                        require_once 'goodday-february.php';
                        break;
                    case "03":
                        require_once 'goodday-march.php';
                        break;
                    case "04":
                        require_once 'goodday-april.php';
                        break;
                    case "05":
                        require_once 'goodday-may.php';
                        break;
                    case "06":
                        require_once 'goodday-june.php';
                        break;
                    case "07":
                        require_once 'goodday-july.php';
                        break;
                    case "08":
                        require_once 'goodday-august.php';
                        break;
                    case "09":
                        require_once 'goodday-september.php';
                        break;
                    case "10":
                        require_once 'goodday-october.php';
                        break;
                    case "11":
                        require_once 'goodday-november.php';
                        break;
                    case "12":
                        require_once 'goodday-december.php';
                        break;
                    default:
                        echo "Month check error!";
                        break;
                }
                ?>
                </div>
            </div>
            <div class="container tab-pane fade" id="mgd">
                <div id="mgd-content">Under construction</div>
            </div>
        </div>
    </div>
</div>

<footer>
    <p class="text">Developed by Kuznetsov Andrey</p>
</footer>
</body>
</html>