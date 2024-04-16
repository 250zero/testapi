<?php
function auto_loader($className) { 

    $baseNamespace = 'App\\';
    $baseDir = __DIR__ . '/App/';

    $len = strlen($baseNamespace);
    if (strncmp($baseNamespace, $className, $len) !== 0) {
        return;
    }

    $relativeClass = substr($className, $len);

    $file = $baseDir . str_replace('\\', '/', $relativeClass) . '.php';

    if (file_exists($file)) {
        require $file;
    }
}
spl_autoload_register('auto_loader');
?>
