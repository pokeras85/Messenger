<?php
require('Configuratiomn/database.php');

$database =new Database();
// insert data in database 'user'

if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['password']) ){
  if(!empty($_POST['username']) && !empty($_POST['email']) && !empty($_POST['password'])){
     $email = $database->sanitize($_POST['email']);

     $r = $database->check_email($email); //check if usr allredy exist
          if ($r !== 1) {
          $username = $database->sanitize($_POST['username']);
          $password = $database->sanitize($_POST['password']);

          $password = $database->mid($password);

         $res = $database->create($username, $email, $password);
                if ($res) {
                   $smsg = "Successfully registration,please back to login ";
                    } else {
                      $fmsg = "failed to insert data";
                               }
          } else {
            $fmsg = "Username already exist,please choice another username!";
                 }
}else($fmsg='you must input all field!');
}
?>
<?php if(isset($smsg)){ ?><div class="alert alert-success" role="alert"> <?php echo $smsg; ?> </div><?php } ?>
<?php if(isset($fmsg)){ ?><div class="alert alert-danger" role="alert"> <?php echo $fmsg; ?> </div><?php } ?>