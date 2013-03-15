<?php

/**
 * This file is loaded automatically by the app/webroot/index.php file after core.php
 *
 * This file should load/create any application wide configuration settings, such as 
 * Caching, Logging, loading additional configuration files.
 *
 * You should also use this file to include any files that provide global functions/constants
 * that your application uses.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.10.8.2117
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Cache Engine Configuration
 * Default settings provided below
 *
 * File storage engine.
 *
 * 	 Cache::config('default', array(
 * 		'engine' => 'File', //[required]
 * 		'duration'=> 3600, //[optional]
 * 		'probability'=> 100, //[optional]
 * 		'path' => CACHE, //[optional] use system tmp directory - remember to use absolute path
 * 		'prefix' => 'cake_', //[optional]  prefix every cache file with this string
 * 		'lock' => false, //[optional]  use file locking
 * 		'serialize' => true, // [optional]
 * 		'mask' => 0666, // [optional] permission mask to use when creating cache files
 * 	));
 *
 * APC (http://pecl.php.net/package/APC)
 *
 * 	 Cache::config('default', array(
 * 		'engine' => 'Apc', //[required]
 * 		'duration'=> 3600, //[optional]
 * 		'probability'=> 100, //[optional]
 * 		'prefix' => Inflector::slug(APP_DIR) . '_', //[optional]  prefix every cache file with this string
 * 	));
 *
 * Xcache (http://xcache.lighttpd.net/)
 *
 * 	 Cache::config('default', array(
 * 		'engine' => 'Xcache', //[required]
 * 		'duration'=> 3600, //[optional]
 * 		'probability'=> 100, //[optional]
 * 		'prefix' => Inflector::slug(APP_DIR) . '_', //[optional] prefix every cache file with this string
 * 		'user' => 'user', //user from xcache.admin.user settings
 * 		'password' => 'password', //plaintext password (xcache.admin.pass)
 * 	));
 *
 * Memcache (http://memcached.org/)
 *
 * 	 Cache::config('default', array(
 * 		'engine' => 'Memcache', //[required]
 * 		'duration'=> 3600, //[optional]
 * 		'probability'=> 100, //[optional]
 * 		'prefix' => Inflector::slug(APP_DIR) . '_', //[optional]  prefix every cache file with this string
 * 		'servers' => array(
 * 			'127.0.0.1:11211' // localhost, default port 11211
 * 		), //[optional]
 * 		'persistent' => true, // [optional] set this to false for non-persistent connections
 * 		'compress' => false, // [optional] compress data in Memcache (slower, but uses less memory)
 * 	));
 *
 *  Wincache (http://php.net/wincache)
 *
 * 	 Cache::config('default', array(
 * 		'engine' => 'Wincache', //[required]
 * 		'duration'=> 3600, //[optional]
 * 		'probability'=> 100, //[optional]
 * 		'prefix' => Inflector::slug(APP_DIR) . '_', //[optional]  prefix every cache file with this string
 * 	));
 *
 * Redis (http://http://redis.io/)
 *
 * 	 Cache::config('default', array(
 * 		'engine' => 'Redis', //[required]
 * 		'duration'=> 3600, //[optional]
 * 		'probability'=> 100, //[optional]
 * 		'prefix' => Inflector::slug(APP_DIR) . '_', //[optional]  prefix every cache file with this string
 * 		'server' => '127.0.0.1' // localhost
 * 		'port' => 6379 // default port 6379
 * 		'timeout' => 0 // timeout in seconds, 0 = unlimited
 * 		'persistent' => true, // [optional] set this to false for non-persistent connections
 * 	));
 */
Cache::config('default', array('engine' => 'File'));

/**
 * The settings below can be used to set additional paths to models, views and controllers.
 *
 * App::build(array(
 *     'Model'                     => array('/path/to/models', '/next/path/to/models'),
 *     'Model/Behavior'            => array('/path/to/behaviors', '/next/path/to/behaviors'),
 *     'Model/Datasource'          => array('/path/to/datasources', '/next/path/to/datasources'),
 *     'Model/Datasource/Database' => array('/path/to/databases', '/next/path/to/database'),
 *     'Model/Datasource/Session'  => array('/path/to/sessions', '/next/path/to/sessions'),
 *     'Controller'                => array('/path/to/controllers', '/next/path/to/controllers'),
 *     'Controller/Component'      => array('/path/to/components', '/next/path/to/components'),
 *     'Controller/Component/Auth' => array('/path/to/auths', '/next/path/to/auths'),
 *     'Controller/Component/Acl'  => array('/path/to/acls', '/next/path/to/acls'),
 *     'View'                      => array('/path/to/views', '/next/path/to/views'),
 *     'View/Helper'               => array('/path/to/helpers', '/next/path/to/helpers'),
 *     'Console'                   => array('/path/to/consoles', '/next/path/to/consoles'),
 *     'Console/Command'           => array('/path/to/commands', '/next/path/to/commands'),
 *     'Console/Command/Task'      => array('/path/to/tasks', '/next/path/to/tasks'),
 *     'Lib'                       => array('/path/to/libs', '/next/path/to/libs'),
 *     'Locale'                    => array('/path/to/locales', '/next/path/to/locales'),
 *     'Vendor'                    => array('/path/to/vendors', '/next/path/to/vendors'),
 *     'Plugin'                    => array('/path/to/plugins', '/next/path/to/plugins'),
 * ));
 *
 */
/**
 * Custom Inflector rules, can be set to correctly pluralize or singularize table, model, controller names or whatever other
 * string is passed to the inflection functions
 *
 * Inflector::rules('singular', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 * Inflector::rules('plural', array('rules' => array(), 'irregular' => array(), 'uninflected' => array()));
 *
 */
/**
 * Plugins need to be loaded manually, you can either load them one by one or all of them in a single call
 * Uncomment one of the lines below, as you need. make sure you read the documentation on CakePlugin to use more
 * advanced ways of loading plugins
 *
 * CakePlugin::loadAll(); // Loads all plugins at once
 * CakePlugin::load('DebugKit'); //Loads a single plugin named DebugKit
 *
 */
/**
 * Your application configuration starts here
 */
$baseUrl = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'hub.gdglagos.com';
Configure::write(
        'Application', array(
    'name' => '&#8747; dev',
    'safe_name' => '∫ dev',
    'from_email' => 'hub@gdglagos.com',
    'contact_mail' => 'hub@gdglagos.com',
    'base_url' => "http://" . $baseUrl,
    'gplus_page_id' => '112227844855698647164'
        )
);

/**
 * Choose your application theme
 * The list of supported themes are:
 * 	-> default
 * 	-> amelia
 * 	-> cerulean
 * 	-> cyborg
 * 	-> journal
 * 	-> readable
 * 	-> simplex
 * 	-> slate
 * 	-> spacelab
 * 	-> spruce
 * 	-> superhero
 * 	-> united
 */
Configure::write(
        'Layout', array(
    'theme' => 'default'
        )
);


App::uses('CakeEmail', 'Network/Email');

/**
 * You can attach event listeners to the request lifecyle as Dispatcher Filter . By Default CakePHP bundles two filters:
 *
 * - AssetDispatcher filter will serve your asset files (css, images, js, etc) from your themes and plugins
 * - CacheDispatcher filter will read the Cache.check configure variable and try to serve cached content generated from controllers
 *
 * Feel free to remove or add filters as you see fit for your application. A few examples:
 *
 * Configure::write('Dispatcher.filters', array(
 * 		'MyCacheFilter', //  will use MyCacheFilter class from the Routing/Filter package in your app.
 * 		'MyPlugin.MyFilter', // will use MyFilter class from the Routing/Filter package in MyPlugin plugin.
 * 		array('callable' => $aFunction, 'on' => 'before', 'priority' => 9), // A valid PHP callback type to be called on beforeDispatch
 * 		array('callable' => $anotherMethod, 'on' => 'after'), // A valid PHP callback type to be called on afterDispatch
 *
 * ));
 */
Configure::write('Dispatcher.filters', array(
    'AssetDispatcher',
    'CacheDispatcher'
));

/**
 * Configures default file logging options
 */
App::uses('CakeLog', 'Log');
CakeLog::config('debug', array(
    'engine' => 'FileLog',
    'types' => array('notice', 'info', 'debug'),
    'file' => 'debug',
));
CakeLog::config('error', array(
    'engine' => 'FileLog',
    'types' => array('warning', 'error', 'critical', 'alert', 'emergency'),
    'file' => 'error',
));

CakePlugin::load('Opauth', array('routes' => true, 'bootstrap' => true));

$appUrl = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
if (stripos($appUrl, 'auth') !== false) {
        $pos = stripos($appUrl, 'auth') + 5;
        $appUrl = substr($appUrl, 0, $pos);
}

Configure::write('Opauth.path', $appUrl);

Configure::write('Opauth.Strategy.Facebook', array(
    'app_id' => '141716812655517',
    'app_secret' => 'f6dea36626b6cc634745a8795a013271',
    'scope' => 'email'
));

if (isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] == 'localhost') {
        Configure::write('Opauth.Strategy.Google', array(
            'client_id' => '354523643987-lu90ptpblkudmnb7068a32gfqdov2pkr.apps.googleusercontent.com',
            'client_secret' => 'XH6MWuAiORO15EFHbJlp8foh'
        ));
} else {
        Configure::write('Opauth.Strategy.Google', array(
            'client_id' => '354523643987.apps.googleusercontent.com',
            'client_secret' => 'bcFKod_vgjuA4F_AiZlplaIy'
        ));
}

Configure::write('Opauth.Strategy.LinkedIn', array(
    'api_key' => 'zvlq5i0xpc72',
    'secret_key' => 'UbVrfWCPpuIK3dCz'
));

Configure::write('Opauth.Strategy.Twitter', array(
    'key' => 'gNPRuxWB7Tg8DhuoZBuQ',
    'secret' => 'p7xZPFcUk29OvwZyUAFRuNnNlHPNMpcT4SCqknsDiA'
));



Configure::write('syntaxHighlighter',
array(
          'tag'=>'srccode',
          'supportedTypes'=>  array( 
          'as3' => 'ActionScript3',
            'bash' => 'Bash/shell',
            'cf' => 'ColdFusion',
            'c-sharp' => 'C#',
            'cpp' => 'C++',
            'css' => 'CSS',
            'delphi' => 'Delphi',
            'diff' => 'Diff',
            'erl' => 'Erlang',
            'groovy' => 'Groovy',
            'xml'=>'HTML',
            'js' => 'JavaScript',
            'java' => 'Java',
            'jfx' => 'JavaFX',
            'perl' => 'Perl',
            'php' => 'PHP',
            'text' => 'Plain',
            'ps' => 'PowerShell',
            'py' => 'Python',
            'rails' => 'Ruby',
            'scala' => 'Scala',
            'sql' => 'SQL',
            'basic' => 'Visual',
            'xml' => 'XML',
            'text' => 'Other',
      )
      )
);

Configure::write('Application.MailConfig',array(
    'enabled'=>true,
    'limit_per_run'=>120,
    
));

Configure::write('Application.upload.abs_profile_photos',APP.'webroot'.DS.'uploads'.DS.'profiles');
Configure::write('Application.upload.url_profile_photos','/uploads/profiles/');

Configure::write('Application.upload.abs_projects',APP.'webroot'.DS.'uploads'.DS.'projects');
Configure::write('Application.upload.url_projects','/uploads/projects/');
Configure::write('Application.upload.max_project_photos',4);
Configure::write('Application.upload.max_projects',25);
    
//CakePlugin::load('DebugKit');
/**
 * Shortcut to Configure::read function
 * @param string $key
 * @return mixed
 */
function cRead($key) {

        return Configure::read($key);
}
