<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clés secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C’est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d’installation. Vous n’avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define( 'DB_NAME', 'wordpress' );

/** Utilisateur de la base de données MySQL. */
define( 'DB_USER', 'root' );

/** Mot de passe de la base de données MySQL. */
define( 'DB_PASSWORD', '1234' );

/** Adresse de l’hébergement MySQL. */
define( 'DB_HOST', 'localhost' );

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Type de collation de la base de données.
  * N’y touchez que si vous savez ce que vous faites.
  */
define('DB_COLLATE', '');

/**#@+
 * Clés uniques d’authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n’importe quel moment, afin d’invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'W+T-c#efC`#<)qYzcbg[~y88,) Rsn-qM&o;y8kz( >hadU<L7D<HwJEU.:j(nuy' );
define( 'SECURE_AUTH_KEY',  'v[{z</@JTeGSah@yECD;)H10Au1;K2LBoNBMJx>Pr{UB&-jQUNf!l-M3vR8|^drg' );
define( 'LOGGED_IN_KEY',    '!_B]byUIsJPK=?(Bgw,TbmIZ]3>iH{.b3fs,dwKZN@r}4,8{|0Ug(f_J?wp<bLcL' );
define( 'NONCE_KEY',        '<{r?)Gaa6}<i_)~?q(GhDf|1v+.ri8|Y!|CI#(.gnz;_v|CbS|G5rCOO#!e0acdk' );
define( 'AUTH_SALT',        '-v@w$,.sesge38CY(H[(8 +{baZS.0}(mI7k:DL[$9[Pa!)%He5y,M<DsW~moecl' );
define( 'SECURE_AUTH_SALT', 'B^--`Lg?/J{PX+P>}hDl~`Hd?@hlx0XOxIQ%130twIMjjIVeO7x0d5$h|67PqZmg' );
define( 'LOGGED_IN_SALT',   '<X%p=n`Q>aF_6U7/wASk>vFax*1^MxIm[BhSnps9NP;HBk&C6`fe1I[z8!Zv{.E^' );
define( 'NONCE_SALT',       '6moW%QxE?PYm%4,zssA0,X5u>?z3G}~[d]]6LhJi vI.m+u+GTc=WPZ9_uV$,fV$' );
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique.
 * N’utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés !
 */
$table_prefix = 'wp_';

/**
 * Pour les développeurs : le mode déboguage de WordPress.
 *
 * En passant la valeur suivante à "true", vous activez l’affichage des
 * notifications d’erreurs pendant vos essais.
 * Il est fortemment recommandé que les développeurs d’extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de
 * développement.
 *
 * Pour plus d’information sur les autres constantes qui peuvent être utilisées
 * pour le déboguage, rendez-vous sur le Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* C’est tout, ne touchez pas à ce qui suit ! Bonne publication. */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');
