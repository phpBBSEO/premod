<?php
/**
*
* help_faq [Standard french]
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
*/
if (!defined('IN_PHPBB'))
{
	exit;
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

$help = array(
	array(
		0 => '--',
		1 => 'Problèmes de connexion et d’enregistrement',
	),
	array(
		0 => 'Pourquoi dois-je m’enregistrer ?',
		1 => 'Vous pouvez ne pas le faire, mais l’administrateur du forum peut avoir configuré les forums afin qu’il soit nécessaire de s’enregistrer pour poster des messages. Par ailleurs, l’enregistrement vous permet de bénéficier de fonctionnalités supplémentaires inaccessibles aux invités comme les avatars personnalisés, la messagerie privée, l’envoi d’e-mails aux autres membres, l’adhésion à des groupes, etc. La création d’un compte est rapide et vivement conseillée.'
	),
	array(
		0 => 'Que signifie COPPA ?',
		1 => 'COPPA (ou <em>Children’s Online Privacy Protection Act</em> de 1998) est une loi aux États-Unis qui dit que les sites Internet pouvant recueillir des informations de mineurs de moins de 13 ans doivent obtenir le consentement écrit des parents (ou d’un tuteur légal) pour la collecte de ces informations permettant d’identifier un mineur de moins de 13 ans. Si vous n’êtes pas sûr que cela s’applique à vous, lorsque vous vous enregistrez ou que quelqu’un le fait à votre place, contactez un conseiller juridique pour obtenir son avis. Notez que phpBB Limited et les propriétaires de ce forum ne peuvent pas fournir de conseils juridiques et ne sauraient être contactés pour des questions légales de toutes sortes, à l’exception de celles mentionnées dans la question « Qui contacter pour les abus ou les questions légales concernant ce forum ? ».',
	),
	array(
		0 => 'Je souhaite m’enregistrer, mais je n’y parviens pas !',
		1 => 'Il est possible qu’un administrateur du forum ait désactivé la création de nouveaux comptes. Il peut également avoir banni votre IP ou interdit le nom d’utilisateur que vous souhaitez utiliser. Contactez un administrateur du forum pour obtenir de l’aide.',
	),
	array(
		0 => 'Je suis enregistré mais je ne peux pas me connecter !',
		1 => 'Vérifiez, en premier, votre nom d’utilisateur et votre mot de passe. S’ils sont corrects, il y a deux possibilités :<br />Si la gestion COPPA est active et si vous avez indiqué avoir moins de 13 ans lors de l’enregistrement, alors vous devrez suivre les instructions reçues par e-mail. Certains forums peuvent également nécessiter que toute nouvelle création de compte soit activée par vous-même ou par un administrateur avant que vous puissiez vous connecter. Cette information est indiquée lors de l’enregistrement. Si vous avez reçu un e-mail, suivez ses instructions.<br />Si vous n’avez pas reçu d’e-mail, il se peut que vous ayez fourni une adresse incorrecte ou que l’e-mail ait été traité par un filtre anti-spam. Si vous êtes sûr de l’adresse e-mail fournie, contactez un administrateur.'
	),
	array(
		0 => 'Pourquoi ne puis-je pas me connecter ?',
		1 => 'Plusieurs raisons pourraient expliquer cela. Premièrement, vérifiez que votre nom d’utilisateur et votre mot de passe soient corrects. S’ils le sont, contactez un administrateur du forum pour vérifier que vous n’avez pas été banni. Il est également possible que le propriétaire du site Internet ait une erreur de configuration de son côté, et qu’il devra la corriger.',
	),
	array(
		0 => 'Je me suis enregistré par le passé mais je ne peux plus me connecter ?!',
		1 => 'Il est possible qu’un administrateur ait désactivé ou supprimé votre compte. En effet, il est courant de supprimer régulièrement les membres ne postant pas pour réduire la taille de la base de données. Si cela vous arrive, tentez de vous ré-enregistrer et soyez plus investi sur le forum.'
	),
	array(
		0 => 'J’ai perdu mon mot de passe !',
		1 => 'Pas de panique ! Bien que votre mot de passe ne puisse pas être récupéré, il peut facilement être réinitialisé. Pour ce faire, rendez vous sur la page de connexion puis cliquez sur <em>J’ai oublié mon mot de passe</em>. Suivez les instructions énoncées et vous devriez pouvoir à nouveau vous connecter.<br />Si toutefois vous ne parveniez pas à réinitialiser votre mot de passe, contactez un administrateur du forum.',
	),
	array(
		0 => 'Pourquoi suis-je automatiquement déconnecté ?',
		1 => 'Si vous ne cochez pas la case <em>Se souvenir de moi</em> lors de votre connexion, vous ne resterez connecté que pendant une durée déterminée. Cela empêche que quelqu’un d’autre utilise votre compte à votre insu en utilisant le même ordinateur. Pour rester connecté, cochez la case <em>Se souvenir de moi</em> lors de la connexion. Ce n’est pas recommandé si vous utilisez un ordinateur public pour accéder au forum (bibliothèque, cyber-café, université, etc.). Si vous ne voyez pas cette case, cela signifie qu’un administrateur du forum a désactivé cette fonctionnalité.',
	),
	array(
		0 => 'À quoi sert « Supprimer les cookies du forum » ?',
		1 => 'Cela supprime tous les cookies créés par phpBB qui conservent vos paramètres d’authentification et votre connexion au forum. Ils fournissent aussi des fonctionnalités telles que les indicateurs de lecture des messages (lu ou non lu) si cela a été activé par un administrateur du forum. Si vous rencontrez des problèmes de connexion ou de déconnexion, la suppression des cookies pourrait les résoudre.',
	),
	array(
		0 => '--',
		1 => 'Paramètres et préférences de l’utilisateur'
	),
	array(
		0 => 'Comment modifier mes paramètres ?',
		1 => 'Si vous êtes membre de ce forum, tous vos paramètres sont stockés dans notre base de données. Pour les modifier, accédez au <em>Panneau de l’utilisateur</em> (généralement ce lien est accessible en haut de toutes les pages du forum). Cela vous permettra de modifier tous les paramètres et préférences de votre compte.',
	),
	array(
		0 => 'Comment empêcher mon nom d’apparaître dans la liste des membres connectés ?',
		1 => 'Depuis votre panneau de l’utilisateur, onglet « Préférences du forum », vous trouverez l’option <em>Cacher mon statut en ligne</em>. Si vous activez cette option vous ne serez visible que par les administrateurs, les modérateurs et vous-même. Vous serez compté parmi les membres invisibles.',
	),
	array(
		0 => 'Les heures ne sont pas correctes !',
		1 => 'Il est possible que l’heure affichée utilise un fuseau horaire différent de celui dans lequel vous êtes. Dans ce cas, accédez au <em>panneau de l’utilisateur</em> et modifiez le fuseau horaire afin qu’il corresponde à la zone où vous vous trouvez (ex : Londres, Paris, New York, Sydney, etc.). Notez que la modification du fuseau horaire, comme la plupart des paramètres, n’est accessible qu’aux membres du forum. Donc si vous n’êtes pas enregistré, c’est le bon moment pour le faire.',
	),
	array(
		0 => 'J’ai changé mon fuseau horaire et l’heure est toujours incorrecte !',
		1 => 'Si vous êtes sûr d’avoir correctement paramétré votre fuseau horaire et l’heure d’été et que l’heure est toujours incorrecte, il se peut que le serveur ne soit pas à l’heure. Signalez ce problème à un administrateur.'
	),
	array(
		0 => 'Ma langue n’est pas dans la liste !',
		1 => 'La raison la plus probable est que l’administrateur n’ait pas installé votre langue ou bien que personne n’ait encore traduit phpBB dans votre langue. Essayez de demander à un administrateur du forum d’installer la langue désirée. Si elle n’existe pas, n’hésitez pas à créer et partager une nouvelle traduction. Vous trouverez plus d’informations sur le site Internet de <a href="https://www.phpbb.com/">phpBB</a>&reg;.',
	),
	array(
		0 => 'A quoi correspondent les images à proximité de mon nom d’utilisateur ?',
		1 => 'Il y a deux images qui peuvent être associées avec votre nom d’utilisateur lorsque vous consultez les messages d’un sujet. L’une d’elles peut être associée à votre rang, généralement des étoiles ou des blocs indiquant votre nombre de messages ou votre statut sur le forum. La seconde image, souvent plus grande, est connue sous le nom d’avatar et généralement est unique ou propre à chaque membre.',
	),
	array(
		0 => 'Comment puis-je afficher un avatar ?',
		1 => 'Depuis votre panneau d’utilisateur, dans l’onglet « profil » vous pouvez ajouter un avatar en utilisant l’une des trois méthodes d’avatar suivantes : galerie, distant ou importé. L’administrateur du forum peut activer ou non les avatars et décider de la manière dont ils sont mis à disposition. Si vous ne pouvez pas utiliser d’avatar, contactez un administrateur du forum.',
	),
	array(
		0 => 'Qu’est-ce que mon rang et comment le modifier ?',
		1 => 'Les rangs, qui peuvent être associés au nom d’utilisateur, indiquent le nombre de messages postés ou identifient certains membres tels que les modérateurs et administrateurs. En général, vous ne pouvez pas directement modifier l’intitulé d’un rang car il est paramétré par l’administrateur du forum. Évitez de poster des messages sur le forum dans le seul but de passer au rang supérieur. Sur la plupart des forums, cette pratique est rarement tolérée et un modérateur (ou un administrateur) peut facilement abaisser votre compteur de messages.',
	),
	array(
		0 => 'Lorsque je clique sur le lien <em>e-mail</em> d’un membre, on me demande de me connecter !?',
		1 => 'Seuls les membres peuvent s’envoyer des e-mails via le formulaire intégré (si la fonction a été activée par l’administrateur). Ceci pour empêcher l’utilisation malveillante de la fonctionnalité par les invités.',
	),
	array(
		0 => '--',
		1 => 'Problèmes liés à la publication de messages',
	),
	array(
		0 => 'Comment créer un nouveau sujet ou poster une réponse ?',
		1 => 'Cliquez sur le bouton « Nouveau » depuis la page d’un forum ou « Répondre » depuis la page d’un sujet. Il se peut que vous ayez besoin d’être enregistré pour écrire un message. Une liste des options disponibles est affichée en bas de page des forums, exemple : Vous <strong>pouvez</strong> poster de nouveaux sujets, Vous <strong>pouvez</strong> joindre des fichiers, etc.',
	),
	array(
		0 => 'Comment modifier ou supprimer un message ?',
		1 => 'À moins d’être administrateur ou modérateur, vous ne pouvez modifier ou supprimer que vos propres messages. Vous pouvez modifier un message (quelquefois dans une durée limitée après sa publication) en cliquant sur le bouton <em>modifier</em> du message correspondant. Si quelqu’un a déjà répondu au message, un petit texte s’affichera en bas du message indiquant qu’il a été modifié, le nombre de fois qu’il a été modifié ainsi que la date et l’heure de la dernière modification. Ce message n’apparaîtra pas si un modérateur ou un administrateur modifie le message, cependant ils ont la possibilité de laisser une note indiquant qu’ils ont modifié le message de leur propre initiative. Notez que les utilisateurs ne peuvent pas supprimer un message une fois que quelqu’un y a répondu.',
	),
	array(
		0 => 'Comment ajouter une signature à mes messages ?',
		1 => 'Vous devez d’abord créer une signature depuis votre panneau de l’utilisateur. Une fois créée, vous pouvez cocher <em>Attacher ma signature</em> sur le formulaire de rédaction de message. Vous pouvez aussi ajouter la signature par défaut à tous vos messages en activant l’option « Attacher ma signature » à partir du panneau de l’utilisateur (onglet <em>Préférences du forum --> Modifier les préférences de message</em>). Par la suite, vous pourrez toujours empêcher une signature d’être ajoutée à un message en décochant la case <em>Attacher ma signature</em> dans le formulaire de rédaction de message.',
	),
	array(
		0 => 'Comment créer un sondage ?',
		1 => 'Il est facile de créer un sondage, lors de la publication d’un nouveau sujet ou la modification du premier message d’un sujet (si vous en avez les permissions), cliquez sur l’onglet <em>Sondage</em> sous la partie message (si vous ne le voyez pas, vous n’avez probablement pas le droit de créer des sondages). Saisissez le titre du sondage et au moins deux options possibles, entrez une option par ligne dans le champ des réponses. Vous pouvez aussi indiquer le nombre de réponses qu’un utilisateur peut choisir lors de son vote dans « Option(s) par l’utilisateur », limiter la durée en jours du sondage (mettre « 0 » pour une durée illimitée) et enfin permettre aux utilisateurs de modifier leur vote.'
	),
	array(
		0 => 'Pourquoi ne puis-je pas ajouter plus d’options à mon sondage ?',
		1 => 'Le nombre d’options maximum par sondage est défini par l’administrateur. Si vous avez besoin d’indiquer plus d’options, contactez-le.'
	),
	array(
		0 => 'Comment modifier ou supprimer un sondage ?',
		1 => 'Comme pour les messages, les sondages ne peuvent être modifiés que par l’auteur original, un modérateur ou un administrateur. Pour modifier un sondage, cliquez sur le bouton <em>Modifier</em> du premier message du sujet (c’est toujours celui auquel est associé le sondage). Si personne n’a voté, l’auteur peut modifier une option ou supprimer le sondage. Autrement, seuls les modérateurs et les administrateurs peuvent le modifier ou le supprimer. Ceci pour empêcher le trucage en changeant les intitulés en cours de sondage.'
	),
	array(
		0 => 'Pourquoi ne puis-je pas accéder à un forum ?',
		1 => 'Certains forums peuvent être réservés à certains utilisateurs ou groupes. Pour les consulter, les lire, y poster, etc., vous devez avoir les permissions s’y rapportant. Seuls les modérateurs de groupes et les administrateurs peuvent accorder ces accès, vous devez donc les contacter.',
	),
	array(
		0 => 'Pourquoi ne puis-je pas joindre des fichiers à mon message ?',
		1 => 'La possibilité d’ajouter des fichiers joints peut être accordée par forum, par groupe, ou par utilisateur. L’administrateur peut ne pas avoir autorisé l’ajout de fichiers joints pour le forum dans lequel vous postez, ou peut-être que seul un groupe peut en joindre. Contactez l’administrateur si vous ne savez pas pourquoi vous ne pouvez pas ajouter de fichiers joints sur un forum.'
	),
	array(
		0 => 'Pourquoi ai-je reçu un avertissement ?',
		1 => 'Chaque administrateur a son propre ensemble de règles pour son site. Si vous avez dérogé à une règle, vous pouvez recevoir un avertissement. Notez que c’est la décision de l’administrateur, et que phpBB Limited n’est pas concerné par les avertissements d’un site donné. Contactez l’administrateur si vous ne comprenez pas les raisons de votre avertissement.'
	),
	array(
		0 => 'Comment rapporter des messages à un modérateur ?',
		1 => 'Si l’administrateur l’a permis, allez sur le message à signaler et vous devriez voir un bouton pour rapporter le message. En cliquant dessus, vous accéderez aux étapes nécessaires pour le faire.',
	),
	array(
		0 => 'À quoi sert le bouton « Sauvegarder » dans la page de rédaction de message ?',
		1 => 'Il vous permet de sauvegarder des brouillons de vos messages et de les poster ultérieurement. Pour les recharger, allez dans le panneau de l’utilisateur (onglet <em>Aperçu --> Gestion des brouillons</em>).'
	),
	array(
		0 => 'Pourquoi mon message doit être validé ?',
		1 => 'L’administrateur peut avoir décidé que les messages du forum dans lequel vous postez nécessitent d’être validés avant d’être publiés. Il est possible aussi que l’administrateur vous ait placé dans un groupe dont les messages doivent être validés avant d’être publiés. Contactez l’administrateur pour plus d’informations.'
	),
	array(
		0 => 'Comment remonter mon sujet ?',
		1 => 'En cliquant sur le lien « Remonter le sujet » lors de sa consultation, vous pouvez <em>remonter</em> le sujet en haut du forum sur la première page. Par ailleurs, si vous ne voyez pas ce lien, cela signifie que la remontée de sujet est désactivée ou que l’intervalle de temps pour autoriser la remontée n’est pas atteint. Il est également possible de remonter un sujet simplement en y répondant. Néanmoins, assurez-vous de respecter les règles du forum en le faisant.'
	),
	array(
		0 => '--',
		1 => 'Mise en forme et types de sujets'
	),
	array(
		0 => 'Que sont les BBCodes ?',
		1 => 'Le BBCode est une implantation spéciale au language HTML, offrant un large contrôle de mise en forme des éléments d’un message. L’administrateur peut décider si vous pouvez utiliser les BBCodes, vous pouvez aussi les désactiver dans chacun de vos messages en utilisant l’option appropriée du formulaire de rédaction de message. Le BBCode lui-même est similaire au style HTML, mais les balises sont incluses entre crochets [ et ] plutôt que &lt; et &gt;. Pour plus d’informations sur le BBCode, consultez le guide accessible depuis la page de rédaction de message.',
	),
	array(
		0 => 'Puis-je utiliser le HTML ?',
		1 => 'Non, il n’est pas possible de publier du HTML sur ce forum. La plupart des mises en forme permises par le HTML peuvent être appliquées avec les BBCodes.'
	),
	array(
		0 => 'Que sont les smileys ?',
		1 => 'Les smileys, ou émoticônes, sont de petites images utilisées pour exprimer des sentiments avec un code simple, exemple : :) signifie joyeux, :( signifie triste. La liste complète des smileys est visible sur la page de rédaction de message. Essayez toutefois de ne pas en abuser. Ils peuvent rapidement rendre un message illisible et un modérateur peut décider de les retirer ou simplement d’effacer le message. L’administrateur peut aussi avoir défini un nombre maximum de smileys par message.'
	),
	array(
		0 => 'Puis-je publier des images ?',
		1 => 'Oui, vous pouvez afficher des images dans vos messages. Par ailleurs, si l’administrateur a autorisé les fichiers joints, vous pouvez charger une image sur le forum. Autrement, vous devez lier une image placée sur un serveur Web public, exemple : http://www.exemple.com/mon-image.gif. Vous ne pouvez pas lier des images de votre ordinateur (sauf si c’est un serveur Web public) ni des images placées derrière des mécanismes d’authentification, exemple : Boîtes e-mail Hotmail ou Yahoo!, sites protégés par un mot de passe, etc. Pour afficher l’image, utilisez la balise BBCode [img].'
	),
	array(
		0 => 'Que sont les annonces globales ?',
		1 => 'Les annonces globales contiennent des informations importantes que vous devez lire dès que possible. Elles apparaissent en haut de chaque forum et dans votre panneau de l’utilisateur. La possibilité de publier des annonces globales dépend des permissions définies par l’administrateur.'
	),
	array(
		0 => 'Que sont les annonces ?',
		1 => 'Les annonces contiennent souvent des informations importantes concernant le forum que vous consultez et doivent être lues dès que possible. Les annonces apparaissent en haut de chaque page du forum dans lequel elles sont publiées. Comme pour les annonces globales, la possibilité de publier des annonces dépend des permissions définies par l’administrateur.'
	),
	array(
		0 => 'Que sont les post-it ?',
		1 => 'Un post-it apparaît en dessous des annonces sur la première page du forum dans lequel il a été publié. Il contient des informations relativement importantes et vous devez le consulter régulièrement. Comme pour les annonces et les annonces globales, la possibilité de publier des post-it dépend des permissions définies par l’administrateur.'
	),
	array(
		0 => 'Que sont les sujets verrouillés ?',
		1 => 'Vous ne pouvez plus répondre dans les sujets verrouillés et tout sondage y étant contenu est alors terminé. Les sujets peuvent être verrouillés pour différentes raisons par un modérateur ou un administrateur. Selon les permissions accordées par l’administrateur, vous pouvez ou non verrouiller vos propres sujets.'
	),
	array(
		0 => 'Que sont les icônes de sujet ?',
		1 => 'Les icônes de sujet sont des images qui peuvent être associées à des messages pour refléter leur contenu. La possibilité d’utiliser des icônes de sujet dépend des permissions définies par l’administrateur.'
	),
	// This block will switch the FAQ-Questions to the second template column
	array(
		0 => '--',
		1 => '--'
	),
	array(
		0 => '--',
		1 => 'Niveaux d’utilisateurs et groupes'
	),
	array(
		0 => 'Que sont les administrateurs ?',
		1 => 'Les administrateurs sont les utilisateurs qui ont le plus haut niveau de contrôle sur tout le forum. Ils contrôlent tous les aspects du forum comme les permissions, le bannissement, la création de groupes d’utilisateurs ou de modérateurs, etc., selon les permissions que le fondateur du forum a attribuées aux autres administrateurs. Ils peuvent aussi avoir toutes les capacités de modération sur l’ensemble des forums, selon ce que le fondateur a autorisé.',
	),
	array(
		0 => 'Que sont les modérateurs ?',
		1 => 'Les modérateurs sont des utilisateurs (ou groupes d’utilisateurs) dont le travail consiste à vérifier au jour le jour le bon fonctionnement du forum. Ils ont le pouvoir de modifier ou supprimer des messages, de verrouiller, déverrouiller, déplacer, supprimer et diviser les sujets des forums qu’ils modèrent. Généralement, les modérateurs empêchent que les utilisateurs partent en <em>hors-sujet</em> ou publient du contenu abusif ou offensant.'
	),
	array(
		0 => 'Que sont les groupes d’utilisateurs ?',
		1 => 'Les groupes permettent aux administrateurs de gérer l’accès des membres et des invités au forum et à ses fonctionnalités. Chaque membre peut appartenir à un ou plusieurs groupes et chaque groupe peut avoir ses permissions. La gestion des membres par l’intermédiaire des groupes permet aux administrateurs de modifier rapidement les permissions de plusieurs membres à la fois, telles qu’ajouter des permissions de modération ou rendre accessible un forum privé.',
	),
	array(
		0 => 'Où trouver la liste des groupes d’utilisateurs et comment les rejoindre ?',
		1 => 'Pour consulter la liste des groupes, cliquez sur le lien <em>Groupes d’utilisateurs</em> depuis votre panneau de l’utilisateur. Si vous souhaitez rejoindre un des groupes, sélectionnez le groupe désiré et cliquez sur le bouton approprié. Toutefois, tous les groupes ne sont pas en libre accès. Certains peuvent nécessiter une approbation, certains sont fermés et d’autres peuvent même être masqués. Si le groupe est dit « Ouvert », vous pouvez le rejoindre librement. Si le groupe est dit « À la demande », vous pouvez rejoindre le groupe mais votre demande nécessitera d’être approuvée par un chef de groupe. Ce dernier pourra vous demander pourquoi vous souhaitez rejoindre le groupe et ainsi décider s’il approuvera ou non votre demande. N’importunez pas le chef de groupe s’il annule votre demande, il a sûrement ses raisons.',
	),
	array(
		0 => 'Comment devenir chef de groupe ?',
		1 => 'Lorsque des groupes sont créés par l’administrateur, il leur est attribué un chef de groupe. Si vous désirez créer un groupe d’utilisateurs, contactez l’administrateur en premier lieu en lui envoyant un message privé.',
	),
	array(
		0 => 'Pourquoi certains membres apparaissent dans une couleur différente ?',
		1 => 'L’administrateur peut attribuer une couleur aux membres d’un groupe pour les rendre facilement identifiables.',
	),
	array(
		0 => 'Qu’est-ce qu’un « Groupe par défaut » ?',
		1 => 'Si vous êtes membre de plus d’un groupe, celui par défaut est utilisé pour déterminer le rang et la couleur de groupe affichés par défaut. L’administrateur peut vous permettre de changer votre groupe par défaut via votre panneau de l’utilisateur.'
	),
	array(
		0 => 'Qu’est-ce que le lien « L’équipe du forum » ?',
		1 => 'Cette page donne la liste des membres de l’équipe du forum, y compris les administrateurs et modérateurs ainsi que d’autres détails tels que les forums qu’ils modèrent.'
	),
	array(
		0 => '--',
		1 => 'Messagerie privée'
	),
	array(
		0 => 'Je ne peux pas envoyer de messages privés !',
		1 => 'Il y a trois raisons pour cela : vous n’êtes pas enregistré et/ou connecté, l’administrateur a désactivé la messagerie privée sur l’ensemble du forum, ou l’administrateur vous a empêché d’envoyer des messages. Contactez l’administrateur pour plus d’informations.'
	),
	array(
		0 => 'Je reçois sans arrêt des messages indésirables !',
		1 => 'Vous pouvez supprimer automatiquement les messages privés d’un membre en utilisant les filtres de message dans les paramètres de votre messagerie privée. Si vous recevez des messages privés abusifs d’un membre en particulier, rapportez les messages aux modérateurs. Ce dernier a la possibilité d’empêcher complètement un membre d’envoyer des messages privés.'
	),
	array(
		0 => 'J’ai reçu un spam ou un e-mail abusif d’un membre de ce forum !',
		1 => 'Le formulaire de courrier électronique du forum comprend des sécurités pour suivre les utilisateurs qui envoient de tels messages. Envoyez à l’administrateur une copie complète de l’e-mail reçu. Il est très important d’inclure les en-têtes (ils contiennent des informations sur l’expéditeur de l’e-mail). L’administrateur pourra alors prendre les mesures nécessaires.'
	),
	array(
		0 => '--',
		1 => 'Amis et ignorés'
	),
	array(
		0 => 'Que sont mes listes d’amis et d’ignorés ?',
		1 => 'Vous pouvez utiliser ces listes pour organiser les autres membres du forum. Les membres ajoutés à votre liste d’amis seront affichés dans votre panneau de l’utilisateur pour un accès rapide, voir leur état de connexion et leur envoyer des messages privés. Selon les thèmes graphiques, leurs messages peuvent être mis en valeur. Si vous ajoutez un utilisateur à votre liste d’ignorés, tous ses messages seront masqués par défaut.'
	),
	array(
		0 => 'Comment puis-je ajouter/supprimer des utilisateurs de ma liste d’amis ou d’ignorés ?',
		1 => 'Vous pouvez ajouter des utilisateurs à votre liste de deux manières. Dans le profil de chaque membre, il y a un lien pour l’ajouter dans votre liste d’amis ou d’ignorés. Ou, depuis votre panneau de l’utilisateur, vous pouvez ajouter directement des membres en saisissant leur nom d’utilisateur. Vous pouvez également supprimer des utilisateurs de votre liste depuis cette même page.'
	),
	array(
		0 => '--',
		1 => 'Recherche dans les forums'
	),
	array(
		0 => 'Comment rechercher dans les forums ?',
		1 => 'Saisissez un terme à rechercher dans la zone de recherche située en haut des pages d’index, de forums ou de sujets. La recherche avancée est accessible en cliquant sur le lien « Recherche avancée » disponible sur toutes les pages du forum. L’accès à la recherche peut dépendre des thèmes graphiques utilisés.'
	),
	array(
		0 => 'Pourquoi ma recherche ne renvoie aucun résultat ?',
		1 => 'Votre recherche est probablement trop vague ou comprend plusieurs termes courants non indexés par phpBB. Vous pouvez affiner votre recherche en utilisant les options disponibles dans la recherche avancée.',
	),
	array(
		0 => 'Pourquoi ma recherche renvoie une page blanche ?!',
		1 => 'Votre recherche renvoie plus de résultats que ne peut gérer le serveur Web. Utilisez la « Recherche avancée » et soyez plus précis dans le choix des termes utilisés et des forums concernés par la recherche.',
	),
	array(
		0 => 'Comment rechercher des membres ?',
		1 => 'Allez sur la page « Membres », cliquez sur le lien « Rechercher un membre ».',
	),
	array(
		0 => 'Comment puis-je trouver mes propres messages et sujets ?',
		1 => 'Vos messages peuvent être retrouvés en cliquant sur le lien « Voir vos messages » dans le panneau de l’utilisateur, en cliquant sur le lien « Rechercher les messages de l’utilisateur » depuis votre propre page de profil ou bien en cliquant sur le lien « Accès rapide » depuis n’importe quelle page du forum. Pour rechercher vos sujets, utilisez la page de recherche avancée et choisissez les paramètres appropriés.',
	),
	array(
		0 => '--',
		1 => 'Surveillance et favoris'
	),
	array(
		0 => 'Quelle est la différence entre les favoris et la surveillance ?',
		1 => 'Les favoris dans phpBB sont comme les favoris de votre navigateur. Vous n’êtes pas nécessairement averti des mises à jour, mais vous pouvez revenir plus tard sur le sujet. A l’inverse, la surveillance vous préviendra lorsqu’un sujet ou un forum sera mis à jour via votre choix de préférence.'
	),
	array(
		0 => 'Comment mettre en favoris ou surveiller des sujets ?',
		1 => 'Vous pouvez ajouter aux favoris ou surveiller un sujet en cliquant sur le lien approprié, souvent placé en bas du sujet de discussion.<br />Répondre à un sujet en cochant la case du formulaire « M’avertir lorsqu’une réponse est postée » vous permettra également de surveiller le sujet.',
	),
	array(
		0 => 'Comment surveiller des forums ?',
		1 => 'Pour surveiller un forum en particulier, une fois entré sur celui-ci, cliquez sur le lien « Surveiller ce forum » qui se trouve en bas de page.',
	),
	array(
		0 => 'Comment puis-je supprimer mes surveillances de sujets ?',
		1 => 'Pour supprimer vos surveillances, allez dans votre panneau de l’utilisateur (onglet <em>Aperçu --> Gestion des surveillances</em>) et suivez les instructions.'
	),
	array(
		0 => '--',
		1 => 'Fichiers joints'
	),
	array(
		0 => 'Quels fichiers joints sont autorisés sur ce forum ?',
		1 => 'L’administrateur peut autoriser ou interdire certains types de fichiers joints. Si vous n’êtes pas sûr de ce qui est autorisé à être chargé, contactez l’administrateur pour plus d’informations.'
	),
	array(
		0 => 'Comment trouver tous mes fichiers joints ?',
		1 => 'Pour accéder à la liste des fichiers que vous avez joints à vos messages et messages privés, allez dans votre panneau de l’utilisateur puis <em>Gestion des fichiers joints</em>.',
	),
	array(
		0 => '--',
		1 => 'Concernant phpBB',
	),
	array(
		0 => 'Qui a développé ce logiciel de forum ?',
		1 => 'Ce logiciel (dans sa version non modifiée) est développé et distribué par <a href="https://www.phpbb.com/">phpBB Limited</a>, qui en a les droits d’auteur. Il est publié sous la Licence Publique Générale GNU et peut être diffusé librement. Pour plus d’informations, visitez la page « <a href="https://www.phpbb.com/about/">À propos de phpBB</a> » (en anglais).',
	),
	array(
		0 => 'Pourquoi la fonctionnalité X n’est pas disponible ?',
		1 => 'Ce logiciel a été développé et mis sous licence par phpBB Limited. Si vous pensez qu’une fonctionnalité nécessite d’être ajoutée, visitez la page <a href="https://www.phpbb.com/ideas/">phpBB Ideas</a> (en anglais) où vous pouvez voter pour des idées proposées ou en suggérer de nouvelles.',
	),
	array(
		0 => 'Qui contacter pour les abus ou les questions légales concernant ce forum ?',
		1 => 'Contactez n’importe lequel des administrateurs de la liste « L’équipe du forum ». Si vous restez sans réponse alors prenez contact avec le propriétaire du domaine (en faisant une <a href="http://www.google.com/search?q=whois">recherche sur whois</a>) ou si un service gratuit est utilisé (exemple : Yahoo!, Free, f2s.com, etc.), avec le service de gestion ou des abus. Notez que phpBB Limited <strong>n’a absolument aucun contrôle</strong> et ne peut être, en aucun cas, tenu pour responsable sur <em>comment</em>, <em>où</em> ou <em>par qui</em> ce forum est utilisé. Il est inutile de contacter phpBB Limited pour toute question légale (cessions et désistements, responsabilité, propos diffamatoires, etc.) <strong>non directement liée</strong> au site Internet phpbb.com ou au logiciel phpBB lui-même. Si vous adressez un e-mail au groupe phpBB à propos de l’utilisation <strong>par une tierce partie</strong> de ce logiciel vous devez vous attendre à une réponse très courte voire à aucune réponse du tout.',
	),
);

?>