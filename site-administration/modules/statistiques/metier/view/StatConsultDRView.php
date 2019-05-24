<?php
/**
 * Vue de la répartition par domaine
 * @author Alexandre DIALLO
 * @package site-administration
 * @subpackage statistiques
 * @version 1.0.4
 */
class StatConsultDRView {
	private $myList;
	private $myTotal;
	private $myRegion;
	public function __construct($aList, $aTotal, $aRegion) {
		$this->myList = $aList;
		$this->myTotal = $aTotal;
		$this->myRegion = $aRegion;
	}
	/**
	 * Rendu du style de la page
	 */
	public function renderstyle() {
		$aff = '<style>';
		$aff .= 'td.center {text-align:center;}';
		$aff .= '</style>';

		return $aff;
	}
	/**
	 * Création du tableau
	 */
	public function renderHTML() {
		// On récupère le site sur lequel on est connecté
		switch ($_GET ['site']) {
			case 1 :
				$site = 'CISCAR';
				break;
			case 3 :
				$site = 'ACNF';
				break;
			case 2 :
				$site = 'GCR';
				break;
			case 7 :
				$site = 'GCRE';
				break;
		}
		// Mois et année du jour
		$time = time ();
		$mois_actuel = date ( 'm', $time );
		$annee_actuelle = date ( 'Y', $time );
		$aff = $this->renderstyle ();
		$aff .= '<div id="FilAriane"><a href="../?menu=6">Statistiques</a>&nbsp;>&nbsp;';
		$aff .= '<a href="?site=' . $_GET ['site'] . '">' . $site . '</a>&nbsp;>&nbsp;';
		$aff .= 'Répartitions par DR<br /></div><br />';

		$aff .= '<table><tr>';
		$aff .= '<td><img width="15px" height="15px" src="../../include/images/export.jpg" /></td>';
		$aff .= '<td> <a   target="blank" href="metier/getDRDoc.php?export=1&m=' . (isset ( $_GET ['m'] ) ? $_GET ['m'] : $mois_actuel) . '&a=' . (isset ( $_GET ['a'] ) ? $_GET ['a'] : $annee_actuelle) . '&type=' . (isset ( $_GET ['type'] ) ? $_GET ['type'] : 3) . '&site=' . $_GET ['site'] . '">  Exporter les données affichées</a></td>';
		$aff .= '</tr><tr></table>';

		// *************************************** Début calendrier ******************************************

		$aff .= '<div align="center" ><form>';
		// Si on a demandé une date
		if (isset ( $_GET ['m'] ) && isset ( $_GET ['a'] )) {
			$aff .= '<a  style="background-image:url(\'../../include/images/3.png\');" href="?site=' . $_GET ['site'] . '&action=dr&m=' . $_GET ['m'] . '&a=' . ($_GET ['a'] - 1);
			$aff .= '">	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><a  style="background-image:url(\'../../include/images/3.png\');" href="?site=' . $_GET ['site'] . '&action=dr&m=';
			if ($_GET ['m'] == '01') {
				$aff .= '12&a=' . ($_GET ['a'] - 1);
			} else {
				$aff .= ($_GET ['m'] - 1) . '&a=' . $_GET ['a'];
			}
			$aff .= '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
			$aff .= '<select name="mois"  onChange="window.location=\'/admin/modules/statistiques/index.php?site=' . $_GET ['site'] . '&action=dr&m=\' + this.form.mois.value + \'&a=' . $_GET ['a'] . '\'">';
			$i = 1;
			while ( $i <= 12 ) {
				$aff .= '<option  value="' . $i . '" ' . ($_GET ['m'] == $i ? 'selected' : '') . '>' . FunctionDate::getMois ( $i ) . '</option>';
				$i ++;
			}
			$aff .= '</select>  ';
			$aff .= $_GET ['a'] . ' <a style="background-image:url(\'../../include/images/1.png\');" href="?site=' . $_GET ['site'] . '&action=dr&m=';
			if ($_GET ['m'] == '12') {
				$aff .= '01&a=' . ($_GET ['a'] + 1);
			} else {
				$aff .= ($_GET ['m'] + 1) . '&a=' . $_GET ['a'];
			}
			$aff .= '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><a  style="background-image:url(\'../../include/images/1.png\');" href="?site=' . $_GET ['site'] . '&action=dr&m=' . $_GET ['m'] . '&a=' . ($_GET ['a'] + 1);
			$aff .= '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
		} // Sinon on prend le moi et l'année actuels
		else {
			$aff .= '<a  style="background-image:url(\'../../include/images/3.png\');" href="?site=' . $_GET ['site'] . '&action=dr&m=' . $mois_actuel . '&a=' . ($annee_actuelle - 1);
			$aff .= '">	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><a style="background-image:url(\'../../include/images/3.png\');" href="?site=' . $_GET ['site'] . '&action=dr&m=';
			if ($mois_actuel == '01') {
				$aff .= '12&a=' . ($annee_actuelle - 1);
			} else {
				$aff .= ($mois_actuel - 1) . '&a=' . $annee_actuelle;
			}
			$aff .= '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
			$aff .= ' <select name="mois"  onChange="window.location=\'/admin/modules/statistiques/index.php?site=' . $_GET ['site'] . '&action=dr&m=\' + this.form.mois.value + \'&a=' . $annee_actuelle . '\'">';
			$i = 1;
			while ( $i <= 12 ) {
				$aff .= '<option  value="' . $i . '" ' . ($mois_actuel == $i ? 'selected' : '') . '>' . FunctionDate::getMois ( $i ) . '</option>';
				$i ++;
			}
			$aff .= '</select>  ';
			$aff .= $annee_actuelle . '<a style="background-image:url(\'../../include/images/1.png\');" href="?site=' . $_GET ['site'] . '&action=dr&m=';
			if ($mois_actuel == '12') {
				$aff .= '01&a=' . ($annee_actuelle + 1);
			} else {
				$aff .= ($mois_actuel + 1) . '&a=' . $annee_actuelle;
			}
			$aff .= '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a><a  style="background-image:url(\'../../include/images/1.png\');" href="?site=' . $_GET ['site'] . '&action=dr&m=' . $mois_actuel . '&a=' . ($annee_actuelle + 1);
			$aff .= '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>';
		}
		$aff .= '</div></form><br />';
		// *************************************** Fin calendrier ******************************************

		// Création du tableau
		$aff .= '<table id="TableList"  width="100%">';
		$aff .= '<tr class="title">';
		$aff .= '	<td align="center" width="200"><b>Région</b></td>';
		$aff .= '	<td align="center"><b>Domaine</b></td>';
		$aff .= '	<td align="center"><b>Publication</b></td>';
		$aff .= '	<td align="center"  colspan="2" width="200"><b>Nombre de consultations</b></td>';
		$aff .= '</tr>';
		$aff .= '<tr><td class="row2" align="center" style="font-weight:bold;">Total</td><td class="row2"></td><td class="row2"></td><td class="row2" align="center" style="font-weight:bold;">' . $this->myTotal . '</td>';
		$aff .= '<td class="row2" align="center" style="font-weight:bold;">100%<td></tr>';
		$row = 1;
		$aType = '';
		$time = time ();

		foreach ( $this->myRegion->getRegionListe () as $aVerif ) {
			$aStat = new StatConsultDR ();
			$aConsult = $aStat->SQL_COUNT_DR ( $_GET ['site'], isset ( $_GET ['m'] ) ? $_GET ['m'] : date ( 'm', $time ), isset ( $_GET ['a'] ) ? $_GET ['a'] : date ( 'Y', $time ), $aVerif->getID () );

			$aff .= '<tr id="DR-' . $aVerif->getID () . '">';
			$aff .= '	<td    align="left"  style="font-weight:bold;background-color:#E8E8E8;font-size:11px;height:30px;"><img id="ImgDR-' . $aVerif->getID () . '" src="../../include/images/1.png"><a style="cursor:pointer" onclick="extend_dr(\'' . $aVerif->getID () . '\')">' . $aVerif->getName () . '</a></td>';
			$aff .= '	<td   align="center" style="font-style:italic;background-color:#E8E8E8;font-size:11px;height:30px;" ></b></td>';
			$aff .= '	<td    align="center" style="font-style:italic;background-color:#E8E8E8;font-size:11px;height:30px;" ></b></td>';

			$aff .= '	<td    align="center" width="100" style="background-color:#E8E8E8;font-size:11px;height:30px;">' . $aConsult . '</td>';

			$aff .= '	<td    align="center" width="100" style="background-color:#E8E8E8;font-size:11px;height:30px;">';
			$aff .= (($this->myTotal != 0) ? round ( ($aConsult / $this->myTotal) * 100 ) : '0');
			$aff .= '%</td>';
			$aff .= '</tr>';

			$row = ($row == 1 ? 2 : 1);
		}
		$aff .= '<tr id="DR-NULL">';
		$aff .= '	<td    align="left"  style="font-weight:bold;background-color:#E8E8E8;font-size:11px;height:30px;"><img id="ImgDR-NULL" src="../../include/images/1.png"><a style="cursor:pointer" onclick="extend_dr(\'NULL\')">Indéfini</a></td>';
		$aff .= '	<td    align="center" style="font-style:italic;background-color:#E8E8E8;font-size:11px;height:30px;" ></b></td>';
		$aff .= '	<td    align="center" style="font-style:italic;background-color:#E8E8E8;font-size:11px;height:30px;" ></b></td>';
		$aStat = new StatConsultDR ();
		$aConsult = $aStat->SQL_COUNT_DR ( $_GET ['site'], isset ( $_GET ['m'] ) ? $_GET ['m'] : date ( 'm', $time ), isset ( $_GET ['a'] ) ? $_GET ['a'] : date ( 'Y', $time ), 'NULL' );

		$aff .= '	<td    align="center" width="100" style="background-color:#E8E8E8;font-size:11px;height:30px;">' . $aConsult . '</td>';

		$aff .= '	<td   " align="center" width="100" style="background-color:#E8E8E8;font-size:11px;height:30px;">';
		$aff .= (($this->myTotal != 0) ? round ( ($aConsult / $this->myTotal) * 100 ) : '0');
		$aff .= '%</td>';
		$aff .= '</tr>';

		$aff .= '</table>';
		// Fonction AJAX servant à récupérer les domaines pour une région (extend_dr) et les documents pour un domaine et une région (extend_da)
		$aff .= '<script>';
		$aff .= 'function extend_dr(categorie_id)
					{		
						var obj = $("#ImgDR-"+categorie_id);
	
						if(obj.attr("src")=="../../include/images/1.png")
						{
								
								if($(".DR-"+categorie_id).length==0){	
								$.ajax({
										type: "GET",
										url: "indexSimple.php?action=SplitDRDoc&m=' . (isset ( $_GET ['m'] ) ? $_GET ['m'] : $mois_actuel) . '&a=' . (isset ( $_GET ['a'] ) ? $_GET ['a'] : $annee_actuelle) . '&type=' . (isset ( $_GET ['type'] ) ? $_GET ['type'] : 0) . '&site=' . $_GET ['site'] . '&id="+categorie_id,
										
										success: function(msg){
											$("#DR-"+categorie_id).after(msg);
										}
									});
								}
								$(".DR-"+categorie_id).show();
								obj.attr("src","../../include/images/1bas.png");
						}
								else {
									  $(".DR-"+categorie_id).each( function(){
									  
									      $(this).hide();
									     $("."+$(this).attr("id")).hide();
									     obj.attr("src","../../include/images/1.png");	
									     var obj2 = $(".ImgDR-"+categorie_id);
									     obj2.attr("src","../../include/images/1.png");
											}											  
									  );
								}											
					}	
				
					function extend_da(categorie_id)
					{		
						var obj = $("#ImgDOM-"+categorie_id);
	
						if(obj.attr("src")=="../../include/images/1.png")
						{	
							 if($(".DOM-"+categorie_id).length==0){	
									$.ajax({
										type: "GET",
										url: "indexSimple.php?action=SplitDADoc&m=' . (isset ( $_GET ['m'] ) ? $_GET ['m'] : $mois_actuel) . '&a=' . (isset ( $_GET ['a'] ) ? $_GET ['a'] : $annee_actuelle) . '&type=' . (isset ( $_GET ['type'] ) ? $_GET ['type'] : 0) . '&site=' . $_GET ['site'] . '&id="+categorie_id,
										
										success: function(msg){
											$("#DOM-"+categorie_id).after(msg);
										}
									});
							}
							$(".DOM-"+categorie_id).show();
							obj.attr("src","../../include/images/1bas.png");
						}
							else{
									$(".DOM-"+categorie_id).hide();
									obj.attr("src","../../include/images/1.png");
							}
					}';

		$aff .= '</script>';
		echo $aff;
	}
}
?>