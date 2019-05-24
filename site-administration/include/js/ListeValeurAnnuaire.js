
var ListeValeurAnnuaire = {} ;

// Marque
ListeValeurAnnuaire.Marque = {
		_formIsValid : function() {
			var msg = "";
			
			var fieldNom = document.getElementById("Nom");
			if(fieldNom.value == "") {
				msg = msg += "Le champ Nom ne peut \352tre vide\n";
			}
			
			// Display Validation Error
			if(msg.length > 0) {
				alert(msg);
			}
			
			return (msg.length == 0);
		},
		btEnregistrer : function() {
			
			if(this._formIsValid()) {
				jQuery.ajax({
				   type: "POST",
				   url: "",
				   data: "Nom="+$("#Nom").val(),
				   success: function(msg){
						alert("Sauvegard\351");
					}
				});

				
			}
		},
		btEnregistrerFermer : function() { 
			if(this._formIsValid()) {
				document.forms['formMarque'].submit();
			}
		}
} ;

//Nature
ListeValeurAnnuaire.Nature = {
		_formIsValid : function() {
			var msg = "";
			
			var fieldNom = document.getElementById("Nom");
			if(fieldNom.value == "") {
				msg = msg += "Le champ Nom ne peut \352tre vide\n";
			}
			
			// Display Validation Error
			if(msg.length > 0) {
				alert(msg);
			}
			
			return (msg.length == 0);
		},
		btEnregistrer : function() {
			
			if(this._formIsValid()) {
				jQuery.ajax({
				   type: "POST",
				   url: "",
				   data: "Nom="+$("#Nom").val(),
				   success: function(msg){
						alert("Sauvegard\351");
					}
				});

				
			}
		},
		btEnregistrerFermer : function() { 
			if(this._formIsValid()) {
				document.forms['formNature'].submit();
			}
		}
};

//Langue
ListeValeurAnnuaire.Langue = {
		_formIsValid : function() {
			var msg = "";
			
			var fieldNom = document.getElementById("Nom");
			if(fieldNom.value == "") {
				msg = msg += "Le champ Langue ne peut \352tre vide\n";
			}
			
			var fieldCode = document.getElementById("Code");
			if(fieldCode.value == "") {
				msg = msg += "Le champ Code ne peut \352tre vide\n";
			}

			// Display Validation Error
			if(msg.length > 0) {
				alert(msg);
			}
			
			return (msg.length == 0);
		},
		btEnregistrer : function() {
			
			if(this._formIsValid()) {
				jQuery.ajax({
				   type: "POST",
				   url: "",
				   data: "Nom="+$("#Nom").val()+"&Code="+$("#Code").val(),
				   success: function(msg){
						alert("Sauvegard\351");
					}
				});
				
			}
		},
		btEnregistrerFermer : function() { 
			if(this._formIsValid()) {
				document.forms['formLangue'].submit();
			}
		}
};

// Typologie
ListeValeurAnnuaire.Typologie = {
		_formIsValid : function() {
			var msg = "";
			
			var fieldNom = document.getElementById("Nom");
			if(fieldNom.value == "") {
				msg = msg += "Le champ Nom ne peut \352tre vide\n";
			}
			
			// Display Validation Error
			if(msg.length > 0) {
				alert(msg);
			}
			
			return (msg.length == 0);
		},
		btEnregistrer : function() {
			
			if(this._formIsValid()) {
				jQuery.ajax({
				   type: "POST",
				   url: "",
				   data: "Nom="+$("#Nom").val(),
				   success: function(msg){
						alert("Sauvegard\351");
					}
				});

				
			}
		},
		btEnregistrerFermer : function() { 
			if(this._formIsValid()) {
				document.forms['formTypologie'].submit();
			}
		}
};

// Groupe Etablissement
ListeValeurAnnuaire.GroupeEtablissement = {
		_formIsValid : function() {
			var msg = "";
			
			var fieldNom = document.getElementById("Nom");
			if(fieldNom.value == "") {
				msg = msg += "Le champ Nom ne peut \352tre vide\n";
			}
			
			// Display Validation Error
			if(msg.length > 0) {
				alert(msg);
			}
			
			return (msg.length == 0);
		},
		btEnregistrer : function() {
			
			if(this._formIsValid()) {
				jQuery.ajax({
				   type: "POST",
				   url: "",
				   data: "Nom="+$("#Nom").val(),
				   success: function(msg){
						alert("Sauvegard\351");
					}
				});

				
			}
		},
		btEnregistrerFermer : function() { 
			if(this._formIsValid()) {
				document.forms['formGroupeEtablissement'].submit();
			}
		}
};

// Statut Etablissement
ListeValeurAnnuaire.StatutEtablissement = {
		_formIsValid : function() {
			var msg = "";
			
			var fieldNom = document.getElementById("Nom");
			if(fieldNom.value == "") {
				msg = msg += "Le champ Nom ne peut \352tre vide\n";
			}
			
			// Display Validation Error
			if(msg.length > 0) {
				alert(msg);
			}
			
			return (msg.length == 0);
		},
		btEnregistrer : function() {
			
			if(this._formIsValid()) {
				jQuery.ajax({
				   type: "POST",
				   url: "",
				   data: "Nom="+$("#Nom").val(),
				   success: function(msg){
						alert("Sauvegard\351");
					}
				});

				
			}
		},
		btEnregistrerFermer : function() { 
			if(this._formIsValid()) {
				document.forms['formStatutEtablissement'].submit();
			}
		}
};

// Fonction Commission
ListeValeurAnnuaire.FonctionCommission = {
		_formIsValid : function() {
			var msg = "";
			
			var fieldNom = document.getElementById("Nom");
			if(fieldNom.value == "") {
				msg = msg += "Le champ Nom ne peut \352tre vide\n";
			}
			
			// Display Validation Error
			if(msg.length > 0) {
				alert(msg);
			}
			
			return (msg.length == 0);
		},
		btEnregistrer : function() {
			
			if(this._formIsValid()) {
				jQuery.ajax({
				   type: "POST",
				   url: "",
				   data: "Nom="+$("#Nom").val(),
				   success: function(msg){
						alert("Sauvegard\351");
					}
				});

				
			}
		},
		btEnregistrerFermer : function() { 
			if(this._formIsValid()) {
				document.forms['formFonctionCommission'].submit();
			}
		}
};

// Fonction Delegation
ListeValeurAnnuaire.FonctionDelegation = {
		_formIsValid : function() {
			var msg = "";
			
			var fieldNom = document.getElementById("Nom");
			if(fieldNom.value == "") {
				msg = msg += "Le champ Nom ne peut \352tre vide\n";
			}
			
			// Display Validation Error
			if(msg.length > 0) {
				alert(msg);
			}
			
			return (msg.length == 0);
		},
		btEnregistrer : function() {
			
			if(this._formIsValid()) {
				jQuery.ajax({
				   type: "POST",
				   url: "",
				   data: "Nom="+$("#Nom").val(),
				   success: function(msg){
						alert("Sauvegard\351");
					}
				});

				
			}
		},
		btEnregistrerFermer : function() { 
			if(this._formIsValid()) {
				document.forms['formFonctionDelegation'].submit();
			}
		}
};

// Fonction Bureau National
ListeValeurAnnuaire.FonctionBureauNational = {
		_formIsValid : function() {
			var msg = "";
			
			var fieldNom = document.getElementById("Nom");
			if(fieldNom.value == "") {
				msg = msg += "Le champ Nom ne peut \352tre vide\n";
			}
			
			var fieldNumeroOrdre = document.getElementById("NumeroOrdre");
			if(fieldNumeroOrdre.value == "") {
				msg = msg += "Le champ Numero Ordre ne peut \352tre vide\n";
			}
			
			// Display Validation Error
			if(msg.length > 0) {
				alert(msg);
			}
			
			return (msg.length == 0);
		},
		btEnregistrer : function() {
			
			if(this._formIsValid()) {
				jQuery.ajax({
				   type: "POST",
				   url: "",
				   data: "Nom="+$("#Nom").val()+"&NumeroOrdre="+$("#NumeroOrdre").val(),
				   success: function(msg){
						alert("Sauvegard\351");
					}
				});

				
			}
		},
		btEnregistrerFermer : function() { 
			if(this._formIsValid()) {
				document.forms['formFonctionBureauNational'].submit();
			}
		}
};

//Fonction Domaine Activite
ListeValeurAnnuaire.FonctionDomaineActivite = {
		_formIsValid : function() {
			var msg = "";
			
			var fieldNom = document.getElementById("Nom");
			if(fieldNom.value == "") {
				msg = msg += "Le champ Nom ne peut \352tre vide\n";
			}
			
			var fieldNumeroOrdre = document.getElementById("NumeroOrdre");
			if(fieldNumeroOrdre.value == "") {
				msg = msg += "Le champ Numero Ordre ne peut \352tre vide\n";
			}
			
			// Display Validation Error
			if(msg.length > 0) {
				alert(msg);
			}
			
			return (msg.length == 0);
		},
		btEnregistrer : function() {
			
			if(this._formIsValid()) {
				jQuery.ajax({
				   type: "POST",
				   url: "",
				   data: "Nom="+$("#Nom").val()+"&NumeroOrdre="+$("#NumeroOrdre").val(),
				   success: function(msg){
						alert("Sauvegard\351");
					}
				});

				
			}
		},
		btEnregistrerFermer : function() { 
			if(this._formIsValid()) {
				document.forms['formFonctionDomaineActivite'].submit();
			}
		}
};

// Domaine Activite
ListeValeurAnnuaire.DomaineActivite = {
		_formIsValid : function() {
			var msg = "";
			
			var fieldNom = document.getElementById("Nom");

			if(fieldNom.value == "") {
				msg = msg += "Le champ Nom ne peut \352tre vide\n";
			}
			
			var fieldNumeroOrdre = document.getElementById("NumeroOrdre");
			if(fieldNumeroOrdre.value == "") {
				msg = msg += "Le champ Numero Ordre ne peut \352tre vide\n";
			}
			
			// Display Validation Error
			if(msg.length > 0) {
				alert(msg);
			}
			
			return (msg.length == 0);
		},
		btEnregistrer : function() {
			
			if(this._formIsValid()) {
				jQuery.ajax({
				   type: "POST",
				   url: "",
				   data: "Nom="+$("#Nom").val()+"&NumeroOrdre="+$("#NumeroOrdre").val(),
				   success: function(msg){
						alert("Sauvegard\351");
					}
				});

				
			}
		},
		btEnregistrerFermer : function() { 
			if(this._formIsValid()) {
				document.forms['formDomaineActivite'].submit();
			}
		}
};

// Commission Groupe de Travail
ListeValeurAnnuaire.CommissionGroupeTravail = {};

//Region
ListeValeurAnnuaire.Region = {
		//var departement = new Array(95);
};