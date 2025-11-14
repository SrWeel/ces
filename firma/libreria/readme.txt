/**************************************************************************

        Script: PaginaZ v1.1
        Fecha: Septiembre del 2002


        Autor: Zubyc (webmaster@php-hispano.net)

        Este script se encarga de paginar una tabla de una base de datos,
        diviendo los registros en páginas de un tamaño definido.
        Serviría tanto para paginar resultados de búsquedas como noticias,
        imágenes,...
 
        Recuerdo que este script no muestra la información obtenida ya que 
        simplemente te devuelve los datos de la consulta. 
        Por esto, deberás ser tú quien se encargue de darle formato a esa 
        consulta, adaptándola a una tabla o de cualquier otra forma que 
        se te ocurra..


        Para cualquier sugerencia o error, contactad conmigo a través de:
       
                       webmaster@php-hispano.net


        Podrás encontrar más scripts, tutoriales y manuales sobre éste y otros temas en
        la web de PHP PARA TORPES:
 
                     http://php-hispano.net


****************************************************************************/


    Requisitos mínimos

    - Se requiere disponer de un servidor web con capacidad para PHP y MySQL.
    - Es MUY conveniente tener ciertos conocimientos de PHP para hacer funcionar 
      todo correctamente.



     Mejoras en la versión 1.1

        - Arreglado un pequeño fallo al crear el número de enlaces
        - Se han añadido las siguientes funcionas para modificar los colores
             de ciertas partes del script:

                   set_color_tabla($color);
                   set_tabla_transparente()
                   set_color_texto($color)
                   set_color_enlaces($color_inactivo,$color_activo)


****************************************************************************



    Los pasos a seguir para instalar el paginador son los siguientes:


    1) Copiar el archivo class.paginaZ.php en un directorio cualquiera de tu web.
       Si tienes algún directorio donde tengas más clases seria aconsejable copiarlo 
       aqui, en caso contrario lo más adecuado sería copiarlo en el directorio donde
       se encuentren los archivos que hagan uso de esta clase.

       Edita este archivo (class.paginaZ.php), y rellena los datos de configuración
       para conectar a la base de datos.

      ---------------------------------------------------------------------------

    2) Crear un fichero que se encargue de mostrar la información obtenida. Como ejemplo,
       puedes crear un archivo llamado "mostrar_info.php".
       En este archivo deberás incluir las siguientes líneas en el orden especificado 
       justo al principio del fichero:

       ------------------------------------------------------------------------

         <? 
          
          include("class.paginaZ.php");

          $page=new sistema_paginacion($nombre_tabla);
          $page->set_condicion($condicion_sql);
          $page->ordenar_por($campo);

          $page->set_limite_pagina(30);
         
          $result_page=$page->obtener_consulta();

         ?>

       ------------------------------------------------------------------------


      A continuación describimos estas funciones:


           include("class.paginaZ.php");  
 
            --> Incluye la clase en el archivo actual.

         
           $page=new sistema_paginacion($nombre_tabla);
          
            --> Crea una instancia de la clase. 
                Parámetro: Nombre de la tabla de la BD que deseamos paginar.

          
           $page->set_condicion($condicion_SQL); 

           --> Esta linea es opcional. Sólo se debe incluir si deseas 
               que sólo se muestren algunos registros. Es una extension 
               a la consulta SQL.
 
               Ejemplo: campos de la tabla: edad y color_pelo
               
                      Deseamos mostrar sólo aquellas personas con más de 25 y morenas:      
               
                          $page->set_condicion("WHERE edad>25 and color_pelo='morena'");
               

           $page->ordenar_por($campo);
           
           --> Esta línea también es opcional. 
               Acepta como parámetro el nombre de un campo de la tabla por el cual
               se ordenarán los datos.
               En caso de omitir esta línea, los datos serán ordenados por el campo
               establecido por defecto.


          $page->set_limite_pagina($numero_por_pagina);

           --> Esta línea si es obligatoria. Se deben establecer el número de registros
               a mostrar por página. 
                                     

          $result_page=$page->obtener_consulta();
 
          --> Línea obligatoria y prácticamente la más importante. 
              En $result_page devolverá el resultado de la consulta realizada. 
              Es decir, sólo tienes que limitarte a mostrar los datos:
 
                        $result_page=$page->obtener_consulta();

			/* Codigo intermedio */

                        while($row=mysql_fetch_object($result_page))
                        {
                           /* Mostrar datos */
                        }


	Funciones añadidas:
        ---------------------------------
        $page->set_color_tabla("yellow");

        --> Es posible que deseeis reutilizar el archivo para realizar varios paginados
            con distinta información pero ocurre que si modificais el archivo, los colores
            de las tablas serán iguales para todos. Esta función se ha introducido para
            permitiros cambiar el color de fondo de las tablas.

            Los colores son introducidos como si se usara la propiedad bgcolor:

            Ejemplos de colores: "yellow","black","#306090",...

 
	
        $page->set_tabla_transparente()

        --> Esta función debes llamarla si deseas que las tablas creadas por el script tomen
	    el color de fondo de la página. 


         $page->set_color_texto($color)
 
        --> Usado para elegir un color para el texto normal 
            (El color de los enlaces no se verá afectado)

         
         $page->set_color_enlaces($color_inactivo,$color_activo)
         
	--> Si quereis modificar los colores de los enlaces podeis hacerlo llamando a
            esta función. 
            - El primer parámetro indica el color cuando el enlace no esta activo, es decir
              que el raton no está sobre él
            - El segundo parámetro sirve para establecer el color que tomará el enlace                    cuando el ratón pase por encima.


  
       -------------------------------------------------------------------------
        3. El codigo encargado de listar los registros en pantalla deberá 
           ser realizado por ti mismo. Por eso es conveniente realizar esa parte 
           en este paso.

           Para mostrar los registros de la consulta por pantalla, con esto bastaría:

		while($row=mysql_fetch_object($result_page))
                        {
                           echo "$row->campo_de_la_tabla<br>"
                        } 

           Pero lo más cómodo y elegante como sabrás, es mostrar toda 
           la información dividida en varias columnas usando una tabla.
           Bueno, el modo en el que realices esta parte ya depende de los 
           gustos del programador. 


        --------------------------------------------------------------------------


        4. Una vez realizado todo esto, el tercer y último paso sería colocar los enlaces a 
           las otras páginas. Para esto sólo tienes que añadir las siguientes líneas 
           en el archivo en el lugar que más conveniente te resulte: 


          <? $page->mostrar_numero_pagina() ?>

          Muestra por pantalla un mensaje del tipo:    "Página 1 de 4"

          Esta línea es un tanto opcional, aunque resulta bastante útil para que los 
          usuarios de la web tengan conocimiento de la página en la que se encuentran.
       


          <? $page->mostrar_enlaces(); ?>

          Muestra los enlaces a otras páginas. 
          Se muestran de la forma siguiente: Paginas 1 - 2 - 3 - 4... >> Siguiente
 
          Esta línea es OBLIGATORIA. 

	-------------------------------------------------------------------------



         Bueno, espero que haciendo todo esto consigais hacer funcionar el paginado 
         a la primera :)

         Recordad que cualquier error mostrado por pantalla referido a MySQL, será 
         debido probablemente a algún error en los datos de configuración de la base de 
         datos o bien por algún fallo en el nombre de campo de ordenación o en las 
         condiciones. Sólo teneis que revisar estos datos. 







         Si cualquiera de vosotros ha realizado algún script de este tipo o sobre 
         cualquier otro tema relacionado con PHP, si lo considera útil y quiere darlo a 
         conocer a otras personas para que podamos aprender de él, estaremos encantados
         de publicarlo en
                            http://php-hispano.net
         
          
         Un saludo y suerte! ;)

          

          
          
         