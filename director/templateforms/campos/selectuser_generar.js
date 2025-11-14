var xmlHttp_generar

function showUser_generar(str,str1,str2,str3,str4,str5,str6,str7,str8,str9,str10)
{ 
xmlHttp_generar=GetXmlHttpObject_generar()
if (xmlHttp_generar==null)
 {
 alert ("Browser does not support HTTP Request")
 return
 }
var url="templateforms/campos/combo_generar.php"
url=url+"?q="+str+"&q1="+str1+"&q2="+str2+"&q3="+str3+"&q4="+str4+"&q5="+str5+"&q6="+str6+"&q7="+str7+"&q8="+str8+"&q9="+str9+"&q10="+str10
url=url+"&sid="+Math.random()
xmlHttp_generar.onreadystatechange=stateChanged_generar 
xmlHttp_generar.open("GET",url,true)
xmlHttp_generar.send(null)
}

function stateChanged_generar() 
{ 
if (xmlHttp_generar.readyState==4 || xmlHttp_generar.readyState=="complete")
 { 
 document.getElementById("txtHint_generar").innerHTML=xmlHttp_generar.responseText 
 
 } 
}

function GetXmlHttpObject_generar()
{
var xmlHttp_generar=null;
try
 {
 // Firefox, Opera 8.0+, Safari
 xmlHttp_generar=new XMLHttpRequest();
 }
catch (e)
 {
 //Internet Explorer
 try
  {
  xmlHttp_generar=new ActiveXObject("Msxml2.XMLHTTP");
  }
 catch (e)
  {
  xmlHttp_generar=new ActiveXObject("Microsoft.XMLHTTP");
  }
 }
return xmlHttp_generar;
}