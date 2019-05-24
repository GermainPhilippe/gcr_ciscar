function OpenWindowSelection()
{
	windowParent = window.open("index.php?action=addDomaineActivite","FlashInfo");
}

function addDomaineActivite(id,value)
{
	//Inc counter
	window.opener.jQuery("#Counter").val(parseInt(window.opener.jQuery("#Counter").val())+1);
	
	HTML =  "<tr id='trDA-"+id+"'>";
	HTML = HTML + "<td><input type='hidden' name='DA"+window.opener.jQuery("#Counter").val()+"' value='" + id + "'/>" + value + "</td>";
	HTML = HTML + "<td width='50' align='center'><a style='cursor:pointer;' onclick='removeTrDA("+id+")'><img src='../../include/images/garbage_empty.png' border=0/></a></td>";
	HTML = HTML + "</tr>";
		
	window.opener.jQuery(".DestinataireTable").append(HTML);
	
	self.close();
}

$("#pElmentIDDisplay").change(function(){
	if($(this).val()=='')
	{
		$("#pElmentID").val('');
	}
});

function openWindowSelectionDocument()
{
	windowParent = window.open("../document/DocInfoDyn/PGDocInfoDyn.php?add2=","_blank");
}

function addElement(id,value)
{
	//Inc counter
	window.opener.jQuery("#pElmentID").val(id);
	window.opener.jQuery("#pElmentIDDisplay").val(value);
	self.close();
}

function removeTrDA(id)
{
	if(confirm("Confirmation de suppression"))
	{
		$("#trDA-"+id).remove();
	}
}

