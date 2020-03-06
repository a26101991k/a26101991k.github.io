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

    <script>
        function checkUser(user) {
            if (user.value == '') {
                O('info').innerHTML = ''
                return
            }

            params = "user=" + user.value
            request = new ajaxRequest()
            request.open("POST","checkuser.php",true)
            request.setRequestHeader("Content-type","application/x-www-form-urlencoded")
            request.setRequestHeader("Content-length",params.length)
            request.setRequestHeader("Connection","close")

            request.onreadystatechange = function() {
                if (this.readyState == 4)
                    if (this.status == 200)
                        if (this.responseText != null)
                            O('info').innerHTML = this.responseText
            }
            request.send(params)
        }

        function ajaxRequest() {
            try {var request = new XMLHttpRequest()}
            catch(e1) {
                try {request = new ActiveXObject("Msxml2.XMLHTTP")}
                catch(e2) {
                    try {request = new ActiveXObject("Microsoft.XMLHTTP")}
                    catch(e3) {
                        request = false
                    }
                }
            }
            return request
        }
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


<div class="main"><h3>Please enter your details to sign up</h3>

<?php
$error = $user = $pass = "";
if (isset($_SESSION['user'])) destroySession();

if (isset($_POST['user'])) {
    $user = sanitizeString($_POST['user']);
    $pass = sanitizeString($_POST['pass']);

    if ($user == "" || $pass == "")
        $error = "Данные введены не во все поля<br><br>";
    else {
        $result = queryMysql("SELECT * FROM members WHERE user='$user'");
        if ($result->num_rows)
            $error = "Такое имя уже существует<br><br>";
        else {
            queryMysql("INSERT INTO members VALUES('$user','$pass')");
            die("<h4>Account created</h4>Please Log in.<br><br>");
        }
    }
}
?>

<form method='post' action='signup.php'>$error
<span class="fieldname">Username</span>
<input type="text" maxlength="16" name="user" value="$user" onBlur="checkUser(this)"><span id="info"></span><br>
<span class="fieldname">Password</span>
<input type="text" maxlength="16" name="pass" value="$pass"><br>
<span class="fieldname">&nbsp;</span>
<input type="submit" value="Sign up" />
</form></div><br>
</body>
</html>
