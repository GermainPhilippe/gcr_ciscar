function displayTab(num)
{
	//hide all tab
	$(".tabDocument").hide();
	$(".linkTabDocumentCurrent").removeClass();
	$("#linkTabGeneral").addClass("linkTabDocument");
	$("#linkTabPublication").addClass("linkTabDocument");
	$("#linkTabLCA").addClass("linkTabDocument");
	$("#linkTabPage").addClass("linkTabDocument");
	$("#linkTabModule").addClass("linkTabDocument");
	
	switch(num)
	{
		case '1':
			$("#tabGeneral").show();
			$("#linkTabGeneral").addClass("linkTabDocumentCurrent");
			break;
		case '2':
			$("#tabPublication").show();
			$("#linkTabPublication").addClass("linkTabDocumentCurrent");
			break;	
		case '3':
			$("#tabLCA").show();
			$("#linkTabLCA").addClass("linkTabDocumentCurrent");
			break;
		case '4':
			$("#tabPage").show();
			$("#linkTabPage").addClass("linkTabDocumentCurrent");
			break;
		case '5':
			$("#tabModule").show();
			$("#linkTabModule").addClass("linkTabDocumentCurrent");
			break;
	}
}









function expendModule(id)
{
	var obj = $("#ImgModule"+id);
	
	if(obj.attr("src")=="../../include/images/1.png")
	{
		if($(".module"+id).length==0)
		{
			obj.attr("src","../../include/images/delai.jpg");
			$.ajax({
			   type: "POST",
			   url: "metier/view/FormulaireSectionListAjaxView.php",
			   data: "id="+id,
			   success: function(msg){
					$("#module"+id).after(msg);
				}
			});
		}
		$(".module"+id).show();
		obj.attr("src","../../include/images/1bas.png");
	}
	else if(obj.attr("src")=="../../include/images/1bas.png")
	{
		$(".module"+id).hide();
		$(".module"+id).each(function()
		{
			$("."+$(this).attr("id")).hide();
			
		});
		obj.attr("src","../../include/images/1.png");
	}
}

function expendSection(id)
{
	var obj = $("#ImgSection"+id);
	
	$(this).attr("src","../../include/images/1bas.png");
	
	
	/*if($(this).attr("src")=="../../include/images/1.png")
	{
		if($(".section"+id).length==0)
		{
			$(this).attr("src","../../include/images/delai.jpg");
			$.ajax({
			   type: "POST",
			   url: "metier/view/FormulaireChampListAjaxView.php",
			   data: "id="+id,
			   success: function(msg){
					$("#section"+id).after(msg);
				}
			});
		}
		$(".section"+id).show();
		$(this).attr("src","../../include/images/1bas.png");
	}
	else if($(this).attr("src")=="../../include/images/1bas.png")
	{
		$(".section"+id).hide();
		$(this).attr("src","../../include/images/1.png");
	}
	else
	{
		alert($(this));
		
	}*/
}

function expendReponseChamp(id2, id)
{
	var obj = $("#ImgChamp"+id);
	
	if(obj.attr("src")=="../../include/images/1.png")
	{
		if($(".User"+id).length==0)
		{
			obj.attr("src","../../include/images/delai.jpg");
			$.ajax({
			   type: "POST",
			   url: "metier/view/FormulaireReponseListAjaxView.php",
			   data: "id="+id+"&id2="+id2,
			   success: function(msg){
					$("#User"+id).after(msg);
				}
			});
		}
		$(".User"+id).show();
		obj.attr("src","../../include/images/1bas.png");
	}
	else if(obj.attr("src")=="../../include/images/1bas.png")
	{
		$(".User"+id).hide();
		obj.attr("src","../../include/images/1.png");
	}
}



function SectionValidation()
{
	$("#ModuleID").val($("#SelectModule").val());
	
	return true;
}

function ChampValidation()
{
	var result = true;
	var msg = "";
	
	$("#SectionID").val($("#SelectSection").val());
	if($("#SectionID").val()=='')
	{
		msg += "La section est vide !";
		result = false;
	}
	
	if(!result)
	{
		alert(msg);
	}
	
	return result;
}


function FormulaireValidation()
{
	var result = true;
	var msg = "";
	
	var counter = 0;
	for(var i=1;i<=6;i++)
	{
		if(document.forms[0]['LCAGroupe'+i].checked == true)
		{
			counter++;
		}
	}
	if(counter==0)
	{
		result = false;
		msg += "Au moins 1 Type LCA doit être sélectionné";
	}
		
	if(!result)
	{
		alert(msg);
	}	
		
	return result;
}

$(document).ready(function(){
	$("#SelectType").change(function(){
		switch($("#SelectType").val())
		{
			case '1':
				$("#formModule").show();
				$("#formSection").hide();
				$("#formChamp").hide();
				$("#trModuleList").hide();
				$("#trSectionList").hide();
				break;
			case '2':
				$("#formModule").hide();
				$("#formSection").show();
				$("#formChamp").hide();
				$("#trModuleList").show();
				$("#trSectionList").hide();
				break;
			case '3':
				$("#formModule").hide();
				$("#formSection").hide();
				$("#formChamp").show();
				$("#trModuleList").show();
				$("#trSectionList").show();
				break;		
		}
	});
	
	$("#SelectModule").change(function(){
		if($("#SelectType").val()=='3')
		{
			$("#SelectSection").html("");
			$.ajax({
			   type: "POST",
			   url: "metier/view/FormulaireSectionOptionAjaxView.php",
			   data: "id="+$("#SelectModule").val(),
			   success: function(msg){
					$("#SelectSection").html(msg);
				}
			});
		}
	});
	
	$("#ChampType").change(function(){
		$("#FormChampSimple").hide();
		$("#FormChampListeSimple").hide();
		$("#FormChampListeMultiple").hide();
		$("#FormChampBoutonRadio").hide();
		$("#FormChampCaseACocher").hide();
		$("#FormChampTextRiche").hide();
		$("#FormChampDate").hide();
		
		switch($("#ChampType").val())
		{
			case '1':
				$("#FormChampSimple").show();
				break;
			case '2':
				$("#FormChampListeSimple").show();
				break;
			case '3':
				$("#FormChampListeMultiple").show();
				break;
			case '4':
				$("#FormChampBoutonRadio").show();
				break;
			case '5':
				$("#FormChampCaseACocher").show();
				break;
			case '6':
				$("#FormChampTextRiche").show();
				break;
			case '7':
				$("#FormChampDate").show();
				break;						
		}
	});
});