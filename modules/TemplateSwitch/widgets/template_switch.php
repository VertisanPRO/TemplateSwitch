<?php

class TemplateSwitch extends WidgetBase
{
	public function __construct($pages = array(), $smarty, $user, $language, $queries)
	{
		parent::__construct($pages);
		$this->_smarty = $smarty;
		$this->_queries = $queries;
		$this->_language = $language;

		$this->_user = $user;
		// Get order
		$order = DB::getInstance()->query('SELECT `location`, `order` FROM nl2_widgets WHERE `name` = ?', array('TemplateSwitch'))->first();

		// Set widget variables
		$this->_module = 'TemplateSwitch';
		$this->_name = 'TemplateSwitch';
		$this->_location = isset($order->location) ? $order->location : null;
		$this->_description = 'TemplateSwitch Widget';
		$this->_order = $order->order;
	}
	public function initialise()
	{
		if ($this->_user->isLoggedIn()) {

			$user_query = $this->_user->data();

			$templates = array();
			$templates_query = $this->_queries->getWhere('templates', array('enabled', '=', 1));

			foreach ($templates_query as $item) {
				$templates[] = array(
					'id' => Output::getClean($item->id),
					'name' => Output::getClean($item->name),
				);
			}


			if (isset($_POST['new_template'])) {
				$new_template = (int) $_POST['new_template'];
				$this->_queries->update('users', $user_query->id, array(
					'theme_id' => $new_template
				));
				Redirect::to(URL::build('/'));
				die();
			}
		}

		$this->_smarty->assign(array(
			'TEMPLATES_DATA' => $templates,
			'TEMPLATES_ACTIVE' => $user_query->theme_id,
			'TEMPLATES_HEAD' => $this->_language->get('admin', 'templates'),
			'SUBMIT' => $this->_language->get('general', 'submit')
		));

		$this->_content = $this->_smarty->fetch('TemplateSwitch/template_switch.tpl');
	}
}
