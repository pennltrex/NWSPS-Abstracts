/************************************************************************
 *
 *	phpAbstracts
 *  http://www.phpabstracts.com
 *
 *  Copyright (c) 2008 Omar Qazi
 *
 *  phpAbstracts is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  phpAbstracts is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with phpAbstracts.  If not, see <http://www.gnu.org/licenses/>. 
 *
************************************************************************/


var xmlHttp;

function showemails(str, str2) { 
		
	document.getElementById("emails_container").style.visibility = "visible";
	document.getElementById("emails_container").style.display = "block";
	document.getElementById("emails_container").style.backgroundColor = "#f8f8f8";
	document.getElementById("emails_container").style.border="1px solid #cccccc";
	document.getElementById("emails_container").innerHTML="<img src='images/loading.gif'> Loading...";
	
	xmlHttp=GetXmlHttpObject();
	if (xmlHttp==null) {
		alert ("Browser does not support HTTP Request");
		return;
	}
	
	var url = "list_emails_ajax.php";
	url = url + "?q=" + str + "&r=" + str2;
	url = url + "&sid=" + Math.random();
	xmlHttp.onreadystatechange = stateChanged ;
	xmlHttp.open("GET",url,true);
	xmlHttp.send(null);
}

function stateChanged() {
	if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete") { 
		 
		document.getElementById("emails_container").innerHTML=xmlHttp.responseText;
	} 
}

function GetXmlHttpObject() {
	var xmlHttp=null;
	try	{
		// Firefox, Opera 8.0+, Safari
		xmlHttp=new XMLHttpRequest();
	}
	catch (e) {
		//Internet Explorer
		try {
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e) {
			xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	return xmlHttp;
}