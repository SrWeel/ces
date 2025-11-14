<style type="text/css">
<!--
.stltitulo {
	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #006699;
	font-weight: bold;
	text-transform: uppercase;
}
.stlnt1 {
	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
}
.stlnt2 {
	font-size: 11px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #666666;
	text-align: justify;
}
.stlnt3 {
	font-size: 10px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	color: #999999;
}
-->
</style>
<hr size="1" />
<?php

 $fechahoy=date("Y-m-d");
$selecTablanc="select * from guia_clasificados,guia_provincias,guia_cantones,guia_bien,guia_tipoclasificado,guia_accion where (guia_clasificados.pro_id=guia_provincias.pro_id and guia_clasificados.can_id=guia_cantones.can_id and guia_clasificados.bie_id=guia_bien.bie_id and guia_clasificados.tcla_id=guia_tipoclasificado.tcla_id and guia_clasificados.acc_id=guia_accion.acc_id and cla_fecha<='".$fechahoy."' and cla_fechafin>='".$fechahoy."') order by cla_fecha desc";
   
  $resultadonc = mysql_query($selecTablanc);
  $kc=1;
  		while($rownc = mysql_fetch_array($resultadonc) and $kc<=5) 
			{	
			$idn=$rownc["cla_id"];
			$titulon=$rownc["cla_titulo"];
			$accn=$rownc["acc_titulo"];
			$ciudadn=$rownc["can_nombre"];
			$descripcionn=$rownc["cla_descripcion"];
			$fechan=$rownc["cla_fecha"];
			echo '<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><span class="stltitulo"><a href="index.php?cla_id='.$idn.'&apl=17&secc=7&system='.$system.'&sessid='.$sessid.'" class="stltitulo">'.$titulon.'</a></span>. <span class="stlnt1">'.$ciudadn.'-'.$accn.'</span><br>
      <span class="stlnt2">'.$descripcionn.'</span><br>
      <span class="stlnt3">('.$fechan.')</span></td>
  </tr>
</table><hr size="1" />';
			$kc++;
			}

?>
