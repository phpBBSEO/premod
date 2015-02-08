<?php
/**
*
* acp_groups [Standard french]
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
	'ACP_GROUPS_MANAGE_EXPLAIN'		=> 'Depuis cette page, vous pouvez gérer tous vos groupes d’utilisateurs. Vous pouvez supprimer, créer et modifier ceux existants. De plus, vous pouvez définir les chefs de groupes, leurs types (ouvert, à la demande, fermé ou invisible), le nom et la description du groupe.',
	'ADD_USERS'						=> 'Ajouter des membres',
	'ADD_USERS_EXPLAIN'				=> 'Vous pouvez ajouter de nouveaux membres aux groupes. Vous pouvez également choisir que ce groupe sélectionné devienne le nouveau groupe par défaut pour les membres sélectionnés. Vous pouvez les définir comme chefs de groupe. Indiquez un nom d’utilisateur par ligne.',

	'COPY_PERMISSIONS'				=> 'Copier les permissions du groupe',
	'COPY_PERMISSIONS_EXPLAIN'		=> 'Une fois créé, le groupe aura les mêmes permissions que le groupe sélectionné.',
	'CREATE_GROUP'					=> 'Créer un nouveau groupe',

	'GROUPS_NO_MEMBERS'				=> 'Aucun membre dans ce groupe',
	'GROUPS_NO_MODS'				=> 'Aucun chef de groupe',

	'GROUP_APPROVE'					=> 'Approuver le(s) membre(s)',
	'GROUP_APPROVED'				=> 'Membres approuvés',
	'GROUP_AVATAR'					=> 'Avatar du groupe',
	'GROUP_AVATAR_EXPLAIN'			=> 'Cette image sera affichée dans le panneau de gestion des groupes.',
	'GROUP_CLOSED'					=> 'Fermé',
	'GROUP_COLOR'					=> 'Couleur du groupe',
	'GROUP_COLOR_EXPLAIN'			=> 'Définit la couleur utilisée pour afficher le nom d’utilisateur des membres du groupe, laissez à vide pour conserver les paramètres par défaut du membre.',
	'GROUP_CONFIRM_ADD_USER'		=> 'Êtes-vous sûr de vouloir ajouter le membre %1$s à ce groupe ?',
	'GROUP_CONFIRM_ADD_USERS'		=> 'Êtes-vous sûr de vouloir ajouter les membres %1$s à ce groupe ?',
	'GROUP_CREATED'					=> 'Le groupe a été créé.',
	'GROUP_DEFAULT'					=> 'Définir comme groupe par défaut',
	'GROUP_DEFS_UPDATED'			=> 'Le groupe a été défini par défaut pour les membres sélectionnés.',
	'GROUP_DELETE'					=> 'Retirer ce(s) membre(s) du groupe',
	'GROUP_DELETED'					=> 'Le groupe a été supprimé, les membres de ce groupe ont été transférés dans le groupe par défaut.',
	'GROUP_DEMOTE'					=> 'Rétrograder le(s) chef(s) de groupe',
	'GROUP_DESC'					=> 'Description du groupe',
	'GROUP_DETAILS'					=> 'informations sur le groupe',
	'GROUP_EDIT_EXPLAIN'			=> 'Vous pouvez modifier un groupe existant. Vous pouvez modifier son nom, sa description et son type (ouvert, fermé, etc.). Vous pouvez également changer certains paramètres comme la couleur, le rang, etc. Les changements effectués ici annulent les préférences utilisateur. Notez que les membres du groupe peuvent modifier les paramètres d’avatar de groupe seulement si vous leur en donnez la permission.',
	'GROUP_ERR_USERS_EXIST'			=> 'Les membres sélectionnés font déjà partie de ce groupe.',
	'GROUP_FOUNDER_MANAGE'			=> 'Gestion par les fondateurs uniquement',
	'GROUP_FOUNDER_MANAGE_EXPLAIN'	=> 'Limite la gestion de ce groupe aux fondateurs. Les membres ayant des permissions de groupes peuvent voir ce groupe, ainsi que les membres du groupe.',
	'GROUP_HIDDEN'					=> 'Invisible',
	'GROUP_LANG'					=> 'Langue du groupe',
	'GROUP_LEAD'					=> 'Chefs de groupe',
	'GROUP_LEADERS_ADDED'			=> 'De nouveaux chefs de groupe ont été ajoutés.',
	'GROUP_LEGEND'					=> 'Afficher le groupe dans la légende',
	'GROUP_LIST'					=> 'Membres actuels',
	'GROUP_LIST_EXPLAIN'			=> 'Voici la liste complète de tous les membres actuels de ce groupe. Vous pouvez retirer ces membres (excepté dans certains groupes spéciaux) ou en ajouter de nouveaux.',
	'GROUP_MEMBERS'					=> 'Membres du groupe',
	'GROUP_MEMBERS_EXPLAIN'			=> 'Voici la liste complète de tous les membres de ce groupe. Ils sont regroupés en trois catégories : Chefs de groupe, membres approuvés et membres en attente. Vous pouvez gérer tous les paramètres des membres de ce groupe ainsi que leurs rôles. Pour rétrograder un chef de groupe mais le conserver dans le groupe, utilisez « Rétrograder » et non « Retirer ». De la même manière, utilisez « Promouvoir » pour passer un membre existant en chef de groupe.',
	'GROUP_MESSAGE_LIMIT'			=> 'Limite de messages privés par dossier pour le groupe',
	'GROUP_MESSAGE_LIMIT_EXPLAIN'	=> 'Ce paramètre annulera la limite des messages des utilisateurs par dossier. Une valeur à « 0 » signifie que la limite des utilisateurs par défaut sera utilisée.',
	'GROUP_MODS_ADDED'				=> 'De nouveaux chefs de groupe ont été ajoutés.',
	'GROUP_MODS_DEMOTED'			=> 'Un ou plusieurs chefs de groupe ont été rétrogradés.',
	'GROUP_MODS_PROMOTED'			=> 'Un ou plusieurs membres ont été promu en chef de groupe.',
	'GROUP_NAME'					=> 'Nom du groupe',
	'GROUP_NAME_TAKEN'				=> 'Le nom du groupe que vous avez indiqué est déjà utilisé, saisissez-en un autre.',
	'GROUP_OPEN'					=> 'Ouvert',
	'GROUP_PENDING'					=> 'Membres en attente',
	'GROUP_MAX_RECIPIENTS'			=> 'Nombre maximum de destinataires autorisés par message privé',
	'GROUP_MAX_RECIPIENTS_EXPLAIN'	=> 'Définit le nombre maximum de destinataires autorisés par message privé.<br />Si défini à « 0 », la valeur utilisée sera celle configurée pour le forum.',
	'GROUP_OPTIONS_SAVE'			=> 'Options du groupe',
	'GROUP_PROMOTE'					=> 'Promouvoir en chef de groupe',
	'GROUP_RANK'					=> 'Rang du groupe',
	'GROUP_RECEIVE_PM'				=> 'Groupe autorisé à recevoir des messages privés',
	'GROUP_RECEIVE_PM_EXPLAIN'		=> 'Notez que les groupes invisibles ne peuvent pas recevoir de messages privés, malgré ce paramètre.',
	'GROUP_REQUEST'					=> 'À la demande',
	'GROUP_SETTINGS_SAVE'			=> 'Paramètres du groupe',
	'GROUP_SKIP_AUTH'				=> 'Exempte le chef de groupe des permissions',
	'GROUP_SKIP_AUTH_EXPLAIN'		=> 'Si activé, le chef de groupe n’héritera pas des permissions de ce groupe.',
	'GROUP_TYPE'					=> 'Type du groupe',
	'GROUP_TYPE_EXPLAIN'			=> 'Cela détermine quels utilisateurs peuvent rejoindre ou voir ce groupe.',
	'GROUP_UPDATED'					=> 'Les préférences du groupe ont été mises à jour.',

	'GROUP_USERS_ADDED'				=> 'Des membres ont été ajoutés au groupe.',
	'GROUP_USERS_EXIST'				=> 'Les membres sélectionnés font déjà partie de ce groupe.',
	'GROUP_USERS_REMOVE'			=> 'Un ou plusieurs membres ont été retirés du groupe et de nouveaux paramètres par défaut ont été définis.',

	'MAKE_DEFAULT_FOR_ALL'	=> 'Définir comme groupe par défaut pour tous les membres',
	'MEMBERS'				=> 'Membres',

	'NO_GROUP'					=> 'Aucun groupe n’a été indiqué.',
	'NO_GROUPS_CREATED'			=> 'Aucun groupe n’a été créé.',
	'NO_PERMISSIONS'			=> 'Ne pas copier les permissions',
	'NO_USERS'					=> 'Aucun membre n’a été indiqué.',
	'NO_USERS_ADDED'			=> 'Aucun membre n’a été ajouté au groupe.',
	'NO_VALID_USERS'			=> 'Aucun membre n’est éligible pour cette action.',

	'SPECIAL_GROUPS'			=> 'Groupes prédéfinis',
	'SPECIAL_GROUPS_EXPLAIN'	=> 'Les groupes prédéfinis sont des groupes spéciaux, ils ne peuvent pas être supprimés ou directement modifiés. Vous pouvez néanmoins y ajouter des membres et modifier les paramètres de base.',

	'TOTAL_MEMBERS'				=> 'Membres',

	'USERS_APPROVED'				=> 'Un ou plusieurs membres ont été approuvés.',
	'USER_DEFAULT'					=> 'Utilisateur par défaut',
	'USER_DEF_GROUPS'				=> 'Groupes personnalisés',
	'USER_DEF_GROUPS_EXPLAIN'		=> 'Ce sont des groupes créés par vous ou un autre administrateur du forum. Vous pouvez y gérer les membres, ainsi que modifier les propriétés du groupe ou même supprimer le groupe.',
	'USER_GROUP_DEFAULT'			=> 'Définir comme groupe par défaut',
	'USER_GROUP_DEFAULT_EXPLAIN'	=> 'Si « Oui », ce groupe sera défini en tant que groupe par défaut pour tous les membres ajoutés.',
	'USER_GROUP_LEADER'				=> 'Définir comme chef de groupe',
));

?>