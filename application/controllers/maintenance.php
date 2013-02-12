<?php

/*
  |--------------------------------------------------------------------------
  | Maintenance Section
  |--------------------------------------------------------------------------
  |
  | Following functions must be called by CLI, if tried to run from browser
  | they will throw 404 error.
  |
  |	Must include PHP_EOL; after every print or echo.
  |
  | Must be checked with $this->input->is_cli_request () if they are from CLI.
  |
  | Must be executed from root of the site, where index.php is located.
  | eg: php index.php maintenance clean_cache
 */
class Maintenance extends CI_Controller
{

    function __construct ()
    {
        parent::__construct();
    }

    // Netbean auto complete and generate classes references.
    function fix_netbeans ()
    {
        $sys_lib = BASEPATH . '/libraries';
        $app_lib = APPPATH . '/libraries';
        $app_model = APPPATH . '/models';

        $sys_core = BASEPATH . '/core';

        echo "&lt;?php<br><br>";
        echo "/**<br/>";
        echo '* @property CI_DB_active_record $db<br/>';
        echo '* @property CI_DB_forge $dbforge<br/>';

        if ($handle = opendir($sys_lib))
        {
            /* This is the correct way to loop over the directory. */
            while (false !== ($file = readdir($handle)))
            {
                if ($file[0] == '.')
                    continue;
                $files = explode('.', $file);
                $file = $files[0];
                $file2 = $file;
                if ($file == 'index')
                    continue;
                if ($file == 'Loader')
                    $file2 = 'load';
                echo "* @property CI_" . $file . " $" . strtolower($file2) . "<br/>";
            }
            closedir($handle);
        }
        if ($handle = opendir($app_lib))
        {
            /* This is the correct way to loop over the directory. */
            while (false !== ($file = readdir($handle)))
            {
                if ($file[0] == '.')
                    continue;
                $files = explode('.', $file);
                $file = $files[0];
                $file_parts = explode('_', $file);
                $first_part = $file_parts[0];
                if ($first_part == 'index' || $first_part == 'MY')
                    continue;
                if (count($file_parts) > 1)
                {
                    $last_part = $file_parts[1];
                    echo "* @property " . ucfirst($first_part) . "_" . ucfirst($last_part) . " $" . strtolower($first_part) . "_" . strtolower($last_part) . "<br/>";
                }
                else
                {
                    echo "* @property " . ucfirst($first_part) . " $" . strtolower($first_part) . "<br/>";
                }
            }
            closedir($handle);
        }

        // core
        if ($handle = opendir($sys_core))
        {
            /* This is the correct way to loop over the directory. */
            while (false !== ($file = readdir($handle)))
            {
                if ($file[0] == '.')
                    continue;
                $files = explode('.', $file);
                $file = $files[0];
                $file2 = $file;
                if ($file == 'index')
                    continue;
                if ($file == 'Loader')
                    $file2 = 'load';
                echo "* @property CI_" . $file . " $" . strtolower($file2) . "<br/>";
            }
            closedir($handle);
        }

        if ($handle = opendir($app_model))
        {
            /* This is the correct way to loop over the directory. */
            while (false !== ($file = readdir($handle)))
            {
                if ($file[0] == '.')
                    continue;
                $files = explode('.', $file);
                $file = $files[0];
                if ($file == 'index')
                    continue;
                $file_parts = explode('_', $file);
                $first_part = $file_parts[0];
                $last_part = $file_parts[1];
                echo "* @property " . ucfirst($first_part) . "_" . ucfirst($last_part) . " $" . strtolower($first_part) . "_" . strtolower($last_part) . "<br/>";
            }
            closedir($handle);
        }

        echo "*/<br><br>";
        echo "class CI_Controller {}<br><br>";
        echo "?>";
    }

}
