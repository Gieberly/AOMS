@ -1,33 +0,0 @@
<?php

declare(strict_types=1);

function input_empty(string $name,string $mname,string $lname,string $email,string $pwd){
    if(empty($name) ||empty($mname) ||  empty($lname)|| empty($email) || empty($pwd)){
        return true;
    }else{
        return false;
    }
}


function email_invalid(string $email){
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        return true;
    }else{
        return false;
    }
}


function email_taken(object $conn,string $email){
    if(get_email($conn,$email)){
        return true;
    }else{
        return false;
    }
}

function create_user(object $conn, string $name,string $mname,string $lname,string $email,string $pwd, string $role){
    set_user($conn,  $name,$mname, $lname,$email,$pwd,$role);
}