<?php
/**
 * @deprecated
 * Enter description here ...
 * @author fde
 *
 */
class NewsletterView {
	private $myNewsletter;
	public function __construct(Newsletter $aNewsletter) {
		$this->myNewsletter = $aNewsletter;
	}
	public function renderPreviewHTML() {
		// Navigation Bar
		$aff = '<div id="FilAriane">' . "\n";
		$aff .= '<a href="../../?menu=2">Site</a>&nbsp;>&nbsp;<a href="?">Newsletter</a>&nbsp;>&nbsp;Preview';
		$aff .= '</div><br/><br/>' . "\n";
		if ($this->myNewsletter->getCssHeader () != '') {
			$aff .= '<style type="text/css">' . $this->myNewsletter->getCssHeader () . '</style>';
		}
		$aff .= stripslashes ( $this->myNewsletter->getRichContentValue () );

		echo $aff;
	}
	public function renderHTML($mod) {
		// Navigation Bar
		$aff = '<div id="FilAriane">' . "\n";
		$aff .= '<a href="../../?menu=2">Site</a>&nbsp;>&nbsp;<a href="?">Newsletter</a>';
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
				$aff .= '<form method="post" action="?action=new" onsubmit="return validationFormulaire()">';
				break;
			case 'update' :
				$aff .= '<form method="post" action="?action=update&id=' . $_GET ['id'] . '" onsubmit="return validationFormulaire()">';
				break;
		}

		$aff .= '<table>';
		$aff .= '<tr>';
		$aff .= '<td width="100">Nom *</td><td><input type="text" id="Nom" name="Nom" value="' . $this->myNewsletter->getName () . '" size="50"/></td>';
		$aff .= '</tr>';
		$aff .= '</table><br/><br/>';

		$aff .= $this->renderMessageHTML ();

		$aff .= '<table>';
		$aff .= '<tr>';
		$aff .= '<td width="100">Style CSS</td>';
		$aff .= '<td><textarea name="pCssHeader" id="pCssHeader" rows="8" cols="100">' . $this->myNewsletter->getCssHeader () . '</textarea></td>';
		$aff .= '</tr>';
		$aff .= '</table><br/><br/>';

		$aff .= $this->renderDestinataireHTML ( $mod );

		switch ($mod) {
			case 'new' :
				$aff .= '<input type="submit" value="Créer"></form>';
				break;
			case 'update' :
				$aff .= '<input type="submit" value="Mettre à jour"></form>';
				break;
		}

		echo $aff;
	}
	private function renderMessageHTML() {
		include_once ("../../include/js/fckeditor/fckeditor.php");
		$aff = '<img src="../../include/images/1.png" border="0"/> Contenu du message<br/><br/>';

		$aff .= '<table>';
		$aff .= '<tr>';
		$aff .= '<td width="100">Expéditeur *</td><td><input type="text" id="From" name="From" size="50" value="' . $this->myNewsletter->getFrom () . '"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td width="100">Répondre A *</td><td><input type="text" id="ReplyTo" name="ReplyTo" size="50" value="' . $this->myNewsletter->getReplyTo () . '"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td width="100">Sujet *</td><td><input type="text" id="Sujet" name="Sujet" size="50" value="' . $this->myNewsletter->getSubject () . '"/></td>';
		$aff .= '</tr>';
		$aff .= '</table>';

		$oFCKeditor = new FCKeditor ( 'FCKeditor1' );
		$oFCKeditor->BasePath = '../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $this->myNewsletter->getRichContentValue () );
		$oFCKeditor->Width = '100%';
		$oFCKeditor->Height = '256';
		$oFCKeditor->ToolbarSet = 'WCM';
		$oFCKeditor->BaseHref = 'http://' . $_SERVER ['HTTP_HOST'];
		$aff .= $oFCKeditor->CreateHtml ();

		return $aff;
	}
	private function renderDestinataireHTML($mod) {
		$aArray = array ();
		$aNewsletterDestinataireManager = new NewsletterDestinataireManager ();
		if ($mod != 'new') {
			$aArray = $aNewsletterDestinataireManager->getList ( $this->myNewsletter->getID () );
		}

		$aff = '<br/><br/><img src="../../include/images/1.png" border="0"/> Destinataires<br/><br/>';
		$aff .= '<input type="button" value="Ajouter Destinataire" onclick="javascript:OpenWindowSelection()"/><br/>';
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
			$aff .= '<td><input type="hidden" name="ListeDiffusion' . $i . '" value="' . $aListeDiffusion->getID () . '"/>' . $aListeDiffusion->getNom () . '</td>';
			$aff .= '<td width="50" align="center"><a style="cursor:pointer;" onclick="removeListeDiffusion(' . $aListeDiffusion->getID () . ')"><img src="../../include/images/garbage_empty.png" border=0/></a></td>';
			$aff .= '</tr>';

			$i ++;
		}

		$aff .= '</table><br/><br/>';
		$aff .= '<script>function removeListeDiffusion(id){ if(confirm(\'Confirmation de suppression\')){ $("#trDestinataire-"+id).remove();}}</script>';
		return $aff;
	}
}
?>