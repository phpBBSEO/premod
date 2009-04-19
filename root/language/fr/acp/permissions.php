<?php
/** 
*
* acp_permissions [Standard french]
* translated originally by PhpBB-fr.com <http://www.phpbb-fr.com/> and phpBB.biz <http://www.phpBB.biz>
*
* @package language
* @version $Id: permissions.php,v 1.23 2008/07/03 17:41:35 elglobo Exp $
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

$lang = array_merge($lang, array(
	'ACP_PERMISSIONS_EXPLAIN'	=> '		<p>Les permissions sont très nombreuses et regroupées en quatre grandes sections qui sont:

		</p><h2>Permissions globales</h2>
		<p>Elles sont utilisées pour contrôler l’accès de façon globale et sont appliquées à l’ensemble du forum. Elles sont elles-mêmes divisées en permissions des utilisateurs, groupes, administrateurs et modérateurs globaux.</p>

		<h2>Permissions de forums</h2>
		<p>Elles sont utilisées pour contrôler l’accès de base aux forums. Elles sont elles-mêmes divisées en permissions des forums, modérateurs des forums, permissions des forums pour les utilisateurs et permissions des forums pour les groupes.</p>

		<h2>Modèles de permissions</h2>
		<p>Ils sont utilisés afin de créer différents ensembles de permissions pour les différents types de permission pouvant être assignés plus tard à une base de modèles de base. Les modèles par défaut doivent couvrir l’administration des petits et grands forums, cependant dans chacune des quatre divisions, vous pouvez ajouter/éditer/supprimer des modèles selon vos souhaits.</p>

		<h2>Masques de permissions</h2>
		<p>Ils sont utilisés afin de voir les permissions effectives assignées aux utilisateurs, modérateurs (locaux et globaux), administrateurs du forum.</p>

		<br />

		<p>Pour de plus amples informations sur la configuration et la gestion des permissions de votre forum phpBB3, consultez le <a href="http://www.phpbb.com/support/documentation/3.0/quickstart/quick_permissions.html">Chapitre 1.5 de notre Guide de Démarrage Rapide</a>.</p>
	',
	'ACL_NEVER'				=> 'Jamais',
	'ACL_SET'				=> 'Configuration des Permissions',
	'ACL_SET_EXPLAIN'		=> 'Les permissions sont basées sur un simple système <samp>OUI</samp>/<samp>NON</samp>. Régler une option sur <samp>JAMAIS</samp> pour un utilisateur ou groupe d’utilisateurs l’emporte sur toute autre valeur qui lui était assignée. Si vous ne souhaitez pas assigner de valeur à une option pour cet utilisateur ou ce groupe, sélectionnez <samp>NON</samp>. Si des valeurs sont assignées ailleurs pour cette option, elles seront utilisées de préférence, autrement <samp>JAMAIS</samp> est appliqué. Tous les objets sélectionnés (avec la case de choix devant eux) copieront l’ensemble de permissions que vous aurez défini.',
	'ACL_SETTING'			=> 'Configuration',

	'ACL_TYPE_A_'			=> 'Permissions d’administration',
	'ACL_TYPE_F_'			=> 'Permissions des Forums',
	'ACL_TYPE_M_'			=> 'Permissions de Modération',
	'ACL_TYPE_U_'			=> 'Permissions de l’Utilisateur',

	'ACL_TYPE_GLOBAL_A_'	=> 'Permissions d’administration',
	'ACL_TYPE_GLOBAL_U_'	=> 'Permissions de l’Utilisateur',
	'ACL_TYPE_GLOBAL_M_'	=> 'Permissions des modérateurs globaux',
	'ACL_TYPE_LOCAL_M_'		=> 'Permissions des modérateurs',
	'ACL_TYPE_LOCAL_F_'		=> 'Permissions des forums',

	'ACL_NO'				=> 'Non',
	'ACL_VIEW'				=> 'Aperçu des Permissions',
	'ACL_VIEW_EXPLAIN'		=> 'Vous pouvez voir les permissions effectives de l’utilisateur/du groupe. Un rectangle rouge indique que l’utilisateur/le groupe n’a pas la permission, un rectangle vert indique que l’utilisateur/le groupe a la permission.',
	'ACL_YES'				=> 'Oui',

	'ACP_ADMINISTRATORS_EXPLAIN'				=> 'Vous pouvez attribuer des droits d’administration à des utilisateurs ou groupes. Tous les utilisateurs avec des permissions d’administration peuvent accéder au panneau d’administration.',
	'ACP_FORUM_MODERATORS_EXPLAIN'				=> 'Vous pouvez attribuer des utilisateurs et des groupes en tant que modérateurs du forum. Pour attribuer l’accès des utilisateurs aux forums et pour définir des droits de modération globale ou d’administration, utilisez la page appropriée.',
	'ACP_FORUM_PERMISSIONS_EXPLAIN'				=> 'Vous pouvez modifier le nombre d’utilisateurs et de groupes pouvant accéder à certains forums. Pour attribuer des modérateurs ou définir des administrateurs, utilisez la page appropriée.',
	'ACP_GLOBAL_MODERATORS_EXPLAIN'				=> 'Vous pouvez attribuer les droits de modérateur global aux utilisateurs ou aux groupes. Ces modérateurs sont des modérateurs ordinaires excepté qu’ils ont accès à tous les forums.',
	'ACP_GROUPS_FORUM_PERMISSIONS_EXPLAIN'		=> 'Vous pouvez attribuer les permissions des forums aux groupes.',
	'ACP_GROUPS_PERMISSIONS_EXPLAIN'			=> 'Vous pouvez attribuer les permissions globales aux groupes d’utilisateur, de modérateur global et d’administrateur. Les permissions d’utilisateur incluent des possibilités comme l’utilisation d’avatar, l’envoi de messages privés, etc. les permissions de modérateur global comme l’approbation des messages, la gestion des sujets, la gestion des bannissements, etc. et enfin les permissions d’administrateur comme la modification de permissions, la gestion des BBCodes personnalisés, la gestion des forums, etc. Les permissions individuelles des utilisateurs ne doivent être modifiées que dans de rares occasions, la méthode appropriée est l’intégration d’utilisateurs dans des groupes puis l’attribution de permissions à ces groupes.',
	'ACP_ADMIN_ROLES_EXPLAIN'					=> 'Vous pouvez gérer les modèles des permissions des administrateurs. Les modèles sont des permissions effectives, si vous modifiez un modèle les éléments auxquels ce modèle était assigné verront aussi leurs permissions modifiées.',
	'ACP_FORUM_ROLES_EXPLAIN'					=> 'Vous pouvez gérer les modèles des permissions des forums. Les modèles sont des permissions effectives, si vous modifiez un modèle les éléments auxquels ce modèle était assigné verront leurs permissions modifiées aussi.',
	'ACP_MOD_ROLES_EXPLAIN'						=> 'Vous pouvez gérer les modèles des permissions des modérateurs. Les modèles sont des permissions effectives, si vous modifiez un modèle les éléments auxquels ce modèle était assigné verront leurs permissions modifiées aussi.',
	'ACP_USER_ROLES_EXPLAIN'					=> 'Vous pouvez gérer les modèles des permissions des utilisateurs. Les modèles sont des permissions effectives, si vous modifiez un modèle les éléments auxquels ce modèle était assigné verront leurs permissions modifiées aussi.',
	'ACP_USERS_FORUM_PERMISSIONS_EXPLAIN'		=> 'Vous pouvez attribuer les permissions des forums aux utilisateurs.',
	'ACP_USERS_PERMISSIONS_EXPLAIN'				=> 'Vous pouvez attribuer les permissions globales aux utilisateurs - permissions d’utilisateur, permissions de modérateur global et permissions d’administrateur. Les permissions d’utilisateur incluent des possibilités comme l’utilisation d’avatar, l’envoi de messages privés, etc. les permissions de modérateur global comme l’approbation des messages, la gestion des sujets, la gestion des bannissements, etc. et enfin les permissions d’administrateur comme la modification de permissions, la gestion des BBCodes personnalisés, la gestion des forums, etc. Pour modifier les permissions d’un grand nombre d’utilisateurs, le système de permissions des groupes est la méthode la plus appropriée. Les permissions individuelles des utilisateurs ne doivent être modifiées que dans de rares occasions, la méthode appropriée est l’intégration d’utilisateurs dans des groupes et l’attribution de permissions à ces groupes.',
	'ACP_VIEW_ADMIN_PERMISSIONS_EXPLAIN'		=> 'Vous pouvez consulter les permissions effectives des administrateurs assignées aux utilisateurs ou groupes sélectionnés',
	'ACP_VIEW_GLOBAL_MOD_PERMISSIONS_EXPLAIN'	=> 'Vous pouvez consulter les permissions effectives des modérateurs globaux assignées aux utilisateurs ou groupes sélectionnés',
	'ACP_VIEW_FORUM_PERMISSIONS_EXPLAIN'		=> 'Vous pouvez consulter les permissions effectives des forums assignées aux utilisateurs ou groupes sélectionnés',
	'ACP_VIEW_FORUM_MOD_PERMISSIONS_EXPLAIN'	=> 'Vous pouvez consulter les permissions effectives des modérateurs du forum assignées aux utilisateurs ou groupes sélectionnés',
	'ACP_VIEW_USER_PERMISSIONS_EXPLAIN'			=> 'Vous pouvez consulter les permissions effectives des utilisateurs assignées aux utilisateurs ou groupes sélectionnés',

	'ADD_GROUPS'				=> 'Ajouter des groupes',
	'ADD_PERMISSIONS'			=> 'Ajouter des permissions',
	'ADD_USERS'					=> 'Ajouter des utilisateurs',
	'ADVANCED_PERMISSIONS'		=> 'Permissions avancées',
	'ALL_GROUPS'				=> 'Sélectionner tous les groupes',
	'ALL_NEVER'					=> 'Tous sur <samp>JAMAIS</samp>',
	'ALL_NO'					=> 'Tous sur <samp>NON</samp>',
	'ALL_USERS'					=> 'Sélectionner tous les utilisateurs',
	'ALL_YES'					=> 'Tous sur <samp>OUI</samp>',
	'APPLY_ALL_PERMISSIONS'		=> 'Appliquer toutes les permissions',
	'APPLY_PERMISSIONS'			=> 'Appliquer les permissions',
	'APPLY_PERMISSIONS_EXPLAIN'	=> 'Les permissions et modèles définis pour cet élément seront appliqués uniquement à cet élément et à tous les éléments cochés.',
	'AUTH_UPDATED'				=> 'Les permissions ont été mises à jour.',

	'CREATE_ROLE'				=> 'Créer un modèle',
	'CREATE_ROLE_FROM'			=> 'Utiliser les paramètres de…',
	'CUSTOM'					=> 'Personnaliser…',

	'DEFAULT'					=> 'Défaut',
	'DELETE_ROLE'				=> 'Supprimer le modèle',
	'DELETE_ROLE_CONFIRM'		=> 'Etes-vous sûr(e) de vouloir supprimer ce modèle? Les éléments auxquels ce modèle est assigné <strong>ne</strong> perdront <strong>pas</strong> leurs paramètres de permission.',
	'DISPLAY_ROLE_ITEMS'		=> 'Voir les éléments utilisant ce modèle',

	'EDIT_PERMISSIONS'			=> 'Editer les permissions',
	'EDIT_ROLE'					=> 'Editer le modèle',

	'GROUPS_NOT_ASSIGNED'		=> 'Aucun groupe n’est assigné à ce modèle',

	'LOOK_UP_GROUP'				=> 'Rechercher le groupe d’utilisateurs',
	'LOOK_UP_USER'				=> 'Rechercher l’utilisateur',

	'MANAGE_GROUPS'		=> 'Gérer les groupes',
	'MANAGE_USERS'		=> 'Gérer les utilisateurs',

	'NO_AUTH_SETTING_FOUND'		=> 'Paramètres de permission non définis.',
	'NO_ROLE_ASSIGNED'			=> 'Aucun modèle assigné…',
	'NO_ROLE_ASSIGNED_EXPLAIN'	=> 'La configuration de ce modèle ne modifie pas les permissions sur la droite. Si vous souhaitez supprimer toutes les permissions, vous devez utiliser le lien “Tous sur <samp>NON</samp>”.',
	'NO_ROLE_AVAILABLE'			=> 'Aucun modèle disponible',
	'NO_ROLE_NAME_SPECIFIED'	=> 'Merci de donner un nom au modèle.',
	'NO_ROLE_SELECTED'			=> 'Le modèle n’a pas été trouvé.',
	'NO_USER_GROUP_SELECTED'	=> 'Vous n’avez pas sélectionné d’utilisateur ou de groupe.',

	'ONLY_FORUM_DEFINED'	=> 'Vous n’avez défini que des forums dans votre sélection. Sélectionnez aussi, au moins, un utilisateur ou un groupe.',

	'PERMISSION_APPLIED_TO_ALL'		=> 'Les permissions et modèles seront aussi appliqués à tous les objets cochés',
	'PLUS_SUBFORUMS'				=> '+Sous-forums',

	'REMOVE_PERMISSIONS'			=> 'Supprimer des permissions',
	'REMOVE_ROLE'					=> 'Supprimer un modèle',
	'RESULTING_PERMISSION'			=> 'Permission résultante',
	'ROLE'							=> 'modèle',
	'ROLE_ADD_SUCCESS'				=> 'modèle ajouté.',
	'ROLE_ASSIGNED_TO'				=> 'Utilisateurs/groupes assignés à %s',
	'ROLE_DELETED'					=> 'modèle supprimé.',
	'ROLE_DESCRIPTION'				=> 'Description du modèle',

	'ROLE_ADMIN_FORUM'			=> 'Administrateur du forum',
	'ROLE_ADMIN_FULL'			=> 'Super Administrateur',
	'ROLE_ADMIN_STANDARD'		=> 'Administrateur standard',
	'ROLE_ADMIN_USERGROUP'		=> 'Administrateur des utilisateurs et des groupes',
	'ROLE_FORUM_BOT'			=> 'Accès robots',
	'ROLE_FORUM_FULL'			=> 'Accès total',
	'ROLE_FORUM_LIMITED'		=> 'Accès limité',
	'ROLE_FORUM_LIMITED_POLLS'	=> 'Accès limité + Sondages',
	'ROLE_FORUM_NOACCESS'		=> 'Aucun accès',
	'ROLE_FORUM_ONQUEUE'		=> 'Attente de modération',
	'ROLE_FORUM_POLLS'			=> 'Accès standard + Sondages',
	'ROLE_FORUM_READONLY'		=> 'Accès en lecture uniquement',
	'ROLE_FORUM_STANDARD'		=> 'Accès standard',
	'ROLE_MOD_FULL'				=> 'Super Modérateur',
	'ROLE_MOD_QUEUE'			=> 'Modérateur suppléant',
	'ROLE_MOD_SIMPLE'			=> 'Modérateur simple',
	'ROLE_MOD_STANDARD'			=> 'Modérateur standard',
	'ROLE_USER_FULL'			=> 'Toutes fonctionnalités',
	'ROLE_USER_LIMITED'			=> 'Fonctionnalités limitées',
	'ROLE_USER_NOAVATAR'		=> 'Aucun avatar',
	'ROLE_USER_NOPM'			=> 'Aucun message privé',
	'ROLE_USER_STANDARD'		=> 'Fonctionnalités standards',

	'ROLE_DESCRIPTION_ADMIN_FORUM'			=> 'Peut accéder à la gestion et à la configuration des permissions du forum.',
	'ROLE_DESCRIPTION_ADMIN_FULL'			=> 'A accès à toutes les fonctions administratives du forum.<br />Non recommandé.',
	'ROLE_DESCRIPTION_ADMIN_STANDARD'		=> 'A accès à la plupart des fonctionnalités administratives mais ne peut pas utiliser le serveur ou les outils relatifs au système.',
	'ROLE_DESCRIPTION_ADMIN_USERGROUP'		=> 'Peut gérer des groupes et des utilisateurs: est autorisé à modifier les permissions, les paramètres, à gérer les bannissements et les rangs.',
	'ROLE_DESCRIPTION_FORUM_BOT'			=> 'Ce modèle est recommandé pour les robots et moteurs de recherche.',
	'ROLE_DESCRIPTION_FORUM_FULL'			=> 'Peut utiliser toutes les fonctionnalités du forum, y compris les annonces et les post-it. N’est pas concerné(e) par la limite de flood.<br />Non recommandé pour les utilisateurs normaux.',
	'ROLE_DESCRIPTION_FORUM_LIMITED'		=> 'Peut utiliser quelques fonctionnalités du forum, mais ne peut pas joindre de fichiers ou utiliser les icônes des messages.',
	'ROLE_DESCRIPTION_FORUM_LIMITED_POLLS'	=> 'Comme l’Accès Limité mais peut aussi créer des sondages.',
	'ROLE_DESCRIPTION_FORUM_NOACCESS'		=> 'Ne peut ni voir ni accéder au forum.',
	'ROLE_DESCRIPTION_FORUM_ONQUEUE'		=> 'Peut utiliser la plupart des fonctionnalités du forum y compris les fichiers joints, mais les messages et les sujets doivent être approuvés par un modérateur.',
	'ROLE_DESCRIPTION_FORUM_POLLS'			=> 'Comme l’Accès Standard mais peut aussi créer des sondages.',
	'ROLE_DESCRIPTION_FORUM_READONLY'		=> 'Peut lire le forum, mais ne peut pas créer de nouveaux sujets ou répondre aux messages.',
	'ROLE_DESCRIPTION_FORUM_STANDARD'		=> 'Peut utiliser la plupart des fonctionnalités du forum y compris les fichiers joints, mais ne peut pas verrouiller ou supprimer ses propres sujets, et ne peut pas créer de sondages.',
	'ROLE_DESCRIPTION_MOD_FULL'				=> 'Peut utiliser toutes les fonctionnalités de modération, y compris le bannissement.',
	'ROLE_DESCRIPTION_MOD_QUEUE'			=> 'Peut utiliser l’attente de modération pour valider ou éditer des messages, mais rien d’autre.',
	'ROLE_DESCRIPTION_MOD_SIMPLE'			=> 'Peut utiliser seulement les actions de sujet de base. Ne peut pas envoyer d’avertissements ou utiliser l’attente de modération.',
	'ROLE_DESCRIPTION_MOD_STANDARD'			=> 'Peut utiliser la plupart des outils de modération, mais ne peut pas bannir les utilisateurs ou modifier l’auteur du message.',
	'ROLE_DESCRIPTION_USER_FULL'			=> 'Peut utiliser toutes les fonctionnalités disponibles du forum pour les utilisateurs, y compris modifier le nom d’utilisateur ou ignorer la limite de flood.<br />Non recommandé.',
	'ROLE_DESCRIPTION_USER_LIMITED'			=> 'Peut avoir accès à la plupart des fonctionnalités de l’utilisateur. Les fichiers joints, e-mails ou messages instantanés ne sont pas autorisés.',
	'ROLE_DESCRIPTION_USER_NOAVATAR'		=> 'A un ensemble limité de fonctionnalités et n’est pas autorisé à avoir d’avatar.',
	'ROLE_DESCRIPTION_USER_NOPM'			=> 'A un ensemble limité de fonctionnalités et n’est pas autorisé à envoyer de messages privés.',
	'ROLE_DESCRIPTION_USER_STANDARD'		=> 'Peut accéder à la plupart des fonctionnalités de l’utilisateur, mais pas à toutes. Par exemple, ne peut pas modifier le nom d’utilisateur ou ignorer la limite de flood.',

	'ROLE_DESCRIPTION_EXPLAIN'		=> 'Vous avez la possibilité d’entrer une courte explication sur ce que fait le modèle ou ce qu’il signifie. Le texte que vous entrez sera aussi affiché dans l’écran des permissions.',
	'ROLE_DESCRIPTION_LONG'			=> 'La description du modèle est trop longue. Limitez-la à 4000 caractères.',
	'ROLE_DETAILS'					=> 'Détails du modèle',
	'ROLE_EDIT_SUCCESS'				=> 'Le modèle a été édité.',
	'ROLE_NAME'						=> 'Nom du modèle',
	'ROLE_NAME_ALREADY_EXIST'		=> 'Un modèle nommé <strong>%s</strong> existe déjà pour le type de permission indiqué.',
	'ROLE_NOT_ASSIGNED'				=> 'Le modèle n’a pas encore été assigné.',

	'SELECTED_FORUM_NOT_EXIST'		=> 'Le(s) forum(s) sélectionné(s) n’existe(nt) pas.',
	'SELECTED_GROUP_NOT_EXIST'		=> 'Le(s) groupe(s) sélectionné(s) n’existe(nt) pas.',
	'SELECTED_USER_NOT_EXIST'		=> 'L’utilisateur (les utilisateurs) sélectionné(s) n’existe(nt) pas.',
	'SELECT_FORUM_SUBFORUM_EXPLAIN'	=> 'Le forum que vous sélectionnez inclura tous les sous-forums dans la sélection',
	'SELECT_ROLE'					=> 'Sélectionner un modèle…',
	'SELECT_TYPE'					=> 'Sélectionner un type',
	'SET_PERMISSIONS'				=> 'Régler les permissions',
	'SET_ROLE_PERMISSIONS'			=> 'Régler les permissions du modèle',
	'SET_USERS_PERMISSIONS'			=> 'Régler les permissions des utilisateurs',
	'SET_USERS_FORUM_PERMISSIONS'	=> 'Régler les permissions des utilisateurs du forum',

	'TRACE_DEFAULT'					=> 'Par défaut, chaque permission est sur <samp>NON</samp> (Désactivée). Ainsi la permission peut être outrepassée par d’autres paramètres.',
	'TRACE_FOR'						=> 'Tracer pour',
	'TRACE_GLOBAL_SETTING'	=> '%s (global)',
	'TRACE_GROUP_NEVER_TOTAL_NEVER'	=> 'Cette permission de groupe est réglée sur <samp>JAMAIS</samp> tout comme le résultat total, l’ancien résultat est donc conservé..',
	'TRACE_GROUP_NEVER_TOTAL_NEVER_LOCAL'	=> 'Cette permission de groupe pour ce forum est réglée sur <samp>JAMAIS</samp> tout comme le résultat total, l’ancien résultat est donc conservé.',
	'TRACE_GROUP_NEVER_TOTAL_NO'	=> 'Cette permission de groupe est réglée sur <samp>JAMAIS</samp> ce qui devient la nouvelle valeur globale car elle n’était pas encore réglée (Paramètre sur <samp>NON</samp>).',
	'TRACE_GROUP_NEVER_TOTAL_NO_LOCAL'	=> 'Cette permission de groupe pour ce forum est réglée sur <samp>JAMAIS</samp> ce qui devient la nouvelle valeur globale car elle n’était pas encore réglée (Paramètre sur <samp>NON</samp>).',
	'TRACE_GROUP_NEVER_TOTAL_YES'	=> 'Cette permission de groupe est réglée sur <samp>JAMAIS</samp> ce qui outrepasse le <samp>OUI</samp> pour appliquer <samp>JAMAIS</samp> pour cet utilisateur.',
	'TRACE_GROUP_NEVER_TOTAL_YES_LOCAL'	=> 'Cette permission de groupe pour ce forum est réglée sur <samp>JAMAIS</samp> ce qui outrepasse le <samp>OUI</samp> pour appliquer <samp>JAMAIS</samp> pour cet utilisateur.',
	'TRACE_GROUP_NO'				=> 'Cette permission de groupe est réglée sur <samp>NON</samp> pour ce groupe, ainsi l’ancienne valeur est conservée.',
	'TRACE_GROUP_NO_LOCAL'			=> 'Cette permission de groupe est réglée sur <samp>NON</samp> pour ce groupe dans ce forum, ainsi l’ancienne valeur est conservée.',
	'TRACE_GROUP_YES_TOTAL_NEVER'	=> 'Cette permission de groupe est réglée sur <samp>OUI</samp> mais la valeur globale <samp>JAMAIS</samp> ne peut pas être outrepassée.',
	'TRACE_GROUP_YES_TOTAL_NEVER_LOCAL'	=> 'Cette permission de groupe pour ce forum est réglée sur <samp>OUI</samp> mais la valeur globale <samp>JAMAIS</samp> ne peut pas être outrepassée.',
	'TRACE_GROUP_YES_TOTAL_NO'		=> 'Cette permission de groupe est réglée sur <samp>OUI</samp> ce qui devient la nouvelle valeur globale car elle n’était pas encore réglée (Paramètre sur <samp>NON</samp>).',
	'TRACE_GROUP_YES_TOTAL_NO_LOCAL'		=> 'Cette permission de groupe pour ce forum est réglée sur <samp>OUI</samp> ce qui devient la nouvelle valeur globale car elle n’était pas encore réglée (Paramètre sur <samp>NON</samp>).',
	'TRACE_GROUP_YES_TOTAL_YES'		=> 'Cette permission de groupe est réglée sur <samp>OUI</samp> et la permission totale est déjà réglée sur <samp>OUI</samp> , elle est donc conservée.',
	'TRACE_GROUP_YES_TOTAL_YES_LOCAL'		=> 'Cette permission de groupe pour ce forum est réglée sur <samp>OUI</samp> et la permission totale est déjà réglée sur <samp>OUI</samp> , elle est donc conservée.',
	'TRACE_PERMISSION'				=> 'Tracer la permission - %s',
	'TRACE_RESULT'					=> 'Tracer le résultat',
	'TRACE_SETTING'					=> 'Tracer la configuration',

	'TRACE_USER_GLOBAL_YES_TOTAL_YES'		=> 'La permission de l’utilisateur sur le forum est sur <samp>OUI</samp>, mais la permission commune étant déjà réglée sur <samp>OUI</samp>, elle est conservée. %sTracer la permission globale%s',
	'TRACE_USER_GLOBAL_YES_TOTAL_NEVER'		=> 'La permission de l’utilisateur sur le forum est sur <samp>OUI</samp>, ce qui outrepasse le résultat actuel <samp>JAMAIS</samp>. %sTracer la permission globale%s',
	'TRACE_USER_GLOBAL_NEVER_TOTAL_KEPT'	=> 'La permission de l’utilisateur sur le forum est sur <samp>JAMAIS</samp> ce qui n’influence pas la permission locale. %sTracer la permission globale%s',
	
	'TRACE_USER_FOUNDER'					=> 'L’utilisateur est un fondateur, c’est pourquoi les permissions d’administration sont toutes réglées sur <samp>OUI</samp> par défaut.',
	'TRACE_USER_KEPT'						=> 'La permission de l’utilisateur est réglée sur <samp>NON</samp>, ainsi l’ancienne valeur globale est conservée.',
	'TRACE_USER_KEPT_LOCAL'						=> 'La permission de l’utilisateur pour ce forum est réglée sur <samp>NON</samp>, ainsi l’ancienne valeur globale est conservée.',
	'TRACE_USER_NEVER_TOTAL_NEVER'			=> 'La permission de l’utilisateur est réglée sur <samp>JAMAIS</samp> et la valeur commune est réglée sur <samp>JAMAIS</samp>, donc rien n’est modifié.',
	'TRACE_USER_NEVER_TOTAL_NEVER_LOCAL'			=> 'La permission de l’utilisateur pour ce forum est réglée sur <samp>JAMAIS</samp> et la valeur commune est réglée sur <samp>JAMAIS</samp>, donc rien n’est modifié.',
	'TRACE_USER_NEVER_TOTAL_NO'				=> 'La permission de l’utilisateur est réglée sur <samp>JAMAIS</samp> ce qui devient la valeur commune car elle était réglée sur NON.',
	'TRACE_USER_NEVER_TOTAL_NO_LOCAL'				=> 'La permission de l’utilisateur pour ce forum est réglée sur <samp>JAMAIS</samp> ce qui devient la valeur commune car elle était réglée sur NON.',
	'TRACE_USER_NEVER_TOTAL_YES'			=> 'La permission de l’utilisateur est réglée sur <samp>JAMAIS</samp> et outrepasse le <samp>OUI</samp> précédent.',
	'TRACE_USER_NEVER_TOTAL_YES_LOCAL'			=> 'La permission de l’utilisateur pour ce forum est réglée sur <samp>JAMAIS</samp> et outrepasse le <samp>OUI</samp> précédent.',
	'TRACE_USER_NO_TOTAL_NO'				=> 'La permission de l’utilisateur est réglée sur <samp>NON</samp> et la valeur commune était réglée sur NON ainsi par défaut sur <samp>JAMAIS</samp>.',
	'TRACE_USER_NO_TOTAL_NO_LOCAL'				=> 'La permission de l’utilisateur pour ce forum est réglée sur <samp>NON</samp> et la valeur commune était réglée sur NON ainsi par défaut sur <samp>JAMAIS</samp>.',
	'TRACE_USER_YES_TOTAL_NEVER'			=> 'La permission de l’utilisateur est réglée sur <samp>OUI</samp> mais la valeur commune est sur <samp>JAMAIS</samp> et ne peut pas être outrepassée.',
	'TRACE_USER_YES_TOTAL_NEVER_LOCAL'			=> 'La permission de l’utilisateur pour ce forum est réglée sur <samp>OUI</samp> mais la valeur commune est sur <samp>JAMAIS</samp> et ne peut pas être outrepassée.',
	'TRACE_USER_YES_TOTAL_NO'				=> 'La permission de l’utilisateur est réglée sur <samp>OUI</samp> ce qui devient la valeur commune car elle était réglée sur <samp>NON</samp>.',
	'TRACE_USER_YES_TOTAL_NO_LOCAL'				=> 'La permission de l’utilisateur pour ce forum est réglée sur <samp>OUI</samp> ce qui devient la valeur commune car elle était réglée sur <samp>NON</samp>.',
	'TRACE_USER_YES_TOTAL_YES'				=> 'La permission de l’utilisateur est réglée sur <samp>OUI</samp> et la valeur commune est réglée sur <samp>OUI</samp>, donc rien n’est modifié.',
	'TRACE_USER_YES_TOTAL_YES_LOCAL'				=> 'La permission de l’utilisateur pour ce forum est réglée sur <samp>OUI</samp> et la valeur commune est réglée sur <samp>OUI</samp>, donc rien n’est modifié.',
	'TRACE_WHO'									=> 'Qui',
	'TRACE_TOTAL'							=> 'Total',

	'USERS_NOT_ASSIGNED'			=> 'Aucun utilisateur assigné à ce modèle',
	'USER_IS_MEMBER_OF_DEFAULT'		=> 'est un membre des groupes prédéfinis suivants',
	'USER_IS_MEMBER_OF_CUSTOM'		=> 'est un membre des groupes normaux suivants',

	'VIEW_ASSIGNED_ITEMS'	=> 'Voir les éléments assignés',
	'VIEW_LOCAL_PERMS'		=> 'Permissions locales',
	'VIEW_GLOBAL_PERMS'		=> 'Permissions globales',
	'VIEW_PERMISSIONS'		=> 'Voir les permissions',

	'WRONG_PERMISSION_TYPE'	=> 'Mauvais type de permission sélectionné.',
	'WRONG_PERMISSION_SETTING_FORMAT'	=> 'Les paramètres des permissions sont enregistrés dans un mauvais format, phpBB est incapable de les traiter correctement.',
));

?>