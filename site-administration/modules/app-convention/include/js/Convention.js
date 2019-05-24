
function confirmation(msg, url)
{
	if(confirm(msg))
	{
		window.location.href = url;
	}
}

function ValidateConventionForm()
{
	var result = true;
	var msg = "";
	
	/*var str1 = FRversUS(document.forms["FormConvention"]["DateDebutInscription"].value);
	var str2 = FRversUS(document.forms["FormConvention"]["DateFinInscription"].value);
	var str3 = FRversUS(document.forms["FormConvention"]["DateDebutSatisfaction"].value);
	var str4 = FRversUS(document.forms["FormConvention"]["DateFinSatisfaction"].value);*/
	
	var str1 = document.forms["FormConvention"]["DateDebutInscription"].value;
	var str2 = document.forms["FormConvention"]["DateFinInscription"].value;
	var str3 = document.forms["FormConvention"]["DateDebutSatisfaction"].value;
	var str4 = document.forms["FormConvention"]["DateFinSatisfaction"].value;
	
	if(str1=="")
	{
		result = false;
		msg += "DateDebut Inscription ne peut être vide\n";
	}
	if(str2=="")
	{
		result = false;
		msg += "DateFin Inscription ne peut être vide\n";
	}
	if(str3=="")
	{
		result = false;
		msg += "DateDebut Satisfaction ne peut être vide\n";
	}
	if(str4=="")
	{
		result = false;
		msg += "DateFin Satisfaction ne peut être vide\n";
	}
	
	if(result)
	{
		if(!(compareDateToDate(str1,str2) && compareDateToDate(str2,str3) && compareDateToDate(str3,str4)))
		{
			result = false;
			msg += "Les dates de début doivent être antérieures aux dates de fin et la phase d'inscription doit être avant la date de satisfaction\n";
		}
	}
	
	if(!result)
	{
		alert(msg);
	}
	return result;
}


function compareDateToDate(date1, date2)
{
	var str1 = date1.split('/',3);
	var str2 = date2.split('/',3);
	
	var dateObj1 = new Date(str1[2], str1[1], str1[0], 0, 0, 0);
	var dateObj2 = new Date(str2[2], str2[1], str2[0], 0, 0, 0);
	
	return (dateObj1<dateObj2);
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
