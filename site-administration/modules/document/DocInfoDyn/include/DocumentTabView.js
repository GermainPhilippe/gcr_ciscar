
function displayTab(num)
{
	//hide all tab
	$(".tabDocument").hide();
	$(".linkTabDocumentCurrent").removeClass();
	$("#linkTabGeneral").addClass("linkTabDocument");
	$("#linkTabCategorie").addClass("linkTabDocument");
	$("#linkTabContenuRiche").addClass("linkTabDocument");
	$("#linkTabPublication").addClass("linkTabDocument");
	$("#linkTabSecurite").addClass("linkTabDocument");
	$("#linkTabCommentaire").addClass("linkTabDocument");
	
	switch(num)
	{
		case '1':
			$("#tabGeneral").show();
			$("#linkTabGeneral").addClass("linkTabDocumentCurrent");
			break;
		case '2':
			$("#tabCategorie").show();
			$("#linkTabCategorie").addClass("linkTabDocumentCurrent");
			break;	
		case '3':
			$("#tabContenuRiche").show();
			$("#linkTabContenuRiche").addClass("linkTabDocumentCurrent");
			break;
		case '4':
			$("#tabPublication").show();
			$("#linkTabPublication").addClass("linkTabDocumentCurrent");
			break;
		case '5':
			$("#tabSecurite").show();
			$("#linkTabSecurite").addClass("linkTabDocumentCurrent");
			break;
		case '6':
			$("#tabCommentaire").show();
			$("#linkTabCommentaire").addClass("linkTabDocumentCurrent");
			break;
	}
}

function ExpendLCATab(num)
{
	$(".lcaRow"+num).toggle()
}



function valider()
{		
	var result = true;
	var msg = "Validation du formulaire :\n";
	
	var i = 0;
	var COCHE = false;		
	for (i=0;i< document.getElementsByName("CatUne").length;i++)
	{
		if(document.getElementsByName("CatUne").item(i).checked)
		{
			COCHE = true;
			break;
		}
	}	
	
	if(!COCHE)
	{
		msg += "- Sélectionner au moins une Catégorie Principale\n";
		result=false;
	}
	
	if(document.forms[0]["Titre"].value=="")
	{
		msg += "- Titre ne peut être vide\n";
		result=false;
	}
	
	//Test Date
	if($("#DateDebut").val()!="" && $("#DateFin").val()!="")
	{
		var str1 = FRversUS(document.forms[0]['DateDebut'].value);
		var str2 = FRversUS(document.forms[0]['DateFin'].value);
		
		var yr1  = parseInt(str1.substring(0,4),10);
		var mon1 = parseInt(str1.substring(5,7),10);
		var dt1  = parseInt(str1.substring(8,10),10);
		var yr2 = parseInt(str2.substring(0,4),10);
		var mon2 = parseInt(str2.substring(5,7),10);
		var dt2  = parseInt(str2.substring(8,10),10);
	
		if(str1 > str2)
		{
			result = false;
			msg += "La date de début doit être antérieure a la date de fin";
		}
	}

	
	if(!result)
	{
		alert(msg);
	}
	return result;
}


function FRversUS(aDate)
{
	var str = aDate.split('/',3);
	if(str.lenght<3)
	{
		return aDate;
	}
	else
	{
		return str[2]+'-'+str[1]+'-'+str[0];
	}
}