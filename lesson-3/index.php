<?php

require 'vendor/autoload.php';

require 'helpers.php';
require 'routes.php';

Router::resolve($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
