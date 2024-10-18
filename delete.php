<?php
include("data_class.php");
$delete=$_GET["useriddelete"];

$obj =new date();
$obj ->setconnection();
$obj ->deleteserdata($delete);