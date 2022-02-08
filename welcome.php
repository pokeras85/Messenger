<?php
session_start();
include_once ('inc/navbar.php');
include_once ('bootstrap.php');
include ('Configuratiomn/database.php');

$database= new Database();

//ukoliko sesija ne postoji da vrati korisnika na logovanje
if(!isset($_SESSION['username']) && empty($_SESSION['username'])){
    header('location: login.php');}

echo "<h1>Dobrodosli  ". $_SESSION['username']." na web chat</h1>";
?>

<?php
//insert msg in database
if(isset($_POST['submit'])) {
    $msg = htmlentities($_POST['messages']);
    $receiver_user=$_POST['receiver'];
    $sender_user=$_SESSION['username'];
    if($msg==""){
        echo "<div class='alert alert-danger'>
    <strong>Messages not be send because is empty</strong>
</div>";
    }elseif (strlen($msg)>255){
        echo "<div class='alert alert-danger'>
    <strong>Messages not be send, is to long. Use only 255</strong>
</div>";
    }else{$res=$database->sendmsg($sender_user,$receiver_user,$msg);}
}
?>



<head>
    <link rel="stylesheet" type="text/css" href="CSS/welcome2.css" >

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<div  class="container" style="height: 700px">
    <h3 class=" text-center">Messaging</h3>
    <div class="messaging" >
        <div class="inbox_msg">
            <div class="inbox_people">
                <div class="headind_srch">
                    <div class="recent_heading">
                        <h4>Online usres</h4>
                    </div>
                    <div class="srch_bar">
                        <a href="creategroup.php" style="margin-left: 110px">   <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Create group</button></a>
                    </div>
                </div>

                <div class="inbox_chat" >
                    <?php
                    $res=$database->alluser($_SESSION['username']);  //show active users except me
                    while($r = mysqli_fetch_assoc($res)){
                        ?>
                        <div class="chat_list active_chat" >
                            <div class="chat_people" >
                                <div class="chat_img"> <img src="https://ptetutorials.com/images/user-profile.png" alt="sunil"> </div>
                                <div class="chat_ib">
                                    <h5 ><a href="welcome.php?user=<?php echo $r['username'] ?>"><?php echo $r['username'] ?></a> <span class="chat_date"></span></h5>
                                    <p style="color: green">Aktive user</p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <!--if have group show-->




                </div>
            </div>
            <div class="mesgs" id="scrol">
                <div class="msg_history" id="load_post" >


                    <?php
                    if(isset($_GET['user']) || isset($_GET['group'])) {
                        if (isset($_GET['user'])) {                             //if isset no group chat
                            $_SESSION['getuser'] = $_GET['user'];
                            $receiver_user = $_SESSION['getuser'];
                            $_SESSION['group'] = "false";
                        }
                        if (isset($_GET['group'])) {
                            $_SESSION['getuser'] = $_GET['group'];       //if isset group chat
                            $receiver_user = $_SESSION['getuser'];
                            $_SESSION['group'] = "true";
                        }
                    }

                    if(!isset($_SESSION['getuser'])){$_SESSION['getuser']=$_SESSION['username'];}
                    if(!isset($_SESSION['group'])){$_SESSION['group']="false";}

                    $receiver_user = $_SESSION['getuser'];
                    $group=$_SESSION['group'];
                    $sender_user = $_SESSION['username'];
                    $database->updatemsg($sender_user, $receiver_user); //to means that msg is read
                    $res = $database->allmsg_group($receiver_user); //get all messages between two users
                    ?>
                    <!--messages-->



                </div>

                <!--create message and sent in detabase-->

                <div class="type_msg">
                    <div class="input_msg_write">
                        <form method="post" action="welcome.php">
                            <input type="text"  name="messages" class="write_msg" placeholder="Type a message" />
                            <input  name="receiver" value="<?php if(isset($receiver_user)){echo $receiver_user;}?>"  style="display: none"/>
                            <button class="msg_send_btn"  name="submit" type="submit"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>