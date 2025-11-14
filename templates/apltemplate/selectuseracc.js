var xmlHttp

function showUseracc(str,str1,str2,str3,str4)
{ 
xmlHttp=GetXmlHttpObjectacc()
if (xmlHttp==null)
 {
 alert ("Browser does not support HTTP Request")
 return
 }
var url="templates/guia/acceso.php"
url=url+"?q="+str+"&q1="+str1+"&q2="+str2+"&q3="+str3+"&q4="+str4
url=url+"&sid="+Math.random()
xmlHttp.onreadystatechange=stateChangedacc 
xmlHttp.open("GET",url,true)
xmlHttp.send(null)
}

function stateChangedacc() 
{ 

document.getElementById("accesodiv").innerHTML="<table width='100%' border='0' align='center' cellpadding='0' cellspacing='0'><tr><td bgcolor='#E1F1F2'><center><img src='aplications/registro/graficos/loadinfo.gif'/></center></td></tr></table>"
if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete")
 { 
  document.getElementById("accesodiv").innerHTML=xmlHttp.responseText;  
  document.location.href='index.php?system=14&sessid=' + document.accfin.vfaca.value;
 } 
}

function GetXmlHttpObjectacc()
{
var xmlHttp=null;
try
 {
 // Firefox, Opera 8.0+, Safari
 xmlHttp=new XMLHttpRequest();
 }
catch (e)
 {
 //Internet Explorer
 try
  {
  xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
  }
 catch (e)
  {
  xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
 }
return xmlHttp;
}