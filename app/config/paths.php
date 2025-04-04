<?php
// app/config/paths.php

// المسار الجذري للمشروع (مستوى المجلد الرئيسي)
define('ROOT_DIR', realpath(__DIR__ . '/../..')); 

// مسارات الملفات الأساسية
define('APP_DIR', ROOT_DIR . '/app');
define('MODELS_DIR', APP_DIR . '/models');
define('CONTROLLERS_DIR', APP_DIR . '/controllers');
?>