var xmlHttpcontenido

function showUsercontenido(str,str1,str2,str3,str4,str5,str6,str7,str8,str9,str10)
{ 
xmlHttpcontenido=GetXmlHttpObjectcontenido()
if (xmlHttpcontenido==null)
 {
 alert ("Browser does not support HTTP Request")
 return
 }
var url="templates/acerotmp/combo_contenido.php"
url=url+"?q="+str+"&q1="+str1+"&q2="+str2+"&q3="+str3+"&q4="+str4+"&q5="+str5+"&q6="+str6+"&q7="+str7+"&q8="+str8+"&q9="+str9+"&q10="+str10
url=url+"&sid="+Math.random()
xmlHttpcontenido.onreadystatechange=stateChangedcontenido 
xmlHttpcontenido.open("GET",url,true)
xmlHttpcontenido.send(null)
}

function stateChangedcontenido() 
{ 
document.getElementById("txtHintcontenido").innerHTML="<span class=stlmsg><br><br>Espere un momento porfavor...</span>" 
if (xmlHttpcontenido.readyState==4 || xmlHttpcontenido.readyState=="complete")
 { 
 document.getElementById("txtHintcontenido").innerHTML=xmlHttpcontenido.responseText 
 
 } 
}

function GetXmlHttpObjectcontenido()
{
var xmlHttpcontenido=null;
try
 {
 // Firefox, Opera 8.0+, Safari
 xmlHttpcontenido=new XMLHttpRequest();
 }
catch (e)
 {
 //Internet Explorer
 try
  {
  xmlHttpcontenido=new ActiveXObject("Msxml2.XMLHTTP");
  }
 catch (e)
  {
  xmlHttpcontenido=new ActiveXObject("Microsoft.XMLHTTP");
  }
 }
return xmlHttpcontenido;
}