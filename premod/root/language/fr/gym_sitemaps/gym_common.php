<?php
/** 
*
* gym_common [French]
*
* @package phpbb_seo
* @version $Id: gym_common.php, 2007/08/30 13:48:48 fds Exp $
* @copyright (c) 2007, 2008 phpBB SEO
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
	'RSS_AUTH_SOME_USER' => '<b><u>Avertissement :</u></b>Cette liste d’éléments est personalisée selon les autorisations de <b>%s</b>.<br/>Certains éléments ne seront pas visibles par les invités.',
	'RSS_AUTH_THIS_USER' => '<b><u>Avertissement :</u></b>Cet élément est personalisé selon les autorisations de <b>%s</b>.<br/>Il ne sera pas visible par les invités.',
	'RSS_AUTH_SOME' => '<b><u>Avertissement :</u></b>Cette liste d’éléments n’est pas publique.<br/>Certains éléments ne seront pas visibles par les invités.',
	'RSS_AUTH_THIS' => '<b><u>Avertissement :</u></b>Cet élément n’est pas public.<br/>Il ne sera pas visible par les invités.',
	'RSS_CHAN_LIST_TITLE' => 'Liste des flux',
	'RSS_CHAN_LIST_DESC' => 'Ceci est une liste de tous les flux RSS disponibles.',
	'RSS_CHAN_LIST_DESC_MODULE' => 'Ceci est une liste de tous les flux RSS disponibles pour : %s.',
	'RSS_ANNOUCES_DESC' => 'Ce flux liste toutes les annonces globales de : %s',
	'RSS_ANNOUNCES_TITLE' => 'Annonces de : %s',
	'GYM_LAST_POST_BY' => 'Dernier message par ',
	'GYM_FIRST_POST_BY' => 'Message de ',
	'GYM_LINK' => 'Lien',
	'GYM_SOURCE' => 'Source',
	'RSS_MORE' => 'plus',
	'RSS_CHANNELS' => 'Canaux',
	'RSS_CONTENT' => 'Résumé',
	'RSS_SHORT' => 'Liste courte',
	'RSS_LONG' => 'Liste longue',
	'RSS_NEWS' => 'Actualités',
	'RSS_NEWS_DESC' => 'Dernières actualités de',
	'RSS_REPORTED_UNAPPROVED' => 'Ce sujet est en attente d’approbation.',

	'GYM_HOME' => 'Page principale',
	'GYM_FORUM_INDEX' => 'Index du forum',
	'GYM_LASTMOD_DATE' => 'Dernière modification',
	'GYM_SEO' => 'Optimisation du référencement',
	'GYM_MINUTES' => 'minute(s)',
	'GYM_SQLEXPLAIN' => 'Rapport SQL',
	'GYM_SQLEXPLAIN_MSG' => 'Connecté en tant qu’admin, vous pouvez vérifier le %s de cette page.',

	'GOOGLE_SITEMAP' => 'Sitemap',
	'GOOGLE_SITEMAP_OF' => 'Sitemap de',
	'GOOGLE_SITEMAPINDEX' => 'SitemapIndex',
	'GOOGLE_NUMBER_OF_SITEMAP' => 'Nombre de Sitemaps dans ce SitemapIndex Google',
	'GOOGLE_NUMBER_OF_URL' => 'Nombre d’URLs dans ce Sitemap Google',
	'GOOGLE_SITEMAP_URL' => 'URL du Sitemap',
	'GOOGLE_CHANGEFREQ' => 'Fréquence de Màj',
	'GOOGLE_PRIORITY' => 'Priorité',

	'RSS_FEED' => 'Flux RSS',
	'RSS_2_LINK' => 'Lien du flux RSS 2.0',
	'RSS_UPDATE' => 'Mise à jour',
	'RSS_LAST_UPDATE' => 'Dernière Màj',
	'RSS_SUBSCRIBE_POD' => '<h2>S’abonner à ce flux!</h2>Avec votre service préféré.',
	'RSS_SUBSCRIBE' => 'Pour s’abonner manuellement à ce flux, utilisez l’URL suivante :',
	'RSS_ITEM_LISTED' => 'Un élément listé.',
	'RSS_ITEMS_LISTED' => 'éléments listés.',
	'RSS_VALID' => 'Flux RSS 2.0 valide',

	// Old URL handling
	'RSS_1XREDIR' => 'Ce flux RSS a été déplacé',
	'RSS_1XREDIR_MSG' => 'Ce flux RSS a été déplacé, il se trouve désormais à cette adresse',
));
?>
