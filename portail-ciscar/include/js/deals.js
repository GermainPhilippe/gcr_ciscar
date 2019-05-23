function ValidationDealForm()
{
	var result = true;
	var result1 = true;
	var result2 = true;
	var msg = "";


	if (document.forms["FormDeals"]["hidIndividuID"].value == 0)
	{
		if(document.forms["FormDeals"]["nomFac"].value == '')
			result = false;
		if(document.forms["FormDeals"]["telFac"].value == '')
			result = false;

		if (!result)
			msg += "Veuillez renseigner vos données personnelles.\n"
	}

	if (document.forms["FormDeals"]["hidIndividuID"].value == 0)
		{
			if(document.forms["FormDeals"]["raisonsocialeFac"].value == '')
				result1 = false;
			if(document.forms["FormDeals"]["adresse1Fac"].value == '')
				result1 = false;
			if(document.forms["FormDeals"]["codepostalFac"].value == '')
				result1 = false;
			if(document.forms["FormDeals"]["villeFac"].value == '')
				result1 = false;

			if (!result1)
				{
				msg += "Veuillez renseigner les données de facturation.\n"
				result = false;
				}
		}
		
	if(document.forms["FormDeals"]["raisonsocialeLiv"].value == '')
		result2 = false;
	if(document.forms["FormDeals"]["destinataireLiv"].value == '')
		result2 = false;
	if(document.forms["FormDeals"]["adresse1Liv"].value == '')
		result2 = false;
	if(document.forms["FormDeals"]["codepostalLiv"].value == '')
		result2 = false;
	if(document.forms["FormDeals"]["villeLiv"].value == '')
		result2 = false;

	if (!result2)
		{
		msg += "Veuillez renseigner les données de livraison."
		result = false;
		}
	
	if(document.getElementById('mtcmd').innerHTML == '' && result)
	{
		msg += "Veuillez renseigner une quantité.";
		result = false;
	}
	
	if(document.forms["FormDeals"]["chkcp"].checked == false && result)
	{
		msg += "Veuillez prendre connaissance des conditions particulières.";
		result = false;
	}
	
	if(!result)
	{
		alert(msg);
	}

	return result;
}

function ValidationMailForm()
{
	var result = true;
	var msg = "";

	if(document.forms["FormDeals"]["mailcnx"].value == '')
	{
		msg += "Le mail est obligatoire";
		result = false;
	}
	
	if (result)
	{
		if(!verifEmail(document.forms["FormDeals"]["mailcnx"].value))
		{
			result = false;
			msg += "Mail Incorrect\n";
		}
	}
	
	if(!result)
	{
		alert(msg);
	}

	return result;
}

function ValidationConnexionForm()
{
	var result = true;
	var msg = "";

	if(document.forms["FormDeals"]["logincnx"].value == '')
	{
		msg += "L\'utilisateur est obligatoire\n";
		result = false;
	}
	if(document.forms["FormDeals"]["pwdcnx"].value == '')
	{
		msg += "Le mot de passe est obligatoire";
		result = false;
	}
	
	if(!result)
	{
		alert(msg);
	}

	return result;
}

function RecupAdrLiv(myString) 
{
	if(document.forms["FormDeals"]["chkadrliv"].checked == true )
		{
		document.forms["FormDeals"]["raisonsocialeLiv"].value = document.forms["FormDeals"]["raisonsocialeFac"].value;
		document.forms["FormDeals"]["adresse1Liv"].value = document.forms["FormDeals"]["adresse1Fac"].value;
		document.forms["FormDeals"]["adresse2Liv"].value = document.forms["FormDeals"]["adresse2Fac"].value;
		document.forms["FormDeals"]["codepostalLiv"].value = document.forms["FormDeals"]["codepostalFac"].value;
		document.forms["FormDeals"]["villeLiv"].value = document.forms["FormDeals"]["villeFac"].value;
		}

}

function verifEmail(myString) 
{
	var reg = /^([a-zA-Z0-9_-])+([.]?[a-zA-Z0-9_-]{1,})*@([a-zA-Z0-9-_]{2,}[.])+[a-zA-Z]{2,4}$/
	return (reg.exec(myString)!=null)
}