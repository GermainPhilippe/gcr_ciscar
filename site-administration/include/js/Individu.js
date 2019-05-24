function displayTab(num)
{
	//hide all tab
	$(".tabDocument").hide();
	$(".linkTabDocumentCurrent").removeClass();
	$("#linkTabGeneral").addClass("linkTabDocument");
	$("#linkTabRole").addClass("linkTabDocument");
	$("#linkTabLCA").addClass("linkTabDocument");
	$("#linkTabSage").addClass("linkTabDocument");
	
	switch(num)
	{
		case '1':
			$("#tabGeneral").show();
			$("#linkTabGeneral").addClass("linkTabDocumentCurrent");
			break;
		case '2':
			$("#tabRole").show();
			$("#linkTabRole").addClass("linkTabDocumentCurrent");
			break;	
		case '3':
			$("#tabLCA").show();
			$("#linkTabLCA").addClass("linkTabDocumentCurrent");
			break;
		case '4':
			$("#tabSage").show();
			$("#linkTabSage").addClass("linkTabDocumentCurrent");
			break;
	}
}

function checkFormIndividu()
{
	var result = true;
	var resultMessage = '';

	//Nom
	if(document.forms['IndividuForm']['Nom'].value=="")
	{
		result = false;
		resultMessage = resultMessage+"le champ 'Nom' ne peut \352tre vide\n";
	}
	//Prenom
	if(document.forms['IndividuForm']['Prenom'].value=="")
	{
		result = false;
		resultMessage = resultMessage+"le champ 'Pr\351nom' ne peut \352tre vide\n";
	}
	
	//email
	if(document.forms['IndividuForm']['Mail'].value=="" || !verifEmail(document.forms['IndividuForm']['Mail'].value))
	{
		result = false;
		resultMessage = resultMessage+"le champ 'Mail' est mal form\351 ou est vide\n";
	}
	//loginRgpd
	if(document.forms['IndividuForm']['LoginRgpd'].value=="" || !verifEmail(document.forms['IndividuForm']['LoginRgpd'].value))
	{
		result = false;
		resultMessage = resultMessage+"le champ 'Mail Login RGPD' est mal form\351 ou est vide\n";
	}
	//############
	//Domaine Activit�
	if(isset('DomainActiviteID') && document.forms['IndividuForm']['DomainActiviteID'].value=="0")
	{
		result = false;
		resultMessage = resultMessage+"le champ 'Domaine Activit\351' ne peut \352tre vide\n";
	}
	//Fonction
	if(isset('FonctionDAID') && document.forms['IndividuForm']['FonctionDAID'].value=="0")
	{
		result = false;
		resultMessage = resultMessage+"le champ 'Fonction' de l'onglet 'Role' ne peut \352tre vide\n";
	}
		
	//Resultat final
	if(!result)
	{
		alert("Certains champs ne sont pas corrects : \n"+resultMessage);
	}
	
	return result;
}

function checkFormIndividuSansRole()
{
	var result = true;
	var resultMessage = '';
	
	//Nom
	if(document.forms['IndividuForm']['Nom'].value=="")
	{
		result = false;
		resultMessage = resultMessage+"le champ 'Nom' ne peut \352tre vide\n";
	}
	//Prenom
	if(document.forms['IndividuForm']['Prenom'].value=="")
	{
		result = false;
		resultMessage = resultMessage+"le champ 'Pr\351nom' ne peut \352tre vide\n";
	}
	//telephone
	if(document.forms['IndividuForm']['Telephone'].value!="")
	{
		if(!verifTelephone(document.forms['IndividuForm']['Telephone'].value))
		{
			result = false;
			resultMessage = resultMessage+"le champ 'T\351l\351phone' est mal form\351\n";
		}
	}
	//Portable
	if(document.forms['IndividuForm']['TelephonePortable'].value!="")
	{
		if(!verifTelephone(document.forms['IndividuForm']['TelephonePortable'].value))
		{
			result = false;
			resultMessage = resultMessage+"le champ 'T\351l\351phone Portable' est mal form\351\n";
		}
	}
	//fax
	if(document.forms['IndividuForm']['Fax'].value!="")
	{
		if(!verifTelephone(document.forms['IndividuForm']['Fax'].value))
		{
			result = false;
			resultMessage = resultMessage+"le champ 'Fax' est mal form\351\n";
		}
	}
	//email
	if(document.forms['IndividuForm']['Mail'].value=="" || !verifEmail(document.forms['IndividuForm']['Mail'].value))
	{
		result = false;
		resultMessage = resultMessage+"le champ 'Mail' est mal form\351 ou est vide\n";
	}
	//loginRgpd
	if(document.forms['IndividuForm']['LoginRgpd'].value=="" || !verifEmail(document.forms['IndividuForm']['LoginRgpd'].value))
	{
		result = false;
		resultMessage = resultMessage+"le champ 'Mail Login RGPD' est mal form\351 ou est vide\n";
	}				
	//Resultat final
	
	if(!result)
	{
		alert("Certains champs ne sont pas corrects : \n"+resultMessage);
	}
	return result;
}

function NotificationMail()
{
	var result = true;
	var resultMessage = '';
	if(document.forms['IndividuForm']['LoginRgpd'].value=="" || !verifEmail(document.forms['IndividuForm']['LoginRgpd'].value))
	{
		result = false;
		resultMessage = resultMessage+"le champ 'Mail Login RGPD' est mal form\351 ou est vide\n";
	}				
	if (result)
	{
		alert('Une Notification va \352tre envoy\351e \340 l\'adresse ' + document.forms['IndividuForm']['LoginRgpd'].value)
		$("#action2").val("NotificationIdentifiant");
		document.forms[0].submit();
	}
	else
	{
		alert(resultMessage);
	}
	return result;
}
