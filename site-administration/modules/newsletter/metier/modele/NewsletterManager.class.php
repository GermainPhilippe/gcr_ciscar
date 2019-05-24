<?php
class NewsletterManager {
	public function __construct() {
		ShortcodeManager::add_shortcode ( 'Newsletter_CantDisplay', 'NewsletterSC::CantDisplay' );
		ShortcodeManager::add_shortcode ( 'Newsletter_UserInfo', 'NewsletterSC::UserInfo' );
		ShortcodeManager::add_shortcode ( 'Newsletter_LoginUser', 'NewsletterSC::LoginUser' );
		ShortcodeManager::add_shortcode ( 'Newsletter_NameUser', 'NewsletterSC::NameUser' );
	}
	public function add(Newsletter $aNewsletter) {
		$sql = "INSERT INTO wcm_newsletter (NewsID, Nom, FromTo, ReplyTo, Subject, RichContentValue, CssHeader, SiteID, NewsBloquee)";
		$sql .= " VALUES(NULL,'%s','%s','%s','%s','%s','%s','%s','%s')";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aNewsletter->getName () ), mysqli_real_escape_string ($_SESSION['LINK'], $aNewsletter->getFrom () ), mysqli_real_escape_string ($_SESSION['LINK'], $aNewsletter->getReplyTo () ), mysqli_real_escape_string ($_SESSION['LINK'], $aNewsletter->getSubject () ), mysqli_real_escape_string ($_SESSION['LINK'], $aNewsletter->getRichContentValue () ), $aNewsletter->getCssHeader (), mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], $aNewsletter->getNewsBloquee() ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$aNewsletter->setID ( ( int ) mysqli_insert_id ($_SESSION['LINK']) );
	}
	public function update(Newsletter $aNewsletter) {
		$sql = "UPDATE wcm_newsletter SET Nom='%s', FromTo='%s', ReplyTo='%s', Subject='%s', RichContentValue='%s', CssHeader='%s', NewsBloquee='%s' WHERE NewsID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aNewsletter->getName () ), mysqli_real_escape_string ($_SESSION['LINK'], $aNewsletter->getFrom () ), mysqli_real_escape_string ($_SESSION['LINK'], $aNewsletter->getReplyTo () ), mysqli_real_escape_string ($_SESSION['LINK'], $aNewsletter->getSubject () ), mysqli_real_escape_string ($_SESSION['LINK'], $aNewsletter->getRichContentValue () ), $aNewsletter->getCssHeader (), mysqli_real_escape_string ($_SESSION['LINK'], $aNewsletter->getNewsBloquee () ), mysqli_real_escape_string ($_SESSION['LINK'], $aNewsletter->getID () ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function delete($aID) {
		$sql = "DELETE FROM wcm_newsletter WHERE NewsID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function duplicate($aID) {
		$sql = "insert into wcm_newsletter select null, CONCAT('(Copie de) ' , Nom) , FromTo, ReplyTo, Subject, RichContentValue, CssHeader, SiteID, 0, 0 from wcm_newsletter WHERE NewsID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $aID ) );

		mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );
	}
	public function get($aID) {
		$sql = "SELECT NewsID, Nom, FromTo, ReplyTo, Subject, RichContentValue, CssHeader, SiteID, NewsBloquee FROM wcm_newsletter";
		$sql .= " WHERE SiteID='%s' AND NewsID='%s'";

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ), mysqli_real_escape_string ($_SESSION['LINK'], $aID ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$aNewsletter = new Newsletter ();
		if (mysqli_num_rows ( $result ) > 0) {
			$line = mysqli_fetch_array  ( $result );
			$aNewsletter->setID ( ( int ) $line [0] );
			$aNewsletter->setName ( $line [1] );
			$aNewsletter->setFrom ( $line [2] );
			$aNewsletter->setReplyTo ( $line [3] );
			$aNewsletter->setSubject ( $line [4] );
			$aNewsletter->setRichContentValue ( $line [5] );
			$aNewsletter->setCssHeader ( $line [6] );
			$aNewsletter->setSiteID ( ( int ) $line [7] );
			$aNewsletter->setNewsBloquee( ( int ) $line [8] );
		}

		mysqli_free_result  ( $result );

		return $aNewsletter;
	}
	public function getList($archive, $debut = -1, $limite = -1) {
		if ($archive == 1)
			$archive = '0,1';
		$aArray = array ();

		$sql = "SELECT NewsID, Nom, FromTo, ReplyTo, Subject, RichContentValue, CssHeader, SiteID,NewsBloquee FROM wcm_newsletter";
		$sql .= " WHERE Archive in ( " . $archive . " ) and SiteID='%s' order by NewsID desc";
		if ($debut != - 1 || $limite != - 1) {
			$sql .= ' LIMIT ' . ( int ) $debut . ', ' . ( int ) $limite;
		}

		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );

		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		while ( $line = mysqli_fetch_array  ( $result ) ) {
			$aNewsletter = new Newsletter ();
			$aNewsletter->setID ( ( int ) $line [0] );
			$aNewsletter->setName ( $line [1] );
			$aNewsletter->setFrom ( $line [2] );
			$aNewsletter->setReplyTo ( $line [3] );
			$aNewsletter->setSubject ( $line [4] );
			$aNewsletter->setRichContentValue ( $line [5] );
			$aNewsletter->setCssHeader ( $line [6] );
			$aNewsletter->setSiteID ( ( int ) $line [7] );
			$aNewsletter->setNewsBloquee( ( int ) $line [8] );
			$aArray [] = $aNewsletter;
		}

		mysqli_free_result  ( $result );

		return $aArray;
	}
	public function count() {
		$sql = "SELECT count(*) FROM wcm_newsletter WHERE SiteID='%s'";
		$query = sprintf ( $sql, mysqli_real_escape_string ($_SESSION['LINK'], $_SESSION ['ADMIN'] ['USER'] ['AnnuaireID'] ) );
		$result = mysqli_query ($_SESSION['LINK'], $query ) or die ( mysqli_error ($_SESSION['LINK']) );

		$line = 0;
		if (mysqli_num_rows ( $result ) > 0) {
			$line = mysqli_fetch_array  ( $result );
			$line = $line [0];
		}
		mysqli_free_result  ( $result );
		return $line;
	}
	public function save(Newsletter $aNewsletter) {
		$aNewsletter->isNew () ? $this->add ( $aNewsletter ) : $this->update ( $aNewsletter );
	}
	public function sendNewsletter(Newsletter $aNewsletter) {
		// Purge la table
		mysqli_query ($_SESSION['LINK'], "TRUNCATE wcm_newsletter_tmp" ) or die ( mysqli_error ($_SESSION['LINK']) );

		// On augmente la durée d'éxecution pour permettre d'envoyer toutes les newsletter bug 763
		set_time_limit ( 500 );

		// Import des individus
		$aNewsletterDestinataireManager = new NewsletterDestinataireManager ();
		foreach ( $aNewsletterDestinataireManager->getList ( $aNewsletter->getID () ) as $aDestinataire ) {
			$aListeDiffusionCritere = new ListeDiffusionCritere ();

			$sql = $aListeDiffusionCritere->generateSQL ( $aDestinataire->getListeDiffusionID () );

			// TODO A suuprimer
			// if (! empty ( $sql )) {
			// $user = new Individu ();
			// $result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );
			// while ( $line = mysqli_fetch_array  ( $result ) ) {
			// $user->select_individu ( $line [0] );
			// print $user->getStringCivilite ().';'.$user->getNom ().';'.$user->getPrenom ().';'.'?login=' . utf8_encode ( $user->getLogin () ) . '&pwd=' . utf8_encode ( $user->getPassword () ).'<br>';
			// }
			// }
			// die();

			if (! empty ( $sql )) {
				$result = mysqli_query ($_SESSION['LINK'], $sql ) or die ( mysqli_error ($_SESSION['LINK']) );
				while ( $line = mysqli_fetch_array  ( $result ) ) {
					$sql2 = "INSERT IGNORE INTO wcm_newsletter_tmp (Id, Mail, EtablissementID, Nom, Prenom, Civilite, Liste_EtablissementID) VALUES('%s','%s', '%s', '%s','%s','%s','%s')";

					$query2 = sprintf ( $sql2, mysqli_real_escape_string ($_SESSION['LINK'], $line [0] ), mysqli_real_escape_string ($_SESSION['LINK'], $line [3] ), mysqli_real_escape_string ($_SESSION['LINK'], $line [4] ), mysqli_real_escape_string ($_SESSION['LINK'], $line [1] ), mysqli_real_escape_string ($_SESSION['LINK'], $line [2] ),mysqli_real_escape_string ($_SESSION['LINK'], $line [5] ),mysqli_real_escape_string ($_SESSION['LINK'], $line [6] ) );

					mysqli_query ($_SESSION['LINK'], $query2 ) or die ( mysqli_error ($_SESSION['LINK']) );
				}
			}
		}

		// Notification & log par individu
		$result = mysqli_query ($_SESSION['LINK'], "SELECT DISTINCT(Id), Mail, EtablissementID, Nom, Prenom, Civilite, Liste_EtablissementID FROM wcm_newsletter_tmp where Mail <> '' " ) or die ( mysqli_error ($_SESSION['LINK']) );

		$aNewsletterManager = new NewsletterManager ();
		$aNewsletter = $aNewsletterManager->get ( $_GET ['id'] );

		$aNewsletterAttachmentManager = new NewsletterAttachmentManager ();
		$attachments = $aNewsletterAttachmentManager->getListByNewsletter ( $_GET ['id'] );

		$aMail = new NotificationMail ();
		foreach ( $attachments as $attachment ) {
			$aMail->addAttachmentDATA ( $attachment->getMime (), $attachment->getName (), base64_encode ( $attachment->getData () ) );
		}

		$aMail->setFrom ( str_replace('\\','',$aNewsletter->getFrom ()) );
		$aMail->setSubject ( $aNewsletter->getSubject () );
		// $msg = '<html><head>
		// <meta http-equiv="Content-Type" content="text/html; charset=Windows-1252">
		// <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0," />';
		$msg = '<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Windows-1252" />
    <!--[if !mso]><!-->
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!--<![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <!--[if (gte mso 9)|(IE)]>
    <style type="text/css">
        table {border-collapse: collapse;}
    </style>
    <![endif]-->
</head>		';
		if ($aNewsletter->getCssHeader () != '') {
			$msg .= '<style type="text/css">' . $aNewsletter->getCssHeader () . '</style>';
		}
		// $msg .= '</head><body style="font-family:Arial;font-size:x-small;color:#000000;">';
		$msg .= '</head><body>';

		$msg_corps_mail = stripslashes ( $aNewsletter->getRichContentValue () );

		// si demande lien sur un Deal
		$lien = $_SERVER ['HTTP_HOST'] . '/modules/Deals/index.php?deal=';
		$lien = str_replace ( 'gcrfrance.com', 'ciscar.fr', $lien );
		$msg_corps_mail = str_replace ( '{Deal}', $lien, $msg_corps_mail );
		$msg_corps_mail = str_replace ( '<tbody>', '', $msg_corps_mail );
		$msg_corps_mail = str_replace ( '</tbody>', '', $msg_corps_mail );
		// ajout duc code pour le pixel d visu (ouverture du mail)
		$msg_corps_mail = $msg_corps_mail . '<p><img src="' . 'http://' . $_SERVER ['HTTP_HOST'] . '/admin/modules/newsletter/stats_visu.php{Login_User}" border="0" alt="" width="1" height="1" /></p>';

		// $explod_tab = array('<a href','<a target="_blank" href');
		$explod_tab = array (
				'<a '
		);
		$NumLien = 0;

		foreach ( $explod_tab as $explod ) {
			// on detecte tous les liens pour y affecter les paramètre d'autologin
			if ($explod == '<a href')
				$href_tab = explode ( '<a href', $msg_corps_mail );

			if ($explod == '<a target="_blank" href')
				$href_tab = explode ( '<a target="_blank" href', $msg_corps_mail );

			if ($explod == '<a ')
				$href_tab = explode ( '<a ', $msg_corps_mail );

			$ind_tab = 0;
			foreach ( $href_tab as $str_href ) {
				$ind_tab += 1;
				// on ne traite pas la première occurence
				if ($ind_tab > 1) {
					// on recherche la balise de fermeture de l'adresse
					$pos1 = strpos ( $str_href, '">' );
					$str_href = substr ( $str_href, 0, $pos1 ) . '">';

					if ($explod == '<a href')
						$href = '<a href' . $str_href;
					if ($explod == '<a target="_blank" href')
						$href = 'href' . $str_href;
					if ($explod == '<a ')
						$href = $str_href;

					$pos = false;
					$pos = strpos ( $href, 'http://www.gcrfrance.com' );
					if ($pos === false)
						$pos = strpos ( $href, 'http://gcrfrance.com' );
					if ($pos === false)
						$pos = strpos ( $href, 'http://gcrfrance.vm' );
					if ($pos === false)
						$pos = strpos ( $href, 'http://gcrfrance.local' );
					if ($pos === false)
						$pos = strpos ( $href, 'http://ciscar.fr' );
					if ($pos === false)
						$pos = strpos ( $href, 'http://ciscar.vm' );
					if ($pos === false)
						$pos = strpos ( $href, 'http://www.ciscar.fr' );
					if ($pos === false)
						$pos = strpos ( $href, 'http://ciscar.be' );
					if ($pos === false)
						$pos = strpos ( $href, 'http://www.ciscar.be' );
					if ($pos === false)
						$pos = strpos ( $href, 'http://ciscar.net' );
					if ($pos === false)
						$pos = strpos ( $href, 'http://www.ciscar.net' );
					if ($pos === false)
						$pos = strpos ( $href, 'http://ciscar-prod.geolane.fr' );
					if ($pos === false)
						$pos = strpos ( $href, 'http://192.168.16.204' );
					if ($pos !== false) {
						$NumLien += 1;
						if ($explod == '<a ') {
							$href = substr ( $href, $pos );
							$pos1 = strpos ( $href, '" ' );
							if ($pos1 === false)
								$pos1 = strpos ( $href, '">' );
							$href0 = substr ( $href, 0 );
						} else {
							$pos1 = strpos ( $href, '">' );
							$href0 = substr ( $href, 0, $pos1 );
							$pos_target_blk = strpos ( $href0, ' target="_blank' );
							$href0 = str_replace ( '" target="_blank', '', $href0 );
						}

						if ($explod == '<a ') {
							$href1 = str_replace ( '\&', '&amp;', $href0 );
							$href2 = substr_replace ( $href1, '{Login_User}&lien=' . $NumLien, $pos1, 0 );
							$msg_corps_mail = str_replace ( $href1, $href2, $msg_corps_mail );
							$msg_corps_mail = str_replace ( '{Login_User}{Login_User}', '{Login_User}', $msg_corps_mail );
						} else {
							if ($pos_target_blk == false) {
								$href1 = str_replace ( '\&', '&amp;', substr ( $href0, 0, $pos1 ) . '">' );
								$href2 = str_replace ( '\&', '&amp;', substr ( $href0, 0, $pos1 ) . '{Login_User}&lien=' . $NumLien . '">' );
							} else {
								$href1 = str_replace ( '\&', '&amp;', substr ( $href0, 0, $pos1 ) . '" target="_blank"' );
								$href2 = str_replace ( '\&', '&amp;', substr ( $href0, 0, $pos1 ) . '{Login_User}&lien=' . $NumLien . '" target="_blank"' );
							}
							// print '<br>-'.$href1.'-';
							// print '<br>-'.$href2.'-';
							$msg_corps_mail = str_replace ( $href1, $href2, $msg_corps_mail );
							$msg_corps_mail = str_replace ( '{Login_User}{Login_User}', '{Login_User}', $msg_corps_mail );
							$msg_corps_mail = str_replace ( '{Login_User}', '{Login_User}&lien=' . $NumLien, $msg_corps_mail );
						}
					}

					$pos = false;
				}
			}
		}

		$msg .= str_replace ( '/userfiles/', 'http://' . $_SERVER ['HTTP_HOST'] . '/userfiles/', $msg_corps_mail );
		// $msg .= str_replace ( '/userfiles/', 'http://www.gcrfrance.com/userfiles/', $msg_corps_mail );
		$msg .= '</body></html>';

		$aMail->setMessage ( $msg );
		$aMail->setHeaderReplyTo ( $aNewsletter->getReplyTo () );
		$aMail->setHeaderContentType ( 'text/html; charset="iso-8859-1"' );
		$aMail->setHeaderContentTransferEncoding ( '8bit' );

		$aNewsletterHistorique = new NewsletterHistorique ();
		$aNewsletterHistorique->setNewsletterID ( ( int ) $aNewsletter->getID () );
		$aNewsletterHistoriqueManager = new NewsletterHistoriqueManager ();

		// on incremente le numéro d'envoi EnvoiID
		$EnvoiID = $aNewsletterHistoriqueManager->MaxEnvoiId ();
		$EnvoiID += 1;
		$aNewsletterHistorique->setEnvoiID ( ( int ) $EnvoiID );

		// on enregistre les informations à memoriser concernant l'envoi
		$aNewsletterEnvoiManager = new NewsletterEnvoiManager ();
		$aNewsletterEnvoi = $aNewsletterEnvoiManager->selectListeDiffusion ( $aNewsletter->getID () );
		$aNewsletterEnvoi->setEnvoiID ( ( int ) $EnvoiID );
		$aNewsletterEnvoi->setNbEnvois ( mysqli_num_rows ( $result ) );
		$aNewsletterEnvoiManager = new NewsletterEnvoiManager ();
		$aNewsletterEnvoiManager->add ( $aNewsletterEnvoi );

		$user = new Individu ();
		$etablissement = new Etablissement ();

		while ( $line = mysqli_fetch_array  ( $result ) ) {

			$user->select_individu ( $line [0] );
			
			//si l'individu n'existe pas dans l'annuaire on conserve le nom prenom de la liste de diffusion
			$userID = $user->getID();
			if (!isset($userID))
			{
				$user->setMail($line [1]);
				$user->setNom($line [3]);
				$user->setPrenom($line [4]);
				$user->setCivilite($line [5]);
			}
			
			if ($user->getLoginRgpd() != '')
			{
				$login = $user->getLoginRgpd();
			}
			else 
			{
				$login = $user->getLogin();
			}
			if ($user->getPasswordRgpd() != '')
			{
				$pwd = 	$user->getPasswordRgpd();
			}
			else
			{
				$pwd = $user->getPassword();
			}
			
			$aMail->setMessage ( str_replace ( '{Nom}', $user->getNom (), $msg ) );
			$aMail->setMessage ( str_replace ( '{Prenom}', $user->getPrenom (), $aMail->getMessage () ) );
			$aMail->setMessage ( str_replace ( '{Email}', $user->getMail (), $aMail->getMessage () ) );
			$aMail->setMessage ( str_replace ( '{Login}', $login, $aMail->getMessage () ) );

			// Crypter le mot de passe
			$pwd = base64_encode ( $user->getPassword () );
			
			// Crypter le mail et le mot de passe pour ciscar.net
			if ($user->getLogin () != '')
				$userPrestashopLogin = base64_encode ( utf8_encode ( stripslashes ( $user->getMail () . '&' . $user->getPassword () ) ) );
			else
				$userPrestashopLogin = base64_encode ( utf8_encode ( stripslashes ( 'visitor@ciscar.net' . '&' . 'a1b2c3d4' ) ) );

			// Crypter le nom prenom mail civilite pour enquete en ligne si le login n'existe pas
			if ($user->getLogin () == '')
				$userEnquete = base64_encode ( utf8_encode ( stripslashes ( $user->getNom() . '&' . $user->getPrenom() .'&'. $user->getMail () .'&'. $user->getCivilite()) ) );
						
				
			$aMail->setMessage ( str_replace ( '{Mdp}', $user->getPassword (), $aMail->getMessage () ) );
			$aMail->setMessage ( str_replace ( '{Civ}', $user->getStringCivilite (), $aMail->getMessage () ) );
			$aMail->setMessage ( str_replace ( '{Cher}', $user->getStringCher (), $aMail->getMessage () ) );
			if ($user->getLogin () != '') {
				$aMail->setMessage ( str_replace ( '{Login_User}', '&login=' . $login . '&pwd=' . $pwd . '&news=' . $aNewsletter->getID () . '&env=' . $EnvoiID, $aMail->getMessage () ) );
				$aMail->setMessage ( str_replace ( '.fr&login=', '.fr?login=', $aMail->getMessage () ) );
				$aMail->setMessage ( str_replace ( '.vm&login=', '.vm?login=', $aMail->getMessage () ) );
				$aMail->setMessage ( str_replace ( '.com&login=', '.com?login=', $aMail->getMessage () ) );
				$aMail->setMessage ( str_replace ( '.com/convention/&login=', '.com/convention/&?login=', $aMail->getMessage () ) );
				$aMail->setMessage ( str_replace ( '.be&login=', '.be?login=', $aMail->getMessage () ) );
				$aMail->setMessage ( str_replace ( '.204&login=', '.204?login=', $aMail->getMessage () ) );
				$aMail->setMessage ( str_replace ( '.php&login=', '.php?login=', $aMail->getMessage () ) );

				// Enquete en ligne
				$aMail->setMessage ( str_replace ( '{Login_Enquete}', '' , $aMail->getMessage () ) );
				// ciscar.net
				$aMail->setMessage ( str_replace ( '{Login_Prestashop}', '&autologin=' . $userPrestashopLogin . '&news=' . $aNewsletter->getID () . '&env=' . $EnvoiID, $aMail->getMessage () ) );
				$aMail->setMessage ( str_replace ( '.net&autologin=', '.net/index.php?controller=authentication&autologin=', $aMail->getMessage () ) );
			} 
			else 
			{
				$aMail->setMessage ( str_replace ( '{Login_User}', '&news=' . $aNewsletter->getID () . '&env=' . $EnvoiID, $aMail->getMessage () ) );
				// Enquete en ligne
				//$aMail->setMessage ( str_replace ( '{Login_Enquete}', '&enquetelogin=' . $userEnquete . '&news=' . $aNewsletter->getID () . '&env=' . $EnvoiID, $aMail->getMessage () ) );
				$aMail->setMessage ( str_replace ( '{Login_Enquete}', '&eqtelogin=' . $userEnquete . '&news=' . $aNewsletter->getID () . '&env=' . $EnvoiID, $aMail->getMessage () ) );
				// ciscar.net
				$aMail->setMessage ( str_replace ( '{Login_Prestashop}', '&autologin=' . $userPrestashopLogin . '&news=' . $aNewsletter->getID () . '&env=' . $EnvoiID, $aMail->getMessage () ) );
				$aMail->setMessage ( str_replace ( '.net&autologin=', '.net/index.php?controller=authentication&autologin=', $aMail->getMessage () ) );
			}

			// si l'établissement est renseigné (Maj Annuaire)
			$soc = $line [6];
			if ($soc != '') {
				// pour se connecter directement sur l'établissement (Maj Annuaire)				
				$tab_soc = explode ( "+", $soc );
				
				$mess = '';
				foreach ($tab_soc as $idsoc)
				{
					$etablissement->select_etablissement ( $idsoc );
					$mess .= 
					'<tr>
					<td>
					<p style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#1c86c2; text-align:center; margin:5px;">'.$etablissement->getRaisonSociale ().'</p>
					</td>
					<td bgcolor="#18a689">
					<p style="font-family:Arial, Helvetica, sans-serif; font-size:12px; color:#ffffff; text-align:center; margin:20px;"><a style="color:#FFFFFF;" target="_blank" href="http://gcrfrance.com/annuaire/'.$idsoc.'"><strong>Acc&eacute;der                         &agrave; la fiche</strong></a></p>
					</td>
					</tr>
					<tr>
					<td colspan="2">
					<p style="font-family:Arial, Helvetica, sans-serif; font-size:13px; color:#383838; margin:5px; text-align:center;">Vous souhaitez d&eacute;l&eacute;guer cette mise &agrave; jour ? 
					<a href="http://gcrfrance.com/annuaire/'.$idsoc.'&deleg=1">Cliquez-ici</a></p>
					</td>
					</tr>';
					//$aMail->setMessage ( str_replace ( '{societeID}', '?soc=' . $soc, $aMail->getMessage () ) );
				}
				$aMail->setMessage ( str_replace ( '{raisonSoc}', $mess, $aMail->getMessage () ) );
			}
			// Add Shortcode NewsletterSC
			$aMail->setMessage ( ShortcodeManager::do_shortcode ( str_replace ( '[Newsletter_UserInfo_box]', '[Newsletter_UserInfo id="' . $line [0] . '"]', $aMail->getMessage () ) ) );
			$aMail->setMessage ( ShortcodeManager::do_shortcode ( str_replace ( '[NAME_USER]', '[Newsletter_NameUser id="' . $line [0] . '"]', $aMail->getMessage () ) ) );
			$aMail->setMessage ( ShortcodeManager::do_shortcode ( str_replace ( '[LOGIN_USER]', '[Newsletter_LoginUser id="' . $line [0] . '"]', $aMail->getMessage () ) ) );

			// Envoyer mail
			$aMail->setTo ( $line [1] );
			if (! $aMail->send()) {
				$aNewsletterHistorique->setDescription ( 'Notification Newsletter en Erreur : ' . $line [1] );
			} else {
				$aNewsletterHistorique->setDescription ( 'Notification Newsletter Envoyée : ' . $line [1] );
			}
			$aNewsletterHistoriqueManager->add ( $aNewsletterHistorique );
		}
	}
}
?>