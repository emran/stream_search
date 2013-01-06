function search(username)
{
var xmlhttp;
if (window.XMLHttpRequest)
  {
  // code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else if (window.ActiveXObject)
  {
  // code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
else
  {
  alert("Sorry, your browser seems to not support XMLHTTP functionality.");
  }


xmlhttp.onreadystatechange=function()
{
if(xmlhttp.readyState==4)
  {
  document.getElementById("txtResult").innerHTML=xmlhttp.responseText;
  }
}
var url="ajax_search.php";
url=url+"?q="+username;
url=url+"&sid="+Math.random();
xmlhttp.open("GET",url,true);
xmlhttp.send(null);
/*It has been assumed here that ajax_search.php is in the same directory.*/
xmlhttp.send(null);
}