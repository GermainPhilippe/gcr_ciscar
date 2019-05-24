$(document).ready(function(){
	
	//Partie LCA
	
	var counterLCA = 1;
	
	$('#dialog').jqm();
	
	$(".addLCAGroupe a").click( function(){
		
		var Num = $(this).attr('id').split('-')[0];
		var action = $(this).attr('id').split('-')[1];
		var Nom = $(this).attr('id').split('-')[2];
		
		if(action=='plus')
		{
			$(this).attr('id', Num+'-moins-'+Nom);
			$(this).children("img:first-child").attr('src','../../../include/images/checkbox_checked.jpg');
		}
		else
		{
			$(this).attr("id",Num+"-plus-"+Nom);
			$(this).children("img:first-child").attr('src','../../../include/images/checkbox_empty.jpg');
		}
	});
	
	$("#applyLCAGroupe").click( function(){
		
		$('#myTable',window.parent.document).html('<tr class="title"><td>#</td><td>Nom</td></tr>');
		$("#counterLCA").val(1);
		
		$('#myiframe').contents().find('.addLCAGroupe a').each(function(){
			var Num = $(this).attr('id').split('-')[0];
			var action = $(this).attr('id').split('-')[1];
			var Nom = $(this).attr('id').split('-')[2];
			
			if(action=='moins')
			{
				$('#myTable',window.parent.document).append('<tr><td><input type="hidden" name="LCARow'+$("#counterLCA").val()+'" value="'+Num+'"/>'+Num+'</td><td>'+Nom+'</td></tr>');
				$("#counterLCA").val($("#counterLCA").val()+1);
			}
		});
	});
});
