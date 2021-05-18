// var cari=document.getElementById('cari');
// var submit=document.getElementById('submit');
// var container=document.getElementById('container');
// cari.addEventListener('keyup',function(){
// 	var xhr=new XMLHttpRequest();
// 		xhr.onreadystatechange=function(){
// 			if (xhr.readyState==4 && xhr.status==200) {
// 				container.innerHTML=xhr.responseText;
// 			}
// 		}
// 		xhr.open('GET','ajax/warung.php?cari='+cari.value,true);
// 		xhr.send();
// });
$(document).ready(function(){
	$('#submit').hide();
	$('#cari').on('keyup',function(){
		$('.link').hide();
		$('.loader').show();
		// $('#container').load('ajax/warung.php?cari='+$('#cari').val());
		$.get('ajax/warung.php?cari='+  $('#cari').val(),function(data){
			$('.table').html(data);
			$('.loader').hide();
		});
	});
});