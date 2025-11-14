<?php
$crpadet_valorx=$_POST["crpadet_valorx"];
$crpadet_saldox=$_POST["crpadet_saldox"];
$crpadet_valorapagar=$_POST["crpadet_valorapagar"];
$crpadet_saldox=$crpadet_valorx-$crpadet_valorapagar;
echo " var crpadet_saldoxresultado = '".$crpadet_saldox."'; ";
?>