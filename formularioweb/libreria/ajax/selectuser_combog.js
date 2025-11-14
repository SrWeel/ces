var xmlHttp_combog
var divdato

function showUser_combog(str,str1,str2,str3,str4,str5,str6,str7,str8,str9,str10)
{ 
 $("#"+str2).load("libreria/ajax/combo_combog.php",{q:str,q1:str1,q2:str2,q3:str3,q4:str4,q5:str5,q6:str6,q7:str7,q8:str8,q9:str9,q10:str10},function(result){ });  
 $("#"+str2).html("Espere un momento...");

}