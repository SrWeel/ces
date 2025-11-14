<style type="text/css">
.css_titulo {
	font-size: 11px;
	font-family: Verdana, Geneva, sans-serif;
}
.css_titulo td {
	text-align: center;
}
.css_titulo td {
	font-weight: bold;
}
.css_texto {
	font-size: 11px;
	font-family: Verdana, Geneva, sans-serif;
	text-align: center;
}
</style>

<?php
include("../../../../../cfgclases/sessiontime.php");
ini_set("session.cookie_lifetime",$tiempossss);
ini_set("session.gc_maxlifetime",$tiempossss);
session_start();

$director="../../../../../";
include ("../../../../../cfgclases/clases.php");



if($_SESSION['ces1313777_sessid_inicio'])
{
	$ncolombo=0;
	$necua=0;
	//COLOMBIANOS
	$numerpercolombo="select count(bene_id) as numero from ca_beneficiario where tipoci_id=2 and bene_id=".$_POST["pVar1"];
	$rs_numcol = $DB_gogess->Execute($numerpercolombo);
	if($rs_numcol)
    {
		  $ncolombo=$ncolombo+$rs_numcol->fields["numero"];
		
	}
	
	
	//ECUATORIANOS
	$numerperecua="select count(bene_id) as numero from ca_beneficiario where tipoci_id=1 and bene_id=".$_POST["pVar1"];
	$rs_numecua = $DB_gogess->Execute($numerperecua);
	if($rs_numecua)
    {
		  $necua=$necua+$rs_numecua->fields["numero"];
		
	}
	
	
	//conyugue
	//colombiano
	$numerperecua="select count(cony_id) as numero from ca_conyugue where tipoci_id=2 and bene_ci_bene='".$_POST["pVar2"]."'";
	$rs_numecua = $DB_gogess->Execute($numerperecua);
	if($rs_numecua)
    {
		  $ncolombo=$ncolombo+$rs_numecua->fields["numero"];
		
	}
	
	//ecuatoriano
	$numerperecua="select count(cony_id) as numero from ca_conyugue where tipoci_id=1 and bene_ci_bene='".$_POST["pVar2"]."'";
	$rs_numecua = $DB_gogess->Execute($numerperecua);
	if($rs_numecua)
    {
		  $necua=$necua+$rs_numecua->fields["numero"];
		
	}
	
	//
	
	//tiene conyugue
	$nesposa=0;
	$tieneconyugue="select count(cony_id) as numero from ca_conyugue where bene_ci_bene='".$_POST["pVar2"]."'";
	$rs_numeconyugue = $DB_gogess->Execute($tieneconyugue);
	if($rs_numeconyugue)
    {
		  $nesposa=$rs_numeconyugue->fields["numero"];
		
	}
	
	//tiene cargas familiares
	$ncarga=0;
	$tienecarga="select count(carg_id) as numero from ca_cargasf where bene_ci_beneaf='".$_POST["pVar2"]."'";
	$rs_numecarga = $DB_gogess->Execute($tienecarga);
	if($rs_numecarga)
    {
		  $ncarga=$rs_numecarga->fields["numero"];
		
	}
	
	if($nesposa==0 and $ncarga>0)
	{
		$esjefe="SI";
		$esjefe_val=1;
	}  
	else
	{
		
		$esjefe="NO";
		$esjefe_val=0;
	}
	
	
	//edad de cargas familiares
	$listacarga="select  EXTRACT(DAY FROM age(timestamp 'now()',date(carg_fechanac) ) ) as dif_dias,EXTRACT(MONS FROM age(timestamp 'now()',date(carg_fechanac) ) ) as dif_meses, EXTRACT(YEAR FROM age(timestamp 'now()',date(carg_fechanac) ) ) as dif_anio from ca_cargasf where bene_ci_beneaf='".$_POST["pVar2"]."'";
	
	$rs_listacarga = $DB_gogess->Execute($listacarga);
	if($rs_listacarga)
	{
	while (!$rs_listacarga->EOF) {	
	
	
	   //echo "dias".$rs_listacarga->fields["dif_dias"]."<br>";
	  // echo "mes".$rs_listacarga->fields["dif_meses"]."<br>";
	  // echo "anio".$rs_listacarga->fields["dif_anio"]."<br>";
	   
	   $numeromeses=$rs_listacarga->fields["dif_meses"]+($rs_listacarga->fields["dif_anio"]* 12);
	    //echo  $numeromeses;
		
		if($numeromeses>=3 and $numeromeses<=36)
		{
			$sumahijos++;
			 
		}
	   
	$rs_listacarga->MoveNext(); 
	
	}
	
	}
	

	
	//
	
	//numero cargas
	$numerocargasf="select  count(*) as numerocarga from ca_cargasf where bene_ci_beneaf='".$_POST["pVar2"]."'";
	$rs_ncargas = $DB_gogess->Execute($numerocargasf);
	$ncargasf=$rs_ncargas->fields["numerocarga"];
	
	
	
}



?>
<table width="600" border="0" align="center" cellpadding="0" cellspacing="2">
  <tr class="css_titulo">
    <td bgcolor="#CBD9E4">Num Per.Colombianas</td>
    <td bgcolor="#CBD9E4">Num Per.Ecuatorianas</td>
    <td bgcolor="#CBD9E4">Jefe de Hogar</td>
    <td bgcolor="#CBD9E4">Numero de Niños entre 3 meses y 3 años</td>
    <td bgcolor="#CBD9E4">&nbsp;</td>
  </tr>
  <tr class="css_texto">
    <td bgcolor="#E4ECF1"><?php echo $ncolombo ?></td>
    <td bgcolor="#E4ECF1"><?php echo $necua ?></td>
    <td bgcolor="#E4ECF1"><?php echo $esjefe ?></td>
    <td bgcolor="#E4ECF1"><?php echo $sumahijos ?></td>
    <td bgcolor="#E4ECF1"><?php
	
	if($ncargasf>0)
	{
		//---------------------------------
    $listaparametros="select * from ca_parametros";
	$rs_listacarga = $DB_gogess->Execute($listaparametros);
	if($rs_listacarga)
	{
	while (!$rs_listacarga->EOF) {	
	
	 $punto1=0;
	 $punto2=0;
	 $punto3=0;
	 $imprimevalor=0;
	//$rs_listacarga->fields["parament_nombre"]
	if($rs_listacarga->fields["parament_ncolombianos"]==$ncolombo)
	{
		 $punto1=1;
		
	}
	if($rs_listacarga->fields["parament_jefehogar"]==$esjefe_val)
	{
	     $punto2=1;
		
	}
	
	if($rs_listacarga->fields["parament_edadrango_ninio"])
	{
		if($sumahijos>0)
		{
			 $punto3=1;
			
		}
		
	}
	
	if($punto1)
	{
	 
	  $imprimevalor1=1;
	}
	
	if($punto2)
	{
	 
	  $imprimevalor2=1;
	}
	
	if($punto3)
	{
	  
	  $imprimevalor3=1;
	}
	
	$sumavalorp=$imprimevalor1+$imprimevalor2+$imprimevalor3;
	if($sumavalorp>0)
	{
		echo 	$rs_listacarga->fields["parament_nombre"]."<br>";
	}
	
	$rs_listacarga->MoveNext(); 
	}
	}
	
	
	//-------------------------------
	}
	?></td>
  </tr>
</table>