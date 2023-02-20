function favorite(action, accountID, productID){
	var xhttp;
	var arr = [action, accountID, productID];
	arr = JSON.stringify(arr);
	xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function(){
	//	alert(this.responseText);
		if(this.readyState == 4 && this.status == 200){
			if(action == 1){
				document.getElementById("favBtn"+productID).style.display = "none";
				document.getElementById("notFavBtn"+productID).style.display = "inline-block";
			}else{
				document.getElementById("notFavBtn"+productID).style.display = "none";
				document.getElementById("favBtn"+productID).style.display = "inline-block";
			}
			
		}
	};
	xhttp.open("POST", "addRemoveFav.php", true);
	xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhttp.send("jsonData="+arr);
}