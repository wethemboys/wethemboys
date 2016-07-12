<?php
session_name("evypms");
session_start();

if (isset($_SESSION["login"])) {
    header("Location: index.html");
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["username"]) && isset($_POST["password"])) {
        $mysqli = new mysqli("localhost", "root", "", "evypms");
        $username = $mysqli->real_escape_string($_POST["username"]);
        $password = $mysqli->real_escape_string(hash("ripemd160", $_POST["password"]));
        $query = "SELECT * FROM users WHERE Username='".$username."' AND Password='".$password."'";
        $qq = $mysqli->query($query);
        if ($qq->num_rows > 0) {
            $_SESSION["login"] = true;
            $_SESSION["theuser"] = $qq->fetch_assoc();
            header("Location: index.php");
            die();
        } else {
            $loginerror = true;
        }
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>HeartBase</title>
    <link href="bootstrap-3.3.6-dist/css/bootstrap.min.css" type="text/css" rel="stylesheet" />
    <link href="css/login.css" type="text/css" rel="stylesheet" />
    <script src="js/jquery.min.js"></script>
    <script src="bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="card card-container">
            <!-- <img class="profile-img-card" src="//lh3.googleusercontent.com/-6V8xOA6M7BA/AAAAAAAAAAI/AAAAAAAAAAA/rzlHcD0KYwo/photo.jpg?sz=120" alt="" /> -->
            <h3 style="text-align:center;color:green">EVYPMS</h3>
            <p id="profile-name" class="profile-name-card"></p>
            <div id="sin_error" class="alert alert-danger" style="border-radius:0px;display:none;"></div>
            <form id="theForm" class="form-signin" method="POST" onsubmit="return validateForm(this)">
                <span id="reauth-email" class="reauth-email"></span>
                <input id="username" type="text" name="username" class="form-control" placeholder="Username">
                <input id="password" type="password" name="password" class="form-control" placeholder="Password">
                <button id="signin" class="btn btn-lg btn-success btn-block btn-signin">Sign in</button>
            </form><!-- /form -->
        </div><!-- /card-container -->
    </div><!-- /container -->

<script>
<?php
    if (isset($loginerror) && $loginerror) {
        echo '$("#sin_error").html("<b>Error:</b> The Username or Password you enter is incorrect.").css("display", "block");';
    }
?>
function validateForm(theForm) {
    for (i = 0; i < (theForm.length - 1); i++) {
        if (theForm[i].value.length <= 0) {
            $("#sin_error").html("<b>Error:</b> Please enter your username and password.").css("display", "block");
            return false;
        }
    }
    return true;
}
</script>
</body>