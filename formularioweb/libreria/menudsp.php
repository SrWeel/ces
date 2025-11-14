$por='"';
printf ("<script language='JavaScript'>\n<!-- \nfunction imenu(obj,op) {\nvar NS4 = (navigator.appName=='Netscape' && parseInt(navigator.appVersion)>=4);\n");
printf ("var show_v=(NS4)?'show':'visible';\nvar hide_v=(NS4)?'hide':'hidden';\nvar layerObj=(NS4) ? 'document' : 'document.all';\n        var styleObj=(NS4) ? '' : '.style'; \n");
printf ("if (op==1)\n contenido = %s<b><img src='graficos/luz_ind.gif' width='18' height='16'></b>%s;\n",$por,$por);
printf ("}\nif (op==2) \n { contenido = %s%s;\n}\n",$por,$por);
printf("if (NS4) { \n eval(layerObj + '[%s' + obj + '%s]' + styleObj + '.document.open()');\n",$por,$por);
printf("eval(layerObj + '[%s' + obj + '%s]' + styleObj + '.document.write(contenido)');\n",$por,$por);
printf("eval(layerObj + '[%s' + obj + '%s]' + styleObj + '.document.close()'); \n",$por,$por);               
printf("}\nelse \n{ \neval(layerObj + '["' + obj + '"].innerHTML = contenido');   \n}\n}\n//-->\n</script> \n");