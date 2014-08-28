<?php
/** 
 * Configuración básica de WordPress.
 *
 * Este archivo contiene las siguientes configuraciones: ajustes de MySQL, prefijo de tablas,
 * claves secretas, idioma de WordPress y ABSPATH. Para obtener más información,
 * visita la página del Codex{@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} . Los ajustes de MySQL te los proporcionará tu proveedor de alojamiento web.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** Ajustes de MySQL. Solicita estos datos a tu proveedor de alojamiento web. ** //
/** El nombre de tu base de datos de WordPress */
define('DB_NAME', 'recambios');

/** Tu nombre de usuario de MySQL */
define('DB_USER', 'root');

/** Tu contraseña de MySQL */
define('DB_PASSWORD', 'root');

/** Host de MySQL (es muy probable que no necesites cambiarlo) */
define('DB_HOST', 'localhost');

/** Codificación de caracteres para la base de datos. */
define('DB_CHARSET', 'utf8');

/** Cotejamiento de la base de datos. No lo modifiques si tienes dudas. */
define('DB_COLLATE', '');

/**#@+
 * Claves únicas de autentificación.
 *
 * Define cada clave secreta con una frase aleatoria distinta.
 * Puedes generarlas usando el {@link https://api.wordpress.org/secret-key/1.1/salt/ servicio de claves secretas de WordPress}
 * Puedes cambiar las claves en cualquier momento para invalidar todas las cookies existentes. Esto forzará a todos los usuarios a volver a hacer login.
 *
 * @since 2.6.0
 */
define('AUTH_KEY', 'o{Rr2G;!+%Gv/<5.`*Mu4!^|a)~tREm4PL8~6.C->rL$ft?!FH8hDG32+,Wqu$Up'); // Cambia esto por tu frase aleatoria.
define('SECURE_AUTH_KEY', 'i8JZ7|iARvCuRr_w~tH1?IftA<r_ZeDAjHq 6E5j2@F`a4}t!zJ<Y+dXF}iso{x('); // Cambia esto por tu frase aleatoria.
define('LOGGED_IN_KEY', 'p@5zbuf^|:0y0;0`.fAMwZ^S{-pkklWO`D3<Kve%a9c4qI9GIH:eg#^hDvW!WRe)'); // Cambia esto por tu frase aleatoria.
define('NONCE_KEY', '/v1j0MMeyez b>,X[aE=PL2MuIbL_UC#F4,xa=sBntk6AjLxYy<NwL0`(*;xWsR('); // Cambia esto por tu frase aleatoria.
define('AUTH_SALT', 'UOB*Oa[EUh[2CwLNnD$Z*1u=ndtf0b| x0G-=~S75G|I[~ydV(_5Y+|;J`}.K^r/'); // Cambia esto por tu frase aleatoria.
define('SECURE_AUTH_SALT', 'SHhS)fV&Aj}hUg}!E];l|r;eL +9_S`AY**uEFP:,6F5-d^bZi(rQQ-?+O)%o?5%'); // Cambia esto por tu frase aleatoria.
define('LOGGED_IN_SALT', 'mWFyZA+qIeYtKMCBb_~F#a!:H)g6HkK?6EUab##FCz*G`<N`Q~(GffmG=%V;(hT?'); // Cambia esto por tu frase aleatoria.
define('NONCE_SALT', '%MnHy5]*_ll>o3ys-Gt-6}QmU?nxZR r:w+0GoKOjI`y{3G9g0lk<pkS[g$1;xN*'); // Cambia esto por tu frase aleatoria.

/**#@-*/

/**
 * Prefijo de la base de datos de WordPress.
 *
 * Cambia el prefijo si deseas instalar multiples blogs en una sola base de datos.
 * Emplea solo números, letras y guión bajo.
 */
$table_prefix  = 'wp_';

/**
 * Idioma de WordPress.
 *
 * Cambia lo siguiente para tener WordPress en tu idioma. El correspondiente archivo MO
 * del lenguaje elegido debe encontrarse en wp-content/languages.
 * Por ejemplo, instala ca_ES.mo copiándolo a wp-content/languages y define WPLANG como 'ca_ES'
 * para traducir WordPress al catalán.
 */
define('WPLANG', 'es_ES');

/**
 * Para desarrolladores: modo debug de WordPress.
 *
 * Cambia esto a true para activar la muestra de avisos durante el desarrollo.
 * Se recomienda encarecidamente a los desarrolladores de temas y plugins que usen WP_DEBUG
 * en sus entornos de desarrollo.
 */
define('WP_DEBUG', false);

/* ¡Eso es todo, deja de editar! Feliz blogging */

/** WordPress absolute path to the Wordpress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

