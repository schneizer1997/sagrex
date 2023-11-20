<!DOCTYPE html>
<html>
<head>
<script>
function printContent(el){
	var restorepage = document.body.innerHTML;
	var printcontent = document.getElementById(el).innerHTML;
	document.body.innerHTML = printcontent;
	window.print();
	document.body.innerHTML = restorepage;
}

</script>
</head> 
<body> 
<h1>My page</h1>
<div style="background-image:url('../requestform.png');background-repeat: no-repeat;width: 400px;height: 800px;border:1px solid yellow; ">
<div id="wew" style="width: 1000px;position: relative;">
<div style="position: absolute;top: 200px;left: 100px;" id="div1">DIV 1 content...</div>
</div>
</div>



<button onclick="printContent('wew')">Print Content</button>
<div id="div2">DIV 2 content...</div>
<button onclick="printContent('wew')">Print Content</button>
<p id="p1">Paragraph 1 content...</p>
<button onclick="printContent('wew')">Print Content</button>
</body> 
</html>