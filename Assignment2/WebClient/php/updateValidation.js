function sendIt(data, ele){
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange = function() {
		if(this.readyState == 4 && this.status == 200){
			ele.innerHTML = this.responseText;
		}
	};
	xhr.open("POST", "changeStock.php", true);
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xhr.send(data);
}

function sendInputU(inp, op, ele, id){
	var data = "op=" + encodeURI(op) +
		   "&no=" + encodeURI(inp) +
		   "&id=" + encodeURI(id);

	sendIt(data, ele);
}

function isNotEmptyU(field){
	var searchVal = field;
	var notEmpty = true;

	if (searchVal == ""){
		alert("The input bar must not be empty");
		notEmpty = false;
	}

	return notEmpty;
}


function isNumberU(field){
	var isLegal = true;
	var inputVal = field;

	for(var i = 0; i < inputVal.length; i++){
		if(isLegal){
			if(inputVal[i] < '0' || inputVal[i] > '9')
				isLegal = false;
		}
	}
	if(!isLegal)
		alert("Stock counts are generally numbers.");

	return isLegal;	
}

function isNotHackTextU(field){
	var illegals = ['"', "'", '<', '>'];
	var searchVal = field.toString();
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

function isNotHackOperationU(field){
	var legals = ["add", "sub"];
	var conVal = field;
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

function inStock(field, ope){
	var stock = field.innerHTML;
	var isLegal = true;

	if(ope == 'sub'){
		if(stock <= 0){
			isLegal = false;
			alert("None in stock!");
		}
	}
	return isLegal;
}

function valInc(inp, ope, ele, id){
	var isGood = false;

	if(isNotEmptyU(inp) && 
		isNumberU(inp) && 
		isNotHackTextU(inp) && 
		isNotHackOperationU(ope) &&
		inStock(ele, ope))
		isGood = true;
	if(isGood)
		sendInputU(inp, ope, ele, id);
}