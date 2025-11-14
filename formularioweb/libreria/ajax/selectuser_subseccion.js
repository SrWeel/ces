var xmlHttp_subseccion

function showUser_subseccion(str,str1,str2,str3,str4,str5,str6,str7,str8,str9,str10)
{ 
xmlHttp_subseccion=GetXmlHttpObject_subseccion()
if (xmlHttp_subseccion==null)
 {
 alert ("Browser does not support HTTP Request")
 return
 }
var url="libreria/ajax/combo_subseccion.php"
url=url+"?q="+str+"&q1="+str1+"&q2="+str2+"&q3="+str3+"&q4="+str4+"&q5="+str5+"&q6="+str6+"&q7="+str7+"&q8="+str8+"&q9="+str9+"&q10="+str10
url=url+"&sid="+Math.random()
xmlHttp_subseccion.onreadystatechange=stateChanged_subseccion 
xmlHttp_subseccion.open("GET",url,true)
xmlHttp_subseccion.send(null)
}

function stateChanged_subseccion() 
{ 

if (xmlHttp_subseccion.readyState==4 || xmlHttp_subseccion.readyState=="complete")
 { 
 document.getElementById("txtHint_subseccion").innerHTML=xmlHttp_subseccion.responseText 
 
 } 
}

function GetXmlHttpObject_subseccion()
{
var xmlHttp_subseccion=null;
try
 {
 // Firefox, Opera 8.0+, Safari
 xmlHttp_subseccion=new XMLHttpRequest();
 }
catch (e)
 {
 //Internet Explorer
 try
  {
  xmlHttp_subseccion=new ActiveXObject("Msxml2.XMLHTTP");
  }
 catch (e)
  {
  xmlHttp_subseccion=new ActiveXObject("Microsoft.XMLHTTP");
  }
 }
return xmlHttp_subseccion;
}