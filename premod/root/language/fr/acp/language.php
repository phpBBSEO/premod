<?php
/**
*
* acp_language [Standard french]
* @translated originally by phpBB.biz and phpBB-fr.com
* @translated currently by phpBB-fr.com (http://www.phpbb-fr.com)
*
* @package language
* @version $Id$
* @copyright (c) 2005 phpBB Group
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

/**
* DO NOT CHANGE
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

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
//
// Some characters you may want to copy&paste:
// ’ « » “ ” …
//

$lang = array_merge($lang, array(
	'ACP_FILES'						=> 'Fichiers de langue de l’administration',
	'ACP_LANGUAGE_PACKS_EXPLAIN'	=> 'Vous pouvez installer/supprimer des packs de langue. Le pack de langue par défaut est marqué d’un astérisque (*).',

	'EMAIL_FILES'					=> 'Modèles d’e-mail',

	'FILE_CONTENTS'					=> 'Contenu du fichier',
	'FILE_FROM_STORAGE'				=> 'Fichier du répertoire de stockage',

	'HELP_FILES'					=> 'Fichiers d’aide',

	'INSTALLED_LANGUAGE_PACKS'		=> 'Packs de langue installés',
	'INVALID_LANGUAGE_PACK'			=> 'Le pack sélectionné ne semble pas être valide. Vérifiez-le et recommencez le transfert si nécessaire.',
	'INVALID_UPLOAD_METHOD'			=> 'La méthode de transfert choisie n’est pas valide, choisissez-en une autre.',

	'LANGUAGE_DETAILS_UPDATED'			=> 'Informations de langue mises à jour.',
	'LANGUAGE_ENTRIES'					=> 'Clés de langue',
	'LANGUAGE_ENTRIES_EXPLAIN'			=> 'Vous pouvez modifier le contenu des clés de langue existantes ou pas encore traduites.<br /><strong>Note :</strong> Une fois le fichier de langue modifié, les modifications seront enregistrées dans un dossier séparé que vous pourrez télécharger. Les modifications ne seront pas visibles par les utilisateurs jusqu’à ce que vous transferiez les fichiers originaux sur votre hébergement Web.',
	'LANGUAGE_FILES'					=> 'Fichiers de langue',
	'LANGUAGE_KEY'						=> 'Clé de langue',
	'LANGUAGE_PACK_ALREADY_INSTALLED'	=> 'Ce pack de langue est déjà installé.',
	'LANGUAGE_PACK_DELETED'				=> 'Le pack de langue « %s » a été supprimé. La langue paramétrée pour les membres qui utilisaient ce pack est désormais la langue par défaut du forum.',
	'LANGUAGE_PACK_DETAILS'				=> 'Informations du pack de langue',
	'LANGUAGE_PACK_INSTALLED'			=> 'Le pack de langue « %s » a été installé.',
	'LANGUAGE_PACK_CPF_UPDATE'			=> 'Les chaînes de caractères pour la langue des champs de profil personnalisés ont été copiées depuis la langue par défaut. Modifiez-les si nécessaire.',
	'LANGUAGE_PACK_ISO'					=> 'ISO',
	'LANGUAGE_PACK_LOCALNAME'			=> 'Nom local',
	'LANGUAGE_PACK_NAME'				=> 'Nom',
	'LANGUAGE_PACK_NOT_EXIST'			=> 'Le pack de langue sélectionné n’existe pas.',
	'LANGUAGE_PACK_USED_BY'				=> 'Utilisé par (robots inclus)',
	'LANGUAGE_VARIABLE'					=> 'Variable de langue',
	'LANG_AUTHOR'						=> 'Auteur du pack de langue',
	'LANG_ENGLISH_NAME'					=> 'Nom Anglais',
	'LANG_ISO_CODE'						=> 'Code ISO',
	'LANG_LOCAL_NAME'					=> 'Nom local',

	'MISSING_LANGUAGE_FILE'		=> 'Fichier de langue manquant : <strong style="color:red">%s</strong>',
	'MISSING_LANG_VARIABLES'	=> 'Variables de langue manquantes',
	'MODS_FILES'				=> 'Fichiers de langue des MODs',

	'NO_FILE_SELECTED'				=> 'Aucun fichier n’a été sélectionné.',
	'NO_LANG_ID'					=> 'Aucun pack de langue n’a été sélectionné.',
	'NO_REMOVE_DEFAULT_LANG'		=> 'Vous ne pouvez pas supprimer le pack de langue par défaut.<br />Si vous voulez supprimer ce pack, changez d’abord la langue par défaut du forum.',
	'NO_UNINSTALLED_LANGUAGE_PACKS'	=> 'Aucun pack de langue installé',

	'REMOVE_FROM_STORAGE_FOLDER'		=> 'Supprimer du répertoire de stockage',

	'SELECT_DOWNLOAD_FORMAT'	=> 'Choisissez le format de téléchargement',
	'SUBMIT_AND_DOWNLOAD'		=> 'Soumettre et télécharger le fichier',
	'SUBMIT_AND_UPLOAD'			=> 'Soumettre et transférer le fichier',

	'THOSE_MISSING_LANG_FILES'			=> 'Les fichiers de langue suivants sont absents du dossier de langue « %s »',
	'THOSE_MISSING_LANG_VARIABLES'		=> 'Les variables de langue suivantes sont absentes du pack « %s »',

	'UNINSTALLED_LANGUAGE_PACKS'	=> 'Packs non installés',

	'UNABLE_TO_WRITE_FILE'		=> 'Le fichier n’a pas pu être enregistré dans %s.',
	'UPLOAD_COMPLETED'			=> 'Le transfert est terminé',
	'UPLOAD_FAILED'				=> 'Le transfert a échoué pour une raison inconnue. Remplacez le fichier manuellement.',
	'UPLOAD_METHOD'				=> 'Méthode de transfert',
	'UPLOAD_SETTINGS'			=> 'Paramètres de transfert',

	'WRONG_LANGUAGE_FILE'		=> 'Le fichier de langue choisi est invalide.',
));

?>