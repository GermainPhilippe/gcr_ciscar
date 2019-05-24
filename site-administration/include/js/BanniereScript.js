$(document).ready(function(){
	$('#dialog').jqm({ajax:'@href',modal:true});
	$("#DateFin").datepicker( { dateFormat: 'dd/mm/yy' } );
	$("#DateDebut").datepicker( { dateFormat: 'dd/mm/yy' } );
});


function FRversUS(aDate)
{
	var str = aDate.split('/',3);
	if(str.lenght<3)
	{
		return aDate;
	}
	else
	{
		return str[1]+'/'+str[0]+'/'+str[2];
	}
}

function formValidater()
{
	var result = true;
	
	var msg = "Certain champs sont mal form�s :\n";
		
	if(document.forms['FormBanniere']['Titre'].value=='')
	{
		result = false;	
		msg += " - Titre ne peut �tre vide\n";
	}
	
	if(document.forms['FormBanniere']['ImagesURL'].value=='')
	{
		result = false;	
		msg += " - Image ne peut �tre vide\n";
	}
	
	if(document.forms['FormBanniere']['DateDebut'].value!='')
	{
		if(!isDate(FRversUS($("#DateDebut").val())))
		{
			result = false;	
			msg += " - Date D�but n'est pas une date (format : mm/dd/yyyy)\n";
		}
	}
	
	if(document.forms['FormBanniere']['DateFin'].value!='')
	{
		if(!isDate(FRversUS($("#DateFin").val())))
		{
			result = false;	
			msg += " - Date Fin n'est pas une date (format : mm/dd/yyyy)\n";
		}
	}

	if(document.forms['FormBanniere']['DateDebut'].value!='' && document.forms['FormBanniere']['DateFin'].value!='')
	{
		if(result)
		{
			if(FRversUS(document.forms['FormBanniere']['DateDebut'].value)>FRversUS(document.forms['FormBanniere']['DateFin'].value))
			{
				result = false;	
				msg += " - Date Fin doit �tre sup�rieur � Date D�but\n";
			}
		}
	}

	if(!result)
	{
		alert(msg);
	}
	return result;
}

function confirmDelete(doc_id)
{
	if(confirm("Confirmation de suppression"))
	{
		document.location.href='?action=delete&id='+doc_id;	
	}
}
