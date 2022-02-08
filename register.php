<?php include ('bootstrap.php')?>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
<div class="container" style="width: 40%; margin-top: 20px">
        <h2 class="form-signin-heading">Please Register</h2>
    <form id="fupForm" name="form1" method="post">
        <br>
        <input type="text" name="username" id="inputUsername" class="form-control" placeholder="Username" required autofocus>
        <br>
        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required >
        <br>
        <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <br>
        <button name="sub" class="btn btn-lg btn-primary btn-block" id="butsave" type="submit">Submit</button>
    </form>

    <!--odgovor koji dobijem putem ajaxa-->
    <div class="alert alert-success alert-dismissible" id="success" style="display:none;">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    </div>
</div>

<br>
<br>

<a href="index.php" class="container" > <button class="btn btn-outline-success my-2 my-sm-0">BACK TO LOGIN</button></a>
<br>

<script>
    $(document).ready(function() {
        $('#butsave').on('click', function() {
            $("#butsave").attr("disabled", "disabled");
            var username = $('#inputUsername').val();
            var email = $('#inputEmail').val();
            var password = $('#inputPassword').val();
            if(username!="" && email!="" && password!=""){
                $.ajax({
                    url: "InsertUser.php",
                    type: "POST",
                    data: {
                        username: username,
                        email: email,
                        password: password,
                    },
                    cache: false,
                    success: function(dataResult){
                        var dataResult = JSON.parse(dataResult);
                        if(dataResult.statusCode==200){
                            $("#butsave").removeAttr("disabled");
                            $('#fupForm').find('input').val('');
                            $("#success").show();
                            $('#success').html('Data added successfully !');
                        }
                        if(dataResult.statusCode==201){
                            alert("Error occured !");
                        }

                        if(dataResult.statusCode==202){
                            alert("Username already exist,please choice another username!");
                        }

                    }
                });
            }
            else{
                alert('Please fill all the field !');
            }
        });
    });
</script>
</body>

