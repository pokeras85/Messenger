<?php
class Database{

    private $connection;

    public function connect_db(){
        $this->connection = mysqli_connect('localhost', 'root', '', 'messenger', '3306');
        if(mysqli_connect_error()){
            die("Database Connection Failed" . mysqli_connect_error() . mysqli_connect_errno());
        }
    }
    public function __construct()
    {
         $this->connect_db();
    }

    public function sanitize($var){
        $return = mysqli_real_escape_string($this->connection, $var);
        return $return;
    }

    public function check_username($var){
        $sql = "SELECT * FROM `user` WHERE username ='$var'";
        $res = mysqli_query($this->connection, $sql);
        $r=mysqli_num_rows($res);
        return $r;

    }

    public function mid($var){
        $var = md5(mysqli_real_escape_string($this->connection, $var));
        return $var;
    }

    public function create($username,$email,$password){
        $sql = "INSERT INTO `user` (username, email, password) VALUES ('$username', '$email', '$password')";
        $res = mysqli_query($this->connection, $sql);
        if($res){
            return true;
        }else{
            return false;
        }
    }

    public function find ($var1, $var2){
        $sql = "SELECT * FROM `user`WHERE username='$var1' AND  password='$var2'";
        $res = mysqli_query($this->connection, $sql);
        $count = mysqli_num_rows($res);
        return $count;
    }

    public function activate($var1,$var2){
        $sql = "UPDATE user SET active = 1 where (username='$var1' AND password='$var2')";
        $res = mysqli_query($this->connection, $sql);
        if($res){
            return true;
        }else{
            return false;
        }
    }

    public function deactivate($username){
        $sql = "UPDATE user SET active = 0 where (username='$username')";
        $res = mysqli_query($this->connection, $sql);
        if($res){
            return true;
        }else{
            return false;
        }
    }

    public function alluser($var){
        $sql = "SELECT * FROM `user`WHERE NOT username='$var' AND  active=1";
        $res = mysqli_query($this->connection, $sql);
        return $res;
    }

    public function get_user($var){
        $sql = "SELECT * FROM `user`WHERE username='$var'";
        $res = mysqli_query($this->connection, $sql);
        $r=mysqli_fetch_array($res);
        return $r;
    }
    public function allmsg($var1,$var2){
        $sql = "SELECT * FROM `posts`WHERE (sender='$var1' and receiver='$var2') OR (sender='$var2' and receiver='$var1') ORDER BY msgid ";
        $res = mysqli_query($this->connection, $sql);
        return $res;
    }

    public function updatemsg($var1,$var2){
        $sql="UPDATE posts SET status='read' where (sender='$var1' AND receiver='$var2')";
        $res = mysqli_query($this->connection, $sql);
        return $res;
    }

    public function sendmsg($var1, $var2,$var3 ){
        $sql = "INSERT INTO `messages` (sender, receiver, message) VALUES ('$var1', '$var2', '$var3')";
        $res = mysqli_query($this->connection, $sql);
        return $res;
    }

    public function create_group($var1,$var2,$var3 ){
        $sql = "INSERT INTO `grupe` (name, users, creator) VALUES ('$var1', '$var2', '$var3')";
        $res = mysqli_query($this->connection, $sql);
        return $res;
    }

    public function all_group($var){
        $sql = "SELECT * FROM `grupe` WHERE  users='$var'";
        $res = mysqli_query($this->connection, $sql);
        return $res;
    }

    public function allmsg_group($var1)
    {
        $sql = "SELECT * FROM `posts`WHERE (sender='$var1' OR receiver='$var1') ORDER BY msgid ";
        $res = mysqli_query($this->connection, $sql);
        return $res;
    }

    public function check_name_for_group($var){
        $sql = "SELECT * FROM `grupe` WHERE `name`='$var'";
        $res = mysqli_query($this->connection, $sql);
        $r = mysqli_num_rows($res);
        return $r;

    }

    public function testing(){
        echo "Hello world!";
    }
}

$database= new Database();


?>