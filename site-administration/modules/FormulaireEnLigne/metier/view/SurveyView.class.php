<?php
class SurveyView {
	private $mySurvey;
	public function __construct(Survey $aSurvey) {
		$this->mySurvey = $aSurvey;
	}
	public function renderHTML($mod) {
		$aff = '<div id="FilAriane">';
		$aff .= '<a href="../../?menu=3">Web Content</a>&nbsp;>&nbsp;<a href="?">Formulaire en ligne</a>';
		switch ($mod) {
			case 'new' :
				$aff .= '&nbsp;>&nbsp;Création';
				break;
			case 'update' :
				$aff .= '&nbsp;>&nbsp;Modification';
				break;
		}
		$aff .= '</div><br/>';

		switch ($mod) {
			case 'new' :
				$aff .= '<form method="post" action="?action=newSurvey">';
				break;
			case 'update' :
				$aff .= '<form method="post" action="?action=updateSurvey&id=' . $this->mySurvey->getID () . '">';
				$aff .= '<fieldset><legend>Actions</legend>';
				if ($this->mySurvey->getStatus () == Survey::STATUS_INPROGRESS && $this->mySurvey->getEnvoiInvitation () == '0') {
					$aff .= '<input type="button" value="Envoyer Invitation" onclick="document.location.href=\'?action=sendInvitation&id=' . $this->mySurvey->getID () . '\'">';
				}
				if ($this->mySurvey->getStatus () == Survey::STATUS_INPROGRESS && $this->mySurvey->getEnvoiInvitation () == '1' && $this->mySurvey->getEnvoiRelance () == '0') {
					$aff .= '<input type="button" value="Envoyer Relance" onclick="document.location.href=\'?action=sendInvitation&id=' . $this->mySurvey->getID () . '\'">';
				}

				switch ($this->mySurvey->getStatus ()) {
					case Survey::STATUS_DRAFT :
						$aff .= '<input type="button" value="Passer à  En Cours" onclick="document.location.href=\'?action=switchStatus&to=' . Survey::STATUS_INPROGRESS . '&id=' . $this->mySurvey->getID () . '\'">';
						break;
					case Survey::STATUS_INPROGRESS :
						$aff .= '<input type="button" value="Passer à  Cloturer" onclick="document.location.href=\'?action=switchStatus&to=' . Survey::STATUS_CLOSED . '&id=' . $this->mySurvey->getID () . '\'">';
						break;
				}
				$aff .= '</fieldset><br/>';
				break;
		}

		$aff .= '<table>';

		$aff .= '<tr>';
		$aff .= '<td width="150">Nom</td>';
		$aff .= '<td><input type="text" name="pName" value="' . stripslashes ( $this->mySurvey->getName () ) . '" size="50"></td>';
		$aff .= '</tr>';

		$aff .= '</table>';

		switch ($mod) {
			case 'new' :
				$aff .= '<input type="submit" name="submitButton" value="Créer"/></form>';
				break;
			case 'update' :
				$aff .= '<input type="submit" name="submitButton" value="Mettre à  jour"/></form>';
				break;
		}

		echo $aff;
	}
}
?>