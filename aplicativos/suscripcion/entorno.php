<div id=acceso_panel >
<?php
//echo $apl;
  $buscaopcionapl="select * from gogess_opcionaplicativo where ap_id=? and opap_activo='?'";
$rs_aplopciones = $DB_gogess->executec($buscaopcionapl,array($apl,1));

  if($rs_aplopciones)

  {

     	while (!$rs_aplopciones->EOF) {

	

		$arrayopciones[$rs_aplopciones->fields["opap_id"]]["ejecuta"]=$rs_aplopciones->fields["opap_ejecuta"];

		$arrayopciones[$rs_aplopciones->fields["opap_id"]]["id"]=$rs_aplopciones->fields["opap_id"];

		$arrayopciones[$rs_aplopciones->fields["opap_id"]]["nombre"]=$rs_aplopciones->fields["opap_nombre"];

		

		if($rs_aplopciones->fields["opap_intro"]==1)

		{

		 $opcioninical=$rs_aplopciones->fields["opap_ejecuta"];

		 $idopcioninical=$rs_aplopciones->fields["opap_id"];

		}

		

		$rs_aplopciones->MoveNext(); 

		}

  }

  

 //print_r($arrayopciones);

  $idvalor_opcion=0;


  if(!(@$seccapl))

  {

     $idvalor_opcion=@$idopcioninical;

	 

	// include("menu/menu.php");

	 include("opciones/".trim(@$opcioninical).".php");

	 

	 

  }

  else

  {

    $idvalor_opcion=$arrayopciones[$seccapl]["id"];

	$pantalla_nombre=$arrayopciones[$seccapl]["nombre"];

	//include("menu/menu.php");

		echo '<table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td bgcolor="#E7EFF5" ><b>'.trim($pantalla_nombre).'</b></td></tr></table>';

	//echo "opciones/".$arrayopciones[$seccapl]["ejecuta"].".php";

	include("opciones/".$arrayopciones[$seccapl]["ejecuta"].".php");

  

  }

  

  





?>



</div>