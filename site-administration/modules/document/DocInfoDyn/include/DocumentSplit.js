$(document).ready(function(){
	
	loadleftColumn();
	//loadRightColumn();
	 $("#DocumentTable").tablesorter();
});

function loadleftColumn()
{
	$.ajax({
	   type: "GET",
	   url: "indexSimple.php?action=splitView_category",
	   success: function(msg){
			$("#leftColumn").html(msg);
		}
	});
	return false;
}

function emptySearchDoc()
{
	$("#Recherche").val('');
	searchDoc();
}

function expendLvl1(categorie_id)
{
	filterDoc(categorie_id);
	var ct = $(".parentCategory"+categorie_id).length;
	var obj = $("#img"+categorie_id);
	if(ct==0)
	{
		obj.attr('src','../../../include/images/delai.jpg');
		$.ajax({
			type: "GET",
			url: "indexSimple.php?action=splitView_category",
			data: "parent_id="+categorie_id,
			success: function(msg){
				$("#tr"+categorie_id).after(msg);
				obj.attr('src','../../../include/images/1bas.png');
			}
		});
	}
	else
	{
		if(obj.attr('src')=='../../../include/images/1bas.png')
		{
			obj.attr('src','../../../include/images/1.png');
			$(".parentCategory"+categorie_id).each(function()
			{
				$(this).hide();
				$(".parentCategory"+$(this).attr('id').substring(2)).each(function()
				{
					$(this).hide();
				});
			});
		}
		else
		{
			obj.attr('src','../../../include/images/1bas.png');
			$(".parentCategory"+categorie_id).each(function()
			{
				$(this).show();
				obj.attr('src','../../../include/images/1.png');
				
			});
		}
	}
	return false;
}

function expendLvl2(categorie_id)
{
	
	filterDoc(categorie_id);
	var ct = $(".parentCategory"+categorie_id).length;
	var obj = $("#img"+categorie_id);
	if(ct==0)
	{
		obj.attr('src','../../../include/images/delai.jpg');
		$.ajax({
			type: "GET",
			url: "indexSimple.php?action=splitView_category",
			data: "parent_id2="+categorie_id,
			success: function(msg){
				$("#tr"+categorie_id).after(msg);
				obj.attr('src','../../../include/images/1bas.png');
			}
		});
	}
	else
	{
		if(obj.attr('src')=='../../../include/images/1bas.png')
		{
			obj.attr('src','../../../include/images/1.png');
			$(".parentCategory"+categorie_id).each(function()
			{
				$(this).hide();
				
			});
		}
		else
		{
			obj.attr('src','../../../include/images/1bas.png');
			$(".parentCategory"+categorie_id).each(function()
			{
				$(this).show();
				
			});
		}
	}
	return false;
}
