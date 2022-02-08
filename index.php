
<head>
<?php
include_once ('bootstrap.php');
?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <link rel="stylesheet" href="CSS/loginForm.css" type="text/css">
</head>
<h1>Dobrodosao na ucenje Ajaxa</h1>

<div class="wrapper fadeInDown">
    <div id="formContent">
        <!-- Tabs Titles -->
<h3>Da bi se dopisivao moras se ulogovati</h3>
        <!-- Login Form -->
        <form method="post" >
            <input type="email" id="username" class="fadeIn second" name="username" placeholder="username">
            <input type="password" id="password" class="fadeIn third" name="login" placeholder="password">
            <input type="button" class="fadeIn fourth" id="butlogin" value="Log In">
        </form>

        <!-- Answer about wrong password or username -->
        <div class="alert alert-danger" id="success" style="display:none;"></div>

        <!-- Remind Passowrd -->
        <div id="formFooter">
            <a class="underlineHover" href="#">Forgot Password?</a>
            <br>
            <a class="underlineHover" href="register.php">Register</a>

        </div>

    </div>
</div>

<script>
    $(document).ready(function(){
        $("#butlogin").on("click", function() {
            var username = $('#username').val();
            var password = $('#password').val();

            if (username!= "" && password!=""){
                $.ajax({
                    url: "login.php",
                    type: "POST",
                    data:{
                        username:username,
                        password:password,
                    },
                    cache: false,
                    success: function (data) {
                        var data = JSON.parse(data);

                        if(data.statusCode==200) {
                            window.location.assign('welcome.php')
                        } if(data.statusCode==201){
                            $("#success").show();
                            $('#success').html('Wrong password or username !');
                        }

                        if(data.statusCode==202){
                            $("#success").show();
                            $('#success').html('ne postoje podaci !');
                        }

                    }
                });

            }
        });
    });
</script>