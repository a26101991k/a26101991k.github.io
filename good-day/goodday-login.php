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
$error = $user = $pass = "";

if (isset($_POST['user']))
{
    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);

    if ($user == "" || $pass == "")
    {
        $error = "Not all fields were entered<br>";
    }
    else
    {
        $result = queryMySQL("SELECT user,pass FROM members WHERE user='$user' AND pass='$pass'");
        if ($result->num_rows == 0)
        {
            $error = "<span class='error'>Username/Password invalid</span><br><br>";
        }
        else
        {
            $_SESSION['user'] = $user;
            $_SESSION['pass'] = $pass;
            echo "<script>window.location = 'goodday-mypage.php'</script>";
            die ("You are now logged in. Please wait");
        }
    }
}
?>
    <div class="col-xl-10">
        <form method='post' action='goodday-login.php'><?php$error?>
            <span class='fieldname'>Username</span><input type='text' maxlength='16' name='user' value='$user' /><br>
            <span class='fieldname'>Password</span><input type='password' maxlength='16' name='pass' value='$pass'><br>
            <span class='fieldname'>&nbsp;</span>
            <input type='submit' value='Login'>
        </form>
        <a class="text nav-link" href="goodday-signup.php">Sign Up</a>
    </div>
</div>

<footer>
    <p class="text">Developed by Kuznetsov Andrey</p>
</footer>
</body>
</html>
