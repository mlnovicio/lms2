<?php
require_once'../class.php';
$db=new db_class(); 
if(isset($_GET['email'])&&isset($_GET['uid']) && $_GET['email']!="" && $_GET['uid']!=""){
    if($db->VerifyEmail($_GET['email'],$_GET['uid'])){

        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Verified Successfully');
        window.location.href='https://mail.google.com/';
        </script>");
    
    }
}else if(isset($_GET['email2'])&&isset($_GET['uid2']) && $_GET['email2']!="" && $_GET['uid2']!=""){
    if($db->VerifyEmail2($_GET['email2'],$_GET['uid2'])){

        echo ("<script LANGUAGE='JavaScript'>
        window.alert('Verified Successfully');
        window.location.href='https://mail.google.com/';
        </script>");
    
    }
}else{
    echo ("<script LANGUAGE='JavaScript'>
            window.location.href='https://mail.google.com/';
        </script>");
}
?>