/* function getWebSessionKey(){
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
 */
 
 function getWebSessionKey(odrNo,amt,email,phone){
	var params = "order="+odrNo+"&amt="+amt+"&email="+email+"&phone="+phone;
	var xhttp = new XMLHttpRequest();
	  xhttp.onreadystatechange = function() {
	    if (this.readyState == 4 && this.status == 200) {
			openTrupayIFrame(this.responseText,function(data){
				
	    	}, false);
	    }
	  };
	  xhttp.open("POST", "trupay/callbacks.php", true);
	  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	  xhttp.send(params);
}

