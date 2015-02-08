<?php

// autoload_classmap.php @generated by Composer

$vendorDir = dirname(dirname(__FILE__));
$baseDir = dirname($vendorDir);

return array(
    'BaseController' => $baseDir . '/lib/base_controller.php',
    'BaseModel' => $baseDir . '/lib/base_model.php',
    'DB' => $baseDir . '/lib/database.php',
    'HelloWorldController' => $baseDir . '/app/controllers/hello_word_controller.php',
    'MoveController' => $baseDir . '/app/controllers/moves_controller.php',
    'Slim\\Slim' => $vendorDir . '/Slim/Slim.php',
    'Twig_Autoloader' => $vendorDir . '/Twig/lib/Twig/Autoloader.php',
);