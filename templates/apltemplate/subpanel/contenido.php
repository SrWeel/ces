
        <?php
switch ($secc) 
	{
     case 1:
         {
		 $objcontenido->select_articulo($ar);
         include($objtemplatep->path_template."contenido.php");
         }
         break; 
     case 2:
         {
         include($objtemplatep->path_template."buscar.php");
         }
         break; 

     case 3:
         {
         include($objtemplatep->path_template."secciones.php");
         }
         break; 
	case 4:
         {
         include($objtemplatep->path_template."contenidop.php");
         }
         break; 
	case 5:
         {
         include($objtemplatep->path_template."registro.php");
         }
         break; 
	case 6:
         {
          if  ($sessid)
          {
             include($objtemplatep->path_template."foro.php");
          }
          else
          { 
             echo "<br><br><br><br><center><div class=titulo>Para ingresar a esta seccion debe estar registrado</div>";
             echo "<a href='index.php?secc=5&menu=2' target='_top'><img src=".$objtemplatep->path_template."images/reg.png border=0></a></center><br><br><br><br>";
           } 
         }
         break; 
	case 7:
		{
//Aplicaciones
			include("module/aplication.php");

		}   	
         break; 
     default:	  
         include($objtemplatep->path_template."centro.php");		 
    }  
?>
    