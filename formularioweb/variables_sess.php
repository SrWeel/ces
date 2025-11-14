<?php
ini_set("session.cookie_lifetime","36000");
ini_set("session.gc_maxlifetime","36000");
session_start();

@$_SESSION['formularioweb_carr_id']=$_POST["carr_id"];
@$_SESSION['formularioweb_nivl_id']=$_POST["nivl_id"];
@$_SESSION['formularioweb_matprof_id']=$_POST["matprof_id"];
echo "..";
?>