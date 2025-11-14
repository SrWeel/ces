var xmlHttp_seleccionar

function showUser_seleccionar(str,str1,str2,str3,str4,str5,str6,str7,str8,str9,str10)
{ 
xmlHttp_seleccionar=GetXmlHttpObject_seleccionar()
if (xmlHttp_seleccionar==null)
 {
 alert ("Browser does not support HTTP Request")
 return
 }
var url="templateforms/detperfil/combo_seleccionar.php"
url=url+"?q="+str+"&q1="+str1+"&q2="+str2+"&q3="+str3+"&q4="+str4+"&q5="+str5+"&q6="+str6+"&q7="+str7+"&q8="+str8+"&q9="+str9+"&q10="+str10
url=url+"&sid="+Math.random()
xmlHttp_seleccionar.onreadystatechange=stateChanged_seleccionar 
xmlHttp_seleccionar.open("GET",url,true)
xmlHttp_seleccionar.send(null)
}

function stateChanged_seleccionar() 
{ 
document.getElementById("txtHint_seleccionar").innerHTML="..."
if (xmlHttp_seleccionar.readyState==4 || xmlHttp_seleccionar.readyState=="complete")
 { 
 document.getElementById("txtHint_seleccionar").innerHTML=xmlHttp_seleccionar.responseText 
 
 } 
}

function GetXmlHttpObject_seleccionar()
{
var xmlHttp_seleccionar=null;
try
 {
 // Firefox, Opera 8.0+, Safari
 xmlHttp_seleccionar=new XMLHttpRequest();
 }
catch (e)
 {
 //Internet Explorer
 try
  {
  xmlHttp_seleccionar=new ActiveXObject("Msxml2.XMLHTTP");
  }
 catch (e)
  {
  xmlHttp_seleccionar=new ActiveXObject("Microsoft.XMLHTTP");
  }
 }
return xmlHttp_seleccionar;
}