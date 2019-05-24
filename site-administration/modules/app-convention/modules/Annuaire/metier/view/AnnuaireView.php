<?php
/**
 * @author Florent DESPIERRES
 * @package app-convention
 * @subpackage annuaire
 * @version 1.0.4
 */
class AnnuaireView {
	private $myAnnuaire;
	private $myDR;
	public function __construct($aAnnuaire, $dr) {
		$this->myAnnuaire = $aAnnuaire;
		$this->myDR = $dr;
	}
	public function renderHTML($mod) {
		$aConvention = new Convention ();
		$aConvention->SQL_select ( $this->myAnnuaire->getConventionID () );

		if ($mod == 'edit') {
			$aff = '<div id="FilAriane"><a href="../../../../?menu=5">Convention</a>&nbsp;>&nbsp;<a href="../Convention/?">Conventions</a>&nbsp;>&nbsp;<a href="?id=' . $this->myAnnuaire->getConventionID () . '">Annuaire</a>&nbsp;>&nbsp;Edition</div><br/><br/>';
		} else {
			$aff = '<div id="FilAriane"><a href="../../../../?menu=5">Convention</a>&nbsp;>&nbsp;<a href="../Convention/?">Conventions</a>&nbsp;>&nbsp;<a href="?id=' . $_GET ['id'] . '">Annuaire</a>&nbsp;>&nbsp;Création</div><br/><br/>';
		}

		if ($mod == 'edit') {
			if ($aConvention->getStatut () == '2' || $aConvention->getStatut () == '3') {
				$aff .= '<input type="button" onclick="confirmation(\'Notifier les Identifiants ?\',\'?action=mail-passwd&id=' . $_GET ['id'] . '\')" value="Envoyer les identifiants"/> ';
				$aff .= '<input type="button" onclick="confirmation(\'Notifier la réponse ?\',\'?action=UEnvoiConfirmationInvitation&id=' . $_GET ['id'] . '\')" value="Notifier la réponse"/> ';
				if ($aConvention->getStatut () == '2') {
					$aff .= '<input type="button" onclick="confirmation(\'Envoyer le Mail Invitation ?\',\'?action=UEnvoiInvitation&id=' . $_GET ['id'] . '\')" value="Envoyer Invitation"/> ';
					$aff .= '<input type="button" onclick="confirmation(\'Envoyer le Mail de Relance ?\',\'?action=UEnvoiRelance&id=' . $_GET ['id'] . '\')" value="Envoyer Relance"/>';
				} elseif ($aConvention->getStatut () == '3') {
					$aff .= '<input type="button" onclick="confirmation(\'Envoyer le Mail de Satisfaction ?\',\'?action=UEnvoiSatisfaction&id=' . $_GET ['id'] . '\')" value="Envoyer Satisfaction"/>';
					$aff .= '<input type="button" onclick="confirmation(\'Envoyer le Mail de relance Satisfaction ?\',\'?action=UEnvoiRelanceSatisfaction&id=' . $_GET ['id'] . '\')" value="Envoyer relance Satisfaction"/>';
				}
			}
			$aff .= '<br/><br/>';
		}

		if ($aConvention->getStatut () != '4') {
			switch ($mod) {
				case 'new' :
					$aff .= '<form method="POST" name="FormAnnuaire" action="?action=new&id=' . $_GET ['id'] . '" onsubmit="return ValidationAnnuaireForm()">';
					break;
				case 'edit' :
					$aff .= '<form method="POST" name="FormAnnuaire" action="?action=edit&id=' . $this->myAnnuaire->getID () . '" onsubmit="return ValidationAnnuaireForm()">';
					break;
			}
		}

		$aff .= '<table width="100%" border="1" cellspacing="0" cellpadding="5">';
		$aff .= '<tr>';
		$aff .= '<td rowspan="4" width="100" valign="top">';
		$aff .= '	<a href="javascript:displayTab(\'1\')" class="linkTabDocumentCurrent" id="linkTabUtilisateur">Infos Utilisateur</a><br/>';
		$aff .= '	<a href="javascript:displayTab(\'2\')" class="linkTabDocument" id="linkTabSociete">Infos Société</a><br/>';
		$aff .= '	<a href="javascript:displayTab(\'3\')" class="linkTabDocument" id="linkTabFormulaire">Infos Formulaire</a><br/>';
		$aff .= '	<a href="javascript:displayTab(\'4\')" class="linkTabDocument" id="linkTabInvite">Invité(s)</a><br/>';
		$aff .= '</td>';

		$aff .= '<td class="tabDocument" valign="top" id="tabUtilisateur">';
		$aff .= $this->renderHTMLGeneral ();
		$aff .= '</td></tr>';

		$aff .= '<tr><td style="display:none;" class="tabDocument" valign="top" id="tabSociete">';
		$aff .= $this->rendreHTMLSociete ();
		$aff .= '</td></tr>';

		$aff .= '<tr><td style="display:none;" class="tabDocument" valign="top" id="tabFormulaire">';
		$aff .= $this->renderHTMLInfoComplementaire ();
		$aff .= '</td></tr>';

		$aff .= '<tr><td style="display:none;" class="tabDocument" valign="top" id="tabInvite">';
		$aff .= $this->renderHTMLInvite ();
		$aff .= '</td></tr>';
		$aff .= '</table>';

		if ($aConvention->getStatut () != '4') {
			switch ($mod) {
				case 'new' :
					$aff .= '<p><input type="submit" value="Créer"/></p>';
					break;
				case 'edit' :
					$aff .= '<p><input type="submit"  name="Save" value="Enregistrer"/><input type="submit" name="SaveAndQuit" value="Enregistrer et Fermer"/></p>';
					break;
			}
			$aff .= '</form>';
		}
		echo $aff;
	}
	private function renderHTMLGeneral() {
		$aff = '<table>';

		$aff .= '<tr>';
		$aff .= '	<td>Civilité</td>';
		$aff .= '	<td><input type="radio" value="1" name="Civilite"' . ($this->myAnnuaire->getCivilite () == '1' ? 'CHECKED=CHECKED' : '') . '>M.';
		$aff .= '	<input type="radio" value="2" name="Civilite"' . ($this->myAnnuaire->getCivilite () == '2' ? 'CHECKED=CHECKED' : '') . '>Mme';
		$aff .= '	<input type="radio" value="3" name="Civilite"' . ($this->myAnnuaire->getCivilite () == '3' ? 'CHECKED=CHECKED' : '') . '>Mlle</td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td>Nom</td>';
		$aff .= '	<td><input type="text" name="Nom" value="' . stripslashes ( $this->myAnnuaire->getNom () ) . '"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td>Prénom</td>';
		$aff .= '	<td><input type="text" name="Prenom" value="' . stripslashes ( $this->myAnnuaire->getPrenom () ) . '"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td>Mail*</td>';
		$aff .= '	<td><input type="text" name="Mail" value="' . stripslashes ( $this->myAnnuaire->getMail () ) . '"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td>Login*</td>';
		$aff .= '	<td><input type="text" name="Login" value="' . stripslashes ( $this->myAnnuaire->getLogin () ) . '"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td>Password*</td>';
		$aff .= '	<td><input type="text" name="Password" value="' . stripslashes ( $this->myAnnuaire->getPassword () ) . '"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td valign="top">Type</td>';
		$aff .= '	<td>';

		$aff .= '		<input type="radio" name="AnnuaireTypeID" value="1"' . (($this->myAnnuaire->getAnnuaireTypeID () == '1' || is_null ( $this->myAnnuaire->getAnnuaireTypeID () )) ? ' CHECKED=CHECKED' : '') . ' />1. Concessionnaire / Directeur Général<br/>';
		$aff .= '		<input type="radio" name="AnnuaireTypeID" value="2"' . (($this->myAnnuaire->getAnnuaireTypeID () == '2') ? ' CHECKED=CHECKED' : '') . ' />2. Directeur de concession<br/>';
		$aff .= '		<input type="radio" name="AnnuaireTypeID" value="3"' . (($this->myAnnuaire->getAnnuaireTypeID () == '3') ? ' CHECKED=CHECKED' : '') . ' />3. RRG<br/>';
		$aff .= '	<input type="radio" name="AnnuaireTypeID" value="4"' . (($this->myAnnuaire->getAnnuaireTypeID () == '4') ? ' CHECKED=CHECKED' : '') . ' />4. Constructeur<br/>';
		$aff .= '	<input type="radio" name="AnnuaireTypeID" value="5"' . (($this->myAnnuaire->getAnnuaireTypeID () == '5') ? ' CHECKED=CHECKED' : '') . ' />5. Partenaires<br/>';
		$aff .= '	<input type="radio" name="AnnuaireTypeID" value="6"' . (($this->myAnnuaire->getAnnuaireTypeID () == '6') ? ' CHECKED=CHECKED' : '') . ' />6. Nos autres invités<br/>';
		$aff .= '	<input type="radio" name="AnnuaireTypeID" value="7"' . (($this->myAnnuaire->getAnnuaireTypeID () == '7') ? ' CHECKED=CHECKED' : '') . ' />7. Invité par Concessionaire<br/>';
		$aff .= '	<input type="radio" name="AnnuaireTypeID" value="8"' . (($this->myAnnuaire->getAnnuaireTypeID () == '8') ? ' CHECKED=CHECKED' : '') . ' />8. GCRE<br/>';
		$aff .= '	<input type="radio" name="AnnuaireTypeID" value="9"' . (($this->myAnnuaire->getAnnuaireTypeID () == '9') ? ' CHECKED=CHECKED' : '') . ' />9. GCR+<br/>';
		$aff .= '	</td>';
		$aff .= '</tr>';

		$aff .= '</table>';

		if (! is_null ( $this->myAnnuaire->getID () )) {

			$daoLog = new UserHistoryDAO ();
			$list = $daoLog->findAll ( $this->myAnnuaire->getID () );
			if (count ( $list ) > 0) {
				$aff .= '<h3><u>Historique Individu</u></h3>';
				$aff .= '<table>';
				$aff .= '<tr style="background:#CCC;">';
				$aff .= '<td><b>Date</b></td>';
				$aff .= '<td><b>Description</b></td>';
				$aff .= '<td><b>Action réalisée par</b></td>';
				$aff .= '</tr>';

				foreach ( $list as $log ) {
					$aff .= '<tr style="background:rgb(230,230,230);">';
					$aff .= '<td>' . $log->getDateAction () . '</td>';
					$aff .= '<td>' . $log->getDescription () . '</td>';
					$aff .= '<td>' . $log->getActionRealiseePar () . '</td>';
					$aff .= '</tr>';
				}
				$aff .= '</table>';
			}
		}

		return $aff;
	}
	private function rendreHTMLSociete() {
		$aff = '<table>';

		$aff .= '<tr>';
		$aff .= '	<td>Raison Sociale</td>';
		$aff .= '	<td><input type="text" name="Societe" value="' . stripslashes ( $this->myAnnuaire->getSociete () ) . '"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td>Adresse</td>';
		$aff .= '	<td><textarea name="Adresse">' . stripslashes ( $this->myAnnuaire->getAdresse () ) . '</textarea></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td>Code Postal</td>';
		$aff .= '	<td><input type="text" name="CodePostal" value="' . stripslashes ( $this->myAnnuaire->getCodePostal () ) . '"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td>Ville</td>';
		$aff .= '	<td><input type="text" name="Ville" value="' . stripslashes ( $this->myAnnuaire->getVille () ) . '"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '	<td>Direction Régionale</td>';
		$aff .= '	<td><select name="fieldDR">';
		foreach ( $this->myDR as $dr => $value ) {
			$aff .= '<option value="' . $dr . '"' . ($this->myAnnuaire->getDirectionRegionale () != '0' && $this->myAnnuaire->getDirectionRegionale () == $dr ? ' SELECTED=SELECTED' : '') . '>' . $value . '</option>';
		}
		$aff .= '	</select></td>';
		$aff .= '</tr>';

		$aff .= '</table>';

		return $aff;
	}
	private function renderHTMLInfoComplementaire() {
		$aff = '<table>';

		$aff .= '<tr>';
		$aff .= '<td valign="top">A Répondu</td>';
		$aff .= '<td>';
		$aff .= '<input type="radio"' . ($this->myAnnuaire->getRepondu () == '1' ? ' CHECKED=CHECKED' : '') . ' value="1" name="fieldRepondu" />OUI';
		$aff .= '<input type="radio"' . ($this->myAnnuaire->getRepondu () == '1' ? ' ' : ' CHECKED=CHECKED') . ' value="0" name="fieldRepondu" />NON';
		$aff .= '<br/><br/></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td valign="top">Présence Convention</td>';
		$aff .= '<td><input type="radio"' . ($this->myAnnuaire->getPresence () == 1 ? ' CHECKED=CHECKED' : '') . ' value="1" name="fieldPresent" /> Assistera à la Convention Annuelle<br/>';
		$aff .= '<input type="radio"' . ($this->myAnnuaire->getPresence () == 0 ? ' CHECKED=CHECKED' : '') . ' value="0" name="fieldPresent" />N\'assistera pas à la Convention</td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td valign="top">Présence Repas</td>';
		$aff .= '<td><input type="radio"' . ($this->myAnnuaire->getRepas () == 1 ? ' CHECKED=CHECKED' : '') . ' value="1" name="fieldPresentRepas" /> Restera au repas<br/>';
		$aff .= '<input type="radio"' . ($this->myAnnuaire->getRepas () == 0 ? ' CHECKED=CHECKED' : '') . ' value="0" name="fieldPresentRepas" />Ne restera pas au repas</td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		// $aff .= '<td valign="top">Taxi</td>';
		$aff .= '<td valign="top">Parking</td>';
		$aff .= '<td><input type="radio"' . ($this->myAnnuaire->getTaxi () == 1 ? ' CHECKED=CHECKED' : '') . ' value="1" name="fieldTaxi" /> Souhaite un parking<br/>';
		$aff .= '<input type="radio"' . ($this->myAnnuaire->getTaxi () == 0 ? ' CHECKED=CHECKED' : '') . ' value="0" name="fieldTaxi" />Ne Souhaite pas de parking</td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td valign="top">Présence Diner</td>';
		$aff .= '<td><input type="radio"' . ($this->myAnnuaire->getDiner () == 1 ? ' CHECKED=CHECKED' : '') . ' value="1" name="fieldDiner" /> Assistera au diner<br/>';
		$aff .= '<input type="radio"' . ($this->myAnnuaire->getDiner () == 0 ? ' CHECKED=CHECKED' : '') . ' value="0" name="fieldDiner" />N\'assistera pas au diner</td>';
		$aff .= '</tr>';

		$aff .= '</table>';

		$aff .= '</div><br/>';
		return $aff;
	}
	private function renderHTMLInvite() {
		$aAnnuaireList = new AnnuaireList ();
		$aAnnuaireList->SQL_SELECT_ALL_GUEST ( $this->myAnnuaire->getID () );

		if (count ( $aAnnuaireList->getList () ) == 0) {
			$aff = '<i>Pas d\'invité(s)</i>';
		} else {
			$aff = '<table id="TableList">';
			$aff .= '<tr class="title">';
			$aff .= '	<td align="center"><b>#</b></td>';
			$aff .= '	<td align="center"><b>Nom</b></td>';
			$aff .= '	<td align="center"><b>Prénom</b></td>';
			$aff .= '	<td align="center"><b>Mail</b></td>';
			$aff .= '</tr>';

			foreach ( $aAnnuaireList->getList () as $aAnnuaire ) {
				$aff .= '<tr>';
				$aff .= '	<td>' . $aAnnuaire->getID () . '</td>';
				$aff .= '	<td>' . stripslashes ( $aAnnuaire->getNom () ) . '</td>';
				$aff .= '	<td>' . stripslashes ( $aAnnuaire->getPrenom () ) . '</td>';
				$aff .= '	<td>' . stripslashes ( $aAnnuaire->getMail () ) . '</td>';
				$aff .= '</tr>';
			}
		}
		$aff .= '</table>';
		return $aff;
	}
	public function redirection($url) {
		$aff = '<script type="text/javascript">';
		$aff .= 'document.location.href="' . $url . '";';
		$aff .= '</script>';
		echo $aff;
	}
}
?>
