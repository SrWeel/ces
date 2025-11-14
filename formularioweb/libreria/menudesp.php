<div id="fra1" style="position:absolute; width:200px; height:115px; z-index:1; left: 146px; top: 15px;"></div>
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);
//-->
</script>
</head>
<script language="JavaScript">
<!--
function imenu(obj,op) {
        var NS4 = (navigator.appName=='Netscape' && parseInt(navigator.appVersion)>=4); 
        var show_v=(NS4)?'show':'visible';
        var hide_v=(NS4)?'hide':'hidden';
        var layerObj=(NS4) ? 'document' : 'document.all';
        var styleObj=(NS4) ? '' : '.style'; 
        if (op==1)      	
        {  
   	      contenido = "<b><img src='<?php echo $ap_path; ?>graficos/luz_ind.gif' width='18' height='16'>&nbsp;&nbsp;<a href='<?php echo $ap_path; ?>folleto.php?doc=" + "op.options[op.selectedIndex].value" + "' target='_blank'><font face='Geneva, Arial, Helvetica, san-serif' size='2'>Ver Tema</font></a></b>";
        }
        if (op==2)      	
        {  
   	      contenido = "";
        }
		if (NS4) {        
	      eval(layerObj + '["' + obj + '"]' + styleObj + '.document.open()');
              eval(layerObj + '["' + obj + '"]' + styleObj + '.document.write(contenido)');
	      eval(layerObj + '["' + obj + '"]' + styleObj + '.document.close()');                
        }
        else 
        {              
              eval(layerObj + '["' + obj + '"].innerHTML = contenido');               
              
        }
		}

//-->
</script> 
<span class="menulk" onMouseOut="imenu('fra1',2)" onMouseOver="imenu('fra1',1)"><a href="#"  class="menulk">Menu1</a></span>

<?php
class menudesp{
var $resultado;

function display_menu($menu,$varsend)
{
  $selecmenu1="select * from iba_menudesp where men_id=$menu";  
  $resultado1 = mysql_query($selecmenu1);
  while($row1 = mysql_fetch_array($resultado1)) 
			{	
                $titulo=$row1[men_nombre];			
                $stylot=$row1[men_style];			
                $activem=$row1[men_active];
				$tipom=	$row1[men_type];		

			}  
}
 
?>