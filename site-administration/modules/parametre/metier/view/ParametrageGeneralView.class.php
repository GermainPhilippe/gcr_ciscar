<?php
class ParametrageGeneralView {
	private $myListeParam;
	function __construct($aListeParam) {
		$this->myListeParam = $aListeParam;
	}
	public function renderHTML() {
		// Navigation bar
		$aff = '<div id="FilAriane">';

		$aff .= '<a href="../../?menu=1">Général</a>&nbsp;>&nbsp;Paramètre';
		$aff .= '</div><br/><br/>';

		$aff .= '<form action="?action=general" name="formParamGeneral" method="post">';

		$aff .= '<img src="../../include/images/1.png"> Gestion des logins<br/><br/>';
		$aff .= '<table>';
		$aff .= '<tr>';
		$aff .= '<td width="150">Compteur</td>';
		$aParam = new Param ();
		$aParam->search_param ( "PASSWD_COUNTER" );
		$aff .= '<td><input type="text" id="PasswordCounter" name="PasswordCounter" size="3" value="' . $aParam->getValue () . '" /></td>';
		$aff .= '</tr>';
		$aff .= '</table>';
		if ($_SESSION ['ADMIN'] ['USER'] ['SiteName'] == 'GCR') {

			$aff .= '<br/><br/>';

			$aff .= '<img src="../../include/images/1.png"> Paramétrage de la bannière' . ($_SESSION ['ADMIN'] ['USER'] ['SiteName'] == 'CISCAR' ? ' Renault' : '') . '<br/><br/>';
			$aff .= '<table>';
			$aff .= '<tr>';
			if ($_SESSION ['ADMIN'] ['USER'] ['SiteName'] == 'GCR') {
				$aff .= '<td width="150">Bannière par défaut (799x81)</td>';
			} else {
				$aff .= '<td width="150">Bannière par défaut (760x100)</td>';
			}
			$aff .= '<td>';
			$aParam = new Param ();
			$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_WCM_DEFAULT_BANNER" );
			$aff .= '<input type="text" id="ImagesURL" name="ImagesURL" value="' . $aParam->getValue () . '" size="50"/>';
			$aff .= '</td>';
			$aff .= '<td>';
			$aff .= '<input style="width: 150px" type="button" value="Sélectionnez une image" onclick="OpenServerBrowser(\'../../include/js/fckeditor/editor/filemanager/browser/default/browser.html?Type=Image&Connector=/admin/include/js/fckeditor/editor/filemanager/connectors/php/connector.php\',800,600)"/> ou ';
			$aff .= '<input style="width: 150px" type="button" value="Sélectionnez une animation" onclick="OpenServerBrowser(\'../../include/js/fckeditor/editor/filemanager/browser/default/browser.html?Type=Flash&Connector=/admin/include/js/fckeditor/editor/filemanager/connectors/php/connector.php\',800,600)"/>';
			$aff .= '</td>';
			$aff .= '</tr>';

			$aff .= '<tr>';
			$aff .= '<td width="150">Bannière URL</td>';
			$aff .= '<td>';
			$aParam = new Param ();
			$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_WCM_DEFAULT_URL_BANNER" );
			$aff .= '<input type="text" id="BannerURL" name="BannerURL" value="' . $aParam->getValue () . '" size="50"/>';
			$aff .= '</td>';
			$aff .= '</tr>';
			$aff .= '</table>';
		}

		// if ($_SESSION ['ADMIN'] ['USER'] ['SiteName'] == 'CISCAR') {
		if ($_SESSION ['ADMIN'] ['USER'] ['SiteName'] == '') {
			$aff .= '<br/><br/>';

			$aff .= '<img src="../../include/images/1.png"> Paramétrage de la bannière Hors-Renault<br/><br/>';
			$aff .= '<table>';
			$aff .= '<tr>';
			$aff .= '<td width="150">Bannière (760x100)</td>';
			$aff .= '<td>';
			$aParam = new Param ();
			$aParam->search_param ( "CISCAR_WCM_HORS_RENAULT_BANNER" );
			$aff .= '<input type="text" id="ImagesURL4" name="ImagesURL4" value="' . $aParam->getValue () . '" size="50"/>';
			$aff .= '</td>';
			$aff .= '<td>';
			$aff .= '<input style="width: 150px" type="button" value="Sélectionnez une image" onclick="OpenServerBrowser4(\'../../include/js/fckeditor/editor/filemanager/browser/default/browser.html?Type=Image&Connector=/admin/include/js/fckeditor/editor/filemanager/connectors/php/connector.php\',800,600)"/> ou ';
			$aff .= '<input style="width: 150px" type="button" value="Sélectionnez une animation" onclick="OpenServerBrowser4(\'../../include/js/fckeditor/editor/filemanager/browser/default/browser.html?Type=Flash&Connector=/admin/include/js/fckeditor/editor/filemanager/connectors/php/connector.php\',800,600)"/>';
			$aff .= '</td>';
			$aff .= '</tr>';

			$aff .= '<tr>';
			$aff .= '<td width="150">URL</td>';
			$aff .= '<td>';
			$aParam = new Param ();
			$aParam->search_param ( "CISCAR_WCM_HORS_RENAULT_URL_BANNER" );
			$aff .= '<input type="text" id="BannerHorsRenaultURL" name="BannerHorsRenaultURL" value="' . $aParam->getValue () . '" size="50"/>';
			$aff .= '</td>';
			$aff .= '</tr>';
			$aff .= '</table>';

			// INDRA
			$aff .= '<br/><br/>';

			$aff .= '<img src="../../include/images/1.png"> Paramétrage de la bannière INDRA<br/><br/>';
			$aff .= '<table>';
			$aff .= '<tr>';
			$aff .= '<td width="150">Bannière (760x100)</td>';
			$aff .= '<td>';
			$aParam = new Param ();
			$aParam->search_param ( "CISCAR_WCM_INDRA_BANNER" );
			$aff .= '<input type="text" id="ImagesURL5" name="ImagesURL5" value="' . $aParam->getValue () . '" size="50"/>';
			$aff .= '</td>';
			$aff .= '<td>';
			$aff .= '<input style="width: 150px" type="button" value="Sélectionnez une image" onclick="OpenServerBrowser5(\'../../include/js/fckeditor/editor/filemanager/browser/default/browser.html?Type=Image&Connector=/admin/include/js/fckeditor/editor/filemanager/connectors/php/connector.php\',800,600)"/> ou ';
			$aff .= '<input style="width: 150px" type="button" value="Sélectionnez une animation" onclick="OpenServerBrowser5(\'../../include/js/fckeditor/editor/filemanager/browser/default/browser.html?Type=Flash&Connector=/admin/include/js/fckeditor/editor/filemanager/connectors/php/connector.php\',800,600)"/>';
			$aff .= '</td>';
			$aff .= '</tr>';

			$aff .= '<tr>';
			$aff .= '<td width="150">URL</td>';
			$aff .= '<td>';
			$aParam = new Param ();
			$aParam->search_param ( "CISCAR_WCM_INDRA_URL_BANNER" );
			$aff .= '<input type="text" id="BannerINDRAURL" name="BannerINDRAURL" value="' . $aParam->getValue () . '" size="50"/>';
			$aff .= '</td>';
			$aff .= '</tr>';
			$aff .= '</table>';
		}

		if ($_SESSION ['ADMIN'] ['USER'] ['SiteName'] == 'GCR') {
			$aff .= '<br/><br/>';

			$aff .= '<img src="../../include/images/1.png"> Paramétrage de l\'encart pub<br/><br/>';
			$aff .= '<table>';
			$aff .= '<tr>';
			if ($_SESSION ['ADMIN'] ['USER'] ['SiteName'] == 'GCR') {
				$aff .= '<td width="150">Bannière (Largeur 181)</td>';
			} else {
				$aff .= '<td width="150">Bannière (Largeur 171)</td>';
			}
			$aff .= '<td>';
			$aParam = new Param ();
			$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_PUB_MENU_IMAGE" );
			$aff .= '<input type="text" id="ImagesURL2" name="ImagesURL2" value="' . $aParam->getValue () . '" size="50"/>';
			$aff .= '</td>';
			$aff .= '<td>';
			$aff .= '<input style="width: 150px" type="button" value="Sélectionnez une image" onclick="OpenServerBrowser2(\'../../include/js/fckeditor/editor/filemanager/browser/default/browser.html?Type=Image&Connector=/admin/include/js/fckeditor/editor/filemanager/connectors/php/connector.php\',800,600)"/> ou ';
			$aff .= '<input style="width: 150px" type="button" value="Sélectionnez une animation" onclick="OpenServerBrowser2(\'../../include/js/fckeditor/editor/filemanager/browser/default/browser.html?Type=Flash&Connector=/admin/include/js/fckeditor/editor/filemanager/connectors/php/connector.php\',800,600)"/>';
			$aff .= '</td>';
			$aff .= '</tr>';

			$aff .= '<tr>';
			$aff .= '<td width="150">URL</td>';
			$aff .= '<td>';
			$aParam = new Param ();
			$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_PUB_MENU_URL" );
			$aff .= '<input type="text" id="PubURL" name="PubURL" value="' . $aParam->getValue () . '" size="50"/>';
			$aff .= '</td>';
			$aff .= '</tr>';
			$aff .= '</table>';
		}

		if ($_SESSION ['ADMIN'] ['USER'] ['SiteName'] == 'CISCAR') {
			$aff .= '<br/><br/>';

			$aff .= '<img src="../../include/images/1.png"> Paramétrage de l\'encart pub Homepage<br/><br/>';
			$aff .= '<table>';
			$aff .= '<tr>';
			$aff .= '<td width="150">Bannière (728x90)</td>';
			$aff .= '<td>';
			$aParam = new Param ();
			$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_PUB_HOMEPAGE_IMAGE" );
			$aff .= '<input type="text" id="ImagesURL3" name="ImagesURL3" value="' . $aParam->getValue () . '" size="50"/>';
			$aff .= '</td>';
			$aff .= '<td>';
			$aff .= '<input style="width: 150px" type="button" value="Sélectionnez une image" onclick="OpenServerBrowser3(\'../../include/js/fckeditor/editor/filemanager/browser/default/browser.html?Type=Image&Connector=/admin/include/js/fckeditor/editor/filemanager/connectors/php/connector.php\',800,600)"/> ou ';
			$aff .= '<input style="width: 150px" type="button" value="Sélectionnez une animation" onclick="OpenServerBrowser3(\'../../include/js/fckeditor/editor/filemanager/browser/default/browser.html?Type=Flash&Connector=/admin/include/js/fckeditor/editor/filemanager/connectors/php/connector.php\',800,600)"/>';
			$aff .= '</td>';
			$aff .= '</tr>';

			$aff .= '<tr>';
			$aff .= '<td width="150">URL</td>';
			$aff .= '<td>';
			$aParam = new Param ();
			$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_PUB_HOMEPAGE_URL" );
			$aff .= '<input type="text" id="PubHomepageURL" name="PubHomepageURL" value="' . $aParam->getValue () . '" size="50"/>';
			$aff .= '</td>';
			$aff .= '</tr>';
			$aff .= '</table>';

			$aff .= '<br/><br/>';

			$aff .= '<img src="../../include/images/1.png"> Activation Quest<br/><br/>';
			$aff .= '<table>';
			$aff .= '<tr>';
			$aff .= '<td width="150">Quest</td>';
			$aff .= '<td>';
			$aParam = new Param ();
			$aParam->search_param ( $_SESSION ['ADMIN'] ['USER'] ['SiteName'] . "_ACTIVATION_QUEST" );
			$aff .= '<input type="radio" id="questActivation" name="questActivation" value="1"' . ($aParam->getValue () == '1' ? ' CHECKED=CHECKED' : '') . ' />OUI';
			$aff .= '<input type="radio" id="questActivation" name="questActivation" value="0"' . ($aParam->getValue () == '0' ? ' CHECKED=CHECKED' : '') . ' />NON';
			$aff .= '</td>';
			$aff .= '</tr>';
			$aff .= '</table>';
		}

		if ($_SESSION ['ADMIN'] ['USER'] ['SiteName'] == 'GCR') {
			$aff .= '<br/><br/>';

			$aff .= '<img src="../../include/images/1.png"> Paramétrage Postit<br/><br/>';
			$aff .= '<table>';
			$aff .= '<tr>';
			$aff .= '<td width="150">URL</td>';
			$aff .= '<td>';
			$aParam = new Param ();
			$aParam->search_param ( "POSTIT_URL" );
			$aff .= '<input type="text" id="PostitURL" name="PostitURL" value="' . $aParam->getValue () . '" size="50"/>';
			$aff .= '</td>';
			$aff .= '</tr>';
			$aff .= '<tr>';
			$aff .= '<td width="150">Target</td>';
			$aff .= '<td>';
			$aParam = new Param ();
			$aParam->search_param ( "POSTIT_TARGET" );
			$aff .= '<input type="text" id="PostitTARGET" name="PostitTARGET" value="' . $aParam->getValue () . '" size="20"/>';
			$aff .= '</td>';
			$aff .= '</tr>';
			$aff .= '</table>';
		}

		$aff .= '<br><br>';

		if ($_SESSION ['ADMIN'] ['USER'] ['SiteName'] == 'CISCAR') {
			$aff .= '<input type="button" value="Enregistrer" onclick="Form.ParametreGeneral.btEnregistrerCISCAR()" /> ';
		} else {
			$aff .= '<input type="button" value="Enregistrer" onclick="Form.ParametreGeneral.btEnregistrer()" /> ';
		}
		$aff .= '<input type="button" value="Enregistrer et Fermer" onclick="Form.ParametreGeneral.btEnregistrerEtFermer()"/>';
		$aff .= '</form>';

		$aff .= '<hr>';
		$aff .= $this->renderListParamHTML ();
		echo $aff;
	}
	private function renderListParamHTML() {
		$aff = '<a style="cursor:pointer;" onclick="hideShowDivAllParameter()" id="TriggerHideShowDivAllParameter"><img src="../../include/images/1.png"> Afficher tout les paramètres</a>';

		$aff .= '<div id="AllParameter" style="display:none;">';
		$aff .= '<a style="cursor:pointer;" onclick="hideShowDivAllParameter()"><img src="../../include/images/1bas.png"> Masquer tout les paramètres</a><br/><br/>';
		// Bouton sous menu
		$aff .= '<input type="button" value="Nouveau" onclick="location.href=\'?action=c\'"/><br/>';
		$aff .= '<br/>';

		// Tableau
		$aff .= '<div style="border:solid 1px #000000;"><table cellspacing="1" cellpadding="0" id="TableList" style="width:100%">';
		$aff .= '<tr class="title">';
		$aff .= '<td align="center"><b>Nom</b></td>';
		$aff .= '<td align="center"><b>Valeur</b></td>';
		$aff .= '<td align="center" colspan="2" width="100"><b>Action</b></td>';
		$aff .= '</tr>';

		$row = 1;
		foreach ( $this->myListeParam->getParamListe () as $aParam ) {
			$aff .= '<tr>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . $aParam->getName () . '</td>';
			$tmp = stripslashes ( $aParam->getValue () );
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '">' . (strlen ( $tmp ) == 0 ? '&nbsp' : (strlen ( $tmp ) > 65) ? substr ( $tmp, 0, 64 ) . '...' : $tmp) . '</td>';

			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="?action=u&id=' . $aParam->getID () . '"><img src="../../include/images/document_edit.png" border="0"/></a></b></td>';
			$aff .= '<td align="center" class="' . ($row == 1 ? 'row1' : 'row2') . '" width="50"><b><a href="#" onclick="confirmDelete(' . $aParam->getID () . ')"><img src="../../include/images/garbage_empty.png" border="0"/></a></b></td>';
			$aff .= '</tr>';

			$row = ($row == 1 ? 2 : 1);
		}

		$aff .= '</table></div>';

		$aff .= '<script type="text/javascript">';
		$aff .= 'function confirmDelete(doc_id)
        		{
					if(confirm("Confirmation de suppression"))
					{
						document.location.href=\'?action=delete&id=\'+doc_id;	
					}
				}
				function hideShowDivAllParameter()
				{
					$("#AllParameter").toggle();
					$("#TriggerHideShowDivAllParameter").toggle();
				}
				';
		$aff .= '</script>';
		$aff .= '</div>';
		return $aff;
	}
}
?>