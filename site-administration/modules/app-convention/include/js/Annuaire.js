function displayTab(num)
{
	//hide all tab
	$(".tabDocument").hide();
	$(".linkTabDocumentCurrent").removeClass();
	$("#linkTabUtilisateur").addClass("linkTabDocument");
	$("#linkTabSociete").addClass("linkTabDocument");
	$("#linkTabFormulaire").addClass("linkTabDocument");
	$("#linkTabInvite").addClass("linkTabDocument");
	
	switch(num)
	{
		case '1':
			$("#tabUtilisateur").show();
			$("#linkTabUtilisateur").addClass("linkTabDocumentCurrent");
			break;
		case '2':
			$("#tabSociete").show();
			$("#linkTabSociete").addClass("linkTabDocumentCurrent");
			break;	
		case '3':
			$("#tabFormulaire").show();
			$("#linkTabFormulaire").addClass("linkTabDocumentCurrent");
			break;
		case '4':
			$("#tabInvite").show();
			$("#linkTabInvite").addClass("linkTabDocumentCurrent");
			break;
	}
}


function ValidationAnnuaireForm()
{
	var result = true;
	var msg = "";
	
	if(!verifEmail(document.forms["FormAnnuaire"]["Mail"].value))
	{
		result = false;
		msg += "Mail Incorrect\n";
	}
	if(document.forms["FormAnnuaire"]["Login"].value=="")
	{
		result = false;
		msg += "Login ne peut être vide\n";
	}
	if(document.forms["FormAnnuaire"]["Password"].value=="")
	{
		result = false;
		msg += "Password ne peut être vide\n";
	}
	/*if(document.forms["FormAnnuaire"]["DomaineActiviteID"].value=='0')
	{
		result = false;
		msg += "DomaineActiviteID ne peut être vide\n";
	}*/
		
	if(!result)
	{
		alert(msg);
	}
	return result;
}