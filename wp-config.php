<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Le script de création wp-config.php utilise ce fichier lors de l'installation.
 * Vous n'avez pas à utiliser l'interface web, vous pouvez directement
 * renommer ce fichier en "wp-config.php" et remplir les variables à la main.
 * 
 * Ce fichier contient les configurations suivantes :
 * 
 * * réglages MySQL ;
 * * clefs secrètes ;
 * * préfixe de tables de la base de données ;
 * * ABSPATH.
 * 
 * @link https://codex.wordpress.org/Editing_wp-config.php 
 * 
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'wordpress-projet-hetic');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'root');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', '');

/** Adresse de l'hébergement MySQL. */
define('DB_HOST', 'localhost');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8mb4');

/** Type de collation de la base de données. 
  * N'y touchez que si vous savez ce que vous faites. 
  */
define('DB_COLLATE', '');

/**#@+
 * Clefs uniques d'authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant 
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n'importe quel moment, afin d'invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '@V)M9H|%(- 03g,HHq{W<Q6zp?OoSoxBoK-xQkkk[(H-i-~1;==uMG.|_pL;>ctF');
define('SECURE_AUTH_KEY',  'b DQ;O^@J7O/Ex|G_z T(`scK+o}X?W%)EBO2jT>d[se^pL`-K=rvN*?Qw*6;xLb');
define('LOGGED_IN_KEY',    'o8*5AT+lk|rh25^ -yV6q.#Hn_}6#]7Sg1&O;ZzSdOMO/By@+fNa% 5hf)*W(/Bu');
define('NONCE_KEY',        '_2F,^sySIgb|@|0?3tDa=o+US&%/=*Z}IR[9$5M]^zUJ!obj|@XOPar`74+#>LR;');
define('AUTH_SALT',        'vu(Oh%,c<}(z9W]YqCfjbK)V0(^AV6K7KbXdp@gcKh/9W@.?tZ:5C<>d3A6%`)2h');
define('SECURE_AUTH_SALT', 'q4Dy^F9fQ]r<9-&-&kY()EgR^T{Fq~i|wN3y>!|Tu2WePY[Axl39]I>d|Re&;sg8');
define('LOGGED_IN_SALT',   'tSPPI_g)eRMBhH_4NV!6m:9(n/klx@XfoCT>v-JJn8@<P?3=zMtWyMT>]B^/JFkt');
define('NONCE_SALT',       'MA6ld#Zz>Jg~s?;K;hzdU/YM`&M-(wx=u#cC>U7)bCt`EI3^Vjl>OVa/Y%KpN@{f');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique. 
 * N'utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés!
 */
$table_prefix  = 'wp_';

/** 
 * Pour les développeurs : le mode déboguage de WordPress.
 * 
 * En passant la valeur suivante à "true", vous activez l'affichage des
 * notifications d'erreurs pendant votre essais.
 * Il est fortemment recommandé que les développeurs d'extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de 
 * développement.
 * 
 * Pour obtenir plus d'information sur les constantes 
 * qui peuvent être utilisée pour le déboguage, consultez le Codex.
 * 
 * @link https://codex.wordpress.org/Debugging_in_WordPress 
 */ 
define('WP_DEBUG', true); 

/* C'est tout, ne touchez pas à ce qui suit ! Bon blogging ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');