function loadDoc(data, ele){
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(this.readyState == 4 && this.status == 200){
			ele.innerHTML = this.responseText;
		}
	};
	xhr.open("POST", "php/productDB.php", true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send(data);
}

function sendInput(ele){
	var data = "search=" + encodeURI(document.getElementById('search').value);
	data += "&searchBy=" + encodeURI(document.getElementById('searchBy').value);
	data += "&searchCon="+ encodeURI(document.getElementById('searchCon').value);

	loadDoc(data, ele);
}

function isNotEmpty(field){
	var searchVal = field.value;
	var notEmpty = true;

	if (searchVal == "" || searchVal.length == 0){
		alert("The search bar must not be empty");
		notEmpty = false;
	}

	return notEmpty;
}


function isNumber(field){
	var isLegal = true;
	var illegals = ['+', '-', '*', '/', '%'];
	var searchVal = field.value;

	for(var i = 0; i < illegals.length; i++){
		if(isLegal){
			if(searchVal.includes(illegals[i]))
				isLegal = false;
		}
	}
	if(isNaN(searchVal))
		isLegal = false;
	if(!isLegal)
		alert("Prices are generally numbers.");

	return isLegal;	
}

function isNotHackText(field){
	var illegals = ['"', "'", '<', '>'];
	var searchVal = field.value;
	var isLegal = true;

	for(var i = 0; i < illegals.length; i++){
		if(isLegal){
			if(searchVal.includes(illegals[i]))
				isLegal = false;
		}
	}

	if(!isLegal)
		alert("No, you don't get to drop any tables");

	return isLegal;
}

function isNotHackConstraint(field){
	var legals = ["<", "<=", "=", ">=", ">"]
	var conVal = field.value;
	var isLegal = false;

	for(var i = 0; i < legals.length; i++){
		if(!isLegal){
			if(conVal == legals[i])
				isLegal = true;
		}
	}

	if(!isLegal){
		alert("No, you don't get to drop any tables");
	}

	return isLegal;
}

function isNotHackCategory(field){
	var legals = ["name", "category", "price"]
	var catVal = field.value;
	var isLegal = false;

	for(var i = 0; i < legals.length; i++){
		if(!isLegal){
			if(catVal == legals[i])
				isLegal = true;
		}
	}

	if(!isLegal){
		alert("No, you don't get to drop any tables");
	}
	
	return isLegal;
}

function validate(s, sb, sc, ele){
	var isGood = false;

	if(sb.value == "price"){
		if(isNotEmpty(s) && 
			isNumber(s) && 
			isNotHackText(s) && 
			isNotHackConstraint(sc) &&
			isNotHackCategory(sb))
			isGood = true;
	}
	else{
		if(isNotEmpty(s) &&
		   isNotHackText(s) && 
		   isNotHackConstraint(sc) &&
		   isNotHackCategory(sb))
			isGood = true;
	}
	
	if(isGood)
		sendInput(ele);
}