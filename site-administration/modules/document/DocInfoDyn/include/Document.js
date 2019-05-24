$(document).ready(function(){
	
	//Partie Categorie
	$("#CatType").change( function() {
		$.ajax({
		   type: "POST",
		   url: "../../categorie/metier/view/CategorieAJAX.php",
		   data: "CategorieParentID="+$("#CatType").val(),
		   success: function(msg){
				$("select#CatTheme").html(msg);
				if ($("select#CatMetier").val()!= '0')
				{
					$("a.addCategorie").html("<img src=\"../../../include/images/bt/bt_plus.png\" border=\"0\"/>");
				}
				else
				{
					$("a.addCategorie").html("<img src=\"../../../include/images/bt/bt_plus_grey.png\" border=\"0\"/>");
				}
			}
		});
		return false;
	});

	$("#CatTheme").change( function() {
		$.ajax({
		   type: "POST",
		   url: "../../categorie/metier/view/CategorieAJAX.php",
		   data: "CategorieParentID="+$("#CatTheme").val(),
		   success: function(msg){
				$("select#CatMetier").html(msg);
				if ($("select#CatMetier").val()!= '0')
				{
					$("a.addCategorie").html("<img src=\"../../../include/images/bt/bt_plus.png\" border=\"0\"/>");
				}
				else
				{
					$("a.addCategorie").html("<img src=\"../../../include/images/bt/bt_plus_grey.png\" border=\"0\"/>");
				}
			}
		});
		return false;
	});
	
	$("#CatMetier").change( function() {
		if ($("select#CatMetier").val()!= '0')
		{
			$("a.addCategorie").html("<img src=\"../../../include/images/bt/bt_plus.png\" border=\"0\"/>");
		}
		else
		{
			$("a.addCategorie").html("<img src=\"../../../include/images/bt/bt_plus_grey.png\" border=\"0\"/>");
		}
	});
	

	$("a.addCategorie").click( function() {
		if ($("select#CatMetier").val()!= '0')
		{
			var CatTypeID = $('select#CatType').val();
			var CatTypeTxt = $("select#CatType option:selected").text();
			var CatThemeID = $('select#CatTheme').val();
			var CatThemeTxt = $("select#CatTheme option:selected").text() ;
			var CatMetierID = $('select#CatMetier').val();
			var CatMetierTxt = $("select#CatMetier option:selected").text();
				
			$('#myTableCategorie').append('<tr><td><input type="hidden" name="CatRow'+$("#counterCategorie").val()+'" value="'+CatTypeID+'&'+CatThemeID+'&'+CatMetierID+'"/>'+CatTypeTxt+'</td><td>'+CatThemeTxt+'</td><td>'+CatMetierTxt+'</td><td width="50" align="center"><a href="#" onclick="removeRow(this)"><img src="../../../include/images/bt/bt_moins.png" border="0"/></a></td><td align="center"><input type="radio" value="'+CatTypeID+'" name="CatUne" /></td></tr>');
			$("select#CatType option[value='0']").attr('selected', 'selected');
			$("select#CatTheme").html("<option value=\"0\" selected=\"selected\"></option>");
			$("select#CatMetier").html("<option value=\"0\" selected=\"selected\"></option>");
			$("a.addCategorie").html("<img src=\"../../../include/images/bt/bt_plus_grey.png\" border=\"0\"/>");
			
			
			$("#counterCategorie").val($("#counterCategorie").val()+1);
		}
	});
	
	//#########################
	//#########################
	//#########################
		
	$("#LCAPublic1").change( function() {
		$("#LCATable").hide();
	});
	
	$("#LCAPublic2").change( function() {
		$("#LCATable").show();
	});
	
	
	//#########################
	//#########################
	//#########################
	
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

function removeRow(row) {
	$(row).parent().parent().remove();
}
	