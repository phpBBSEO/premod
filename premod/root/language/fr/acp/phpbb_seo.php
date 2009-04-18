<?php
/** 
*
* seo_cache [French]
*
* @package phpbb_seo
* @version $Id: phpbb_seo.php, 2007/08/30 13:48:48 fds Exp $
* @copyright (c) 2007 phpBB SEO
*
*/
/**
* DO NOT CHANGE
*/
if (empty($lang) || !is_array($lang))
{
	$lang = array();
}
// DEVELOPERS PLEASE NOTE
//
// All language files should use UTF-8 as their encoding and the files must not contain a BOM.
//
// Placeholders can now contain order information, e.g. instead of
// 'Page %s of %s' you can (and should) write 'Page %1$s of %2$s', this allows
// translators to re-order the output of data while ensuring it remains correct
//
// You do not need this where single placeholders are used, e.g. 'Message %d' is fine
// equally where a string contains only two placeholders which are used to wrap text
// in a url you again do not need to specify an order e.g., 'Click %sHERE%s' is fine
$lang = array_merge($lang, array(
	// ACP Main CAT
	'ACP_CAT_PHPBB_SEO'	=> 'phpBB SEO',
	'ACP_MOD_REWRITE'	=> 'Réécriture d\'url',
	// ACP sub cat
	'ACP_PHPBB_SEO_CLASS' => 'Configuration de la classe phpBB SEO',
	'ACP_PHPBB_SEO_CLASS_EXPLAIN'	=> 'Vous pouvez ici régler différentes options du mod rewrite phpBB SEO.<br/>Les réglages par défaut comme les délimiteurs et les extensions doivent toujours être configurés dans le fichier phpbb_seo_class.php, les modifier implique un changement de .htaccess ainsi que des redirections appropriés.%s',
	'ACP_PHPBB_SEO_VERSION' => 'Version',
	'ACP_SEO_SUPPORT_FORUM' => 'Forum de support',
	// ACP sub cat
	'ACP_FORUM_URL'	=> 'Configuration des URL des forums',
	'ACP_FORUM_URL_EXPLAIN'		=> 'Vous pouvez régler ici le contenu du cache, qui sera injecté dans les URLs des forums.<br/>Les forum en vert sont en cache, ceux en rouge pas encore.<br/><b style="color:red">Nota Bene :</b><ul style="margin-left:20px;font-size:12px;"><b>mots-cles-fxx/</b> sera toujours convenablement redirigé par le zéro duplicate, mais pas si vous le modifier par la suite : <b>mots-cles/</b> ne sera pas directement redirigé vers <b>autres-mots-cles/</b>.<br/> Dans ce cas, <b>mots-cles/</b> sera considéré comme une forum qui n\'existe pas, à défaut de redirections personnalisées.</ul><br/>',
	'ACP_NO_FORUM_URL'	=> '<b>La configuration des URL des forums est désactivée<b><br/>La configuration des URL des forums est uniquemant possible en mode Avancé ou Intermédiaire et lorsque le Cache des URL des Forums est activé.<br/> Les URLs éventuellement configurées continuent cependant d\'être utilisées en mode Avancé ou Intermédiaire.',
	// ACP sub cat
	'ACP_HTACCESS'	=> 'htaccess',
	'ACP_HTACCESS_EXPLAIN'	=> 'Cet outil vous aidera à construire votre .htaccess.<br/>La version proposée ci-dessous prends en compte les réglages du fichier phpbb_seo/phpbb_seo_class.php.<br/>Vous pouvez modifier les valeurs des tableaux $seo_ext et $seo_static et personnaliser vos URLs avant de générer un .htaccess.<br/>Vous pouvez par exemple choisir d\'utiliser .htm au lieu de .html, \'message\' au lieu de \'post\' \'mon-equipe\' au lieu de \'equipe\' etc ...<br/>Si vous modifiez ces valeurs après que vos pages aient été indexées, vous aurez besoin de redirections personnalisées.<br/>Les réglages par défaut ne sont pas du tout mauvais, vous pouvez sauter la première étape de personnalisation sans soucis si vous préférez.<br/>Par défaut, le .htacess ci-dessous doit être placé à la racine de votre domaine (ie : où www.example.com est installé).<br/>Si phpBB est installé dans un sous dossier, cliquez sur le bouton "Plus d\'options" ce-dessous ajoutera une option pour permettre son utilisation dans un sous dossier.',
	'SEO_HTACCESS_RBASE'	=> 'Emplacement du .htaccess',
	'SEO_HTACCESS_RBASE_EXPLAIN' => 'Mettre le .htaccess dans le dossier de phpBB ?<br/>La directive RewriteBase nous permet de mettre le .htaccess dans le dossier du forum. Il est généralement plus simple de le mettre à la racine du domaine même quand phpBB est installé dans un sous-dossier, mais vous pourriez préférer de le mettre dans le dossier du forum.',
	'SEO_HTACCESS_SLASH'	=> 'Slash Droit RegEx ',
	'SEO_HTACCESS_SLASH_EXPLAIN'	=> 'En fonction de votre hébergeur, il se peut que vous ayez à retirer les slashes ("/") se trouvant devant la partie droites des RewriteRule. Ce slash particulier est utilisé par défaut quand le .htaccess est instalé à la racine du domaine. C\'est le contraire quand phpBB est installé dans un sous dossier et que vous souaitez mettre le .htaccess dans celui-ci.<br/>Les réglages par défaut marcheront le plus souvent, si ce n\'est pas le cas, essayer de générer et tester différentes versions de .htaccess cliquant sur le bouton "Mettre à jour".',
	'SEO_HTACCESS_WSLASH'	=> 'RegEx Left Slash',
	'SEO_HTACCESS_WSLASH_EXPLAIN'	=> 'En fonction de votre hébergeur, il se peut que vous ayez à ajouter des slashes ("/") se trouvant devant la partie gauche des RewriteRule. Ce slash particulier n\'est jamais utilisé par défaut.<br/>Les réglages par défaut marcheront le plus souvent, si ce n\'est pas le cas, essayer de générer et tester différentes versions de .htaccess cliquant sur le bouton "Mettre à jour".',
	'SEO_MORE_OPTION'	=> 'Plus d\'Options',
	'SEO_MORE_OPTION_EXPLAIN'	=> 'Si le premier .htaccess suggéré ne fonctionne pas :<br/>Assurez vous tout d\'abord que le mod_rewrite est bien activé sur votre serveur.<br/>Ensuite assurez vous d\'avoir bien mis le .htaccess au bon endroit, et qu\'il n\'est pas perturbé par une autre se trouvant dans un autre dossier.<br/>Si ça ne suffit pas, cliquez sur le bouton "Plus d\'Options".',
	'SEO_HTACCESS_SAVE' => 'Sauvegarder le .htaccess',
	'SEO_HTACCESS_SAVE_EXPLAIN' => 'Si vous cochez l\'option, un fichier .htaccess sera généré dans le dossier phpbb_seo/cache/ folder. Il est prêt à l\emplois et prend en compte vos réglages actuels, mais vous devrez tout de même le déplacer au bon endroit.',
	'SEO_HTACCESS_ROOT_MSG'	=> 'Une fois prêt, vous pouvez sélectionnez le code ce-dessous et copiez le dans un fichier .htaccess vide ou utiliser l\'option "Sauvegarder le .htaccess" ci dessus.<br/> Ce .htaccess est fait pour être utilisé à la racine du domaine (ie : où www.example.com est installé).',
	'SEO_HTACCESS_FOLDER_MSG' => 'Une fois prêt, sélectionnez le code ce-dessous et copiez le dans un fichier .htaccess vide ou utiliser l\'option "Sauvegarder le .htaccess" ci dessus.<br/> Ce .htaccess est fait pour être utilisé dans le dossier de phpBB (ie : www.example.com/phpbb/).',
	'SEO_HTACCESS_CAPTION' => 'Légende',
	'SEO_HTACCESS_CAPTION_COMMENT' => 'Commentaires',
	'SEO_HTACCESS_CAPTION_STATIC' => 'Parties statiques, modifiable dans phpbb_seo_class.php',
	'SEO_HTACCESS_CAPTION_SUFFIX' => 'Extensions, modifiable dans phpbb_seo_class.php',
	'SEO_HTACCESS_CAPTION_DELIM' => 'Délimiteurs, modifiable dans phpbb_seo_class.php',
	'SEO_HTACCESS_CAPTION_SLASH' => 'Slashes Optionnels',
	'SEO_SLASH_DEFAULT'	=> 'Défaut',
	'SEO_SLASH_ALT'		=> 'Alternative',
	'SEO_MOD_TYPE_ER'	=> 'Le type de mod rewrite n\'est pas convenablement configurer dans phpbb_seo/phpbb_seo_class.php.', 
	'SEO_SHOW'		=> 'Montrer',
	'SEO_HIDE'		=> 'Cacher',
	'SEO_SELECT_ALL'	=> 'Selectionner',
	// Install
	'SEO_INSTALL_PANEL'	=> 'Installation phpBB SEO',
	'SEO_ERROR_INSTALL'	=> 'Une erreur est survenue lore de l\'installation. Il est plus prudent de désinstaller une fois avant de rééssayer.',
	'SEO_ERROR_INSTALLED'	=> 'Le module %s est déjà installé',
	'SEO_ERROR_ID'	=> 'Le moldule %s n\'a pas d\'ID.',
	'SEO_ERROR_UNINSTALLED'	=> 'Le moldule %s est déjà désinstallé',
	'SEO_ERROR_INFO'	=> 'Information :',
	'SEO_FINAL_INSTALL_PHPBB_SEO'	=> 'Aller à l\'ACP',
	'SEO_FINAL_UNINSTALL_PHPBB_SEO'	=> 'Retour à l\'index du forum',
	'CAT_INSTALL_PHPBB_SEO'	=> 'Installation',
	'CAT_UNINSTALL_PHPBB_SEO'=> 'DésInstallation',
	'SEO_OVERVIEW_TITLE'	=> 'Vue d\'ensemble du mod rewrite phpBB SEO',
	'SEO_OVERVIEW_BODY'	=> 'Bienvenue sur notre Release Candidate publique du mod rewrite phpBB3 SEO.</p><p>Veuillez lire <a href="http://www.phpbb-seo.com/forums/reecriture-url-avancee/seo-url-phpbb3-avance-vt1501.html" title="Voir le sujet de mise à disposition" target="_phpBBSEO"><b>le sujet de mise à disposition</b></a> pour plus de détails.</p><p><strong style="text-transform: uppercase;">Note:</strong> Vous devez avoir effectué les changements de codes des fichiers et upmloadé tous les nouveaux fichiers avant de continuer avec cet installeur.</p><p>Cet installeur vous guidera pendant le processus d\'installation du module d\'administration du mod rewrite phpBB3 SEO. Ce module vous permettra de choisir précisement vos URLs réécrites pour les meilleurs résultats dans les moteurs de recherche.</p>.',
	'CAT_SEO_PREMOD'	=> 'Premod phpBB SEO',
	'SEO_PREMOD_TITLE'	=> 'Vue d\'ensemble de la premod phpBB SEO',
	'SEO_PREMOD_BODY'	=> 'Bienvenue sur notre Release Candidate publique de la premod phpBB SEO.</p><p>Veuillez lire <a href="http://www.phpbb-seo.com/forums/premod-phpbb-seo/premod-referencement-phpbb-vt1951.html" title="Voir le sujet de mise à disposition" target="_phpBBSEO"><b>le sujet de mise à disposition</b></a> pour plus de détails.</p><p><strong style="text-transform: uppercase;">Note:</strong> Vous allez pouvoir choisir entre les trois différents type de réécriture d\'URL pour phpBB3 de phpBB SEO.<br/><br/><b>Les différents types de réécriture dsplonibles :</b><ul><li><a href="http://www.phpbb-seo.com/forums/reecriture-url-simple/seo-url-phpbb3-simple-vt1945.html" title="Plus de détails sur le mode Simple"><b>Le mode Simple</b></a>,</li><li><a href="http://www.phpbb-seo.com/forums/reecriture-url-intermediaire/seo-url-intermediaire-vt1946.html" title="Plus de détails sur le mode Intermédiaire"><b>Le mode Intermédiaire</b></a>,</li><li><a href="http://www.phpbb-seo.com/forums/reecriture-url-avancee/seo-url-phpbb3-avance-vt1501.html" title="Plus de détails sur le mode Avancé"><b>Le mode Avancé</b></a>.</li></ul>Ce choix est crucial, nous vous invitons à prendre le temps de vous familiariser avec cette premod avant de vous lancer.<br/>Cette premod est simple d\'utilisation et d\'installation, il vous suffit de suivre le processus normal d\'installation de phpBB.<br/><br/>
	<p><u>Prés-requis pour la réécriture d\'URL:</u></p>
	<ul>
		<li>Serveur Apache (linux OS) avec le module mod_rewrite.</li>
		<li>Serveur IIS (windows OS) avec le module isapi_rewrite, vous devrez cependant modifier les rewriterules pour votre httpd.ini</li>
	</ul>
	<p>Une fois l\'installation éfféctuée, vous devrez vous rendre dans l\'ACP de phpBB pour configurer et activer la réécriture d\'url.</p>',
	'SEO_LICENCE_TITLE'	=> 'RECIPROCAL PUBLIC LICENSE',
	'SEO_LICENCE_BODY'	=> 'Les mod rewrites phpBB SEO sont diffusés sous la licence RPL qui indique que vous ne devez pas retirer les crédits phpBB SEO<br/>Pour plus de détails concernant les exceptions possibles, merci de contacter un administrateur de phpBB SEO (Prioritairement SeO ou dcz).',
	'SEO_PREMOD_LICENCE'	=> 'Les mod rewrites phpBB SEO et le Zéro duplicate inclus dans cette premod sont diffusés sous la licence RPL qui indique que vous ne devez pas retirer les crédits phpBB SEO<br/>Pour plus de détails concernant les exceptions possibles, merci de contacter un administrateur de phpBB SEO (Prioritairement SeO ou dcz).',
	'SEO_SUPPORT_TITLE'	=> 'Support',
	'SEO_SUPPORT_BODY'	=> 'Un support complet sera offert sur le <a href="%1$s" title=" Visitez le forum Réécriture URL %2$s" target="_phpBBSEO"><b>forum Réécriture URL %2$s</b></a>. Nous fournirons des réponses aux questions générale, aux problèmes de configuration, et aux problèmes courants.</p><p>Prenez cette occasion de visiter notre <a href="http://www.phpbb-seo.com/forums/" title="Forum référencement" target="_phpBBSEO"><b>Forum d\'optimisation du référencement</b></a>.</p><p>Vous devriez vous <a href="http://www.phpbb-seo.com/forums/profile.php?mode=register" title="S\'inscrire sur phpBB SEO" target="_phpBBSEO"><b>inscrire</b></a>, vous enregistrer et <a href="%3$s" title="Etre tenu au courant des mises à jours" target="_phpBBSEO"><b>suivre le sujet de mise à disposition</b></a> pour être tenu au courant des mises à jours par mail.',
	'SEO_PREMOD_SUPPORT_BODY'	=> 'Un support complet sera offert sur le <a href="http://www.phpbb-seo.com/forums/premod-phpbb-seo-vf64/" title=" Visitez le forum Premod phpBB SEO" target="_phpBBSEO"><b>forum Premod phpBB SEO</b></a>. Nous fournirons des réponses aux questions générale, aux problèmes de configuration, et aux problèmes courants.</p><p>Prenez cette occasion de visiter notre <a href="http://www.phpbb-seo.com/forums/" title="Forum référencement" target="_phpBBSEO"><b>Forum d\'optimisation du référencement</b></a>.</p><p>Vous devriez vous <a href="http://www.phpbb-seo.com/forums/profile.php?mode=register" title="S\'inscrire sur phpBB SEO" target="_phpBBSEO"><b>inscrire</b></a>, vous enregistrer et <a href="http://www.phpbb-seo.com/forums/viewtopic.php?t=1951&watch=topic" title="Etre tenu au courant des mises à jours" target="_phpBBSEO"><b>suivre le sujet de mise à disposition</b></a> pour être tenu au courant des mises à jours par mail.',
	'SEO_INSTALL_INTRO'		=> 'Bienvenue sur l\'installeur phpBB SEO',
	'SEO_INSTALL_INTRO_BODY'	=> '<p>Vous êtes sur le point d\'installer le mod rewrite phpBB SEO %1$s %2$s. Cet outil va activer le module d\'administration du mod dans l\'ACP de phpBB.</p><p>Une fois l\'installation éfféctuée, vous devrez vous rendre dans l\'ACP de phpBB pour configurer et activer la réécriture d\'url.</p>
	<p><strong>Note:</strong> Si c\'est votre première utilisation, nous vous conseillons de prendre le temps de tester ce mod sur un serveur local ou privé pour vous familliariser avec les nombreux standard de réécriture d\'url pris en charge par le mod. De cette façon, vous ne montrerez pas des URLs différentes aux moteurs de recherches tous les deux jours pendant vos réglages. Et vous ne découvrirez pas un mois après installation que vous pouviez utiliser un meilleurs standard d\'URL pour votre forum. Le patience est d\'or pour le référencement, et même si le zéro duplicate rend les redirection HTTP 301 très faciles, vous ne voulez pas rediriger toutes vos URLs trop souvent.</p><br/>
	<p>Prés-requis :</p>
	<ul>
		<li>Serveur Apache (linux OS) avec le module mod_rewrite.</li>
		<li>Serveur IIS (windows OS) avec le module isapi_rewrite, vous devrez cependant modifier les rewriterules pour votre httpd.ini</li>
	</ul>',
	'SEO_INSTALL'		=> 'Installation',
	'UN_SEO_INSTALL_INTRO'		=> 'Bienvenue sur le désintalleur phpBB SEO',
	'UN_SEO_INSTALL_INTRO_BODY'	=> '<p>Vous êtes sur le point de désintaller le module d\'administration du mod rewrite phpBB SEO%1$s %2$s.</p>
	<p><strong>Note:</strong> Cette opération ne désactivera pas la réécriture d\'URL sur votre forum tant que les fichiers de phpBB ne seront pas modifiés.</p>',
	'UN_SEO_INSTALL'		=> 'Désinstallation',
	'SEO_INSTALL_CONGRATS'		=> 'Félicitations !',
	'SEO_INSTALL_CONGRATS_EXPLAIN'	=> '<p>Vous avez correctement installé le mod rewrite phpBB3 SEO %1$s %2$s. Vous devriez maintenant vous rendre dans l\'ACP de phpBB pour configurer et activer la réécriture d\'URL.<p>
	<p>Dans la nouvelle catégorie phpBB SEO, vous pourrez :</p>
	<h2>Configurer et activer la réécriture d\'URL</h2>
		<p>Prenez votre temps, c\'est là que vous allez choisir à quoi vos URL ressembleront. Les options du zéro duplicate apparaitront dans le même menu une fois installé.</p>
	<h2>Gérer précisément les URLs de vos forums</h2>
		<p>Vous pourrez, en mode Intermédiaire et Avancé, dissocier les URLs des forums de leur titres réels et utiliser les mots clés que vous souhaitez dans celles-ci</p>
	<h2>Générer un .htaccess personalisé</h2>
	<p>Une fois que vous aurez procédé aux réglages ci dessus, vous pourrez utiliser une interface simple pour générer votre .htaccess personnalisé et l\'enregistrer sur votre serveur.</p>',
	'UN_SEO_INSTALL_CONGRATS'	=> 'Le module d\'administration phpBB SEO à été désinstallé.',
	'UN_SEO_INSTALL_CONGRATS_EXPLAIN'	=> '<p>>Vous avez correctement désinstallé le mod rewrite phpBB3 SEO  %1$s %2$s.<p>
	<p> Cette opération ne désactivera pas la réécriture d\'URL sur votre forum tant que les fichiers de phpBB ne seront pas modifiés.</p>',
	// Security
	'SEO_LOGIN'		=> 'Vous devez être enregistré pour pouvoir accéder à cette page.',
	'SEO_LOGIN_ADMIN'	=> 'Vous devez être enregistré en tant qu\'administrateur pour pouvoir accéder à cette page.<br/>Votre session à été détruite pour des raisons de sécurité.',
	'SEO_LOGIN_FOUNDER'	=> 'Vous devez être enregistré en tant que fondateur pour pouvoir accéder à cette page.',
	'SEO_LOGIN_SESSION'		=> 'LA vérification de sessions à échouée.<br/>Aucune modification prise en compte.<br/>Votre session à été détruite pour des raisons de sécurité.',
	// Cache status
	'SEO_CACHE_FILE_TITLE'	=> 'Statut du cache',
	'SEO_CACHE_STATUS'		=> 'Le dossier du cache configuré est : <b>%s</b>',
	'SEO_CACHE_FOUND'		=> 'Le dossier cache à bien été trouvé.',
	'SEO_CACHE_NOT_FOUND'		=> 'Le dossier cache n\'à pas été trouvé.',
	'SEO_CACHE_WRITABLE'		=> 'Le dossier cache est utilisable.',
	'SEO_CACHE_UNWRITABLE'		=> 'Le dossier cache n\'est pas utilisable. Vous devez configurer son CHMOD sur 0777.',
	'SEO_CACHE_FORUM_NAME'		=> 'Nom du Forum',
	'SEO_CACHE_URL_OK'		=> 'URL en cache',
	'SEO_CACHE_URL_NOT_OK'		=> 'URL pas en cache',
	'SEO_CACHE_URL'			=> 'URL Finale',
	'SEO_CACHE_MSG_OK'	=> 'Le fichier cache a bien été mis à jour.',
	'SEO_CACHE_MSG_FAIL'	=> 'Un erreur s\'est produite lors de la mise à jour du cache.',
	'SEO_CACHE_UPDATE_FAIL'	=> 'L\'URL que vous avez soumise ne peut être utilisée, le cache n\'a pas été modifié.',
	// Seo advices
	'SEO_ADVICE_DUPE'	=> 'Un duplicata de ce titre à été détecté pour ce forum.<br/>Vous devez utiliser un titre et une URL unique pour chaque forum.',
	'SEO_ADVICE_LENGTH'	=> 'L\'URL en cache est un peu trop longue.<br/>Vous devriez en utiliser une plus courte.',
	'SEO_ADVICE_DELIM'	=> 'L\'URL en cache utilise le délimiteur et l\'ID du forum.<br/>Vous devriez en utiliser une sans.',
	'SEO_ADVICE_WORDS'	=> 'L\'URL en cache contient un peu trop de mots.<br/>Vous devriez en utiliser une autre.',
	'SEO_ADVICE_DEFAULT'	=> 'L\'URL finale, après formatage est celle par défaut.<br/>Vous devriez en utiliser une autre.',
	'SEO_ADVICE_START'	=> 'Les URLs soumises ne peuvent pas se terminer par un paramètre de pagination.<br/>Il a donc été retiré.',
	'SEO_ADVICE_DELIM_REM'	=> 'Les URLs soumises ne peuvent pas se terminer par un délimiteur de forum.<br/>Il a donc été retiré.',
	// Mod Rewrite type
	'ACP_SEO_SIMPLE'	=> 'Simple',
	'ACP_SEO_MIXED'		=> 'Intermédiaire',
	'ACP_SEO_ADVANCED'	=> 'Avancée',
	// phpBB SEO Class option
	'url_rewrite' => 'Activer la réécriture d\'URL',
	'url_rewrite_explain' => 'Une fois que vous aurez configurer les options ci-dessous, et généré votre .htaccess personalisé, vous pouvez activer la réécriture d\'URL et vérifier que vos nouvelles URLs fonctionnent correctement. Si vous rencontrez des erreurs 404, c\'est pratiquement à coup sûr lié au .htaccess, essayez alors les options du générateur de .htaccess pour en tester un nouveau.',
	'modrtype' => 'Type de réécriture d\'URL',
	'modrtype_explain' => 'La premod phpBB SEO est compatible avec les trois standards de réécriture d\'URL.<br/>Les trois types de réécriture d\'URL sont : Le mode <a href="http://www.phpbb-seo.com/forums/reecriture-url-simple/seo-url-phpbb3-simple-vt1945.html" title="Plus de détails sur le mode Simple"><b>Simple</b></a>, le mode <a href="http://www.phpbb-seo.com/forums/reecriture-url-intermediaire/seo-url-intermediaire-vt1946.html" title="Plus de détails sur le mode Intermédiaire"><b>Intermédiaire</b></a> et le mod <a href="http://www.phpbb-seo.com/forums/reecriture-url-avancee/seo-url-phpbb3-avance-vt1501.html" title="Plus de détails sur le mode Avancé"><b>Avancé</b></a>.<br/><br/><b style="color:red">Nota Bene :</b><br/><ul style="margin-left:20px">Modifier cette option va changer  toutes les URLs de votre site presque trop facilement.<br/>Si vous la modifiez sur un site déjà convenablement indexé, l\'opération doit être réalisé avec autant de soins et de réflexion préalable que s\'il s\'agissait d\'une migration et pas trop souvent.</ul>',
	'rem_sid' => 'Retrait des SID',
	'rem_sid_explain' => 'Les SID seront retirées pour 100% des URLs passée par la réécriture, pour les invités et donc les bots.<br/>Cela nous assure que les bots ne verront pas de SID sur les URLs de forums, sujets et messages, mais les visiteurs n\'acceptant pas les cookies auront des chances de créer plus d\'une session.<br/>Les SIDs sont toujours retirés pour les invités et robots par le zéro duplicate.',
	'rem_hilit' => 'Retrait des Highlights',
	'rem_hilit_explain' => 'Les Highlights seront retirées pour 100% des URLs passée par la réécriture, pour les invités et donc les bots.<br/>Cela nous assure que les bots ne verront pas de Highlights sur les URLs de forums, sujets et messages.<br/>Les zéro duplicate suivra ce réglage, en redirigeant les urls avec des highlights pour les invités et les bots.',
	'rem_small_words' => 'Filtre des mots courts',
	'rem_small_words_explain' => 'Vous permet de ne pas injecter les mots de moins de 3 lettres dans les URLs.<br/><br/><b style="color:red">Nota Bene :</b><br/><ul style="margin-left:20px">L\'activation de ces filtres peut changer un grand nombre d\'URLs de votre site.<br/>Si vous l\'activez sur un site déjà convenablement indexé, l\'opération doit être réalisé avec autant de soins et de réflexion préalable que s\'il s\'agissait d\'une migration et pas trop souvent.</ul>',
	'virtual_folder' => 'Dossier Virtuels',
	'virtual_folder_explain' => 'Vous permet d\'utiliser les forums comme des dossier virtuels dans les URLs des sujets.<br/><u>Exemple :</u><ul style="margin-left:20px"><b>titre-forum-fxx/titre-sujet-txx.html</b> VS <b>titre-sujet-txx.html</b><br/>pour une URL de sujet.</ul><br/><b style="color:red">Nota Bene :</b><br/><ul style="margin-left:20px">L\'utilisation des dossier virtuels peut changer un grand nombre d\'URLs de votre site presque trop facilement.<br/>Si vous l\'activez sur un site déjà convenablement indexé, l\'opération doit être réalisé avec autant de soins et de réflexion préalable que s\'il s\'agissait d\'une migration et pas trop souvent.</ul>',
	'virtual_root' => 'Racine Virtuelle',
	'virtual_root_explain' => 'Si phpBB est installé dans un sous dossier (exemple phpBB3/), vous pouvez simuler une installation à la racine du domaine pour les liens réécrits.<br/><u>Exemple :</u><ul style="margin-left:20px"><b>phpBB3/titre-forum-fxx/titre-sujet-txx.html</b> VS <b>titre-forum-fxx/titre-sujet-txx.html</b><br/>pour une URL de sujet.</ul><br/>Cela peut être pratique pour raccourcir vos URLs, surtout si vous utilisez l\'option "Dossier Virtuel". Les liens non réécrits continueront d\'apparaître et de fonctionner à l\'interieur du dossier d\'installation de phpBB.<br/><br/><b style="color:red">Nota Bene :</b><br/><ul style="margin-left:20px">L\'utilisation de cette option impose d\'utiliser une page d\'accueil pour votre forum (comme forum.html).<br/> Elle peut également changer un grand nombre d\'URLs de votre site presque trop facilement.<br/>Si vous l\'activez sur un site déjà convenablement indexé, l\'opération doit être réalisé avec autant de soins et de réflexion préalable que s\'il s\'agissait d\'une migration et pas trop souvent.</ul>',
	'cache_layer' => 'Cache des URL des Forums',
	'cache_layer_explain' => 'Active le cache des URLs des forums, ce qui permet de dissocier leur titres de leurs URLs.<br/><u>Exemple :</u><ul style="margin-left:20px"><b>titre-forum-fxx/</b> VS <b>mots-clés-fxx/</b><br/>pour une URL de Forum.</ul><br/><b style="color:red">Nota Bene :</b><br/><ul style="margin-left:20px">Cette option vous permet de modifier les URLs de forum, ainsi que potentiellement celle de nombreux sujets si vous utilisez l\'option "Dossier Virtuels".<br/>Les URLs des sujets seront toujours convenablement redirigées par le zéro duplicate.<br/>Ce sera aussi le cas pour les Forums dot les URL comportent délimiteur et ID, voir ci-dessous.</ul>',
	'rem_ids' => 'Retrait des ID de Forums',
	'rem_ids_explain' => 'Permet de retirer le délimiteur et l\'ID des forums de leurs URLs. Nécessite l\'activation du Cache.<br/><u>Exemple :</u><ul style="margin-left:20px"><b>mots-cles-fxx/</b> VS <b>mots-cles/</b><br/>pour une URL de Forum.</ul><br/><b style="color:red">Nota Bene :</b><br/><ul style="margin-left:20px">Cette option vous permet de modifier les URLs de forum, ainsi que potentiellement celle de nombreux sujets si vous utilisez l\'option "Dossier Virtuels".<br/>Les URLs des sujets seront toujours convenablement redirigées par le zéro duplicate.<br/><u>Cela ne sera pas le cas pour les URL des Forum utilisant cette option :</u><br/><ul style="margin-left:20px"><b>mots-cles-fxx/</b> sera toujours convenablement redirigé, mais ce ne sera plus le cas si vous éditez par la suite<b>mots-cles/</b> pour utiliser par exemple <b>autres-mots-cles/</b>.<br/>Dans ce cas, <b>mots-cles/</b>  sera considéré comme une forum qui n\'existe pas, à défaut de redirections personnalisées. Cela dit, c\'est une optimisation intéressante pour le référencement.</ul></ul>',
	// Zero duplicate
	// Options 
	'ACP_ZERO_DUPE_OFF' => 'Inactif',
	'ACP_ZERO_DUPE_MSG' => 'Message',
	'ACP_ZERO_DUPE_GUEST' => 'Invités',
	'ACP_ZERO_DUPE_ALL' => 'Tous',
	'zero_dupe' => 'Zéro duplictate',
	'zero_dupe_explain' => 'Les options suivantes concerne le Zéro duplicate, vous pouvez les modifier à votre guise.<br/>Ces options n\'entrainent pas de modification du .htaccess.',
	'zero_dupe_on' => 'Activer le Zéro duplictate',
	'zero_dupe_on_explain' => 'Permet d\'activer les redirections du Zéro duplicate.',
	'zero_dupe_strict' => 'Mode stricte',
	'zero_dupe_strict_explain' => 'Quand il est activé le Zéro dupe vérifiera que l\'URL entrante est exactement égale à l\'URL attendue.<br/>Quand il ne l\'est pas le Zéro dupe vérifiera uniquement que l\'URL entrante commence bien par l\'URL attendue.<br/>L\'intérêt de ce réglage est de rendre plus facile l\'installation et l\'utilisation de mod qui ajouterait de telles variables, tout en maintenant une réduction de duplicate proche de 100 %.',
	'zero_dupe_post_redir' => 'Redirection des messages',
	'zero_dupe_post_redir_explain' => 'L\'option va déterminer la manière de prendre en charge les URLs des messages ; elle peut prendre quatre valeurs :<ul style="margin-left:20px"><li><b>&nbsp;Inactif</b>, Pour désactiver les redirections des URLs de messages,</li><li><b>&nbsp;Message</b>, Pour s\'assurer seulement que postxx.html est utilisé pour une URL de message,</li><li><b>&nbsp;Invités</b>, Pour rediriger les invités si besoin sur l\'URL du sujet correspondant, plutot que sur postxx.html, et seulement s\'assurer que postxx.html est utilisé les utilisateurs enregistrés,<li><b>&nbsp;Tous</b>, Pour rediriger si besoin sur l\'URL du sujet correspondant.</li></ul><br/><b style="color:red">Nota Bene :</b><br/><ul style="margin-left:20px">Conserver les url des messages en postxx.hmlt est sans conséquences pour votre référencement dans la mesure ou vous avez bien mis en place l\'interdiction de ces url dans votre robots.txt<br/>C\'est certainement la redirection qui interviendrait le plus souvent si non.<br/>De plus si vous choisissez de rediriger postxx.html dans tous les cas, cela implique qu\'un message qui serait posté dans un sujet et qui serait ensuite déplacé dans un autre verra son url changer.<br/>Ce n\'est pas grave d\'un point de vue du référencement, le zéro duplicate veille, mais l\'url initiale d\'un message déplacé ne sera plus lié à celui ci dans ce cas là</ul>',
	// no duplicate
	'no_dupe' => 'No duplictate',
	'no_dupe_on' => 'Activer le No duplictate',
	'no_dupe_on_explain' => 'Le mod No duplicate remplace les URLs de messages par leur équivalent en URL de sujet (avec pagination).<br/>L\'activation du mod ajoute un LEFT JOIN sur une requête existante. Cela veut dire un peu plus de travail, mais cela ne devrait pas influencer le temps de chargement de page significativement.',
));
?>
