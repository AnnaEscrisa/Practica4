<?php


spl_autoload_register(function ($class) {
    $prefix = 'OAuth2';
    $base_dir = __DIR__;
    
    // Remove the prefix
    $len = strlen($prefix);
    if (strncmp($prefix, $class, $len) !== 0) {
        return;
    }
    
    // Replace namespace separators with directory separators
    $relative_class = substr($class, $len);
    $file = $base_dir . str_replace('\\', '/', $relative_class) . '.php';
    
    if (file_exists($file)) {
        require $file;
    }
});

?>