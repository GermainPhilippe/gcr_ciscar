<?php
class NewsletterTabView {
	private $newsletter;
	private $attachment1;
	private $attachment2;
	private $attachment3;
	public function __construct(Newsletter $newsletter, $attachment1 = NULL, $attachment2 = NULL, $attachment3 = NULL) {
		$this->newsletter = $newsletter;
		$this->attachment1 = $attachment1;
		$this->attachment2 = $attachment2;
		$this->attachment3 = $attachment3;
	}

	// ###
	public function renderPreviewHTML() {
		// Navigation Bar
		$aff = '<div id="FilAriane">' . "\n";
		$aff .= '<a href="../../?menu=2">Site</a>&nbsp;>&nbsp;<a href="?">Newsletter</a>&nbsp;>&nbsp;Preview';
		$aff .= '</div><br/><br/>' . "\n";
		if ($this->newsletter->getCssHeader () != '') {
			$aff .= '<style type="text/css">' . $this->newsletter->getCssHeader () . '</style>';
		}
		$aff .= stripslashes ( $this->newsletter->getRichContentValue () );

		echo $aff;
	}
	public function renderHTML($mod) {
		// Navigation Bar
		$aff = '<div id="FilAriane">' . "\n";
		$aff .= '<a href="../../?menu=2">Admin</a>&nbsp;>&nbsp;';
		$aff .= '<a href="?">Newsletter</a>';
		switch ($mod) {
			case 'new' :
				$aff .= '&nbsp;>&nbsp;Création';
				break;
			case 'update' :
				$aff .= '&nbsp;>&nbsp;Modification';
				break;
		}
		$aff .= '</div><br/><br/>' . "\n";

		switch ($mod) {
			case 'new' :
				$aff .= '<form enctype="multipart/form-data" name="formNewsletter" method="post" action="?action=new" onsubmit="return validationFormulaire()">';
				break;
			case 'update' :
				$aff .= '<form enctype="multipart/form-data" name="formNewsletter" method="post" action="?action=update&id=' . $_GET ['id'] . '" onsubmit="return validationFormulaire()">';
				break;
		}
		$aff .= '<table width="100%" border="1" cellspacing="0" cellpadding="5">';
		$aff .= '<tr>';
		$aff .= '<td rowspan="5" width="100" valign="top">';
		$aff .= '	<a href="javascript:displayTab(\'1\')" class="linkTabDocumentCurrent" id="linkTabGeneral">Général</a><br/>';
		$aff .= '	<a href="javascript:displayTab(\'2\')" class="linkTabDocument" id="linkTabMail">Mail</a><br/>';
		$aff .= '	<a href="javascript:displayTab(\'3\')" class="linkTabDocument" id="linkTabRichContent">Contenu</a><br/>';
		$aff .= '	<a href="javascript:displayTab(\'4\')" class="linkTabDocument" id="linkTabCssHeader">Style CSS</a><br/>';
		$aff .= '	<a href="javascript:displayTab(\'5\')" class="linkTabDocument" id="linkTabDestinataire">Destinataire</a><br/>';
		$aff .= '</td>';
		$aff .= '<td id="tabGeneral" class="tabDocument" valign="top">';
		$aff .= $this->renderGeneralTab ( $mod );
		$aff .= '</td></tr>';
		$aff .= '<tr><td id="tabMail" class="tabDocument" style="display:none;" valign="top">';
		$aff .= $this->renderMailTab ( $mod );
		$aff .= '</td></tr>';
		$aff .= '<tr><td id="tabRichContent" class="tabDocument" style="display:none;" valign="top">';
		$aff .= $this->renderRichContentTab ( $mod );
		$aff .= '</td></tr>';
		$aff .= '<tr><td id="tabCssHeader" class="tabDocument" style="display:none;" valign="top">';
		$aff .= $this->renderCssHeaderTab ( $mod );
		$aff .= '</td></tr>';
		$aff .= '<tr><td id="tabDestinataire" class="tabDocument" style="display:none;" valign="top">';
		$aff .= $this->renderDestinataireTab ( $mod );
		$aff .= '</td></tr>';
		$aff .= '</table>';
		switch ($mod) {
			case 'new' :
				$aff .= '<input type="submit" value="Créer"></form>';
				break;
			case 'update' :
				$aff .= '<input type="button" value="Enregistrer" onclick="Form.Newsletter.btEnregistrer()" /> ';
				$aff .= '<input type="button" value="Enregistrer et Fermer" onclick="Form.Newsletter.btEnregistrerEtFermer()"/>';
				$aff .= '</form>';
				break;
		}
		echo $aff;
	}

	// ###
	private function renderGeneralTab($mod) {
		$aff = '';
		$aff .= '<table>';
		$aff .= '<tr>';
		$aff .= '<td width="100">Nom *</td><td><input type="text" id="Nom" name="Nom" value="' . stripslashes ( $this->newsletter->getName () ) . '" size="50"/></td>';
		$aff .= '</tr>';
		$aff .= '<tr>';
		$aff .= '<td width="100">Bloquer l\'envoi</td><td>';
		$aff .= '<input type="radio" name="newsBloquee" value="1"' . ($this->newsletter->getNewsBloquee () == 1 ? ' Checked' : '') . '/>OUI';
		$aff .= '<input type="radio" name="newsBloquee" value="0"' . ($this->newsletter->getNewsBloquee () != 1 ? ' Checked' : '') . '/>NON';
		$aff .= '<td></tr>';
		$aff .= '</table>';
		return $aff;
	}
	private function renderMailTab($mod) {
		$aff = '';
		$aff .= '<table>';
		$aff .= '<tr>';
		$aff .= '<td width="100">Expéditeur *</td><td><input type="text" id="From" name="From" size="50" value="' . stripslashes ( $this->newsletter->getFrom () ) . '"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td width="100">Répondre A *</td><td><input type="text" id="ReplyTo" name="ReplyTo" size="50" value="' . stripslashes ( $this->newsletter->getReplyTo () ) . '"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td width="100">Sujet *</td><td><input type="text" id="Sujet" name="Sujet" size="50" value="' . stripslashes ( $this->newsletter->getSubject () ) . '"/></td>';
		$aff .= '</tr>';

		if ($this->attachment1 == NULL) {
			$aff .= '<tr>';
			$aff .= '<td width="100">Ficher Joint 1 (1MO max)</td><td id="trpAttachment1"><input type="hidden" name="MAX_FILE_SIZE" value="1024000" /><input type="file" id="pAttachment1" name="pAttachment1" size="50"/></td>';
			$aff .= '</tr>';
		} else {
			$aff .= '<tr>';
			$aff .= '<td width="100">Ficher Joint 1</td><td id="trpAttachment1">' . $this->attachment1->getName () . ' <a href="indexSimple.php?action=getAttachment&id=' . $this->attachment1->getID () . '"><img src="../../include/images/Icone_loupe.jpg" border="0"/></a> | <a href="javascript:deleteAttachment(' . $this->attachment1->getID () . ', 1)"><img src="../../include/images/icone_non.png" border="0" /></a></td>';
			$aff .= '</tr>';
		}

		if ($this->attachment2 == NULL) {
			$aff .= '<tr>';
			$aff .= '<td width="100">Ficher Joint 2 (1MO max)</td><td id="trpAttachment2"><input type="hidden" name="MAX_FILE_SIZE" value="1024000" /><input type="file" id="pAttachment2" name="pAttachment2" size="50"/></td>';
			$aff .= '</tr>';
		} else {
			$aff .= '<tr>';
			$aff .= '<td width="100">Ficher Joint 2</td><td id="trpAttachment2">' . $this->attachment2->getName () . '<a href="indexSimple.php?action=getAttachment&id=' . $this->attachment2->getID () . '"><img src="../../include/images/Icone_loupe.jpg" border="0"/></a> |  <a href="javascript:deleteAttachment(' . $this->attachment2->getID () . ', 2)"><img src="../../include/images/icone_non.png" border="0" /></a></td>';
			$aff .= '</tr>';
		}

		if ($this->attachment3 == NULL) {
			$aff .= '<tr>';
			$aff .= '<td width="100">Ficher Joint 3 (1MO max)</td><td id="trpAttachment3"><input type="hidden" name="MAX_FILE_SIZE" value="1024000" /><input type="file" id="pAttachment3" name="pAttachment3" size="50"/></td>';
			$aff .= '</tr>';
		} else {
			$aff .= '<tr>';
			$aff .= '<td width="100">Ficher Joint 3</td><td id="trpAttachment3">' . $this->attachment3->getName () . '<a href="indexSimple.php?action=getAttachment&id=' . $this->attachment3->getID () . '"><img src="../../include/images/Icone_loupe.jpg" border="0"/></a> | <a href="javascript:deleteAttachment(' . $this->attachment3->getID () . ', 3)"><img src="../../include/images/icone_non.png" border="0" /></a></td>';
			$aff .= '</tr>';
		}
		$aff .= '</table>';
		return $aff;
	}
	private function renderRichContentTab($mod) {
		include_once ("../../include/js/fckeditor/fckeditor.php");
		$aff = '';
		$oFCKeditor = new FCKeditor ( 'FCKeditor1' );
		$oFCKeditor->BasePath = '../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $this->newsletter->getRichContentValue () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '256';
		$oFCKeditor->ToolbarSet = 'WCM';
		$oFCKeditor->BaseHref = 'http://' . $_SERVER ['HTTP_HOST'];
		$aff .= $oFCKeditor->CreateHtml ();
		return $aff;
	}
	private function renderCssHeaderTab($mod) {
		$aff = '';
		$aff .= '<textarea name="pCssHeader" id="pCssHeader" rows="8" cols="100">' . $this->newsletter->getCssHeader () . '</textarea>';
		return $aff;
	}
	private function renderDestinataireTab($mod) {
		$aArray = array ();
		$aNewsletterDestinataireManager = new NewsletterDestinataireManager ();
		if ($mod != 'new') {
			$aArray = $aNewsletterDestinataireManager->getList ( $this->newsletter->getID () );
		}

		$aff = '<input type="button" value="Ajouter Destinataire" onclick="javascript:OpenWindowSelection()"/><br/>';
		$aff .= '<input type="hidden" name="Counter" id="Counter" value="' . count ( $aArray ) . '">';
		$aff .= '<table id="TableList" class="DestinataireTable">' . "\n";
		$aff .= '<tr class="title">';
		$aff .= '<td>Nom</td>';
		$aff .= '<td width="50">Actions</td>';
		$aff .= '</tr>' . "\n";

		$i = 1;
		$aListeDiffusionManager = new ListeDiffusionManager ();
		foreach ( $aArray as $aDestinataire ) {
			$aListeDiffusion = $aListeDiffusionManager->get ( $aDestinataire->getListeDiffusionID () );
			$aff .= '<tr id="trDestinataire-' . $aListeDiffusion->getID () . '">';
			$aff .= '<td><input type="hidden" id="ListeDiffusion-' . $aListeDiffusion->getID () . '" name="ListeDiffusion' . $i . '" value="' . $aListeDiffusion->getID () . '"/>' . $aListeDiffusion->getNom () . '</td>';
			$aff .= '<td width="50" align="center"><a style="cursor:pointer;" onclick="removeListeDiffusion(' . $aListeDiffusion->getID () . ')"><img src="../../include/images/garbage_empty.png" border=0/></a></td>';
			$aff .= '</tr>';

			$i ++;
		}

		$aff .= '</table><br/><br/>';
		$aff .= '<script>function removeListeDiffusion(id){ if(confirm(\'Confirmation de suppression\')){ $("#trDestinataire-"+id).remove();}}</script>';
		return $aff;
	}
}