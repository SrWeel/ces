var xmlHttp_dperfil

function showUser_dperfil(str,str1,str2,str3,str4,str5,str6,str7,str8,str9,str10)
{ 
xmlHttp_dperfil=GetXmlHttpObject_dperfil()
if (xmlHttp_dperfil==null)
 {
 alert ("Browser does not support HTTP Request")
 return
 }
var url="templateforms/detperfil/combo_dperfil.php"
url=url+"?q="+str+"&q1="+str1+"&q2="+str2+"&q3="+str3+"&q4="+str4+"&q5="+str5+"&q6="+str6+"&q7="+str7+"&q8="+str8+"&q9="+str9+"&q10="+str10
url=url+"&sid="+Math.random()
xmlHttp_dperfil.onreadystatechange=stateChanged_dperfil 
xmlHttp_dperfil.open("GET",url,true)
xmlHttp_dperfil.send(null)
}

function stateChanged_dperfil() 
{ 
if (xmlHttp_dperfil.readyState==4 || xmlHttp_dperfil.readyState=="complete")
 { 
 document.getElementById("txtHint_dperfil").innerHTML=xmlHttp_dperfil.responseText 
 
 } 
}

function GetXmlHttpObject_dperfil()
{
var xmlHttp_dperfil=null;
try
 {
 // Firefox, Opera 8.0+, Safari
 xmlHttp_dperfil=new XMLHttpRequest();
 }
catch (e)
 {
 //Internet Explorer
 try
  {
  xmlHttp_dperfil=new ActiveXObject("Msxml2.XMLHTTP");
  }
 catch (e)
  {
  xmlHttp_dperfil=new ActiveXObject("Microsoft.XMLHTTP");
  }
 }
return xmlHttp_dperfil;
}