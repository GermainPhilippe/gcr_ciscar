$(document).ready(function(){ 
	$("#pParentMenu").change(function(){
		if($("#pParentMenu").val()==0)
		{
			$(".trParent").show();
			$(".trEnfant").hide();
		}
		else
		{
			$(".trParent").hide();
			$(".trEnfant").show();
		}
	});

	$("#pTypeVue").change(function(){
		$("#pElmentID").val('');
		$("#pElmentIDDisplay").val('');
	
		switch($("#pTypeVue").val())
		{
			case '8':
			case '10':
				$("#ElementSuplementaire").show();
				$("#pElmentID").show();
				$("#pElmentIDDisplay").show();
				$("#bPlus").hide();
				break;
			case '9':
				$("#ElementSuplementaire").hide();
				break;
			default:
				$("#ElementSuplementaire").show();
				$("#pElmentID").show();
				$("#pElmentIDDisplay").show();
				$("#bPlus").show();
				break;
		}
	});
});



function openWindowSelection()
{
	$("#pElmentID").val('');
	$("#pElmentIDDisplay").val('');
	
	switch($("#pTypeVue").val())
	{
		case '1':
		case '3':
			windowParent = window.open("?action=displayCategory&lvl=1","_blank","width=800,height=800,scrollbars=yes");
			break;
		case '2':
		case '4':
			windowParent = window.open("?action=displayCategory&lvl=2","_blank","width=800,height=800,scrollbars=yes");
			break;
		case '5':
			windowParent = window.open("?action=displayCategory&lvl=3","_blank","width=800,height=800,scrollbars=yes");
			break;
		case '6':
			windowParent = window.open("?action=displayDocStatic","_blank","width=800,height=800,scrollbars=yes");
			break;		
		case '7':
			windowParent = window.open("../document/DocInfoDyn/PGDocInfoDyn.php?add2=","_blank","width=800,height=800,scrollbars=yes");
			break;
	}
}

function addElement(id,value)
{
	//Inc counter
	window.opener.jQuery("#pElmentID").val(id);
	window.opener.jQuery("#pElmentIDDisplay").val(value);
	self.close();
}


function validationMenuForm()
{
	var result = true;
	var msg = "";
	
	if($("#pNom").val()=="")
	{
		result = false;
		msg += "Le champ 'Nom' ne peut être vide\n";
	}
	
	if(!result)
	{
		alert(msg);
	}
	return result;
}