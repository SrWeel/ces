
<?php
$director="../../";
include ("../../cfgclases/clases.php");

include('simple_html_dom.php');

$lista_capitulos="select * from media_tmojcapitulos where tmojcapitulos_codigo=".$_POST["tmojcapitulos_codigo"];
$rs_capitulos = $DB_gogess->Execute($lista_capitulos);


echo "<table width='300' border='0' cellpadding='2' cellspacing='1' >";  
          // Create DOM from URL
$str = <<<HTML
{$rs_capitulos->fields["tmojcapitulos_texto"]}
HTML;


$html = str_get_html($str);

for ($ibat=0;$ibat<=$rs_capitulos->fields["tmojcapitulos_narticulos"];$ibat++)
{
	
foreach($html->find('div#articulo'.$ibat) as $e)
{
   
   //separar del primer .- para verficicar articulo
    @$explode_txt=explode(".-",$e->innertext);
    @$titulo_cpa=str_replace("&amp;","&",@$explode_txt[0].".-".@$explode_txt[1]);
    $titulo_cpa=str_replace("<p>","",$titulo_cpa);
	$titulo_cpa=str_replace("</p>","",$titulo_cpa);
	$titulo_cpa=str_replace('<p style="text-align:justify">',"",$titulo_cpa);
	$titulo_cpa=str_replace("</p>","",$titulo_cpa);
   //separar del primer .- para verficicar articulo
   
 //   echo "<li onclick=document.getElementById('editor_id').contentWindow.ejecuta_link('articulo".$ibat."')  style='cursor:pointer' class='txt_li' >".$titulo_cpa.'</li>';
	
	$busca_indexado="select * from media_listaarticulo where tmojcapitulos_codigo=".$_POST["tmojcapitulos_codigo"]." and articulo_num=".$ibat;
	$rs_indexado = $DB_gogess->Execute($busca_indexado);
	
	 if($rs_indexado->fields["listart_id"])
	{
		 $icono_img="<img src='images/check.png' width='24' height='22'>";
		 $icono_enlace="<img src='images/enlace.png' width='24' height='22'>";
	}
	else
	{
		$icono_img="";
		$icono_enlace="";
	}
	
	$armaencrip='geamv=1&table=media_enlacearticulos&listab='.$rs_indexado->fields["listart_id"].'&campo=listart_id&obp=num';
	$dataenc=base64_encode($armaencrip);			
    $link_val="index.php?mp=".$dataenc;
	$comillsp="'";
	
	$onclick=" style='cursor:pointer' onclick=agregar_detalle(".$comillsp.$link_val.$comillsp.",".$comillsp."191".$comillsp.")";
	
	echo "<tr><td bgcolor='#FFFFFF' >".$icono_img."</td><td bgcolor='#FFFFFF'>".$titulo_cpa."</td><td bgcolor='#FFFFFF' ".$onclick." >".$icono_enlace."</td></tr>";
	
	
	
}

}
       echo "</table>";   

?>
