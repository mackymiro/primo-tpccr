function addItem(){
    var ul = document.getElementById("dynamic-list");
    var candidate = document.getElementById("candidate");
    var li = document.createElement("li");
    li.setAttribute('id',candidate.value);
	var a = document.createElement("a");
	a.setAttribute('href','#');
	
	var i = document.createElement("i");
	i.setAttribute('class','fa fa-circle text-green');
	
	a.appendChild(i);
	a.appendChild(document.createTextNode(" "+candidate.value));
	var input = document.createElement("input");
	input.setAttribute('type','checkbox');
	input.setAttribute('name','Classification[]');
	input.setAttribute('class','pull-right');
	input.setAttribute('value',candidate.value);
	input.setAttribute('checked','true');
	 
	a.appendChild(input);
	li.appendChild(a);

    ul.appendChild(li);
}

function removeItem(){
    var ul = document.getElementById("dynamic-list");
    var candidate = document.getElementById("candidate");
    var item = document.getElementById(candidate.value);
    ul.removeChild(item);
}