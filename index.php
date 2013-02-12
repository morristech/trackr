<?php

/*
 * ---------------------------------------------------------------
 * APPLICATION ENVIRONMENT & SITE DOMAIN
 * ---------------------------------------------------------------
 *
 * You can load different configurations depending on your
 * current environment. Setting the environment also influences
 * things like logging and error reporting. You will also set
 * SITE_DOMAIN constant along with its values based on your
 * $config['base_url'] value. Switch case must also be changed.
 * SITE_DOMAIN must have a trailing slash:
 *
 * http://'.$_SERVER['HTTP_HOST'].'/mydirectoryhere/
 *
 * This can be set to anything, but default usage is:
 *
 *     development
 *     testing
 *     production
 *
 * NOTE: If you change these, also change the error_reporting() code below.
 *
 */

if (isset($_SERVER['HTTP_HOST']))
{
    switch ($_SERVER['HTTP_HOST'])
    {
        case 'trackr.local':
            define('ENVIRONMENT', 'development');
            define('SITE_DOMAIN', 'http://' . $_SERVER['HTTP_HOST'] . '/');
            break;
        case gethostbyname($_SERVER['HTTP_HOST']):
            define('ENVIRONMENT', 'testing');
            define('SITE_DOMAIN', 'http://' . $_SERVER['HTTP_HOST'] . '/trackr/');
            break;
        case 'pwoxi.com':
        case 'www.pwoxi.com':
            define('ENVIRONMENT', 'production');
            define('SITE_DOMAIN', 'http://' . $_SERVER['HTTP_HOST'] . '/');
            break;
        default:
            exit('The application domain is not set correctly.');
    }
}

/*
 * ---------------------------------------------------------------
 * CLI ENVIRONMENT
 * ---------------------------------------------------------------
 *
 * If script is executing from CLI then we must set the envoirment
 * as well. This can be set to anything, but default usage is:
 *
 *     development
 *     testing
 *     production
 *
 */

function is_cli_request()
{
    return (php_sapi_name() == 'cli') or defined('STDIN');
}

if (is_cli_request())
{
    if (!defined('ENVIRONMENT'))
    {
        define('ENVIRONMENT', 'development');
    }
}

/*
 * ---------------------------------------------------------------
 * Use MongoDB or MySQL
 * ---------------------------------------------------------------
 *
 * Different type of Database connection is required.
 * This should only effect our models and everything should work fine.
 * For DB based session I recommend to turn them off if you use MongoDB.
 * define('DBTYPE', 'mongo_db'); // To use MongoDB.
 * define('DBTYPE', 'db'); // To use default CI database driver.
 */
define('DBTYPE', 'db');

/*
 * ---------------------------------------------------------------
 * ERROR REPORTING
 * ---------------------------------------------------------------
 *
 * Different environments will require different levels of error reporting.
 * By default development will show errors but testing and live will hide them.
 */

if (defined('ENVIRONMENT'))
{
    switch (ENVIRONMENT)
    {
        case 'development':
            error_reporting(E_ALL);
            break;

        case 'testing':
            error_reporting(E_ALL);
            break;

        case 'production':
            error_reporting(0);
            break;

        default:
            exit('The application environment is not set correctly.');
    }
}

/*
  |---------------------------------------------------------------
  | DEFAULT PHP INI SETTINGS
  |---------------------------------------------------------------
  |
  | Hosts have a habbit of setting stupid settings for various
  | things. These settings should help provide maximum compatibility.
  |
 */

// Let's hold Windows' hand and set a include_path in case it forgot
set_include_path(dirname(__FILE__));

// Some hosts (was it GoDaddy? complained without this
@ini_set('cgi.fix_pathinfo', 0);


// PHP 5.3 will BITCH without this
if (ini_get('date.timezone') == '' || ini_get('date.timezone') == 'UTC')
{
    date_default_timezone_set('Asia/Karachi');
}

// US currency format.
setlocale(LC_MONETARY, 'en_US');

/*
 * ---------------------------------------------------------------
 * SYSTEM FOLDER NAME
 * ---------------------------------------------------------------
 *
 * This variable must contain the name of your "system" folder.
 * Include the path if the folder is not in the same  directory
 * as this file.
 *
 */
$system_path = 'system/ci';

/*
 * ---------------------------------------------------------------
 * LOG FOLDER NAME
 * ---------------------------------------------------------------
 *
 * This variable must contain the name of your "log" folder.
 * Include the path if the folder is not in the same  directory
 * as this file.
 *
 */
$log_path = 'system/log';

/*
 * ---------------------------------------------------------------
 * CACHE FOLDER NAME
 * ---------------------------------------------------------------
 *
 * This variable must contain the name of your "log" folder.
 * Include the path if the folder is not in the same  directory
 * as this file.
 *
 */
$cache_path = 'system/cache';

/*
 * ---------------------------------------------------------------
 * APPLICATION FOLDER NAME
 * ---------------------------------------------------------------
 *
 * If you want this front controller to use a different "application"
 * folder then the default one you can set its name here. The folder
 * can also be renamed or relocated anywhere on your server.  If
 * you do, use a full server path. For more info please see the user guide:
 * http://codeigniter.com/user_guide/general/managing_apps.html
 *
 * NO TRAILING SLASH!
 *
 */
$application_folder = 'application';

/*
 * --------------------------------------------------------------------
 * DEFAULT CONTROLLER
 * --------------------------------------------------------------------
 *
 * Normally you will set your default controller in the routes.php file.
 * You can, however, force a custom routing by hard-coding a
 * specific controller class/function here.  For most applications, you
 * WILL NOT set your routing here, but it's an option for those
 * special instances where you might want to override the standard
 * routing in a specific front controller that shares a common CI installation.
 *
 * IMPORTANT:  If you set the routing here, NO OTHER controller will be
 * callable. In essence, this preference limits your application to ONE
 * specific controller.  Leave the function name blank if you need
 * to call functions dynamically via the URI.
 *
 * Un-comment the $routing array below to use this feature
 *
 */
// The directory name, relative to the "controllers" folder.  Leave blank
// if your controller is not in a sub-folder within the "controllers" folder
// $routing['directory'] = '';
// The controller class file name.  Example:  Mycontroller
// $routing['controller'] = '';
// The controller function you wish to be called.
// $routing['function']	= '';


/*
 * -------------------------------------------------------------------
 *  CUSTOM CONFIG VALUES
 * -------------------------------------------------------------------
 *
 * The $assign_to_config array below will be passed dynamically to the
 * config class when initialized. This allows you to set custom config
 * items or override any default config values found in the config.php file.
 * This can be handy as it permits you to share one application between
 * multiple front controller files, with each file containing different
 * config values.
 *
 * Un-comment the $assign_to_config array below to use this feature
 *
 */
// $assign_to_config['name_of_config_item'] = 'value of config item';
// --------------------------------------------------------------------
// END OF USER CONFIGURABLE SETTINGS.  DO NOT EDIT BELOW THIS LINE
// --------------------------------------------------------------------

/*
 * ---------------------------------------------------------------
 *  Resolve the system path for increased reliability
 * ---------------------------------------------------------------
 */

// Set the current directory correctly for CLI requests
if (defined('STDIN'))
{
    chdir(dirname(__FILE__));
}

if (function_exists('realpath') AND @realpath($system_path) !== FALSE)
{
    $system_path = realpath($system_path) . '/';
}

if (function_exists('realpath') AND @realpath($log_path) !== FALSE)
{
    $log_path = realpath($log_path) . '/';
}

if (function_exists('realpath') AND @realpath($cache_path) !== FALSE)
{
    $cache_path = realpath($cache_path) . '/';
}

// ensure there's a trailing slash
$system_path = rtrim($system_path, '/') . '/';
$log_path = rtrim($log_path, '/') . '/';
$cache_path = rtrim($cache_path, '/') . '/';

// Is the system path correct?
if (!is_dir($system_path))
{
    exit("Your system folder path does not appear to be set correctly. Please open the following file and correct this: " . pathinfo(__FILE__, PATHINFO_BASENAME));
}

/*
 * -------------------------------------------------------------------
 *  Now that we know the path, set the main path constants
 * -------------------------------------------------------------------
 */
// The name of THIS file
define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));

// The PHP file extension
// this global constant is deprecated.
define('EXT', '.php');

// Path to the system folder
define('BASEPATH', str_replace("\\", "/", $system_path));

// Path to log folder
define('LOG_PATH', str_replace("\\", "/", $log_path));

// Path to cache folder
define('CACHE_PATH', str_replace("\\", "/", $cache_path));

// Path to uploaded files for this site
define('UPLOAD_PATH', 'uploads/');

// Path to the front controller (this file)
define('FCPATH', str_replace(SELF, '', __FILE__));

// Name of the "system folder"
define('SYSDIR', trim(strrchr(trim(BASEPATH, '/'), '/'), '/'));

// The path to the "application" folder
if (is_dir($application_folder))
{
    define('APPPATH', $application_folder . '/');
}
else
{
    if (!is_dir(BASEPATH . $application_folder . '/'))
    {
        exit("Your application folder path does not appear to be set correctly. Please open the following file and correct this: " . SELF);
    }

    define('APPPATH', BASEPATH . $application_folder . '/');
}


/*
 * --------------------------------------------------------------------
 * LOAD THE BOOTSTRAP FILE
 * --------------------------------------------------------------------
 *
 * And away we go...
 *
 */
require_once BASEPATH . 'core/CodeIgniter.php';

/* End of file index.php */
/* Location: ./index.php */