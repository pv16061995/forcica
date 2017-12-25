function getWebSessionKey(odrNo,amt){
	var params = "order="+odrNo+"&amt="+amt;
	var xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
			openTrupayIFrame(this.responseText,function(data){
				
	    	}, false);
	    }
	  };
	  xhttp.open("POST", "php/callbacks.php", true);
	  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	  xhttp.send(params);
}

