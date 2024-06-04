<?php

/**
 * @file
 * Drupal settings, for docs see:
 * @see https://api.drupal.org/api/drupal/sites!default!default.settings.php/11
 *
 * @codingStandardsIgnoreFile
 */

$databases = [];
$settings['hash_salt'] = 'n/a'; // Overridden on Platform.sh
$settings['update_free_access'] = FALSE;
$settings['rebuild_access'] = FALSE;
$settings['file_scan_ignore_directories'] = ['node_modules', 'bower_components',];
$settings['entity_update_batch_size'] = 50;
$settings['entity_update_backup'] = TRUE;
$settings['config_sync_directory'] = '../config/sync';
$settings['skip_permissions_hardening'] = TRUE; // @see fs_requirements_alter().
$settings['trusted_host_patterns'] = ['.*']; // Best practice for Platform.sh.
$settings['file_public_path'] = 'sites/default/files';
$settings['file_private_path'] = 'sites/default/files/private';
$settings['file_temp_path'] = '/tmp';
$settings['container_yamls'][] = DRUPAL_ROOT . '/sites/default/services.yml';

// This setup in just DDEV.
$databases['default']['default'] = [
  'driver' => 'mysql',
  'database' => 'db',
  'username' => 'db',
  'password' => 'db',
  'host' => 'db',
  'port' => 3306,
];

$settings['twig_debug'] = FALSE;
$config['system.performance']['css']['preprocess'] = FALSE;
$config['system.performance']['js']['preprocess'] = FALSE;

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
// $config['system.logging']['error_level'] = ERROR_REPORTING_DISPLAY_SOME;
$config['system.logging']['error_level'] = ERROR_REPORTING_DISPLAY_VERBOSE;

// Beware of xdebug slowness.
// $settings['cache']['bins']['render'] = 'cache.backend.null';
// $settings['cache']['bins']['dynamic_page_cache'] = 'cache.backend.null';
// $settings['cache']['bins']['page'] = 'cache.backend.null';
// $settings['cache']['bins']['discovery'] = 'cache.backend.null';
// $settings['cache']['bins']['container'] = 'cache.backend.null';
// $settings['cache']['bins']['bootstrap'] = 'cache.backend.null';

if (file_exists("/mnt/ddev_config/xhgui/collector/xhgui.collector.php")) {
  require_once "/mnt/ddev_config/xhgui/collector/xhgui.collector.php";
}

// Not in git and knock yourself out.
if (file_exists($app_root . '/' . $site_path . '/local.settings.php')) {
  include_once $app_root . '/' . $site_path . '/local.settings.php';
}
