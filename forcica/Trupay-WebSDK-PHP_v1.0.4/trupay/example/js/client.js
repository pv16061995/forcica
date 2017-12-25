function getWebSessionKey(){
	var xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
			openTrupayIFrame(this.responseText,function(data){
				//Merchant may do something here
	    	}, false);
	    }
	  };
	  xhttp.open("POST", "php/callbacks.php", true);
	  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	  xhttp.send(null);
}
