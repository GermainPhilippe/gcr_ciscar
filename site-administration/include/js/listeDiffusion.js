$(document).ready(function() {
 	$("#dialog").dialog({ height:600 ,width:800, autoOpen: false, modal: true });

	$('#Type').change(function(){
		if($(this).val()=='1')
		{
			$('#TypeElement option[value=1]').removeAttr('disabled');
			$('#TypeElement option[value=1]').attr('selected', 'selected');
			$('#TypeElement option[value=2]').removeAttr('disabled');
			$('#TypeElement option[value=3]').attr('disabled','disabled');
			$('#TypeElement option[value=4]').attr('disabled','disabled');
			$('#TypeElement option[value=5]').attr('disabled','disabled');
			$('#TypeElement option[value=6]').attr('disabled','disabled');
			$('#TypeElement option[value=7]').attr('disabled','disabled');
			$('#TypeElement option[value=8]').attr('disabled','disabled');
			$('#TypeElement option[value=9]').attr('disabled','disabled');
			$('#TypeElement option[value=10]').attr('disabled','disabled');
		}
		else
		{
			if($(this).val()=='2')
			{
				$('#TypeElement option[value=1]').attr('selected', 'selected');
				$('#TypeElement option[value=3]').removeAttr('disabled');
				$('#TypeElement option[value=4]').removeAttr('disabled');
				$('#TypeElement option[value=5]').removeAttr('disabled');
				$('#TypeElement option[value=6]').removeAttr('disabled');
				$('#TypeElement option[value=7]').removeAttr('disabled');
				$('#TypeElement option[value=8]').removeAttr('disabled');
				$('#TypeElement option[value=9]').removeAttr('disabled');
				$('#TypeElement option[value=10]').attr('disabled','disabled');
			}
			else
			{
				$('#TypeElement option[value=1]').attr('disabled','disabled');
				$('#TypeElement option[value=2]').attr('disabled','disabled');
				$('#TypeElement option[value=3]').attr('disabled','disabled');
				$('#TypeElement option[value=4]').attr('disabled','disabled');
				$('#TypeElement option[value=5]').attr('disabled','disabled');
				$('#TypeElement option[value=6]').attr('disabled','disabled');
				$('#TypeElement option[value=7]').attr('disabled','disabled');
				$('#TypeElement option[value=8]').attr('disabled','disabled');
				$('#TypeElement option[value=9]').attr('disabled','disabled');
				$('#TypeElement option[value=10]').removeAttr('disabled');
				$('#TypeElement option[value=10]').attr('selected', 'selected');
			}
		}
	});

});

function OpenWindowSelection(Racine)
{
	$("#CritereValue").val('');
	$("#CritereValueDisplay").val('');

	switch($("#TypeElement").val())
	{

		case '1':
			url = "ListeDiffusion_Individu.php";
			break;
		case '2':
			url = "ListeDiffusion_Etablissement.php";
			break;
		case '3':
			url = "indexSimple.php?action=viewDomaineActivite";
			break;
		case '4':
			url = "indexSimple.php?action=viewFonctionDA";
			break;
		case '5':
			url = "indexSimple.php?action=viewRegion";
			break;
		case '6':
			url = "indexSimple.php?action=viewFonctionRegion";
			break;
		case '7':
			url = "indexSimple.php?action=viewCommission";
			break;
		case '8':
			url = "indexSimple.php?action=viewGroupeLCA";
			break;	
		case '9':
			url = "indexSimple.php?action=viewRegion";
		case '10':
			url = "ListeDiffusion_Csv.php";
			break;						
		case '11':
			url = "indexSimple.php?action=viewBureauNational";
			break;						
		default:
			url = "indexSimple.php?action=";
	}
	
	url = Racine+url ;

	$("#dialogIFrame").attr("src",url);
	$("#dialog").dialog('open');

    changeTab();
}

function changeTab()
{

	if($("#CritereValueDisplay").val()!="")
	{
		$("#CritereValue").val('');
		$("#CritereValueDisplay").val('');	
		//$("#dialog").dialog( "close" );
		//$("#dialogIFrame").attr("src","#");
	}
	setTimeout(changeTab, 500);
}

function addRule(id,value)
{
	$("#CritereValue", top.document).val(id);
	$("#CritereValueDisplay", top.document).val(value);
	$("#Counter", top.document).val(parseInt($("#Counter", top.document).val())+1);
	var Compteur = $("#Counter", top.document).val();
	var Categorie = $("#Categorie", top.document).val();
	var HTML = "<tr>";
	
	HTML = HTML + "<td><input type='hidden' name='TypeElement"+Compteur+"' value='"+$("#TypeElement", top.document).val()+"'/>"+$("#TypeElement option:selected", top.document).text()+"</td>";
	if (Categorie == 'outlook')
		HTML = HTML + "<input type='hidden' name='TypeContient"+Compteur+"' value='"+$("#TypeContient", top.document).val()+"'/>";
	if (Categorie == 'news')
		HTML = HTML + "<td align='center'><input type='hidden' name='TypeContient"+Compteur+"' value='"+$("#TypeContient", top.document).val()+"'/>"+$("#TypeContient option:selected", top.document).text()+"</td>";
	if($("#CritereValueDisplay", top.document).val()!="")
		{
			HTML = HTML + "<td><input type='hidden' name='CritereValue"+Compteur+"' value='"+$("#CritereValue", top.document).val()+"'/>"+$("#CritereValueDisplay", top.document).val()+"</td>";
		}
	else
		{
			HTML = HTML + "<td><input type='hidden' name='CritereValue"+Compteur+"' value='-1'/>Tous</td>";			
		}
	HTML = HTML + "<td width='50' align='center'><a style='cursor:pointer;' onclick='$(this).parent().parent().remove();'><img src='../../include/images/bt/bt_moins.png' border=0/></a></td>";
	HTML = HTML + "</tr>";
	$("#TableList", top.document).append(HTML);

}

function addTrRule()
{
//Maj Germain 20150324 Selection de <<tous>> les éléments
//	if($("#CritereValueDisplay").val()!="")
//	{
		//Inc counter
		$("#Counter").val(parseInt($("#Counter").val())+1);
		var HTML = "<tr>";
		HTML = HTML + "<td><input type='hidden' name='TypeElement"+$("#Counter").val()+"' value='"+$("#TypeElement").val()+"'/>"+$("#TypeElement option:selected").text()+"</td>";
		HTML = HTML + "<td align='center'><input type='hidden' name='TypeContient"+$("#Counter").val()+"' value='"+$("#TypeContient").val()+"'/>"+$("#TypeContient option:selected").text()+"</td>";
		if($("#CritereValueDisplay").val()!="")
			{
				HTML = HTML + "<td><input type='hidden' name='CritereValue"+$("#Counter").val()+"' value='"+$("#CritereValue").val()+"'/>"+$("#CritereValueDisplay").val()+"</td>";
			}
		else
			{
				HTML = HTML + "<td><input type='hidden' name='CritereValue"+$("#Counter").val()+"' value='-1'/>Tous</td>";			
			}
		HTML = HTML + "<td width='50' align='center'><a style='cursor:pointer;' onclick='$(this).parent().parent().remove();'><img src='../../include/images/bt/bt_moins.png' border=0/></a></td>";
		HTML = HTML + "</tr>";
		$("#TableList").append(HTML);
		
		//RAS Ligne
		$("#CritereValue").val('');
		$("#CritereValueDisplay").val('');	
//	}
}

function addTrRuleOutlook()
{
//Maj Germain 20160525 Selection de <<tous>> les éléments
//	if($("#CritereValueDisplay").val()!="")
//	{
		//Inc counter
		$("#Counter").val(parseInt($("#Counter").val())+1);
		var HTML = "<tr>";
		HTML = HTML + "<td><input type='hidden' name='TypeElement"+$("#Counter").val()+"' value='"+$("#TypeElement").val()+"'/>"+$("#TypeElement option:selected").text()+"</td>";
		HTML = HTML + "<input type='hidden' name='TypeContient"+$("#Counter").val()+"' value='"+$("#TypeContient").val()+"'/>";
		if($("#CritereValueDisplay").val()!="")
			{
				HTML = HTML + "<td><input type='hidden' name='CritereValue"+$("#Counter").val()+"' value='"+$("#CritereValue").val()+"'/>"+$("#CritereValueDisplay").val()+"</td>";
			}
		else
			{
				HTML = HTML + "<td><input type='hidden' name='CritereValue"+$("#Counter").val()+"' value='-1'/>Tous</td>";			
			}
		HTML = HTML + "<td width='50' align='center'><a style='cursor:pointer;' onclick='$(this).parent().parent().remove();'><img src='../../include/images/bt/bt_moins.png' border=0/></a></td>";
		HTML = HTML + "</tr>";
		$("#TableList").append(HTML);
		
		//RAS Ligne
		$("#CritereValue").val('');
		$("#CritereValueDisplay").val('');	
//	}
}