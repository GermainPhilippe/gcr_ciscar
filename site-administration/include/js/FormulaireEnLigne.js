
function valideFormQuestion()
{
	var result = true;
	var msg = "";
	
	if($("#pType").val()=="CHECKBOX" || $("#pType").val()=="RADIO" || $("#pType").val()=="LIST")
	{
		if($("#pChoix1").val()=="")
		{
			result = false;
			msg += "Le champ 'Choix 1' ne peut être vide\n";
		}
		
		if($("#pChoix2").val()=="")
		{
			result = false;
			msg += "Le champ 'Choix 2' ne peut être vide\n";
		}
	}
	
	
	if(!result)
	{
		alert(msg);
	}
	return result;
}