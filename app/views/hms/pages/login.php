<?php
require_once APPROOT . "/views/hms/includes/header.php";
?>

<!-- LOGO, TEXT AND FORM -->
<div class="login">
    <div class="container login-wrapper">
        <!-- LOGO AND TEXT -->
        <div class="info">
            <div class="logo">
                <h1 class="logo-icon"><i class="fas fa-h-square"></i></h1>
                <div class="logo-name-star">
                    <h1 class="stars"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></h1>
                    <h1>Juno Hotel</h1>
                </div>
            </div>
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eaque, in doloremque doloribus voluptate consequuntur dicta minus maiores optio maxime alias id.</p>
        </div>

        <!-- FORM -->
        <div class="form">
            <h2>Login</h2>
            <form action="<?php echo URLROOT; ?>/hms/login" method="POST" class="login_form" name="loginForm" onsubmit="return loginValidate()">
                <input type="text" name="username" placeholder="Username *">
                <span>
                    <p><?php echo $data['usernameError']; ?></p>
                </span>
                <input type="password" name="password" placeholder="Password *">
                <span>
                    <p><?php echo $data['passwordError']; ?></p>
                </span>
                <select name="role">
                    <option value="null">-- Role --</option>
                    <option value="admin">Admin</option>
                    <option value="manager">Manager</option>
                    <option value="basic">Basic</option>
                </select>
                <input type="submit" name="login" value="Login">
            </form>
        </div>
    </div>
</div>
<!-- END OF LOGO, TEXT AND FORM -->


<!-- SMALL DESCRIPTION -->
<div class="desc">
    <div class="container">
        <h3>Welcome to Juno Hotel Management System. Manage the hotel activities, bookings, events and much more.</h3>
        <div class="boxes">
            <div class="box">
                <i class="fas fa-mobile-alt"></i>
                <h4>Mobile</h4>
                <h5><span class="danger">!</span> Not Mobile Friendly. Please use the HMS only on a PC or laptop. Nothing less than 1000PX width.</h5>
            </div>
            <div class="box">
                <i class="fas fa-sign-in-alt"></i>
                <h4>Sign In</h4>
                <h5>Sign In using your username, password and assigned role.</h5>
            </div>
            <div class="box">
                <i class="fas fa-user-alt-slash"></i>
                <h4>Account</h4>
                <h5>Don't have an account? Please contact your manager or supervisor.</h5>
            </div>
        </div>
    </div>
</div>
<!-- END OF SMALL DESCRIPTION -->


<!-- COPYRIGHT TEXT-->
<p class="footer">&copy; <?php echo date('Y'); ?> Juno Hotel. All rights reserved.</p>


<script>
    // Login Form Validation
    function loginValidate() {
        // The form variables
        let userName = document.forms["loginForm"]["username"].value;
        let userPass = document.forms["loginForm"]["password"].value;
        let userRole = document.forms["loginForm"]["role"].value;

        // Validation
        if (userName == "") {
            alert("The username is empty.");
            return false;
        } else if (userPass == "") {
            alert("The password is empty.");
            return false;
        } else if (userRole == "null") {
            alert("Please select the correct role.");
            return false;
        }
    }


    // Stop the form re-submiting on page refresh
    if (window.history.replaceState) {
        window.history.replaceState(null, null, window.location.href);
    }
</script>

<!-- FOOTER -->
<?php
require_once APPROOT . "/views/hms/includes/footer.php";
?>