<?php
ini_set('display_errors',0);
error_reporting(E_ALL);

$path_template ="/medicdns/archivo/";

$secc=7;

$apl=17;

if(!(@$apl))

{

$apl=0;

}

else

{

                        $sqlnom = "select * from gogess_aplication where ap_id=$apl";	

						$resultnom = $DB_gogess->executec($sqlnom,array());

	                    if ($resultnom)

						{		 	

						 

							while (!$resultnom->EOF) {    

								

								

								

								$ap_path=$resultnom->fields["ap_path"];

								$ap_activo=$resultnom->fields["ap_activo"];

								$ap_protec=$resultnom->fields["ap_protec"];

								$ap_logo=$resultnom->fields["ap_logo"];

								//$ap_fondo=$resultnom->fields["ap_fondo"];

								$ap_nombre=$resultnom->fields["ap_nombre"];

								

								

								$resultnom->MoveNext();

								

							}

						}

						//-------------------------------	



}



if(!(@$secc))

{

				

				include($objtemplatep->path_template."home.php");

}

else

{



               if($apl==16)

				{

						

						//-------------------------------

						include($objtemplatep->path_template."apl_resgistro.php");

						//-------------------------------	

						

				}

				

				if($apl==17)

				{

				       if(@$_SESSION['ces1313777_sessid_inicio'])

						{

						include($objtemplatep->path_template."apl_panel.php");

						//include($objtemplatep->path_template."apl_ingreso.php");

						}

						else

						{

						//-------------------------------

						include($objtemplatep->path_template."apl_ingreso.php");

						//-------------------------------	

						}

				}

				

				if($apl==6)

				{

				

				       //-------------------------------

						include($objtemplatep->path_template."apl_activa.php");

						//-------------------------------	

				}

				

				

				if($apl==19)

				{

						//-------------------------------

						include($objtemplatep->path_template."iniciar.php");

						//-------------------------------	

				}

				

				if($apl==18)

				{

						//-------------------------------

						include($objtemplatep->path_template."registro.php");

						//-------------------------------	

				}

				

				if($apl==3)

				{

				include($objtemplatep->path_template."contactanos.php");

				

				}



				

				if(!($apl))

				{

				

				  switch ($secc) 

					{

					 case 1:

						 {

						 $objcontenido_portal->select_articulo($ar,$DB_gogess);

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

						 include($objtemplatep->path_template."contenido_blog.php");

						 }

						 break;	 

				    }

				  

				   

				}

				

				

				

}

?>