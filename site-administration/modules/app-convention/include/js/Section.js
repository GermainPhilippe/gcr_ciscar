$(document).ready(function(){
	$("#dialog").jqm();
	
	$(".editChamp").click(function(){
		$("#myiframe").attr("src", $(this).attr("href"));
		$("#dialog").jqmShow(); 
		return false;
	});
	
	$(".deleteChamp").click(function(){
		if(confirm("Etes vous sur de vouloir supprimer ce champ?")) {
			$(this).parent().parent().remove();
		}
	});
	
	$("#applyLCAGroupe").click(function(){
		var TypeChamp = $("#myiframe").contents().find("#TypeChamp").val();	
		var NomHTML = $("#myiframe").contents().find("#NomHTML").val();
		var Libelle = $("#myiframe").contents().find("#Libelle").val();
		var Valeur = $("#myiframe").contents().find("#Valeur").val();
		var TypeChampHTML = "";
		
		switch(TypeChamp)
		{
			case '1':
				TypeChampHTML = "Champ libre";
				break;
			case '2':
				TypeChampHTML = "Liste simple";
				break;
			case '3':
				TypeChampHTML = "Liste multiple";
				break;	
			case '4':
				TypeChampHTML = "Bouton radio";
				break;	
			case '5':
				TypeChampHTML = "Case à cocher";
				break;	
			case '6':
				TypeChampHTML = "Champ Text Riche";
				break;	
			case '7':
				TypeChampHTML = "Date";
				break;					
		}
	
		
		if($("#myiframe").contents().find("#IDtr").val()>=0)
		{
			$("#tr-"+$("#myiframe").contents().find("#IDtr").val()).remove();
		}
		
		if($("#CompteurChamp").val()==0)
		{
			$("#TableChamp").html("");
			$("#TableChamp").append("<tr><td align=\"center\"><b>Type</b></td><td><b>NomHTML</b></td><td width=\"100\" align=\"center\" colspan=\"2\"><b>Action</b></td></tr>");
		}
	
		var msg = "<tr id=\"tr-"+$("#CompteurChamp").val()+"\">";
		msg += "<td><textarea id='Valeur-"+$("#CompteurChamp").val()+"' name='Valeur-"+$("#CompteurChamp").val()+"' style='display:none;'>"+Valeur+"</textarea>"+TypeChampHTML+"</td>";
		msg += "<td><textarea id='Libelle-"+$("#CompteurChamp").val()+"' name='Libelle-"+$("#CompteurChamp").val()+"' style='display:none;'>"+Libelle+"</textarea>"+NomHTML+"</td>";
		msg += "<td width='50' align='center'><input type='hidden' id='NomHTML-"+$("#CompteurChamp").val()+"' name='NomHTML-"+$("#CompteurChamp").val()+"' value='"+NomHTML+"'><a href='#' onclick='test("+$("#CompteurChamp").val()+")'><img src='../../../../../include/images/document_edit.png' border='0' /></a></td>";
		msg += "<td width='50' align='center'><input type='hidden' id='TypeChamp-"+$("#CompteurChamp").val()+"' name='TypeChamp-"+$("#CompteurChamp").val()+"' value='"+TypeChamp+"'><a href='#' onclick='$(this).parent().parent().remove();'><img src='../../../../../include/images/garbage_empty.png' border='0' /></a></b></td>";
		msg += "</tr>";
		
		$("#TableChamp").append(msg);

		$("#CompteurChamp").val(parseInt($("#CompteurChamp").val()) + 1);
	
		//init champs
		$("#myiframe").contents().find("#IDtr").val("");
		$("#myiframe").contents().find("#NomHTML").val("");
		$("#myiframe").contents().find("#Libelle").val("");
		$("#myiframe").contents().find("#Valeur").val("");
		
	});
});

function test(i)
{
	//Open form
	$("#myiframe").contents().find("#IDtr").val(i);
	$("#myiframe").contents().find("#NomHTML").val($("#NomHTML-"+i).val());
	$("#myiframe").contents().find("#Libelle").val($("#Libelle-"+i).val());
	$("#myiframe").contents().find("#Valeur").val($("#Valeur-"+i).val());
	$("#myiframe").contents().find("#TypeChamp").val($("#TypeChamp-"+i).val());
	$("#dialog").jqmShow(); 
}
