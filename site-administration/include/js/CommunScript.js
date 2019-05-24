
function confirmBeforeGoTo(msg, url)
{
	if(confirm(msg))
	{
		document.location.href=url;	
	}
}


//Validation de Formulaire

function isset(variable){
	if(typeof(window[variable])!="undefined"){
		return true;
	}
	else {
		return false;
	}
}

function CompareDates(str1,str2)
{
	var yr1  = parseInt(str1.substring(0,4),10);
	var mon1 = parseInt(str1.substring(5,7),10);
	var dt1  = parseInt(str1.substring(8,10),10);
	var yr2 = parseInt(str2.substring(0,4),10);
	var mon2 = parseInt(str2.substring(5,7),10);
	var dt2  = parseInt(str2.substring(8,10),10);
		
	if(yr1 <= yr2)
	{
		if(mon1<=mon2)
		{
			return (dt1<=dt2);
		}
		return false;
	}
	return false;
}


function verifEmail(myString) 
{
	var reg = /^([a-zA-Z0-9_-])+([.]?[a-zA-Z0-9_-]{1,})*@([a-zA-Z0-9-_]{2,}[.])+[a-zA-Z]{2,4}$/
	return (reg.exec(myString)!=null)
}

function verifEmailExp(myString) 
{
	var reg = /^([a-zA-Z0-9\s<_-\351])+([.]?[a-zA-Z0-9_-]{1,})*@([a-zA-Z0-9-_]{2,}[.])+[a-zA-Z]{2,4}[>]{0,1}$/
	return (reg.exec(myString)!=null)
}

function verifCodePostal(myString)
{
   var reg = /^([0-9]{5,9})$/
   return (reg.exec(myString)!=null)
}

function verifTelephone(myString)
{
   var reg = /^([0]{1}[1-9]{1}[\.\- ]?[0-9]{2}[\.\- ]?[0-9]{2}[\.\- ]?[0-9]{2}[\.\- ]?[0-9]{2})$/
   return (reg.exec(myString)!=null)
}

function verifNumeric(myString)
{
   var reg = /^([0-9]+)$/
   return (reg.exec(myString)!=null)
}
