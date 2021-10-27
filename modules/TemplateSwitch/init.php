<?php
/*
 *  TemplateSwitch By xGIGABAITx
 */

// Initialise module
require_once(ROOT_PATH . '/modules/TemplateSwitch/module.php');
$module = new TemplateSwitch_Module($language, $pages, $queries, $navigation, $cache, $endpoints);
