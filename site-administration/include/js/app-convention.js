
var Convention = {};

Convention.Formulaire = {
	btNouveauChamp : function() {

		var id = document.getElementById('id').value;
		var cid = document.getElementById('cid').value;

		var selectElmt = document.getElementById('fieldSelection');
		var val = selectElmt.options[selectElmt.selectedIndex].value;

		if(val != "") {
			
			if(val == "1" || val == "2" || val == "3" || val == "4" || val == "5" || val == "101") {
				window.open('formulaireChamp.php?id='+id+'&cid='+cid+'&type='+val,"nom_popup","menubar=no, status=no, scrollbars=yes, menubar=no, width=800, height=500");
			} else {
				window.open('formulaireComposant.php?id='+id+'&cid='+cid+'&type='+val,"nom_popup","menubar=no, status=no, scrollbars=yes, menubar=no, width=800, height=500");
			}
		}
	},
	
	btEditField : function(type, compoid) {
		var fid = document.getElementById('id').value;
		var cid = document.getElementById('cid').value;
		
		window.open('formulaireChamp.php?action=edit&id='+fid+'&cid='+cid+'&type='+type+'&compoid='+compoid,"nom_popup","menubar=no, status=no, scrollbars=yes, menubar=no, width=800, height=500");
	},
	
	btEditComposant : function(type, compoid) {
		var fid = document.getElementById('id').value;
		var cid = document.getElementById('cid').value;
		
		window.open('formulaireComposant.php?action=edit&id='+fid+'&cid='+cid+'&type='+type+'&compoid='+compoid,"nom_popup","menubar=no, status=no, scrollbars=yes, menubar=no, width=800, height=500");
	}
};