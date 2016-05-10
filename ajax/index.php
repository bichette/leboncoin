
<!DOCTYPE html>
<html>
	<head>
		<title>Ajax</title>
		<meta charset="UTF-8"> 
		<script src="jquery-2.2.3.js"> </script>
		<link rel="stylesheet" type="text/css" href="ajax.css"/>
		<script type="text/javascript"></script> 
		
	</head>
	
	<body>
	<header>
	
	</header>
	<!-- <input type="button" style="background-color:#3cb371" style="color:white; font-weight:bold"> -->
	
	<button type="button" id="boutonA">A</button> 
	<button type="button" id="boutonB" >B</button> 
	<button type="button" id="boutonC" >C</button> 
	
	<div id="monDiv">
	</div>
<script>
	/*	ma version	
	var elt1 = document.querySelector('#boutonA');
	elt1.addEventListener('click', function(){
		xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function(){			
			if(xhr.readyState === 4){
				if(xhr.status !== 200){
					alert('erreur');
				}
				else{
					var eltmonId = document.querySelector('#monDiv');
					eltmonId.innerHTML = xhr.responseText;
				}
			}
		}
			
		xhr.open("GET", "ajax.php?action=A", true);
		xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
		xhr.send();			
	});
	*/
	
	/* correction */
	
	$('#boutonA').click(function(){
		xhr = new XMLHttpRequest();
		xhr.onreadystatechange = function(){
			if(xhr.readyState === 4){
				if(xhr.status === 200){
					$('#monDiv').html(xhr.responseText);
				}
			}
		}
	
		xhr.open('GET', 'ajax.php?action=A');
		xhr.send();
	});
	
	/* ma version	
	$('#boutonB').click(BoutonB);
	function BoutonB(){
		$.ajax({
			async: true,
			type: 'GET',
			url: "ajax.php?action=B",
			
			error: function(errorData){
				alert('ko');
			},
			success: function(data){
				$('#monDiv').html(data);
			}
		});
	} 
	*/
	
	
	$('#boutonB').click(function(){
		$.ajax({
			async: true,
			type: 'GET',
			url: "ajax.php?action=B",
			
			error: function(errorData){
				alert('ko');
			},
			success: function(data){
				$('#monDiv').html(data);
			}
		});
	});
	
	/*
	$('#boutonC').click(BoutonC);
	function BoutonC(){
		$.ajax({
			async: true,
			type: 'GET',
			url: "ajax.php?action=C",
			
			error: function(errorData){
				alert('ko');
			},
			success: function(data){
				$('#monDiv').html(data);
			}
		});
	}
	*/
	
	$('#boutonC').click(function(){
		$.ajax({
				async: true,
				type: 'POST',
				url: "ajax.php",
				data: "action=C",				
				error: function(errorData){
					alert('ko');
				},
				success: function(data){
					$('#monDiv').html(data);
				}
			});
		});	
		
	
</script>
	

	<footer>

	</footer>

</body>
</html>
