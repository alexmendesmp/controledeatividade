<?php

define( 'MODEL_DIRECTORY', dirname( __FILE__ ) . '/src/Models' );
define( 'CONTROLLER_DIRECTORY', dirname( __FILE__ ) . '/src/Controllers' );
define( 'VIEW_DIRECTORY', dirname( __FILE__ ) . '/src/Views' );
define( 'CONFIG_DIRECTORY', dirname( __FILE__ ) . '/src/config' );

require 'vendor/autoload.php';
require 'src/Ams/Core/Init.php';
require 'src/Ams/Core/Lib/DbConnection.php';

new Init();