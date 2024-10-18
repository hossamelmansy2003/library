<?php

include("data_class.php");


$request=$_GET['reqid'];
$book=$_GET['book'];
$userselect=$_GET['userselect'];
$getdate= date("d/m/y");
$days=$_GET['days'];

$returnDate=Date('d/m/y',strtotime('+'.$days.'days'));

$obj=new date();
$obj->setconnection();
$obj->issuebookapprove($book,$userselect,$days,$getdate,$returnDate,$request);