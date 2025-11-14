<?php
$director="../../";
include ("../../cfgclases/clases.php");

include('simple_html_dom.php');

$lista_capitulos="select * from media_tmojcapitulos where tmojcapitulos_codigo=".$_POST["tmojcapitulos_codigo"];
$rs_capitulos = $DB_gogess->Execute($lista_capitulos);


//echo "<table width='300' border='0' cellpadding='2' cellspacing='1' >";  
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
	
	
	//echo "<tr><td bgcolor='#FFFFFF'>".$titulo_cpa."</td></tr>";
	
	$guarda_procesado="insert into media_listaarticulo (tmojcapitulos_codigo,articulo_num,articulo_titulo) values ('".$_POST["tmojcapitulos_codigo"]."','".$ibat."','".$titulo_cpa."')";
	$rs_gpr = $DB_gogess->Execute($guarda_procesado);
	
	
	
}

}
     //  echo "</table>";   

?>
