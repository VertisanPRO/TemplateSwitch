<?php
class TemplateSwitch_Module extends Module
{
	private $_language;
	private $_queries;


	public function __construct($language, $pages, $queries, $navigation, $cache, $endpoints)
	{
		$this->_queries = $queries;
		$this->_language = $language;
		$name = 'TemplateSwitch';
		$author = '<a href="https://tensa.co.ua" target="_blank" rel="nofollow noopener">xGIGABAITx</a>';
		$module_version = '1.0.0';
		$nameless_version = '2.0.0-pr10';
		parent::__construct($this, $name, $author, $module_version, $nameless_version);
	}

	public function onInstall()
	{
		// Initialise
		try {
			// Update main admin group permissions
			$group = $this->_queries->getWhere('groups', array('id', '=', 2));
			$group = $group[0];

			$group_permissions = json_decode($group->permissions, TRUE);
			$group_permissions['template.switch.view'] = 1;

			$group_permissions = json_encode($group_permissions);
			$this->_queries->update('groups', 2, array('permissions' => $group_permissions));
		} catch (Exception $e) {
			// Error
		}
	}

	public function onUninstall()
	{
		// Not necessary
	}

	public function onEnable()
	{
		// Check if we need to initialise again

	}

	public function onDisable()
	{
		// Not necessary
	}

	public function onPageLoad($user, $pages, $cache, $smarty, $navs, $widgets, $template)
	{

		PermissionHandler::registerPermissions('TemplateSwitch', array(
			'template.switch.view' => 'TemplateSwitch Widget permission',
		));


		if ($user->hasPermission('template.switch.view')) {
			require_once(ROOT_PATH . '/modules/TemplateSwitch/widgets/template_switch.php');
			$module_pages = $widgets->getPages('TemplateSwitch');
			$TemplateSwitch = new TemplateSwitch($module_pages, $smarty, $user, $this->_language, $this->_queries);
			$widgets->add($TemplateSwitch);
		}
	}
}
