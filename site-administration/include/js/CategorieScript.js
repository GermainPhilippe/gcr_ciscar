$(document).ready(function(){
	$("#CatType").change( function() {
		$.ajax({
		   type: "POST",
		   url: "../categorie/metier/view/CategorieAJAX.php",
		   data: "CategorieParentID="+$("#CatType").val(),
		   success: function(msg){
				$("select#CatTheme").html(msg);
				$("select#CatMetier").html("<option value=\"0\" selected=\"selected\"></option>");
		   }
		});
		return false;
	});

	$("#CatTheme").change( function() {
		$.ajax({
		   type: "POST",
		   url: "../categorie/metier/view/CategorieAJAX.php",
		   data: "CategorieParentID="+$("#CatTheme").val(),
		   success: function(msg){
				$("select#CatMetier").html(msg);
			}
		});
		return false;
	});
		
	$("#CategorieType").change( function() {
		if($("#CategorieType").val()=='1')
		{
			$("#trCatType").hide();
			$("#trCatTheme").hide();
			$(".trPicto").show();
		}
		else if($("#CategorieType").val()=='2')
		{
			$("#trCatType").show();	
			$("#trCatTheme").hide();
			$(".trPicto").hide();
		}
		else if($("#CategorieType").val()=='3')
		{
			$("#trCatType").show();	
			$("#trCatTheme").show();
			$(".trPicto").hide();
		}
	});
});

function ValidationFormCategorie()
{
	var result = true;
	if(document.forms['formCategorie']['Nom'].value=="")
	{
		result = false;
		alert("Le nom ne peut être vide");
	}
	
	return result;
}

function expendCat(lvl, typeid)
{
	var obj = $("#ImgType"+typeid);
	var ct = $(".trCat"+typeid).length;
	
	if(ct==0)
	{
		obj.attr('src','../../include/images/delai.jpg');
		$.ajax({
			type: "POST",
			url: "../categorie/metier/view/GetCategorieAJAX.php",
			data: "CategorieParentID="+typeid+"&lvl="+lvl,
			success: function(msg){
				$("#tr"+typeid).after(msg);
				obj.attr('src','../../include/images/1bas.png');
			}
		});
	}
	else
	{
		if(obj.attr('src')=='../../include/images/1bas.png')
		{
			obj.attr('src','../../include/images/1.png');
			$(".trCat"+typeid).each(function()
			{
				$(this).hide();
				
			});
		}
		else
		{
			obj.attr('src','../../include/images/1bas.png');
			$(".trCat"+typeid).each(function()
			{
				$(this).show();
				
			});
		}
	}
	return false;
}

