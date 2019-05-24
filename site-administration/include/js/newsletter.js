function displayTab(num)
{
	//hide all tab
	$(".tabDocument").hide();
	$(".linkTabDocumentCurrent").removeClass();
	$("#linkTabGeneral").addClass("linkTabDocument");
	$("#linkTabMail").addClass("linkTabDocument");
	$("#linkTabRichContent").addClass("linkTabDocument");
	$("#linkTabCssHeader").addClass("linkTabDocument");
	$("#linkTabDestinataire").addClass("linkTabDocument");
	
	switch(num)
	{
		case '1':
			$("#tabGeneral").show();
			$("#linkTabGeneral").addClass("linkTabDocumentCurrent");
			break;
		case '2':
			$("#tabMail").show();
			$("#linkTabMail").addClass("linkTabDocumentCurrent");
			break;	
		case '3':
			$("#tabRichContent").show();
			$("#linkTabRichContent").addClass("linkTabDocumentCurrent");
			break;
		case '4':
			$("#tabCssHeader").show();
			$("#linkTabCssHeader").addClass("linkTabDocumentCurrent");
			break;
		case '5':
			$("#tabDestinataire").show();
			$("#linkTabDestinataire").addClass("linkTabDocumentCurrent");
			break;
	}
}

function deleteAttachment(idAttachment, id)
{
	if(confirm("Supprimer Fichier Joint"))
	{
		$.ajax({
		   type: "GET",
		   url: "index.php?action=deleteAttachment",
		   data: "id="+idAttachment,
		   success: function(msg){
				$("#trpAttachment"+id).html("<input type=\"hidden\" name=\"MAX_FILE_SIZE\" value=\"1024000\" /><input type=\"file\" id=\"pAttachment"+id+"\" name=\"pAttachment"+id+"\" size=\"50\"/>");
		   }
		});	
	}
}

function OpenWindowSelection()
{
	windowParent = window.open("index.php?action=addDestinataire","","_parent,width=800,top=150,left=650");
}

function addDestinataire(id,value)
{
	//Inc counter
	window.opener.jQuery("#Counter").val(parseInt(window.opener.jQuery("#Counter").val())+1);
	var element = window.opener.jQuery("#ListeDiffusion-"+id);
	if(element.length)
	{
		alert ('La liste "' + value + '" a d\351j\340 \351t\351 renseign\351e. ' );
		//self.close();
	} 
	else
	{
		HTML =  "<tr id='trDestinataire-"+id+"'>";
		HTML = HTML + "<td><input type='hidden' id='ListeDiffusion-"+ id +"' name='ListeDiffusion"+window.opener.jQuery("#Counter").val()+"' value='" + id + "'/>" + value + "</td>";
		HTML = HTML + "<td width='50' align='center'><a style='cursor:pointer;' onclick='removeListeDiffusion("+id+")'><img src='../../include/images/garbage_empty.png' border=0/></a></td>";
		HTML = HTML + "</tr>";
		window.opener.jQuery(".DestinataireTable").append(HTML);	
		//if (!confirm ('La liste "' + value + '" a \351t\351 ajout\351e. \n Voulez-vous continer ? ' ))
		//	self.close();
	}
}

function validDestinataire()
{
		self.close();
}


function validationFormulaire()
{
	var result = true;
	var msg = "";
		
	if(!verifEmailExp(document.forms[0]['From'].value))
	{
		result = false;
		msg += "Le mail 'Exp\351diteur' ne peut \352tre vide !\n";
	}
	
	if(!verifEmail(document.forms[0]['ReplyTo'].value))
	{
		result = false;
		msg += "Le mail 'R\351pondre A' ne peut \352tre vide !\n";
	}
	
	if(document.forms[0]['Sujet'].value=="")
	{
		result = false;
		msg += "Le mail 'Sujet' ne peut \352tre vide !\n";
	}
	
	if(document.forms[0]['Nom'].value=="")
	{
		result = false;
		msg += "Le mail 'Nom' ne peut \352tre vide !\n";
	}
	
	if(!result)
	{
		alert(msg);
	}
	
	return result;
}

function confirmeSend(doc_id)
{
	if(confirm("Confirmation de Notification"))
	{
		document.location.href='?action=send&id='+doc_id;	
	}
}
