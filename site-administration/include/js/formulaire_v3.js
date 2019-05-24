
var Form = {};


// Liste de valeur annuaire
Form.CommissionGroupeTravail = {
		ShowCommissionNational : function(texte) {
			if (texte=="2")
				document.getElementById("CommissionNationale").style.visibility= 'visible';
			else
				document.getElementById("CommissionNationale").style.visibility= 'hidden';
		}	
};

// Document Static
Form.DocStatic = {
		_formIsValid : function() {
			var msg = '';
			
			if(document.forms['formDocStatic']['Titre'].value=="")
			{
				msg += "Le titre ne peut �tre vide !!!";
			}
						
			// Display Validation Error
			if(msg.length > 0) {
				alert(msg);
			}
			
			return (msg.length == 0);
		},
		btEnregistrer : function() {
			
			if(this._formIsValid()) {
				
				var oEditor = FCKeditorAPI.GetInstance("FCKeditor1") ;
				var content = oEditor.GetHTML() ;
				
				jQuery.ajax({
					   type: "POST",
					   url: "",
					   data: "Titre="+ escape($("#Titre").val()) + "&FCKeditor1=" +escape(content),
					   success: function(msg){
							alert("Sauvegard\351");
						}
					});
			}
		},	
		btEnregistrerEtFermer : function() {
			if(this._formIsValid()) {
				document.forms['formDocStatic'].submit();
			}
		},
		confirmDelete : function(doc_id)
		{
			if(confirm("Confirmation de suppression"))
			{
				document.location.href='?action=delete&id='+doc_id;	
			}
		},
		ok : function(id,titre) 
		{
			var oEditor = window.opener.FCKeditorAPI.GetInstance('FCKeditor1') ;
			oEditor.InsertHtml('<a href="index.php?action=docStatic&id='+id+'">'+titre+'</a>');
			window.close();
		}   
};

// Autologin

Form.Autologin = {
		_formIsValid : function() {
			return true;
		},
		
		btEnregistrer : function() {
			var CARTERIE_PAGE_CONNEXION = FCKeditorAPI.GetInstance("CARTERIE_PAGE_CONNEXION") ;
			var CARTERIE_PAGE_CONNEXION_HTML = CARTERIE_PAGE_CONNEXION.GetHTML() ;
			
			var CARTERIE_MESSAGE_ERREUR = FCKeditorAPI.GetInstance("CARTERIE_MESSAGE_ERREUR") ;
			var CARTERIE_MESSAGE_ERREUR_HTML = CARTERIE_MESSAGE_ERREUR.GetHTML() ;
			
			var CARTERIE_MESSAGE_ERREUR_LOGIN = FCKeditorAPI.GetInstance("CARTERIE_MESSAGE_ERREUR_LOGIN") ;
			var CARTERIE_MESSAGE_ERREUR_LOGINEUR_HTML = CARTERIE_MESSAGE_ERREUR_LOGIN.GetHTML() ;
			
			var CARTERIE_CLEF_AUTOLOGIN = $("#CARTERIE_CLEF_AUTOLOGIN").val();
			
			// ###
			
			var CIS_COM_PAGE_CONNEXION = FCKeditorAPI.GetInstance("CIS-COM_PAGE_CONNEXION") ;
			var CIS_COM_PAGE_CONNEXION_HTML = CIS_COM_PAGE_CONNEXION.GetHTML() ;
			
			var CIS_COM_MESSAGE_ERREUR = FCKeditorAPI.GetInstance("CIS-COM_MESSAGE_ERREUR") ;
			var CIS_COM_MESSAGE_ERREUR_HTML = CIS_COM_MESSAGE_ERREUR.GetHTML() ;
			
			var CIS_COM_MESSAGE_ERREUR_LOGIN = FCKeditorAPI.GetInstance("CIS-COM_MESSAGE_ERREUR_LOGIN") ;
			var CIS_COM_MESSAGE_ERREUR_LOGIN_HTML = CIS_COM_MESSAGE_ERREUR_LOGIN.GetHTML() ;
			
			var CIS_COM_CLEF_AUTOLOGIN = $("#CIS-COM_CLEF_AUTOLOGIN").val();
			
			// ###
			
			var E_COMMERCE_PAGE_CONNEXION = FCKeditorAPI.GetInstance("E-COMMERCE_PAGE_CONNEXION") ;
			var E_COMMERCE_PAGE_CONNEXION_HTML = E_COMMERCE_PAGE_CONNEXION.GetHTML() ;
			
			var E_COMMERCE_MESSAGE_ERREUR = FCKeditorAPI.GetInstance("E-COMMERCE_MESSAGE_ERREUR") ;
			var E_COMMERCE_MESSAGE_ERREUR_HTML = E_COMMERCE_MESSAGE_ERREUR.GetHTML() ;
			
			var E_COMMERCE_MESSAGE_ERREUR_LOGIN = FCKeditorAPI.GetInstance("E-COMMERCE_MESSAGE_ERREUR_LOGIN") ;
			var E_COMMERCE_MESSAGE_ERREUR_LOGIN_HTML = E_COMMERCE_MESSAGE_ERREUR_LOGIN.GetHTML() ;
			
			var E_COMMERCE_CLEF_AUTOLOGIN = $("#E-COMMERCE_CLEF_AUTOLOGIN").val();
			
			jQuery.ajax({
				   type: "POST",
				   url: "?action=edit",
				   data:"CARTERIE_PAGE_CONNEXION="+ escape(CARTERIE_PAGE_CONNEXION_HTML) +
				   		"&CARTERIE_MESSAGE_ERREUR=" +escape(CARTERIE_MESSAGE_ERREUR_HTML) +
				   		"&CARTERIE_MESSAGE_ERREUR_LOGIN=" +escape(CARTERIE_MESSAGE_ERREUR_LOGINEUR_HTML) +
				   		"&CARTERIE_CLEF_AUTOLOGIN=" +escape(CARTERIE_CLEF_AUTOLOGIN) +
				   		
				   		"&CIS-COM_PAGE_CONNEXION="+ escape(CIS_COM_PAGE_CONNEXION_HTML) +
				   		"&CIS-COM_MESSAGE_ERREUR=" +escape(CIS_COM_MESSAGE_ERREUR_HTML) +
				   		"&CIS-COM_MESSAGE_ERREUR_LOGIN=" +escape(CIS_COM_MESSAGE_ERREUR_LOGIN_HTML) +
				   		"&CIS-COM_CLEF_AUTOLOGIN=" +escape(CIS_COM_CLEF_AUTOLOGIN) +
				   		
				   		"&E-COMMERCE_PAGE_CONNEXION="+ escape(E_COMMERCE_PAGE_CONNEXION_HTML) +
				   		"&E-COMMERCE_MESSAGE_ERREUR=" +escape(E_COMMERCE_MESSAGE_ERREUR_HTML) +
				   		"&E-COMMERCE_MESSAGE_ERREUR_LOGIN=" +escape(E_COMMERCE_MESSAGE_ERREUR_LOGIN_HTML) +
				   		"&E-COMMERCE_CLEF_AUTOLOGIN=" +escape(E_COMMERCE_CLEF_AUTOLOGIN),
				   success: function(msg){
						alert("Sauvegard\351");
					}
				});
		},
		btEnregistrerEtFermer : function() {
			if(this._formIsValid()) {
				document.forms['formAutologin'].submit();
			}
		}
};

// Site Emploi

Form.SiteEmploiParamAccueil = {
		_formIsValid : function() {
			return true;
		},
		
		btEnregistrer : function() {
			jQuery.ajax({
				   type: "POST",
				   url: "",
				   data:"paramemploirenault="+ escape($("#paramemploirenault").val()) +
				   		"&parampictpartenaireacc=" +escape($("#parampictpartenaireacc").val()) +
				   		"&parampictpartenairecand=" +escape($("#parampictpartenairecand").val()) +
				   		"&parampictpartenaireconcess=" +escape($("#parampictpartenaireconcess").val()) +
				   		"&paramconcess=" +escape($("#paramconcess").val()) +
				   		"&paramcandidat=" +escape($("#paramcandidat").val()) +
				   		"&paramlienconcession=" +escape($("#paramlienconcession").val()) +
				   		"&paramliencandidat=" +escape($("#paramliencandidat").val()) +
				   		"&paramlibelleco1=" +escape($("#paramlibelleco1").val()) +
				   		"&paramlibelleco2=" +escape($("#paramlibelleco2").val()) +
				   		"&paramlibelleca1=" +escape($("#paramlibelleca1").val()) +
				   		"&paramlibelleca2=" +escape($("#paramlibelleca2").val()) +
				   		"&paramlienpublicite=" +escape($("#paramlienpublicite").val()),
				   success: function(msg){
						alert("Sauvegard\351");
					}
				});
		},
		btEnregistrerEtFermer : function() {
			if(this._formIsValid()) {
				document.forms['SiteEmploiParamAccueil'].submit();
			}
		}
};

Form.DocZoom = {
		_formIsValid : function() {
			return true;
		},
		btEnregistrer : function() {
			jQuery.ajax({
				   type: "POST",
				   url: "",
				   data:"Titre="+ escape($("#Titre").val()) +
				   		"&Accroche=" +escape($("#Accroche").val()) +
				   		"&ImagesURL=" +escape($("#ImagesURL").val()) +
				   		"&NumOrdre=" +escape($("#NumOrdre").val()) +
				   		"&Publication=" +escape($("input[name=Publication]:checked").val()),
				   success: function(msg){
						alert("Sauvegard\351");
					}
				});		
		},
		btEnregistrerEtFermer : function() {
			if(this._formIsValid()) {
				document.forms['formDocZoom'].submit();
			}
		}
};

Form.ParametreGeneral = {
		_formIsValid : function() {
			return true;
		},
		btEnregistrer : function() {
			jQuery.ajax({
			   type: "POST",
			   url: "?action=general",
			   data:"PasswordCounter="+ escape($("#PasswordCounter").val()) +
			   		"&ImagesURL=" +escape($("#ImagesURL").val()) +
			   		"&BannerURL=" +escape($("#BannerURL").val()) +
			   		"&ImagesURL2=" +escape($("#ImagesURL2").val()) +
			   		"&PubURL=" +escape($("#PubURL").val())+
			   		"&PostitURL=" +escape($("#PostitURL").val())+
			   		"&PostitTARGET=" +escape($("#PostitTARGET").val()),
			   success: function(msg){
					alert("Sauvegard\351");
				}
			});		
		},
		btEnregistrerCISCAR : function() {
			jQuery.ajax({
				   type: "POST",
				   url: "?action=general",
				   data:"PasswordCounter="+ escape($("#PasswordCounter").val()) +
				   		"&ImagesURL=" +escape($("#ImagesURL").val()) +
				   		"&BannerURL=" +escape($("#BannerURL").val()) +
				   		"&ImagesURL2=" +escape($("#ImagesURL2").val()) +
				   		"&PubURL=" +escape($("#PubURL").val()) +
				   		"&ImagesURL4=" +escape($("#ImagesURL4").val()) +
				   		"&BannerHorsRenaultURL=" +escape($("#BannerHorsRenaultURL").val()) +
				   		"&ImagesURL5=" +escape($("#ImagesURL5").val()) +
				   		"&BannerINDRAURL=" +escape($("#BannerINDRAURL").val()) +
				   		"&ImagesURL3=" +escape($("#ImagesURL3").val()) + 
				   		"&PubHomepageURL=" +escape($("#PubHomepageURL").val()) +
				   		"&questActivation=" +escape($("input[name=questActivation]:checked").val()),
				   success: function(msg){
						alert("Sauvegard\351");
					}
				});		
		},
		btEnregistrerEtFermer : function() {
			if(this._formIsValid()) {
				document.forms['formParamGeneral'].submit();
			}
		}
};


Form.ParametreMail = {
		_formIsValid : function() {
			return true;
		},
		btEnregistrer : function() {
			var MAIL_LOGIN_BODY_1 = FCKeditorAPI.GetInstance("MAIL_LOGIN_BODY_1") ;
			var MAIL_LOGIN_BODY_1_HTML = MAIL_LOGIN_BODY_1.GetHTML() ;
			var MAIL_LOGIN_BODY_2 = FCKeditorAPI.GetInstance("MAIL_LOGIN_BODY_2") ;
			var MAIL_LOGIN_BODY_2_HTML = MAIL_LOGIN_BODY_2.GetHTML() ;
			
			var MAIL_ACCOUNT_BODY_1 = FCKeditorAPI.GetInstance("MAIL_ACCOUNT_BODY_1") ;
			var MAIL_ACCOUNT_BODY_1_HTML = MAIL_ACCOUNT_BODY_1.GetHTML() ;
			var MAIL_ACCOUNT_BODY_2 = FCKeditorAPI.GetInstance("MAIL_ACCOUNT_BODY_2") ;
			var MAIL_ACCOUNT_BODY_2_HTML = MAIL_ACCOUNT_BODY_2.GetHTML() ;
			
			var MAIL_COMMENT_BODY_1 = FCKeditorAPI.GetInstance("MAIL_COMMENT_BODY_1") ;
			var MAIL_COMMENT_BODY_1_HTML = MAIL_COMMENT_BODY_1.GetHTML() ;
			var MAIL_COMMENT_BODY_2 = FCKeditorAPI.GetInstance("MAIL_COMMENT_BODY_2") ;
			var MAIL_COMMENT_BODY_2_HTML = MAIL_COMMENT_BODY_2.GetHTML() ;
			
			var MAIL_SURVEY_BODY_1 = FCKeditorAPI.GetInstance("MAIL_SURVEY_BODY_1") ;
			var MAIL_SURVEY_BODY_1_HTML = MAIL_SURVEY_BODY_1.GetHTML() ;
			var MAIL_SURVEY_BODY_2 = FCKeditorAPI.GetInstance("MAIL_SURVEY_BODY_2") ;
			var MAIL_SURVEY_BODY_2_HTML = MAIL_SURVEY_BODY_2.GetHTML() ;
			
			var MAIL_SURVEY_RELANCE_BODY_1 = FCKeditorAPI.GetInstance("MAIL_SURVEY_RELANCE_BODY_1") ;
			var MAIL_SURVEY_RELANCE_BODY_1_HTML = MAIL_SURVEY_RELANCE_BODY_1.GetHTML() ;
			var MAIL_SURVEY_RELANCE_BODY_2 = FCKeditorAPI.GetInstance("MAIL_SURVEY_RELANCE_BODY_2") ;
			var MAIL_SURVEY_RELANCE_BODY_2_HTML = MAIL_SURVEY_RELANCE_BODY_2.GetHTML() ;

			var MAIL_DEAL_CMD_BODY = FCKeditorAPI.GetInstance("MAIL_DEAL_CMD_BODY") ;
			var MAIL_DEAL_CMD_BODY_HTML = MAIL_DEAL_CMD_BODY.GetHTML() ;

			jQuery.ajax({
			   type: "POST",
			   url: "?action=param",
			   data:"MAIL_LOGIN_FROM="+ escape($("#MAIL_LOGIN_FROM").val()) +
			   		"&MAIL_LOGIN_SUBJECT=" +escape($("#MAIL_LOGIN_SUBJECT").val()) +
			   		"&MAIL_LOGIN_BODY_1=" +escape(MAIL_LOGIN_BODY_1_HTML) +
			   		"&MAIL_LOGIN_BODY_2=" +escape(MAIL_LOGIN_BODY_2_HTML) +
			   		"&MAIL_ACCOUNT_FROM=" +escape($("#MAIL_ACCOUNT_FROM").val()) +
			   		"&MAIL_ACCOUNT_SUBJECT=" +escape($("#MAIL_ACCOUNT_SUBJECT").val()) +
			   		"&MAIL_ACCOUNT_BODY_1=" +escape(MAIL_ACCOUNT_BODY_1_HTML) +
			   		"&MAIL_ACCOUNT_BODY_2=" +escape(MAIL_ACCOUNT_BODY_2_HTML) +
			   		"&MAIL_COMMENT_FROM=" +escape($("#MAIL_COMMENT_FROM").val()) +
			   		"&MAIL_COMMENT_SUBJECT=" +escape($("#MAIL_COMMENT_SUBJECT").val()) +
			   		"&MAIL_COMMENT_BODY_1=" +escape(MAIL_COMMENT_BODY_1_HTML) +
			   		"&MAIL_COMMENT_BODY_2=" +escape(MAIL_COMMENT_BODY_2_HTML) +
			   		"&MAIL_SURVEY_FROM=" +escape($("#MAIL_SURVEY_FROM").val()) +
			   		"&MAIL_SURVEY_SUBJECT=" +escape($("#MAIL_SURVEY_SUBJECT").val()) +
			   		"&MAIL_SURVEY_BODY_1=" +escape(MAIL_SURVEY_BODY_1_HTML) +
			   		"&MAIL_SURVEY_BODY_2=" +escape(MAIL_SURVEY_BODY_2_HTML) +
			   		"&MAIL_SURVEY_RELANCE_FROM=" +escape($("#MAIL_SURVEY_RELANCE_FROM").val()) +
			   		"&MAIL_SURVEY_RELANCE_SUBJECT=" +escape($("#MAIL_SURVEY_RELANCE_SUBJECT").val()) +
			   		"&MAIL_SURVEY_RELANCE_BODY_1=" +escape(MAIL_SURVEY_RELANCE_BODY_1_HTML) +
			   		"&MAIL_SURVEY_RELANCE_BODY_2=" +escape(MAIL_SURVEY_RELANCE_BODY_2_HTML) +
			   		"&MAIL_DEAL_CMD_FROM=" +escape($("#MAIL_DEAL_CMD_FROM").val()) +
			   		"&MAIL_DEAL_CMD_SUBJECT=" +escape($("#MAIL_DEAL_CMD_SUBJECT").val()) +
			   		"&MAIL_DEAL_CMD_BODY=" +escape(MAIL_DEAL_CMD_BODY_HTML) ,
			   success: function(msg){
					alert("Sauvegard\351");
				}
			});		
		},
		btEnregistrerEtFermer : function() {
			if(this._formIsValid()) {
				document.forms['formParamMail'].submit();
			}
		}
};


Form.DocInfoDyn = {
		_formIsValid : function() {
			return true;
		},
		btEnregistrer : function() {
			
			var datas = $("form[name=formDocInfoDyn]").serializeArray();
			
			var FCKeditor1 = FCKeditorAPI.GetInstance("FCKeditor1") ;
			var FCKeditor1_HTML = FCKeditor1.GetHTML() ;
			
			var result = "";
			
			$.each(datas, function(i, field) {
				
				if(field['name'] == "FCKeditor1") {
					field['value'] = FCKeditor1_HTML;
				} 
				
				result += "&" + field['name'] + "=" + escape(field['value']);
				result = result.replace("%u2019","'");
				result = result.replace("%u2026","...");
				result = result.replace("&#8216;","‘");
				result = result.replace("&#8217;","’");
				result = result.replace("&#8211;","-");
				result = result.replace("&#8230;","...");
				result = result.replace("&#8482;","™");
				result = result.replace("&#8220;","“");
				result = result.replace("&#8221;","”");
			});

			jQuery.ajax({
				   type: "POST",
				   url: "",
				   data: result,
				   success: function(msg){
						alert("Sauvegard\351");
					}
				});		
		},
		btEnregistrerEtFermer : function() {
			if(this._formIsValid()) {
				document.forms['formDocInfoDyn'].submit();
			}
		}
};

Form.Individu = {
		_formIsValid : function() {
			return true;
		},
		
		checkUniqueSage : function()
		{
			okSage = true;
			var result = $("#IdSage").val();
			if (result != "")
				{
				jQuery.ajax({
					    type: "POST",
					    url: "ValidationFormSageAJAX.php?action=ValidationFormSageAJAX", 
						data: "idSage="+result,
						dataType : "text",
						async: false,
						error: function(xhr, status, error) {
							  alert(xhr.responseText);
							},
						success: function(msg, statut)
					   {
							if (msg != '')
							{
								alert('Le nom utilisateur Sage et d\351j\340 utilis\351 par '+msg);
								okSage = false;
							}
					   }
				});
				
				}
			return (okSage);

		},
		
		btEnregistrer : function() {
			if (this.checkUniqueSage() && checkFormIndividu() )
			{
				var datas = $("form[name=IndividuForm]").serializeArray();
				
				var result = "";
				$.each(datas, function(i, field) {
					result += "&" + field['name'] + "=" + escape(field['value']);
				});
	
				jQuery.ajax({
					   type: "POST",
					   url: "",
					   data: result,
					   success: function(msg){
							alert("Sauvegard\351");
						}
					});
			}
		},
		
		btEnregistrerEtFermer : function() {
			if(this._formIsValid() && checkFormIndividu()) {
				document.forms['IndividuForm'].submit();
			}
		}
};

Form.Newsletter = {
		_formIsValid : function() {
			return true;
		},
		btEnregistrer : function() {
			
			var datas = $("form[name=formNewsletter]").serializeArray();

			var FCKeditor1 = FCKeditorAPI.GetInstance("FCKeditor1") ;
			var FCKeditor1_HTML = FCKeditor1.GetHTML() ;
			
			var result = "";
			
			$.each(datas, function(i, field) {
				
				if(field['name'] == "FCKeditor1") {
					field['value'] = FCKeditor1_HTML;
				} 
				
				result += "&" + field['name'] + "=" + escape(field['value']);
			});
								
			jQuery.ajax({
				   type: "POST",
				   url: "",
				   data: result,
				   success: function(msg){
						alert("Sauvegard\351");
					}
				});		
		},
		btEnregistrerEtFermer : function() {
			if(this._formIsValid()) {
				document.forms['formNewsletter'].submit();
			}
		}
};

