<?php
class SurveyQuestionView {
	private $mySurveyQuestion;
	public function __construct(SurveyQuestion $aSurveyQuestion) {
		$this->mySurveyQuestion = $aSurveyQuestion;
	}
	public function renderHTML($mod) {
		$aff = '<div id="FilAriane">';
		switch ($mod) {
			case 'new' :
				$aff .= '<a href="../../?menu=3">Web Content</a>&nbsp;>&nbsp;<a href="?">Formulaire en ligne</a>&nbsp;>&nbsp;<a href="?action=listQuestion&id=' . $_GET ['id'] . '">Questions</a>';
				$aff .= '&nbsp;>&nbsp;Cr&eacute;ation';
				break;
			case 'update' :
				$aff .= '<a href="../../?menu=3">Admin</a>&nbsp;>&nbsp;<a href="?">Formulaire en ligne</a>&nbsp;>&nbsp;<a href="?action=listQuestion&id=' . $this->mySurveyQuestion->getSurveyID () . '">Questions</a>';
				$aff .= '&nbsp;>&nbsp;Modification';
				break;
		}
		$aff .= '</div><br/><br/>';

		switch ($mod) {
			case 'new' :
				$aff .= '<form method="post" action="?action=newQuestion&id=' . $_GET ['id'] . '" onsubmit="return valideFormQuestion()">';
				break;
			case 'update' :
				$aff .= '<form method="post" action="?action=updateQuestion&id=' . $this->mySurveyQuestion->getID () . '" onsubmit="return valideFormQuestion()">';
				break;
		}

		$aff .= '<table width="100%">';

		$aff .= '<tr>';
		$aff .= '<td width="150" valign="top">Type</td>';
		$aff .= '<td><select name="pType" id="pType">';
		$aff .= '<option value="' . SurveyQuestion::TYPE_SIMPLE . '"' . ($this->mySurveyQuestion->getType () == SurveyQuestion::TYPE_SIMPLE ? ' SELECTED' : '') . '>Simple</option>';
		$aff .= '<option value="' . SurveyQuestion::TYPE_TEXTAREA . '"' . ($this->mySurveyQuestion->getType () == SurveyQuestion::TYPE_TEXTAREA ? ' SELECTED' : '') . '>Textarea</option>';
		$aff .= '<option value="' . SurveyQuestion::TYPE_RADIO . '"' . ($this->mySurveyQuestion->getType () == SurveyQuestion::TYPE_RADIO ? ' SELECTED' : '') . '>Bouton Radio</option>';
		$aff .= '<option value="' . SurveyQuestion::TYPE_CHECKBOX . '"' . ($this->mySurveyQuestion->getType () == SurveyQuestion::TYPE_CHECKBOX ? ' SELECTED' : '') . '>Case &agrave; cocher</option>';
		$aff .= '<option value="' . SurveyQuestion::TYPE_LIST . '"' . ($this->mySurveyQuestion->getType () == SurveyQuestion::TYPE_LIST ? ' SELECTED' : '') . '>Liste d&eacute;roulante</option>';
		$aff .= '</select></td>';
		$aff .= '</tr>';

		$aff .= '<tr>';
		$aff .= '<td width="150" valign="top">Question *</td>';
		$aff .= '<td>';

		include_once ("../../include/js/fckeditor/fckeditor.php");

		$oFCKeditor = new FCKeditor ( 'pDescription' );
		$oFCKeditor->BasePath = '../../include/js/fckeditor/';
		$oFCKeditor->Value = stripslashes ( $this->mySurveyQuestion->getDescription () );
		$oFCKeditor->Width = '800';
		$oFCKeditor->Height = '100';
		$oFCKeditor->ToolbarSet = 'Basic';
		$aff .= $oFCKeditor->CreateHtml ();

		$aff .= '</td>';
		$aff .= '</tr>';

		$aff .= '<tr class="choix" ' . ($this->mySurveyQuestion->getType () == SurveyQuestion::TYPE_SIMPLE || $this->mySurveyQuestion->getType () == SurveyQuestion::TYPE_TEXTAREA ? ' style="display:none;"' : '') . '>';
		$aff .= '<td width="150" valign="top">Choix 1 *</td>';
		$aff .= '<td><input type="text" id="pChoix1" name="pChoix1" size="60" value="' . stripslashes ( $this->mySurveyQuestion->getChoix1 () ) . '"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr class="choix" ' . ($this->mySurveyQuestion->getType () == SurveyQuestion::TYPE_SIMPLE || $this->mySurveyQuestion->getType () == SurveyQuestion::TYPE_TEXTAREA ? ' style="display:none;"' : '') . '>';
		$aff .= '<td width="150" valign="top">Choix 2 *</td>';
		$aff .= '<td><input type="text" id="pChoix2" name="pChoix2" size="60" value="' . stripslashes ( $this->mySurveyQuestion->getChoix2 () ) . '"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr class="choix" ' . ($this->mySurveyQuestion->getType () == SurveyQuestion::TYPE_SIMPLE || $this->mySurveyQuestion->getType () == SurveyQuestion::TYPE_TEXTAREA ? ' style="display:none;"' : '') . '>';
		$aff .= '<td width="150" valign="top">Choix 3</td>';
		$aff .= '<td><input type="text" id="pChoix3" name="pChoix3" size="60" value="' . stripslashes ( $this->mySurveyQuestion->getChoix3 () ) . '"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr class="choix" ' . ($this->mySurveyQuestion->getType () == SurveyQuestion::TYPE_SIMPLE || $this->mySurveyQuestion->getType () == SurveyQuestion::TYPE_TEXTAREA ? ' style="display:none;"' : '') . '>';
		$aff .= '<td width="150" valign="top">Choix 4</td>';
		$aff .= '<td><input type="text" id="pChoix4" name="pChoix4" size="60" value="' . stripslashes ( $this->mySurveyQuestion->getChoix4 () ) . '"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr class="choix" ' . ($this->mySurveyQuestion->getType () == SurveyQuestion::TYPE_SIMPLE || $this->mySurveyQuestion->getType () == SurveyQuestion::TYPE_TEXTAREA ? ' style="display:none;"' : '') . '>';
		$aff .= '<td width="150" valign="top">Choix 5</td>';
		$aff .= '<td><input type="text" id="pChoix5" name="pChoix5" size="60" value="' . stripslashes ( $this->mySurveyQuestion->getChoix5 () ) . '"/></td>';
		$aff .= '</tr>';

		$aff .= '<tr class="choix" ' . ($this->mySurveyQuestion->getType () == SurveyQuestion::TYPE_SIMPLE || $this->mySurveyQuestion->getType () == SurveyQuestion::TYPE_TEXTAREA ? ' style="display:none;"' : '') . '>';
		$aff .= '<td width="150" valign="top">Choix 6</td>';
		$aff .= '<td><input type="text" id="pChoix6" name="pChoix6" size="60" value="' . stripslashes ( $this->mySurveyQuestion->getChoix6 () ) . '"/></td>';
		$aff .= '</tr>';

		$aff .= '</table>';

		$aff .= '<script>';
		$aff .= '$(document).ready(function() {
						$("#pType").change(function(){
							switch($("#pType").val())
							{
								case \'' . SurveyQuestion::TYPE_SIMPLE . '\':
								case \'' . SurveyQuestion::TYPE_TEXTAREA . '\':
									$(".choix").hide();
									break;
								case \'' . SurveyQuestion::TYPE_CHECKBOX . '\':
								case \'' . SurveyQuestion::TYPE_RADIO . '\':
									case \'' . SurveyQuestion::TYPE_LIST . '\':
									$(".choix").show();
									break;		
							}
						});		
				});';
		$aff .= '</script>';

		switch ($mod) {
			case 'new' :
				$aff .= '<input type="submit" name="submitButton" value="Cr&eacute;er"/></form>';
				break;
			case 'update' :
				$aff .= '<input type="submit" name="submitButton" value="Mettre &agrave; jour"/></form>';
				break;
		}

		echo $aff;
	}
}
?>