<?php
/** 
*
* acp common [Standard french]
*
* @package language
* @version $Id: common.php,v 1.119 2007/08/13 12:14:06 acydburn Exp $
* @copyright (c) 2005 phpBB Group 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/
/**
* CONTRIBUTORS
* Translation made by phpBB-fr.com and phpBB.biz Teams
* http://www.phpbb-fr.com
* http://www.phpbb.biz
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

// Common
$lang = array_merge($lang, array(
	'ACP_ADMINISTRATORS'		=> 'Administrateurs',
	'ACP_ADMIN_LOGS'			=> 'Journal d\'administration',
	'ACP_ADMIN_ROLES'			=> 'Modèles d\'administration',
	'ACP_ATTACHMENTS'			=> 'Fichiers joints',
	'ACP_ATTACHMENT_SETTINGS'	=> 'Paramètres des fichiers joints',
	'ACP_AUTH_SETTINGS'			=> 'Identification',
	'ACP_AUTOMATION'			=> 'Automatique',
	'ACP_AVATAR_SETTINGS'		=> 'Paramètres des avatars',

	'ACP_BACKUP'				=> 'Sauvegarder',
	'ACP_BAN'					=> 'Bannissement',
	'ACP_BAN_EMAILS'			=> 'Bannissement d\'e-mails',
	'ACP_BAN_IPS'				=> 'Bannissement d\'IPs',
	'ACP_BAN_USERNAMES'			=> 'Bannissement d\'utilisateurs',
	'ACP_BBCODES'				=> 'BBCodes',
	'ACP_BOARD_CONFIGURATION'	=> 'Configuration générale',
	'ACP_BOARD_FEATURES'		=> 'Options du forum',
	'ACP_BOARD_MANAGEMENT'		=> 'Gestion du forum',
	'ACP_BOARD_SETTINGS'		=> 'Configuration du forum',
	'ACP_BOTS'					=> 'Robots',
	
	'ACP_CAPTCHA'				=> 'CAPTCHA',

	'ACP_CAT_DATABASE'			=> 'Base de données',
	'ACP_CAT_DOT_MODS'			=> '.Mods',
	'ACP_CAT_FORUMS'			=> 'Forums',
	'ACP_CAT_GENERAL'			=> 'Général',
	'ACP_CAT_MAINTENANCE'		=> 'Maintenance',
	'ACP_CAT_PERMISSIONS'		=> 'Permissions',
	'ACP_CAT_POSTING'			=> 'Messages',
	'ACP_CAT_STYLES'			=> 'Styles',
	'ACP_CAT_SYSTEM'			=> 'Système',
	'ACP_CAT_USERGROUP'			=> 'Utilisateurs et groupes',
	'ACP_CAT_USERS'				=> 'Utilisateurs',
	'ACP_CLIENT_COMMUNICATION'	=> 'Communication',
	'ACP_COOKIE_SETTINGS'		=> 'Paramètres des cookies',
	'ACP_CRITICAL_LOGS'			=> 'Journal des erreurs',
	'ACP_CUSTOM_PROFILE_FIELDS'	=> 'Champs de profil personnalisés',
	
	'ACP_DATABASE'				=> 'Gestion de la base de données',
	'ACP_DISALLOW'				=> 'Interdit',
	'ACP_DISALLOW_USERNAMES'	=> 'Interdire des noms d\'utilisateurs',
	
	'ACP_EMAIL_SETTINGS'		=> 'Paramètres des e-mails',
	'ACP_EXTENSION_GROUPS'		=> 'Gérer les groupes d\'extensions',
	
	'ACP_FORUM_BASED_PERMISSIONS'	=> 'Permissions basiques des forums',
	'ACP_FORUM_LOGS'				=> 'Journaux du forum',
	'ACP_FORUM_MANAGEMENT'			=> 'Gestion du forum',
	'ACP_FORUM_MODERATORS'			=> 'Modérateurs des forums',
	'ACP_FORUM_PERMISSIONS'			=> 'Permissions des forums',
	'ACP_FORUM_ROLES'				=> 'Modèles de forum',

	'ACP_GENERAL_CONFIGURATION'		=> 'Configuration générale',
	'ACP_GENERAL_TASKS'				=> 'Tâches générales',
	'ACP_GLOBAL_MODERATORS'			=> 'Modérateurs globaux',
	'ACP_GLOBAL_PERMISSIONS'		=> 'Permissions globales',
	'ACP_GROUPS'					=> 'Groupes',
	'ACP_GROUPS_FORUM_PERMISSIONS'	=> 'Permissions groupes/forums',
	'ACP_GROUPS_MANAGE'				=> 'Gérer les groupes',
	'ACP_GROUPS_MANAGEMENT'			=> 'Gestion des groupes',
	'ACP_GROUPS_PERMISSIONS'		=> 'Permissions des groupes',
	
	'ACP_ICONS'					=> 'Icônes de sujet',
	'ACP_ICONS_SMILIES'			=> 'Icônes et smileys de sujet',
	'ACP_IMAGESETS'				=> 'Packs d\'images',
	'ACP_INACTIVE_USERS'		=> 'Utilisateurs inactifs',
	'ACP_INDEX'					=> 'Index de l\'administration',
	
	'ACP_JABBER_SETTINGS'		=> 'Paramètres Jabber',
	
	'ACP_LANGUAGE'				=> 'Gestion des langues',
	'ACP_LANGUAGE_PACKS'		=> 'Langues',
	'ACP_LOAD_SETTINGS'			=> 'Paramètres de charge',
	'ACP_LOGGING'				=> 'Se connecte',
	
	'ACP_MAIN'					=> 'Index de l\'administration',
	'ACP_MANAGE_EXTENSIONS'		=> 'Gérer les extensions',
	'ACP_MANAGE_FORUMS'			=> 'Gérer les forums',
	'ACP_MANAGE_RANKS'			=> 'Gérer les rangs',
	'ACP_MANAGE_REASONS'		=> 'Gérer les rapports/raisons',
	'ACP_MANAGE_USERS'			=> 'Gérer les utilisateurs',
	'ACP_MASS_EMAIL'			=> 'E-mail de masse',
	'ACP_MESSAGES'				=> 'Messages',
	'ACP_MESSAGE_SETTINGS'		=> 'Messagerie privée',
	'ACP_MODULE_MANAGEMENT'		=> 'Gestion de modules',
	'ACP_MOD_LOGS'				=> 'Journal de modération',
	'ACP_MOD_ROLES'				=> 'Modèles de modération',
	
	'ACP_ORPHAN_ATTACHMENTS'	=> 'Fichiers joints orphelins',
	
	'ACP_PERMISSIONS'			=> 'Permissions',
	'ACP_PERMISSION_MASKS'		=> 'Masques de permission',
	'ACP_PERMISSION_ROLES'		=> 'Modèles de permission',
	'ACP_PERMISSION_TRACE'		=> 'Trace de permission',
	'ACP_PHP_INFO'				=> 'Informations PHP',
	'ACP_POST_SETTINGS'			=> 'Paramètres des messages',
	'ACP_PRUNE_FORUMS'			=> 'Délester les forums',
	'ACP_PRUNE_USERS'			=> 'Délester des utilisateurs',
	'ACP_PRUNING'				=> 'Délestage',
	
	'ACP_QUICK_ACCESS'			=> 'Accès rapide',
	
	'ACP_RANKS'					=> 'Rangs',
	'ACP_REASONS'				=> 'Rapports/raisons',
	'ACP_REGISTER_SETTINGS'		=> 'Paramètres des inscriptions',

	'ACP_RESTORE'				=> 'Restaurer',

	'ACP_SEARCH'				=> 'Recherche',
	'ACP_SEARCH_INDEX'			=> 'Index de recherche',
	'ACP_SEARCH_SETTINGS'		=> 'Paramètres de recherche',

	'ACP_SECURITY_SETTINGS'		=> 'Paramètres de sécurité',
	'ACP_SERVER_CONFIGURATION'	=> 'Configuration du serveur',
	'ACP_SERVER_SETTINGS'		=> 'Paramètres du serveur',
	'ACP_SIGNATURE_SETTINGS'	=> 'Paramètres de signature',
	'ACP_SMILIES'				=> 'Smileys',
	'ACP_STYLE_COMPONENTS'		=> 'Composants des styles',
	'ACP_STYLE_MANAGEMENT'		=> 'Gestion de style',
	'ACP_STYLES'				=> 'Styles',
	
	'ACP_TEMPLATES'				=> 'Templates',
	'ACP_THEMES'				=> 'Thèmes',
	
	'ACP_UPDATE'					=> 'Mise à jour',
	'ACP_USERS_FORUM_PERMISSIONS'	=> 'Permissions utilisateurs/forums',
	'ACP_USERS_LOGS'				=> 'Journal d\'utilisateur',
	'ACP_USERS_PERMISSIONS'			=> 'Permissions des utilisateurs',
	'ACP_USER_ATTACH'				=> 'Fichiers joints',
	'ACP_USER_AVATAR'				=> 'Avatar',
	'ACP_USER_FEEDBACK'				=> 'Fiche de suivi',
	'ACP_USER_GROUPS'				=> 'Groupes',
	'ACP_USER_MANAGEMENT'			=> 'Gestion utilisateur',
	'ACP_USER_OVERVIEW'				=> 'Vue d\'ensemble',
	'ACP_USER_PERM'					=> 'Permissions',
	'ACP_USER_PREFS'				=> 'Préférences',
	'ACP_USER_PROFILE'				=> 'Profil',
	'ACP_USER_RANK'					=> 'Rang',
	'ACP_USER_ROLES'				=> 'Modèles d\'utilisateur',
	'ACP_USER_SECURITY'				=> 'Sécurité utilisateur',
	'ACP_USER_SIG'					=> 'Signature',

	'ACP_VC_SETTINGS'					=> 'Paramètres de confirmation visuelle',
	'ACP_VC_CAPTCHA_DISPLAY'			=> 'Aperçu CAPTCHA',
	'ACP_VERSION_CHECK'					=> 'Vérifier les mises à jour',
	'ACP_VIEW_ADMIN_PERMISSIONS'		=> 'Permissions d\'administration',
	'ACP_VIEW_FORUM_MOD_PERMISSIONS'	=> 'Permissions de modération des forums',
	'ACP_VIEW_FORUM_PERMISSIONS'		=> 'Permissions basiques des forums',
	'ACP_VIEW_GLOBAL_MOD_PERMISSIONS'	=> 'Permissions des modérateurs globaux',
	'ACP_VIEW_USER_PERMISSIONS'			=> 'Permissions basiques des utilisateurs',
	
	'ACP_WORDS'					=> 'Censure',

	'ACTION'				=> 'Action',
	'ACTIONS'				=> 'Actions',
	'ACTIVATE'				=> 'Activer',
	'ADD'					=> 'Ajouter',
	'ADMIN'					=> 'Administration',
	'ADMIN_INDEX'			=> 'Index de l\'administration',
	'ADMIN_PANEL'			=> 'Panneau d\'administration',

	'BACK'					=> 'Retour',

	'COLOUR_SWATCH'			=> 'Palette de couleurs',
	'CONFIG_UPDATED'		=> 'La configuration a été mise à jour.',

	'DEACTIVATE'				=> 'Désactiver',
	'DIRECTORY_DOES_NOT_EXIST'	=> 'Le chemin indiqué “%s” n\'existe pas.',
	'DIRECTORY_NOT_DIR'			=> 'Le chemin indiqué “%s” n\'est pas un répertoire.',
	'DIRECTORY_NOT_WRITABLE'	=> 'Le chemin indiqué “%s” n\'est pas inscriptible.',
	'DISABLE'					=> 'Désactiver',
	'DOWNLOAD'					=> 'Télécharger',
	'DOWNLOAD_AS'				=> 'Télécharger sous',
	'DOWNLOAD_STORE'			=> 'Télécharger ou stocker le fichier joint',
	'DOWNLOAD_STORE_EXPLAIN'	=> 'Vous pouvez directement télécharger le fichier joint ou le sauvegarder dans le répertoire <samp>store/</samp>.',

	'EDIT'					=> 'Editer',
	'ENABLE'				=> 'Activer',
	'EXPORT_DOWNLOAD'		=> 'Téléchargement',
	'EXPORT_STORE'			=> 'Stockage',

	'GENERAL_OPTIONS'		=> 'Options générales',
	'GENERAL_SETTINGS'		=> 'Paramètres généraux',
	'GLOBAL_MASK'			=> 'Masque de permission globale',

	'INSTALL'				=> 'Installer',
	'IP'					=> 'Adresse IP',
	'IP_HOSTNAME'			=> 'Adresses IPs ou noms d\'hôtes',

	'LOGGED_IN_AS'			=> 'Connecté en tant que:',
	'LOGIN_ADMIN'			=> 'Vous devez être connecté pour administrer le forum.',
	'LOGIN_ADMIN_CONFIRM'	=> 'Vous devez vous reconnecter pour administrer le forum.',
	'LOGIN_ADMIN_SUCCESS'	=> 'Vous avez été authentifié et vous allez être redirigé vers le panneau d\'administration.',
	'LOOK_UP_FORUM'			=> 'Sélectionner un forum',
	'LOOK_UP_FORUMS_EXPLAIN'=> 'Vous pouvez sélectionner plus d\'un forum.',

	'MANAGE'				=> 'Gérer',
	'MENU_TOGGLE'			=> 'Cacher ou afficher le menu latéral',
	'MOVE_DOWN'				=> 'Descendre',
	'MOVE_UP'				=> 'Monter',

	'NOTIFY'				=> 'Notification',
	'NO_ADMIN'				=> 'Vous n\'êtes pas autorisé à administrer ce forum.',
	'NO_EMAILS_DEFINED'		=> 'Aucun e-mail valide indiquée.',
	'NO_PASSWORD_SUPPLIED'	=> 'Vous devez indiquer votre mot de passe pour accéder au panneau d\'administration',	

	'OFF'					=> 'Off',
	'ON'					=> 'On',

	'PARSE_BBCODE'						=> 'Autoriser les BBCodes',
	'PARSE_SMILIES'						=> 'Autoriser les smileys',
	'PARSE_URLS'						=> 'Autoriser les liens',
	'PERMISSIONS_TRANSFERRED'			=> 'Les permissions ont été transférées',
	'PERMISSIONS_TRANSFERRED_EXPLAIN'	=> 'Vous utilisez actuellement les permissions de %1$s. Vous pouvez naviguer sur le forum avec ses permissions mais ne pourrait pas accéder au panneau d\'administration car les permissions d\'administration ne sont pas transférables. Vous pouvez <a href="%2$s"><strong>réinitialiser vos permissions</strong></a> à tout moment.',
	'PIXEL'								=> 'px',	
	'PROCEED_TO_ACP'					=> '%sAller au panneau d\'administration%s',

	'REMIND'							=> 'Rappeler',
	'RESYNC'							=> 'Resynchroniser',
	'RETURN_TO'							=> 'Retour vers',

	'SELECT_ANONYMOUS'		=> 'Sélectionner l\'utilisateur invité',
	'SELECT_OPTION'			=> 'Sélectionner une option',

	'UCP'					=> 'Panneau de l\'utilisateur',
	'USERNAMES_EXPLAIN'		=> 'Indiquez un nom d\'utilisateur par ligne',
	'USER_CONTROL_PANEL'	=> 'Panneau de l\'utilisateur',

	'WARNING'				=> 'Avertissement',
));

// PHP info
$lang = array_merge($lang, array(
	'ACP_PHP_INFO_EXPLAIN'   => 'Cette page contient des détails sur la version installée de PHP. Elle comprend les modules chargés, les variables existantes et les paramètres par défaut et peut être utile pour analyser des problèmes. Soyez attentifs car certains hébergeurs limitent l\'information affichée pour des raisons de sécurité. Il est recommandé de ne pas communiquer les informations de cette page, à moins qu\'un membre de l\'équipe ne les demande.',

	'NO_PHPINFO_AVAILABLE'   => 'Impossible d\'afficher les informations PHP. La fonction Phpinfo() a été désactivée pour des raisons de sécurité.',
));

// Logs
$lang = array_merge($lang, array(
	'ACP_ADMIN_LOGS_EXPLAIN'	=> 'Liste des actions effectuées par les administrateurs. Vous pouvez trier par nom, date, IP ou par action. Si vous avez les permissions nécessaires vous pouvez aussi effacer individuellement les opérations ou le journal complet.',
	'ACP_CRITICAL_LOGS_EXPLAIN'	=> 'Liste des actions effectuées par le système. Ce journal liste les informations que vous pouvez utiliser pour résoudre des problèmes spécifiques, comme le non-acheminement des e-mails. Vous pouvez trier par nom d\'utilisateur, date, IP ou action. Si vous avez les permissions nécessaires vous pouvez aussi effacer individuellement les opérations ou le journal complet.',
	'ACP_MOD_LOGS_EXPLAIN'		=> 'Liste des actions effectuées par les modérateurs, sélectionnez un forum dans la liste ci-dessous. Vous pouvez trier par nom d\'utilisateur, date, IP ou action. Si vous avez les permissions nécessaires vous pouvez aussi effacer individuellement les opérations ou le journal complet.',
	'ACP_USERS_LOGS_EXPLAIN'	=> 'Liste des actions effectuées par les utilisateurs ou sur les utilisateurs.',
	'ALL_ENTRIES'				=> 'Toutes les entrées',

	'DISPLAY_LOG'	=> 'Affiche les entrées précédentes',

	'NO_ENTRIES'	=> 'Aucune entrée pour la période indiquée',

	'SORT_IP'		=> 'Addresse IP',
	'SORT_DATE'		=> 'Date',
	'SORT_ACTION'	=> 'Action enregistrée',
));

// Index page
$lang = array_merge($lang, array(
	'ADMIN_INTRO'				=> 'Merci d\'avoir choisi phpBB comme solution de forum. Cet écran vous donnera un rapide aperçu des diverses statistiques de votre forum. Les liens du volet de gauche vous permettront de contrôler tous les aspects de votre forum. Chaque page contiendra les instructions nécessaires concernant l\'utilisation des outils.',
	'ADMIN_LOG'					=> 'Journal des actions des administrateurs',
	'ADMIN_LOG_INDEX_EXPLAIN'	=> 'Ceci est un aperçu rapide des cinq dernières actions effectuées par les administrateurs. Une liste complète des actions est disponible dans le journal d\'administration en cliquant directement sur le lien ci-dessous.',
	'AVATAR_DIR_SIZE'			=> 'Taille des avatars',

	'BOARD_STARTED'		=> 'Date de création du forum',
	'BOARD_VERSION'		=> 'Version du forum',

	'DATABASE_SERVER_INFO'	=> 'Serveur de base de données',
	'DATABASE_SIZE'			=> 'Taille de la base de données',

	'FILES_PER_DAY'		=> 'Moyenne journalière de fichiers joints',
	'FORUM_STATS'		=> 'Statistiques du forum',

	'GZIP_COMPRESSION'	=> 'Compression GZip',

	'NOT_AVAILABLE'		=> 'Indisponible',
	'NUMBER_FILES'  	=> 'Nombre de fichiers joints',
	'NUMBER_POSTS'  	=> 'Nombre de messages',
	'NUMBER_TOPICS'   	=> 'Nombre de sujets',
	'NUMBER_USERS'   	=> 'Nombre d\'utilisateurs',
	'NUMBER_ORPHAN'   	=> 'Nombre de fichiers joints orphelins',

	'POSTS_PER_DAY'		=> 'Moyenne journalière de messages',

	'PURGE_CACHE'			=> 'Vider le cache',
	'PURGE_CACHE_CONFIRM'	=> 'Etes-vous sûr de vouloir vider le cache?',
	'PURGE_CACHE_EXPLAIN'	=> 'Vide tous les fichiers du cache, cela inclut tous les fichiers ou requêtes des templates mis en cache.',

	'RESET_DATE'					=> 'Réinitialiser la date de création du forum',
	'RESET_DATE_CONFIRM'			=> 'Etes-vous sûr de vouloir réinitialiser la date de création du forum?',
	'RESET_ONLINE'					=> 'Réinitialiser le record des utilisateurs connectés',
	'RESET_ONLINE_CONFIRM'			=> 'Etes-vous sûr de vouloir réinitialiser le record des utilisateurs connectés?',
	'RESYNC_POSTCOUNTS'				=> 'Synchroniser les compteurs de message d\'utilisateur',
	'RESYNC_POSTCOUNTS_EXPLAIN'		=> 'Seuls les messages existants seront pris en compte. Les messages délestés ne seront pas pris en compte.',
	'RESYNC_POSTCOUNTS_CONFIRM'		=> 'Etes-vous sûr de vouloir resynchroniser les compteurs de message d\'utilisateur?',
	'RESYNC_POST_MARKING'			=> 'Synchroniser les sujets pointés',
	'RESYNC_POST_MARKING_CONFIRM'	=> 'Etes-vous sûr de vouloir resynchroniser les sujets pointés?',
	'RESYNC_POST_MARKING_EXPLAIN'	=> 'Décochez tous les sujets et cochez uniquement les sujets inactifs depuis plus de 6 mois.',
	'RESYNC_STATS'					=> 'Synchroniser les statistiques',
	'RESYNC_STATS_CONFIRM'			=> 'Etes-vous sûr de vouloir resynchroniser les statistiques?',
	'RESYNC_STATS_EXPLAIN'			=> 'Recalculer le nombre total de messages, sujets, utilisateurs et fichiers joints.',
	'RUN'							=> 'Exécuter maintenant',

	'STATISTIC'					=> 'Statistique',
	'STATISTIC_RESYNC_OPTIONS'	=> 'Synchroniser ou réinitialiser les statistiques',

	'TOPICS_PER_DAY'	=> 'Moyenne journalière de sujets',

	'UPLOAD_DIR_SIZE'	=> 'Taille des fichiers joints',
	'USERS_PER_DAY'		=> 'Moyenne journalière d\'inscriptions',

	'VALUE'					=> 'Valeur',
	'VIEW_ADMIN_LOG'		=> 'Voir le journal d\'administration',
	'VIEW_INACTIVE_USERS'	=> 'Voir les utilisateurs inactifs',

	'WELCOME_PHPBB'			=> 'Bienvenue dans phpBB',
));

// Inactive Users
$lang = array_merge($lang, array(
	'INACTIVE_DATE'					=> 'Date d\'inactivité',
	'INACTIVE_REASON'				=> 'Raison',
	'INACTIVE_REASON_MANUAL'		=> 'Compte désactivé par un administrateur',
	'INACTIVE_REASON_PROFILE'		=> 'Informations du profil mises à jour',
	'INACTIVE_REASON_REGISTER'		=> 'Nouveau compte',
	'INACTIVE_REASON_REMIND'		=> 'Réactivation forcée',
	'INACTIVE_REASON_UNKNOWN'		=> 'Inconnu',
	'INACTIVE_USERS'				=> 'Utilisateurs inactifs',
	'INACTIVE_USERS_EXPLAIN'		=> 'Ceci est une liste des utilisateurs nouvellement inscrits, mais encore inactifs. Vous pouvez activer, supprimer ou contacter (en envoyant un e-mail) ces utilisateurs si vous le désirez.',
	'INACTIVE_USERS_EXPLAIN_INDEX'	=> 'Ceci est une liste des 10 dernières inscriptions inactives. Une liste complète des utilisateurs inactifs est disponible en vous rendant dans le menu approprié de l\'administration ou en cliquant directement sur le lien ci-dessous.',

	'NO_INACTIVE_USERS'	=> 'Aucun utilisateur inactif',

	'SORT_INACTIVE'		=> 'Date',
	'SORT_LAST_VISIT'	=> 'Dernière visite',
	'SORT_REASON'		=> 'Raison',
	'SORT_REG_DATE'		=> 'Date d\'inscription',

	'USER_IS_INACTIVE'		=> 'L\'utilisateur est inactif',
));

// Log Entries
$lang = array_merge($lang, array(
	'LOG_ACL_ADD_USER_GLOBAL_U_'		=> '<strong>Ajout/modification des permissions utilisateur</strong><br />» %s',
	'LOG_ACL_ADD_GROUP_GLOBAL_U_'		=> '<strong>Ajout/modification des permissions utilisateur des groupes</strong><br />» %s',
	'LOG_ACL_ADD_USER_GLOBAL_M_'		=> '<strong>Ajout/modification des permissions de modérateur global des utilisateurs</strong><br />» %s',
	'LOG_ACL_ADD_GROUP_GLOBAL_M_'		=> '<strong>Ajout/modification des permissions de modérateur global des groupes</strong><br />» %s',
	'LOG_ACL_ADD_USER_GLOBAL_A_'		=> '<strong>Ajout/modification des permissions d\'administration des utilisateurs</strong><br />» %s',
	'LOG_ACL_ADD_GROUP_GLOBAL_A_'		=> '<strong>Ajout/modification des permissions d\'administration des groupes</strong><br />» %s',

	'LOG_ACL_ADD_ADMIN_GLOBAL_A_'		=> '<strong>Ajout/modification des administrateurs</strong><br />» %s',
	'LOG_ACL_ADD_MOD_GLOBAL_M_'			=> '<strong>Ajout/modification des modérateurs globaux</strong><br />» %s',

	'LOG_ACL_ADD_USER_LOCAL_F_'			=> '<strong>Ajout/modification des accès utilisateurs aux forums</strong> de %1$s<br />» %2$s',
	'LOG_ACL_ADD_USER_LOCAL_M_'			=> '<strong>Ajout/modification des accès de modération aux forums</strong> de %1$s<br />» %2$s',
	'LOG_ACL_ADD_GROUP_LOCAL_F_'		=> '<strong>Ajout/modification des accès de groupes aux forums</strong> de %1$s<br />» %2$s',
	'LOG_ACL_ADD_GROUP_LOCAL_M_'		=> '<strong>Ajout/modification des accès de modération aux forums des groupes</strong> de %1$s<br />» %2$s',

	'LOG_ACL_ADD_MOD_LOCAL_M_'			=> '<strong>Ajout/modification des modérateurs</strong> de %1$s<br />» %2$s',
	'LOG_ACL_ADD_FORUM_LOCAL_F_'		=> '<strong>Ajout/modification des permissions de forum</strong> de %1$s<br />» %2$s',

	'LOG_ACL_DEL_ADMIN_GLOBAL_A_'		=> '<strong>Suppression de l\'administrateur</strong><br />» %s',
	'LOG_ACL_DEL_MOD_GLOBAL_M_'			=> '<strong>Suppression d\'un modérateur global</strong><br />» %s',
	'LOG_ACL_DEL_MOD_LOCAL_M_'			=> '<strong>Suppression d\'un modérateur</strong> de %1$s<br />» %2$s',
	'LOG_ACL_DEL_FORUM_LOCAL_F_'		=> '<strong>Suppression des permissions au forum des groupes/utilisateurs</strong> de %1$s<br />» %2$s',

	'LOG_ACL_TRANSFER_PERMISSIONS'		=> '<strong>Transfert des permissions de</strong><br />» %s',
	'LOG_ACL_RESTORE_PERMISSIONS'		=> '<strong>Restauration de vos permissions après l\'utilisation des permissions de</strong><br />» %s',
	
	'LOG_ADMIN_AUTH_FAIL'		=> '<strong>Echec de connexion à l\'administration</strong>',
	'LOG_ADMIN_AUTH_SUCCESS'	=> '<strong>Connexion réussie à l\'administration</strong>',
	
	'LOG_ATTACHMENTS_DELETED'   => '<strong>Suppression de fichiers joints d\'un utilisateur</strong><br />» %s',

	'LOG_ATTACH_EXT_ADD'		=> '<strong>Ajout/modification d\'extension de fichier joint</strong><br />» %s',
	'LOG_ATTACH_EXT_DEL'		=> '<strong>Suppression d\'extension de fichier joint</strong><br />» %s',
	'LOG_ATTACH_EXT_UPDATE'		=> '<strong>Mise à jour d\'extension de fichier joint</strong><br />» %s',
	'LOG_ATTACH_EXTGROUP_ADD'	=> '<strong>Ajout d\'un groupe d\'extensions de fichier joint</strong><br />» %s',
	'LOG_ATTACH_EXTGROUP_EDIT'	=> '<strong>Modification d\'un groupe d\'extensions de fichier joint</strong><br />» %s',
	'LOG_ATTACH_EXTGROUP_DEL'	=> '<strong>Suppression d\'un groupe d\'extensions de fichier joint</strong><br />» %s',
	'LOG_ATTACH_FILEUPLOAD'		=> '<strong>Transfert d\'un fichier joint orphelin au message</strong><br />» ID %1$d - %2$s',
	'LOG_ATTACH_ORPHAN_DEL'		=> '<strong>Suppression d\'un fichier joint orphelin</strong><br />» %s',

	'LOG_BAN_EXCLUDE_USER'	=> '<strong>Débannissement d\'un utilisateur</strong> pour la raison suivante: "<em>%1$s</em>"<br />» %2$s',
	'LOG_BAN_EXCLUDE_IP'	=> '<strong>Débannissement d\'adresse IP</strong> pour la raison suivante: "<em>%1$s</em>"<br />» %2$s',
	'LOG_BAN_EXCLUDE_EMAIL' => '<strong>Débannissement d\'e-mail</strong> pour la raison "<em>%1$s</em>"<br />» %2$s',
	'LOG_BAN_USER'			=> '<strong>Bannissement d\'utilisateur</strong> pour la raison "<em>%1$s</em>"<br />» %2$s',
	'LOG_BAN_IP'			=> '<strong>Bannissement d\'une adresse IP</strong> pour la raison "<em>%1$s</em>"<br />» %2$s',
	'LOG_BAN_EMAIL'			=> '<strong>Bannissement d\'un e-mail</strong> pour la raison "<em>%1$s</em>"<br />» %2$s',
	'LOG_UNBAN_USER'		=> '<strong>Débannissement d\'un utilisateur</strong><br />» %s',
	'LOG_UNBAN_IP'			=> '<strong>Débannissement d\'une adresse IP</strong><br />» %s',
	'LOG_UNBAN_EMAIL'		=> '<strong>Débannissement d\'un e-mail</strong><br />» %s',

	'LOG_BBCODE_ADD'		=> '<strong>Ajout d\'un nouveau BBCode</strong><br />» %s',
	'LOG_BBCODE_EDIT'		=> '<strong>Modification d\'un BBCode</strong><br />» %s',
	'LOG_BBCODE_DELETE'		=> '<strong>Suppression d\'un BBCode</strong><br />» %s',

	'LOG_BOT_ADDED'		=> '<strong>Ajout d\'un nouveau robot</strong><br />» %s',
	'LOG_BOT_DELETE'	=> '<strong>Suppression d\'un robot</strong><br />» %s',
	'LOG_BOT_UPDATED'	=> '<strong>Mise à jour d\'un robot</strong><br />» %s',

	'LOG_CLEAR_ADMIN'		=> '<strong>Journal d\'administration effacé</strong>',
	'LOG_CLEAR_CRITICAL'	=> '<strong>Journal des erreurs effacé</strong>',
	'LOG_CLEAR_MOD'			=> '<strong>Journal de modération effacé</strong>',
	'LOG_CLEAR_USER'		=> '<strong>Journal utilisateur effacé</strong><br />» %s',
	'LOG_CLEAR_USERS'		=> '<strong>Journaux des utilisateurs effacés</strong>',

	'LOG_CONFIG_ATTACH'			=> '<strong>Les paramètres des fichiers joints ont été modifiés</strong>',
	'LOG_CONFIG_AUTH'			=> '<strong>Les paramètres d\'authentification ont été modifiés</strong>',
	'LOG_CONFIG_AVATAR'			=> '<strong>Les paramètres d\'avatar ont été modifiés</strong>',
	'LOG_CONFIG_COOKIE'			=> '<strong>Les paramètres de cookies ont été modifiés</strong>',
	'LOG_CONFIG_EMAIL'			=> '<strong>Les paramètres d\'e-mails ont été modifiés</strong>',
	'LOG_CONFIG_FEATURES'		=> '<strong>Les options du forum ont été modifiéss</strong>',
	'LOG_CONFIG_LOAD'			=> '<strong>Les paramètres de charge ont été modifiés</strong>',
	'LOG_CONFIG_MESSAGE'		=> '<strong>Les paramètres de la messagerie privée ont été modifiés</strong>',
	'LOG_CONFIG_POST'			=> '<strong>Les paramètres de messages ont été modifiés</strong>',
	'LOG_CONFIG_REGISTRATION'	=> '<strong>Les paramètres d\'inscriptions ont été modifiés</strong>',
	'LOG_CONFIG_SEARCH'			=> '<strong>Les paramètres de recherche ont été modifiés</strong>',
	'LOG_CONFIG_SECURITY'		=> '<strong>Les paramètres de sécurité ont été modifiés</strong>',
	'LOG_CONFIG_SERVER'			=> '<strong>Les paramètres du serveur ont été modifiés</strong>',
	'LOG_CONFIG_SETTINGS'		=> '<strong>La configuration générale du forum a été modifiée</strong>',
	'LOG_CONFIG_SIGNATURE'		=> '<strong>Les paramètres de signature ont été modifiés</strong>',
	'LOG_CONFIG_VISUAL'			=> '<strong>Les paramètres de la confirmation visuelle ont été modifiés</strong>',

	'LOG_APPROVE_TOPIC'			=> '<strong>Approbation d\'un sujet</strong><br />» %s',
	'LOG_BUMP_TOPIC'			=> '<strong>Sujet remonté par un utilisateur</strong><br />» %s',
	'LOG_DELETE_POST'			=> '<strong>Suppression d\'un message</strong><br />» %s',
	'LOG_DELETE_TOPIC'			=> '<strong>Suppression d\'un sujet</strong><br />» %s',
	'LOG_FORK'					=> '<strong>Copie d\'un sujet</strong><br />» de %s',
	'LOG_LOCK'					=> '<strong>Verrouillage d\'un sujet</strong><br />» %s',
	'LOG_LOCK_POST'				=> '<strong>Verrouillage d\'un message</strong><br />» %s',
	'LOG_MERGE'					=> '<strong>Fusion de messages</strong> dans le sujet <br />»%s',
	'LOG_MOVE'					=> '<strong>Déplacement d\'un sujet</strong><br />» de %s',
	'LOG_POST_APPROVED'			=> '<strong>Approbation d\'un message</strong><br />» %s',
	'LOG_POST_DISAPPROVED'		=> '<strong>Refus d\'un message “%1$s” pour la raison suivante</strong><br />» %2$s',
	'LOG_POST_EDITED'			=> '<strong>Edition d\'un message “%1$s” écrit par</strong><br />» %2$s',
	'LOG_REPORT_CLOSED'			=> '<strong>Clôture d\'un rapport/raison</strong><br />» %s',
	'LOG_REPORT_DELETED'		=> '<strong>Suppression d\'un rapport/raison</strong><br />» %s',
	'LOG_SPLIT_DESTINATION'		=> '<strong>Déplacement de messages divisés</strong><br />» vers %s',
	'LOG_SPLIT_SOURCE'			=> '<strong>Division de messages</strong><br />» depuis %s',

	'LOG_TOPIC_DELETED'			=> '<strong>Sujet supprimé</strong><br />» %s',
	'LOG_TOPIC_APPROVED'		=> '<strong>Sujet approuvé</strong><br />» %s',
	'LOG_TOPIC_DISAPPROVED'		=> '<strong>Sujet refusé “%1$s” pour la raison suivante</strong><br />%2$s',
	'LOG_TOPIC_RESYNC'			=> '<strong>Compteurs de message synchronisés</strong><br />» %s',
	'LOG_TOPIC_TYPE_CHANGED'	=> '<strong>Modification du type de sujet</strong><br />» %s',
	'LOG_UNLOCK'				=> '<strong>Sujet déverrouillé</strong><br />» %s',
	'LOG_UNLOCK_POST'			=> '<strong>Message déverrouillé</strong><br />» %s',

	'LOG_DISALLOW_ADD'		=> '<strong>Ajout d\'un nom d\'utilisateur interdit</strong><br />» %s',
	'LOG_DISALLOW_DELETE'	=> '<strong>Suppression d\'un nom d\'utilisateur interdit</strong>',

	'LOG_DB_BACKUP'			=> '<strong>Sauvegarde de la base de données</strong>',
	'LOG_DB_DELETE'			=> '<strong>Suppression d\'une sauvegarde de la base de données</strong>',
	'LOG_DB_RESTORE'		=> '<strong>Restauration d\'une base de données</strong>',

	'LOG_DOWNLOAD_EXCLUDE_IP'	=> '<strong>Adresse IP/Nom d\'hôte exclu de la liste des téléchargements</strong><br />» %s',
	'LOG_DOWNLOAD_IP'			=> '<strong>Ajout d\'une adresse IP/nom d\'hôte à la liste des téléchargements</strong><br />» %s',
	'LOG_DOWNLOAD_REMOVE_IP'	=> '<strong>Suppression d\'une adresse IP/nom d\'hôte de la liste des téléchargements</strong><br />» %s',

	'LOG_ERROR_JABBER'		=> '<strong>Erreur de compte Jabber</strong><br />» %s',
	'LOG_ERROR_EMAIL'		=> '<strong>Erreur d\'e-mail</strong><br />» %s',
	
	'LOG_FORUM_ADD'							=> '<strong>Création d\'un nouveau forum</strong><br />» %s',
	'LOG_FORUM_DEL_FORUM'					=> '<strong>Suppression d\'un forum</strong><br />» %s',
	'LOG_FORUM_DEL_FORUMS'					=> '<strong>Suppression d\'un forum et de ses sous-forums</strong><br />» %s',
	'LOG_FORUM_DEL_MOVE_FORUMS'				=> '<strong>Suppression d\'un forum et sous-forums déplacés</strong> vers %1$s<br />» %2$s',
	'LOG_FORUM_DEL_MOVE_POSTS'				=> '<strong>Suppression d\'un forum et messages déplacés</strong> vers %1$s<br />» %2$s',
	'LOG_FORUM_DEL_MOVE_POSTS_FORUMS'		=> '<strong>Suppression d\'un forum et ses sous-forums, messages déplacés</strong> vers %1$s<br />» %2$s',
	'LOG_FORUM_DEL_MOVE_POSTS_MOVE_FORUMS'	=> '<strong>Suppression d\'un forum, déplacement des messages</strong> vers %1$s <strong>et de ses sous-forums</strong> vers %2$s<br />» %3$s',
	'LOG_FORUM_DEL_POSTS'					=> '<strong>Suppression d\'un forum et de ses messages</strong><br />» %s',
	'LOG_FORUM_DEL_POSTS_FORUMS'			=> '<strong>Suppression d\'un forum, de ses messages et de ses sous-forums</strong><br />» %s',
	'LOG_FORUM_DEL_POSTS_MOVE_FORUMS'		=> '<strong>Suppression d\'un forum et de ses messages, sous-forums déplacés</strong> vers %1$s<br />» %2$s',
	'LOG_FORUM_EDIT'						=> '<strong>Modification d\'un forum</strong><br />» %s',
	'LOG_FORUM_MOVE_DOWN'					=> '<strong>Déplacement d\'un forum</strong> %1$s <strong>en dessous de</strong> %2$s',
	'LOG_FORUM_MOVE_UP'						=> '<strong>Déplacement d\'un forum</strong> %1$s <strong>au dessus de</strong> %2$s',
	'LOG_FORUM_SYNC'						=> '<strong>Resynchronisation d\'un forum</strong><br />» %s',

	'LOG_GROUP_CREATED'		=> '<strong>Création d\'un nouveau groupe</strong><br />» %s',
	'LOG_GROUP_DEFAULTS'	=> '<strong>Groupe par défaut pour le membre</strong><br />» %s',
	'LOG_GROUP_DELETE'		=> '<strong>Suppression d\'un groupe</strong><br />» %s',
	'LOG_GROUP_DEMOTED'		=> '<strong>Rétrogradation d\'un chef dans le groupe</strong> %1$s<br />» %2$s',
	'LOG_GROUP_PROMOTED'	=> '<strong>Promotion d\'un membre en chef de groupe</strong> %1$s<br />» %2$s',
	'LOG_GROUP_REMOVE'		=> '<strong>Suppression de membre d\'un groupe</strong> %1$s<br />» %2$s',
	'LOG_GROUP_UPDATED'		=> '<strong>Mise à jour des informations d\'un groupe</strong><br />» %s',
	'LOG_MODS_ADDED'		=> '<strong>Ajout d\'un nouveau chef dans le groupe</strong> %1$s<br />» %2$s',
	'LOG_USERS_APPROVED'	=> '<strong>Utilisateurs approuvés dans le groupe</strong> %1$s<br />» %2$s',
	'LOG_USERS_ADDED'		=> '<strong>Ajout de nouveau membre au groupe</strong> %1$s<br />» %2$s',

	'LOG_IMAGESET_ADD_DB'			=> '<strong>Ajout d\'un pack d\'images dans la base de données</strong><br />» %s',
	'LOG_IMAGESET_ADD_FS'			=> '<strong>Ajout d\'un pack d\'images sur le système de fichiers</strong><br />» %s',
	'LOG_IMAGESET_DELETE'			=> '<strong>Suppression d\'un pack d\'images/b><br />» %s',
	'LOG_IMAGESET_EDIT_DETAILS'		=> '<strong>Edition des informations d\'un pack d\'images</strong><br />» %s',
	'LOG_IMAGESET_EDIT'				=> '<strong>Edition d\'un pack d\'images</strong><br />» %s',
	'LOG_IMAGESET_EXPORT'			=> '<strong>Export d\'un pack d\'images</strong><br />» %s',
	'LOG_IMAGESET_LANG_MISSING'		=> '<strong>Traduction manquante “%2$s” pour le pack d\'images</strong><br />» %1$s',
	'LOG_IMAGESET_LANG_REFRESHED'	=> '<strong>Rafraîchissement de la traduction “%2$s” d\'un pack d\'images</strong><br />» %1$s',
	'LOG_IMAGESET_REFRESHED'		=> '<strong>Rafraîchissement d\'un pack d\'images</strong><br />» %s',

	'LOG_INACTIVE_ACTIVATE'	=> '<strong>Activation d\'utilisateurs inactifs</strong><br />» %s',
	'LOG_INACTIVE_DELETE'	=> '<strong>Suppression d\'utilisateurs inactifs</strong><br />» %s',
	'LOG_INACTIVE_REMIND'	=> '<strong>Envoi d\'un rappel par e-mail aux utilisateurs inactifs</strong><br />» %s',
	'LOG_INSTALL_CONVERTED'	=> '<strong>Conversion depuis %1$s vers phpBB %2$s</strong>',
	'LOG_INSTALL_INSTALLED'	=> '<strong>Installation de phpBB %s</strong>',

	'LOG_IP_BROWSER_FORWARDED_CHECK'	=> '<strong>La vérification de la session IP/navigateur/X_FORWARDED_FOR a échouée</strong><br />»L\'adresse IP de l\'utilisateur “<em>%1$s</em>” a été comparée avec la session IP “<em>%2$s</em>”, la chaîne du navigateur de l\'utilisateur “<em>%3$s</em>” a été comparée avec la chaîne de la session “<em>%4$s</em>” du navigateur et la chaîne X_FORWARDED_FOR de l\'utilisateur “<em>%5$s</em>” a été comparée avec la chaîne X_FORWARDED_FOR de la session “<em>%6$s</em>”.',

	'LOG_JAB_CHANGED'			=> '<strong>Modification d\'un compte Jabber</strong>',
	'LOG_JAB_PASSCHG'			=> '<strong>Modification de mot de passe du compte Jabber</strong>',
	'LOG_JAB_REGISTER'			=> '<strong>Enregistrement d\'un compte Jabber</strong>',
	'LOG_JAB_SETTINGS_CHANGED'	=> '<strong>Modification des paramètres du compte Jabber</strong>',

	'LOG_LANGUAGE_PACK_DELETED'		=> '<strong>Suppression d\'une langue</strong><br />» %s',
	'LOG_LANGUAGE_PACK_INSTALLED'	=> '<strong>Installation d\'une langue</strong><br />» %s',
	'LOG_LANGUAGE_PACK_UPDATED'		=> '<strong>Mise à jour des informations d\'une langue</strong><br />» %s',
	'LOG_LANGUAGE_FILE_REPLACED'	=> '<strong>Remplacement d\'un fichier de langue</strong><br />» %s',
	'LOG_LANGUAGE_FILE_SUBMITTED'	=> '<strong>Envoi et stockage d\'un fichier de langue</strong><br />» %s',

	'LOG_MASS_EMAIL'		=> '<strong>Envoi d\'un e-mail de masse</strong><br />» %s',

	'LOG_MCP_CHANGE_POSTER'	=> '<strong>Modification de l\'auteur du sujet “%1$s”</strong><br />» de %2$s en %3$s',

	'LOG_MODULE_DISABLE'	=> '<strong>Désactivation d\'un module</strong><br />» %s',
	'LOG_MODULE_ENABLE'		=> '<strong>Activation d\'un module</strong><br />» %s',
	'LOG_MODULE_MOVE_DOWN'	=> '<strong>Déplacement d\'un module</strong><br />» %1$s au dessous de %2$s',
	'LOG_MODULE_MOVE_UP'	=> '<strong>Déplacement d\'un module</strong><br />» %1$s au dessus de %2$s',
	'LOG_MODULE_REMOVED'	=> '<strong>Suppression d\'un module</strong><br />» %s',
	'LOG_MODULE_ADD'		=> '<strong>Ajout d\'un module</strong><br />» %s',
	'LOG_MODULE_EDIT'		=> '<strong>Modification d\'un module</strong><br />» %s',

	'LOG_A_ROLE_ADD'		=> '<strong>Ajout d\'un modèle d\'administration</strong><br />» %s',
	'LOG_A_ROLE_EDIT'		=> '<strong>Modification d\'un modèle d\'administration</strong><br />» %s',
	'LOG_A_ROLE_REMOVED'	=> '<strong>Suppression d\'un modèle d\'administration</strong><br />» %s',
	'LOG_F_ROLE_ADD'		=> '<strong>Ajout d\'un modèle de forum</strong><br />» %s',
	'LOG_F_ROLE_EDIT'		=> '<strong>Modification d\'un modèle de forum</strong><br />» %s',
	'LOG_F_ROLE_REMOVED'	=> '<strong>Suppression d\'un modèle de forum</strong><br />» %s',
	'LOG_M_ROLE_ADD'		=> '<strong>Ajout d\'un modèle de modération</strong><br />» %s',
	'LOG_M_ROLE_EDIT'		=> '<strong>Modification d\'un modèle de modération</strong><br />» %s',
	'LOG_M_ROLE_REMOVED'	=> '<strong>Suppression d\'un modèle de modération</strong><br />» %s',
	'LOG_U_ROLE_ADD'		=> '<strong>Ajout d\'un modèle d\'utilisateur</strong><br />» %s',
	'LOG_U_ROLE_EDIT'		=> '<strong>Modification d\'un modèle d\'utilisateur</strong><br />» %s',
	'LOG_U_ROLE_REMOVED'	=> '<strong>Suppression d\'un modèle d\'utilisateur</strong><br />» %s',

	'LOG_PROFILE_FIELD_ACTIVATE'	=> '<strong>Activation d\'un champ de profil</strong><br />» %s',
	'LOG_PROFILE_FIELD_CREATE'		=> '<strong>Ajout d\'un champ de profil</strong><br />» %s',
	'LOG_PROFILE_FIELD_DEACTIVATE'	=> '<strong>Désactivation d\'un champ de profil</strong><br />» %s',
	'LOG_PROFILE_FIELD_EDIT'		=> '<strong>Modification d\'un champ de profil</strong><br />» %s',
	'LOG_PROFILE_FIELD_REMOVED'		=> '<strong>Suppression d\'un champ de profil</strong><br />» %s',

	'LOG_PRUNE'					=> '<strong>Déléstage d\'un forum</strong><br />» %s',
	'LOG_AUTO_PRUNE'			=> '<strong>Auto-déléstage d\'un forum</strong><br />» %s',
	'LOG_PRUNE_USER_DEAC'		=> '<strong>Désactivation de l\'utilisateur</strong><br />» %s',
	'LOG_PRUNE_USER_DEL_DEL'	=> '<strong>Déléstage d\'utilisateurs et suppression de leurs messages</strong><br />» %s',
	'LOG_PRUNE_USER_DEL_ANON'	=> '<strong>Déléstage d\'utilisateurs et conservation de leurs messages</strong><br />» %s',

	'LOG_PURGE_CACHE'			=> '<strong>Vidage du cache</strong>',

	'LOG_RANK_ADDED'		=> '<strong>Ajout d\'un nouveau rang</strong><br />» %s',
	'LOG_RANK_REMOVED'		=> '<strong>Suppression d\'un rang</strong><br />» %s',
	'LOG_RANK_UPDATED'		=> '<strong>Mis à jour d\'un rang</strong><br />» %s',

	'LOG_REASON_ADDED'		=> '<strong>Ajout d\'un rapport/raison</strong><br />» %s',
	'LOG_REASON_REMOVED'	=> '<strong>Suppression d\'un rapport/raison</strong><br />» %s',
	'LOG_REASON_UPDATED'	=> '<strong>Mise à jour d\'un rapport/raison</strong><br />» %s',

	'LOG_RESET_DATE'			=> '<strong>Réinitialisation de la date de création du forum</strong>',
	'LOG_RESET_ONLINE'			=> '<strong>Réinitialisation du record des utilisateurs connectés</strong>',
	'LOG_RESYNC_POSTCOUNTS'		=> '<strong>Synchronisation des compteurs de message d\'utilisateur</strong>',
	'LOG_RESYNC_POST_MARKING'	=> '<strong>Synchronisation des sujets pointés</strong>',
	'LOG_RESYNC_STATS'			=> '<strong>Synchronisation des statistiques de message, sujet et utilisateur</strong>',

	'LOG_SEARCH_INDEX_CREATED'	=> '<strong>Création de l\'index de recherche pour</strong><br />» %s',
	'LOG_SEARCH_INDEX_REMOVED'	=> '<strong>Suppression de l\'index de recherche pour</strong><br />» %s',
	'LOG_STYLE_ADD'				=> '<strong>Ajout d\'un nouveau style</strong><br />» %s',
	'LOG_STYLE_DELETE'			=> '<strong>Suppression d\'un style</strong><br />» %s',
	'LOG_STYLE_EDIT_DETAILS'	=> '<strong>Modification des informations d\'un style</strong><br />» %s',
	'LOG_STYLE_EXPORT'			=> '<strong>Export d\'un style</strong><br />» %s',

	'LOG_TEMPLATE_ADD_DB'			=> '<strong>Ajout d\'un pack de template à la base de données</strong><br />» %s',
	'LOG_TEMPLATE_ADD_FS'			=> '<strong>Ajout d\'un pack de template au système de fichier</strong><br />» %s',
	'LOG_TEMPLATE_CACHE_CLEARED'	=> '<strong>Suppression du cache des fichiers d\'un template <em>%1$s</em></strong><br />» %2$s',
	'LOG_TEMPLATE_DELETE'			=> '<strong>Suppression d\'un pack de template</strong><br />» %s',
	'LOG_TEMPLATE_EDIT'				=> '<strong>Modification d\'un pack de template <em>%1$s</em></strong><br />» %2$s',
	'LOG_TEMPLATE_EDIT_DETAILS'		=> '<strong>Modification des informations d\'un pack de template</strong><br />» %s',
	'LOG_TEMPLATE_EXPORT'			=> '<strong>Export d\'un pack de template</strong><br />» %s',
	'LOG_TEMPLATE_REFRESHED'		=> '<strong>Rafraichissement d\'un pack de template</strong><br />» %s',

	'LOG_THEME_ADD_DB'			=> '<strong>Ajout d\'un nouveau thème à la base de données</strong><br />» %s',
	'LOG_THEME_ADD_FS'			=> '<strong>Ajout d\'un nouveau thème au système de fichier</strong><br />» %s',
	'LOG_THEME_DELETE'			=> '<strong>Suppression d\'un thème</strong><br />» %s',
	'LOG_THEME_EDIT_DETAILS'	=> '<strong>Modification des informations d\'un thème</strong><br />» %s',
	'LOG_THEME_EDIT'			=> '<strong>Modification d\'un thème <em>%1$s</em></strong>',
	'LOG_THEME_EDIT_FILE'		=> '<strong>Modification d\'un thème <em>%1$s</em></strong><br />» modification d\'un fichier <em>%2$s</em>',
	'LOG_THEME_EXPORT'			=> '<strong>Export d\'un thème</strong><br />» %s',
	'LOG_THEME_REFRESHED'		=> '<strong>Rafraichissement d\'un thème</strong><br />» %s',

	'LOG_UPDATE_DATABASE'	=> '<strong>Mise à jour de la base de données de la version %1$s à la version %2$s</strong>',
	'LOG_UPDATE_PHPBB'		=> '<strong>Mise à jour de phpBB de la version %1$s à la version %2$s</strong>',

	'LOG_USER_ACTIVE'		=> '<strong>Activation de l\'utilisateur</strong><br />» %s',
	'LOG_USER_BAN_USER'		=> '<strong>Bannissement d\'utilisateur via la gestion d\'utilisateurs</strong> pour la raison “<em>%1$s</em>”<br />» %2$s',
	'LOG_USER_BAN_IP'		=> '<strong>Bannissement d\'adresse IP via la gestion d\'utilisateurs</strong> pour la raison “<em>%1$s</em>”<br />» %2$s',
	'LOG_USER_BAN_EMAIL'	=> '<strong>Bannissement d\'e-mail via la gestion d\'utilisateurs</strong> pour la raison “<em>%1$s</em>”<br />» %2$s',
	'LOG_USER_DELETED'		=> '<strong>Suppression de l\'utilisateur</strong><br />» %s',
	'LOG_USER_DEL_ATTACH'	=> '<strong>Suppression de tous les fichiers joints de l\'utilisateur</strong><br />» %s',
	'LOG_USER_DEL_AVATAR'	=> '<strong>Suppression de l\'avatar de l\'utilisateur</strong><br />» %s',
	'LOG_USER_DEL_POSTS'	=> '<strong>Suppression des messages de l\'utilisateur</strong><br />» %s',
	'LOG_USER_DEL_SIG'		=> '<strong>Suppression de la signature de l\'utilisateur</strong><br />» %s',
	'LOG_USER_INACTIVE'		=> '<strong>Désactivation de l\'utilisateur</strong><br />» %s',
	'LOG_USER_MOVE_POSTS'	=> '<strong>Déplacement des messages de </strong><br />» “%1$s” vers le forum “%2$s”',
	'LOG_USER_NEW_PASSWORD'	=> '<strong>Modification du mot de passe de l\'utilisateur</strong><br />» %s',
	'LOG_USER_REACTIVATE'	=> '<strong>Réactivation forcée du compte de l\'utilisateur</strong><br />» %s',
	'LOG_USER_UPDATE_EMAIL'	=> '<strong>Modification de l\'e-mail de l\'utilisateur “%1$s” </strong><br />» de “%2$s” à “%3$s”',
	'LOG_USER_UPDATE_NAME'	=> '<strong>Modification d\'un nom d\'utilisateur</strong><br />» de “%1$s” à “%2$s”',
	'LOG_USER_USER_UPDATE'	=> '<strong>Mise à jour des informations de l\'utilisateur</strong><br />» %s',

	'LOG_USER_ACTIVE_USER'		=> '<strong>Activation d\'un compte utilisateur</strong>',
	'LOG_USER_DEL_AVATAR_USER'	=> '<strong>Suppression de l\'avatar</strong>',
	'LOG_USER_DEL_SIG_USER'		=> '<strong>Suppression de la signature</strong>',
	'LOG_USER_FEEDBACK'			=> '<strong>Ajout d\'une fiche de suivi pour l\'utilisateur</strong><br />» %s',
	'LOG_USER_GENERAL'			=> '<strong>Ajout d\'une entrée:</strong><br />» %s',
	'LOG_USER_INACTIVE_USER'	=> '<strong>Désactivation d\'un compte utilisateur</strong>',
	'LOG_USER_LOCK'				=> '<strong>Verrouillage par son auteur d\'un sujet</strong><br />» %s',
	'LOG_USER_MOVE_POSTS_USER'	=> '<strong>Déplacement de tous les messages vers le forum</strong> “%s”',
	'LOG_USER_REACTIVATE_USER'	=> '<strong>Réactivation forcée d\'un compte utilisateur</strong>',
	'LOG_USER_UNLOCK'			=> '<strong>Déverrouillage par son auteur d\'un sujet</strong><br />» %s',
	'LOG_USER_WARNING'			=> '<strong>Ajout d\'un avertissement par l\'utilisateur</strong><br />» %s',
	'LOG_USER_WARNING_BODY'		=> '<strong>Un avertissement a été établi par l\'utilisateur</strong><br />»%s',

	'LOG_USER_GROUP_CHANGE'			=> '<strong>Modification du groupe par défaut de l\'utilisateur</strong><br />» %s',
	'LOG_USER_GROUP_DEMOTE'			=> '<strong>Rétrogradation du chef d\'un groupe d\'utilisateurs</strong><br />» %s',
	'LOG_USER_GROUP_JOIN'			=> '<strong>Adhésion à un groupe de l\'utilisateur</strong><br />» %s',
	'LOG_USER_GROUP_JOIN_PENDING'	=> '<strong>Adhésion à un groupe de l\'utilisateur et demande d\'approbation</strong><br />» %s',
	'LOG_USER_GROUP_RESIGN'			=> '<strong>Désinscription à un groupe de l\'utilisateur</strong><br />» %s',

	'LOG_WORD_ADD'			=> '<strong>Ajout d\'un mot censuré</strong><br />» %s',
	'LOG_WORD_DELETE'		=> '<strong>Suppression d\'un mot censuré</strong><br />» %s',
	'LOG_WORD_EDIT'			=> '<strong>Edition d\'un mot censuré</strong><br />» %s',
));
// www.phpBB-SEO.com SEO TOOLKIT BEGIN
$lang = array_merge($lang, array(
	'ACP_CAT_PHPBB_SEO' => 'phpBB SEO',
	'ACP_MOD_REWRITE' => 'Réécriture d\'url',
	'ACP_PHPBB_SEO_CLASS' => 'Configuration de la classe phpBB SEO',
	'ACP_FORUM_URL' => 'Configuration des URLs des forums',
	'ACP_HTACCESS' => '.htaccess',
	'ACP_PREMOD_UPDATE' => '<h1>Annonce de mise à jour</h1>
	<p>Cette mise à jour ne concerne que la premod, pas phpBB lui même.</p>
	<p>Une nouvelle version de la premod phpBB SEO est donc disponible : %1$s<br/>Veuillez vous rendre sur <a href="%2$s" title="Le sujet de mise à disposition"><b>le sujet de mise à disposition</b></a> pour procéder à la mise à jour.</p>',
	'SEO_LOG_INSTALL_PHPBB_SEO' => '<strong>Installation du mod rewrite phpBB SEO</strong>',
	'SEO_LOG_INSTALL_PHPBB_SEO_FAIL' => '<strong>Echec de l\'installation du mod rewrite phpBB SEO</strong>',
	'SEO_LOG_UNINSTALL_PHPBB_SEO' => '<strong>Désinstallation du mod rewrite phpBB SEO</strong>',
	'SEO_LOG_UNINSTALL_PHPBB_SEO_FAIL' => '<strong>Echec de la désinstallation du mod rewrite phpBB SEO</strong>',
	'SEO_LOG_CONFIG_SETTINGS' => '<strong>Modification des r�glages de la classe phpBB SEO</strong>',
	'SEO_LOG_CONFIG_FORUM_URL' => '<strong>Modification des URLs des Forum</strong>',
	'SEO_LOG_CONFIG_HTACCESS' => '<strong>Nouveau .htaccess généré</strong>',
));
// www.phpBB-SEO.com SEO TOOLKIT END
?>
