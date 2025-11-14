var xmlHttp_imenu

function showUser_imenu(str,str1,str2,str3,str4,str5,str6,str7,str8,str9,str10)
{ 
xmlHttp_imenu=GetXmlHttpObject_imenu()
if (xmlHttp_imenu==null)
 {
 alert ("Browser does not support HTTP Request")
 return
 }
var url="templateforms/detperfil/combo_imenu.php"
url=url+"?q="+str+"&q1="+str1+"&q2="+str2+"&q3="+str3+"&q4="+str4+"&q5="+str5+"&q6="+str6+"&q7="+str7+"&q8="+str8+"&q9="+str9+"&q10="+str10
url=url+"&sid="+Math.random()
xmlHttp_imenu.onreadystatechange=stateChanged_imenu 
xmlHttp_imenu.open("GET",url,true)
xmlHttp_imenu.send(null)
}

function stateChanged_imenu() 
{ 
if (xmlHttp_imenu.readyState==4 || xmlHttp_imenu.readyState=="complete")
 { 
 document.getElementById("txtHint_imenu").innerHTML=xmlHttp_imenu.responseText 
 
 } 
}

function GetXmlHttpObject_imenu()
{
var xmlHttp_imenu=null;
try
 {
 // Firefox, Opera 8.0+, Safari
 xmlHttp_imenu=new XMLHttpRequest();
 }
catch (e)
 {
 //Internet Explorer
 try
  {
  xmlHttp_imenu=new ActiveXObject("Msxml2.XMLHTTP");
  }
 catch (e)
  {
  xmlHttp_imenu=new ActiveXObject("Microsoft.XMLHTTP");
  }
 }
return xmlHttp_imenu;
}