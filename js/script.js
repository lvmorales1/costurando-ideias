$(document).ready(function(){
	lista();
	update();
});

function update(){
	
	$('#m-read1').click(function(){
		lista();
		windows.location.href = "../statuspedidocostureira.php"
	});
	$('#acei').click(function(){
		lista();
		windows.location.href = "../statuspedidoentregador.php"
	});


}



function lista(){
	var usuario = $("#m-read").val();
	$.ajax({
		type: "post",
		url: "sys/get-notifi.php?usuario="+usuario,
		success: function(textStatus){
			$("#content-notifi").html(textStatus);
		}
	});
	
}