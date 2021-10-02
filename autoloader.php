<?php
spl_autoload_register('jwr_autoloader');
function jwr_autoloader($class) {
	$namespace = 'JWR\Alea';
 
	if (strpos($class, $namespace) !== 0) {
		return;
	}
 
	$class = str_replace($namespace, '', $class);
	$class = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';
 
	$directory = get_template_directory();
    $directory = WP_PLUGIN_DIR . '/jwr-alea-crm';
    $directories = array(
        "admin",
        "API",
        "classes",
        "model"
    );
    foreach($directories as $dir){
        $path = $directory . DIRECTORY_SEPARATOR . $dir . DIRECTORY_SEPARATOR . $class;
 
        if (file_exists($path)) {
            require_once($path);
            return;
        }    
    }
}