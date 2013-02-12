<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
/*
  |--------------------------------------------------------------------------
  | AJAX request header helper
  |--------------------------------------------------------------------------
  |
  | This will be used to dermine if request is AJAX (xmlhttprequest)
  | or regular browser request.
  |
 */
define('IS_AJAX', isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest');

/*
  |--------------------------------------------------------------------------
  | Application Version Verfication
  |--------------------------------------------------------------------------
  |
  | This will be used to dermine the version of website.
  |
 */
define('SITE_VERSION', '1.0');

/*
  |--------------------------------------------------------------------------
  | Website Infornation
  |--------------------------------------------------------------------------
  |
  | General site variables for configration and settings.
  |
 */
$config['site_name'] = "Trackr";
$config['site_email'] = "web@trackr.local";
$config['site_version'] = SITE_VERSION;
