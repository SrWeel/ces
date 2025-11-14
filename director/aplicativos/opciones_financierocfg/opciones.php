<style>
<!--
#cuadro_menu {
	float:left;
	min-height:50px;
	margin-left:0px;
	margin-top:0px;
	border:1px solid #006699;
	padding:5px;
	background-color: #F2F2F2;
	height: 150px;
	width: 150px;
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	text-decoration: none;
}
.cuadro_txtmenu {
	
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 11px;
	text-decoration: none;
}
-->
</style>
<?php


$list_men=explode(",",$p_financierom);

for($i=0;$i<count($list_men);$i++)
{

$lista[$i]=$objmenu->menu_lista_array($list_men[$i],@$menuperfil,@$imenuperfil,$table,$apl,@$extra,$DB_gogess);
for($z=0;$z<count($lista[$i]);$z++)
{
   echo '<div id=cuadro_menu >'.$lista[$i][$z].'</div>';

}


}



?>

