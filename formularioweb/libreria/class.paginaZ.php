<?php

/**************************************************************************
        PaginaZ v1.1

        Autor: Zubyc (webmaster@php-hispano.net)

        Este script se encarga de paginar una tabla de una base de datos,
        diviendo los registros en páginas de un tamaño definido.
        Serviría tanto para paginar resultados de búsquedas como noticias,
        imágenes,...

        No está recomendado para aquellas personas sin conocimientos previos de
        PHP ya que no será capaz de sacar el máximo provecho a este script.


        Este código es de libre distribución y por tanto puedes modificarlo
        a tu propio riesgo. Al ser totalmente gratuito sólo te pido que mantengas
        esta información al usar este script.

        Para cualquier sugerencia o notificación enviadme un email a la dirección
                        webmaster@php-hispano.net

                   Todas vuestras opiniones serán bien recibidas :)



        Mejoras en la versión 1.1

        - Arreglado un pequeño fallo al crear el número de enlaces
        - Se han añadido las siguientes funcionas para modificar los colores
             de ciertas partes del script:

                   set_color_tabla($color);
                   set_tabla_transparente()
                   set_color_texto($color)
                   set_color_enlaces($color_inactivo,$color_activo)





/***************************************************************************/


  class sistema_paginacion{

     /****************************************************************
                               DATOS A CONFIGURAR
     /****************************************************************/

     /* Colores  -  Configurable a gusto del consumidor :)*/

     var $color_link_inactivo="ffffff";    /* Color del enlace cuando el raton no esta por encima */
     var $color_link_activo="BLUE";     /* Color del enlace al pasar el raton por encima */
     var $color_texto="ffffff";            /* Color del texto normal (Que no es enlace) */
     var $color_tablas="#4271AA";         /* Color de fondo de la tabla que contiene los enlaces */

    /**************************************************************************/
    /* MUY IMPORTANTE!!!: NO MODIFICAR NADA A PARTIR DE ESTA LINEA               */
    /***************************************************************************/

     /* Datos para la creacion de las paginas ¡NO MODIFICAR!  */

     var $numero_por_pagina;     /* Número de registros a mostrar por pagina */
     var $numero_paginas;
     var $total;
     var $condiciones;           /* Condiciones para realizar el query ...p.e. where visible=1.. */
     var $id_inicio=0;


     /* Datos para la conexion a la base de datos  (Deben ser modificados) */

     var $nombre_tabla;     /* Esta variable se establece al crear la clase */
     var $campo_ordenacion; /* Campo de la tabla por el que se ordenan los resultados */

      /* Error */

     var $error=0;
     var $estilos_creados=0;
     var $url;

     /************* METODOS DE LA CLASE *****************/


         // Constructor -> establece el nombre de tabla donde consultar
         function sistema_paginacion($tabla)
         {
            global $id_inicio;

            $this->nombre_tabla=$tabla;
         //   $this->conectar();

            if(isset($id_inicio))
              $this->id_inicio=$id_inicio;
            else
              $this->id_inicio=0;

         }


         function crear_estilos()
         {
            echo "<style type='text/css'>
                       A.paginaZ
                       {
                            text-decoration:none;
                            color: $this->color_link_inactivo;
							font-size: 11px;
							font-family: Verdana, Arial, Helvetica, sans-serif;
                       }
                       A.paginaZ:hover
                       {
                            text-decoration:none;
                            color: $this->color_link_activo;
							font-size: 11px;
							font-family: Verdana, Arial, Helvetica, sans-serif;
                       }
                </style>";

         }


         // Constructor -> establece el nombre de tabla y las condiciones para la consulta
         function set_condicion($cond)
         {
            $this->condiciones=$cond;
         }



         // Obtiene la pagina en la que estamos a partir del id_inicio
         function obtener_pagina_actual()
         {
           $pagina_actual=($this->id_inicio/$this->numero_por_pagina)+1;
           return($pagina_actual);
         }


         /* Establece el campo por el que se realizara la ordenacion de registros */
         function ordenar_por($campo)
         {
              $this->campo_ordenacion=$campo;
         }

         /* Obtiene el numero total de registros a paginar (No modificar!) */
         function obtener_total()
         {
            $query="SELECT count(*) as total from $this->nombre_tabla ";

            if ($this->condiciones!="")
            {
               $query.=" $this->condiciones";
            }
         
            mysql_select_db($this->sql_db);
            $result=mysql_query($query);
            $row=mysql_fetch_object($result);
            $this->total=$row->total;


         }




        // Obtiene el numero de paginas a crear
        function obtener_numero_paginas()
        {
            $this->obtener_total();

            $this->numero_paginas=$this->total/$this->numero_por_pagina;

          // Si hay alguna pagina con menos del maximo tb se añade
           if (($this->total%$this->numero_por_pagina)>0)
              $this->numero_paginas++;

           $this->numero_paginas=floor($this->numero_paginas);

        }




        //Establece un numero maximo de elementos por pagina
        function set_limite_pagina($num)
        {
          $this->numero_por_pagina=$num;
          $this->obtener_numero_paginas();
        }




        /* Obtiene la url donde enlazar (NO MODIFICAR!!!!) */
        function obtener_url()
        {
          global $_GET;
		  global $_POST;

          while (list ($clave, $val) = each ($_GET)) {
            if($clave!="id_inicio")
               $variables .= $clave."=".$val."&";
			if($clave=="table")
			  $bandet=1;    
			if($clave=="sessid")
			  $bandes=1;       
          }

          if(strpos($variables, "&"))    $pag_devuelta = $HTTP_REFERER."?".$variables;
          else                           $pag_devuelta = $HTTP_REFERER."?";

          if (!($bandet))
		     $vari1="table=".$_POST['table'];
		  if (!($bandes))	
		     $vari1.="&sessid=".$_POST['sessid']."&";	   

           $this->url=$pag_devuelta.$vari1;
        }

         // Devuelve una variable $result con los resultados de la consulta
         function obtener_consulta()
         {

            mysql_select_db($this->sql_db);
            $query="SELECT * from $this->nombre_tabla ";			
            if ($this->condiciones!="")     $query.=" $this->condiciones";
            if($this->campo_ordenacion!="") $query.=" order by $this->campo_ordenacion ";
            $query.=" limit $this->id_inicio,$this->numero_por_pagina";
            $result=mysql_query($query);			
            return($result);

         }



         function error($num)
         {
            $this->error=$num;
            switch($num)
            {
            case 1:echo "Error al conectar a la BD";break;
            case 2:break;
            case 3:break;
            case 4:break;
            }
         }



         function set_color_tabla($color)
         {
            $this->color_tablas=$color;
         }

         function set_tabla_transparente()
         {
            $this->color_tablas="NO";
         }

          function set_color_texto($color)
         {
            $this->color_texto=$color;
         }

         function set_color_enlaces($color_inactivo,$color_activo)
         {
            $this->color_link_inactivo=$color_inactivo;
            $this->color_link_activo=$color_activo;
         }




         /*************************************************************
              METODOS QUE MUESTRAN LOS DATOS POR PANTALLA
         ***************************************************************/


         /* Muestra por pantalla una información del tipo  "PAGINA X de X" */

         function mostrar_numero_pagina()
         {
                      /* Crea el tipo de enlace mediante CSS si no esta creado ya */
            if (!$this->estilos_creados) {$this->crear_estilos(); $this->estilos_creados=1; }


           $pagina_actual=$this->obtener_pagina_actual();

           echo "
            <table >
            <tr ";if ($this->color_tablas!="NO") echo "bgcolor='$this->color_tablas'";
             echo " >
            <td style='border:1px solid #000000;font-size:11px' >
              &nbsp;&nbsp;
               <b><font color='$this->color_texto'>  Página $pagina_actual de $this->numero_paginas
              &nbsp;&nbsp;
              </td>
            </table>
          ";
         }

          // Imprime por pantalla los enlaces a cada pagina
         function mostrar_enlaces()
         {
           /* Crea el tipo de enlace mediante CSS si no esta creado ya */
           if (!$this->estilos_creados) {$this->crear_estilos(); $this->estilos_creados=1; }


           /* Obtiene la pagina en la que nos encontramos */
           $pagina_actual=$this->obtener_pagina_actual();

           /* Obtenemos la url donde enlazar */
           if (!$this->url) $this->obtener_url();




           echo "
           <table width='100%' border='0'>

           <tr>

          <td ";if ($this->color_tablas!="NO")
                     echo " bgcolor='$this->color_tablas'";
           echo " style='border:1px solid #000000;font-size=11px'> ";


           echo "


           <font color='$this->color_texto' >&nbsp;&nbsp;<b>Páginas
           ";



           for($i=0;$i<=$this->numero_paginas-1;$i++)
           {
              $numero_inicial=$i*$this->numero_por_pagina;
              $numero_final=$numero_inicial+$numero_por_pagina;

              $enlace_num=$this->url."id_inicio=$numero_inicial";

             $pagina=$i+1;

             echo " - ";

                if($pagina_actual!=$pagina)
                     echo " <a class='paginaZ' href='$enlace_num' class='paginaZ'>$pagina</a> ";
                else
                     echo "<u>$pagina</u>";
           }

           /* Mostramos el enlace de >>Siguiente si es necesario */

           $numero_siguiente=$this->id_inicio+$this->numero_por_pagina;
           $enlace_sig=$this->url."id_inicio=$numero_siguiente";

           if(isset($this->id_inicio)&&($this->id_inicio+$this->numero_por_pagina<$this->total))
                   echo "&nbsp; <a class='paginaZ' href='$enlace_sig' class='paginaZ'>&gt;&gt; Siguiente </a>";


          echo "&nbsp;&nbsp;</td>


          </table>";

         }


  }

?>