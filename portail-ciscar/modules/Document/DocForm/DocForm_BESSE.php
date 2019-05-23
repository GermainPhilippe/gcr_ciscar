<?php
/**
 * @author Florent DESPIERRES
 * @package portail-ciscar
 * @subpackage docform
 * @version 1.0.4
 */
class DocForm_BESSE {
	public function __construct() {
	}
	public function renderHTML() {
		$aff = '<form name="_Form_BESSE" action="?action=docForm&id=besse" method="post">
			<font face="Arial" color="#ffffff">---------</font><b><font face="Arial" color="#000080">Cabinet BESSE</font></b><br>
			<font size="2" face="Arial" color="#ffffff">------------</font><br>
			<font size="2" face="Arial" color="#ffffff">------------</font><br>
			<font size="2" face="Arial" color="#ffffff">------------------------------------------------------</font><b><font size="2" face="Arial" color="#000080">Nous contacter</font></b><br>
			<br>
			<font size="2" face="Arial" color="#ffffff">------------------------</font><img width="606" height="10" src="/ciscar/bases/PortailCISCAR.nsf/454e12509be4d757c125765b00521576/$Body/0.386?OpenElement&amp;FieldElemFormat=gif"><br>
			<font size="2" face="Arial" color="#ffffff">------------</font>
			
			<table cellspacing="0" cellpadding="0" border="0">
			<tbody>
				<tr valign="top"><td width="201"><a target="_self" href="?action=doc&id=634349E799117947C12575E1004E7242"><font size="2" face="Arial" color="#000080">&gt; Cabinet Bessé</font></a><br>
			<br>
			<a target="_self" href="?action=doc&id=EE7CD1EDB108BE60C12575E100506742"><font size="2" face="Arial" color="#000080">&gt; Service Plus</font></a><br>
			<br>
			<b><font size="2" face="Arial" color="#ff8100">&gt; Nous contacter</font></b><br>
			<br>
			<br>
			<img width="150" height="111" src="/userfiles/image/634349e799117947c12575e1004e7242_0010e.gif"></td><td width="568"><i><font size="2" face="Arial" color="#ffffff">___________</font></i>
			<table cellspacing="0" cellpadding="0" border="0">
			<tbody><tr valign="top"><td width="567" bgcolor="#f7f7f7"><div align="center"><b><i><font size="2" face="Arial" color="#f7f7f7">         ___</font></i></b><br>
			<font size="2" face="Arial" color="#000080">Pour nous contacter, remplissez le formulaire ci dessous.</font><br>
			<br>
			<font size="2" face="Arial" color="#000080">Nous vous apporterons une réponse dans les meilleurs délais.</font></div><b><i><font size="2" face="Arial" color="#ffffff">         ___</font></i></b></td></tr>
			</tbody></table>
			<b><i><font size="2" face="Arial" color="#ffffff">      </font></i></b><i><font size="2" face="Arial" color="#ffffff">_______</font></i>
			<table width="100%" cellspacing="0" cellpadding="0" border="0">
			<tbody><tr valign="top"><td width="1%"><img width="189" height="1" border="0" alt="" src="/icons/ecblank.gif"><br>
			<font size="2" face="Arial" color="#ffffff">----</font><font size="2" face="Arial" color="#000080">Votre nom : </font></td><td width="100%"><img width="1" height="1" border="0" alt="" src="/icons/ecblank.gif"><br>
			<font size="2" face="Arial" color="#000080">
			<input size="50&quot;" value="" name="Besse_Nom"></font></td></tr>
			
			<tr valign="top"><td width="1%"><img width="189" height="1" border="0" alt="" src="/icons/ecblank.gif"><br>
			<font size="2" face="Arial" color="#ffffff">----</font><font size="2" face="Arial" color="#000080">Votre prénom :</font></td><td width="100%"><img width="1" height="1" border="0" alt="" src="/icons/ecblank.gif"><br>
			<font size="2" face="Arial" color="#000080">
			<input size="50&quot;" value="" name="Besse_Prenom"></font></td></tr>
			
			<tr valign="top"><td width="1%"><img width="189" height="1" border="0" alt="" src="/icons/ecblank.gif"><br>
			<font size="2" face="Arial" color="#ffffff">----</font><font size="2" face="Arial" color="#000080">Raison sociale :</font></td><td width="100%"><img width="1" height="1" border="0" alt="" src="/icons/ecblank.gif"><br>
			<font size="2" face="Arial" color="#000080">
			<input size="50&quot;" value="" name="Besse_RS"></font></td></tr>
			
			<tr valign="top"><td width="1%"><img width="189" height="1" border="0" alt="" src="/icons/ecblank.gif"><br>
			<font size="2" face="Arial" color="#ffffff">----</font><font size="2" face="Arial" color="#000080">Adresse : </font></td><td width="100%"><img width="1" height="1" border="0" alt="" src="/icons/ecblank.gif"><br>
			<font size="2" face="Arial" color="#000080">
			<input size="50&quot;" value="" name="Besse_Adresse"></font></td></tr>
			
			<tr valign="top"><td width="1%"><img width="189" height="1" border="0" alt="" src="/icons/ecblank.gif"><br>
			<font size="2" face="Arial" color="#ffffff">----</font><font size="2" face="Arial" color="#000080">Code postal :</font></td><td width="100%"><img width="1" height="1" border="0" alt="" src="/icons/ecblank.gif"><br>
			<font size="2" face="Arial" color="#000080">
			<input size="5&quot;" value="" name="Besse_CP"></font></td></tr>
			
			<tr valign="top"><td width="1%"><img width="189" height="1" border="0" alt="" src="/icons/ecblank.gif"><br>
			<font size="2" face="Arial" color="#ffffff">----</font><font size="2" face="Arial" color="#000080">Ville : </font></td><td width="100%"><img width="1" height="1" border="0" alt="" src="/icons/ecblank.gif"><br>
			<font size="2" face="Arial" color="#000080">
			<input size="5&quot;" value="" name="Besse_Ville"></font></td></tr>
			
			<tr valign="top"><td width="1%"><img width="189" height="1" border="0" alt="" src="/icons/ecblank.gif"><br>
			<font size="2" face="Arial" color="#ffffff">----</font><font size="2" face="Arial" color="#000080">Téléphone : </font></td><td width="100%"><img width="1" height="1" border="0" alt="" src="/icons/ecblank.gif"><br>
			<font size="2" face="Arial" color="#000080">
			<input size="14&quot;" value="" name="Besse_Telephone"></font></td></tr>
			
			<tr valign="top"><td width="1%"><img width="189" height="1" border="0" alt="" src="/icons/ecblank.gif"><br>
			<font size="2" face="Arial" color="#ffffff">----</font><font size="2" face="Arial" color="#000080">Email : </font></td><td width="100%"><img width="1" height="1" border="0" alt="" src="/icons/ecblank.gif"><br>
			<font size="2" face="Arial" color="#000080">
			<input size="50&quot;" value="" name="Besse_Mail"></font></td></tr>
			
			<tr valign="top"><td width="1%"><img width="189" height="1" border="0" alt="" src="/icons/ecblank.gif"><br>
			<font size="2" face="Arial" color="#ffffff">----</font><font size="2" face="Arial" color="#000080">Votre question :</font></td><td width="100%"><img width="1" height="1" border="0" alt="" src="/icons/ecblank.gif"><br>
			<font size="2" face="Arial" color="#000080">
			<textarea cols="40" rows="10" name="Besse_Chp_Libre"></textarea>
			</font></td></tr>
			</tbody></table>
			<br>
			<input type="submit" value="Envoyer"/></td></tr>
			</tbody></table>
		</form>';
		return $aff;
	}
}
?>