<?php
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
                <li class="nav-item">
                    <a class="nav-link text" href="goodday-index.php">Top</a>
                </li>
                <li class="nav-item">
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

<?php
    if (!$loggedin) die();

if (isset($_GET['view'])) $view = sanitizeString($_GET['view']);
else $view = $user;

if ($view == $user)
{
    $name1 = $name2 = "Your";
    $name3 = "You are";
}
else
{
    $name1 = "<a href='members.php?view=$view'>$view</a>'s";
    $name2 = "$view's";
    $name3 = "$view is";
}

echo "<div class='main'>";

$followers = array();
$following = array();

$result = queryMysql("SELECT * FROM friends WHERE user='$view'");
$num = $result->num_rows;

for($j=0;$j<$num;++$j)
{
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $followers[$j] = $row['friend'];
}

$result = queryMysql("SELECT * FROM friends WHERE friend='$view'");
$num = $result->num_rows;

for($j=0;$j<$num;++$j)
{
    $row = $result->fetch_array(MYSQLI_ASSOC);
    $following[$j] = $row['user'];
}

$mutual = array_intersect($followers,$following);
$followers = array_diff($followers,$mutual);
$following = array_diff($following,$mutual);
$friends = FALSE;

if (sizeof($mutual))
{
    echo "<span class='subhead'>$name2 mutual friends</span><ul>";
    foreach ($mutual as $friend)
        echo "<li><a href='members.php?view=$friend'>$friend</a>";
    echo "</ul>";
    $friends = TRUE;
}

if (sizeof($followers))
{
    echo "<span class='subhead'>$name2 followers</span><ul>";
    foreach ($followers as $friend)
        echo "<li><a href='members.php?view=$friend'>$friend</a>";
    echo "</ul>";
    $friends = TRUE;
}

if (sizeof($following))
{
    echo "<span class='subhead'>$name3 following</span><ul>";
    foreach ($following as $friend)
        echo "<li><a href='members.php?view=$friend'>$friend</a>";
    echo "</ul>";
    $friends = TRUE;
}

if (!$friends) echo "<br>You don't have any friends yet.<br><br>";
echo "<a class='button' href='messages.php?view=$view'>" . "View $name2 messages</a>";
?>

        </div><br>
    </body>
</html>