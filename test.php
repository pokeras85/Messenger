<?php
include_once ('Configuratiomn/database.php');
include('bootstrap.php');

$database=new Database();
?>
<head>
<title>Testiranje</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</head>
<body class="container" style="margin-top: 25px">
<form id="fupForm" name="form1" method="post">
<label for="user">Username:</label>
<input type="text" id="user" class="erase" name="username">
<br>
<br>
<label for="email">Email:</label>
<input type="email" id="email" name="email" class="erase">
<br>
<br>
<label for="password">Password:</label>
<input type="password" id="password" name="password" class="erase">
<br>
<br>
<input type="button" id="butsave" value="SUBMIT">
</form>

<div id="respond"></div>

<script>
    $(document).ready(function(){
        $("#butsave").on("click", function() {
            var username = $('#user').val();
            var email = $('#email').val();
            var password = $('#password').val();

            if (username!= ""){
                $.ajax({
                    url: "test2.php",
                    type: "POST",
                    data:{
                        username:username,
                        email:email,
                        password:password,
                    },
                    cache: false,
                    success: function (data) {
                        $('#fupForm').find('.erase').val('');
                        $('#respond').html(data);
                    }
                });

        }
        });
    });
</script>



</body>
