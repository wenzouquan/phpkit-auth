<?php
namespace phpkit\auth\models;

class AddonAuth extends \phpkit\core\BaseModel {
	protected $is_show;
	public function getIsShow() {
		return "is_show:" . $this->is_show;
	}
	// public function columnMap() {
	// 	//Keys are the real names in the table and
	// 	//the values their names in the application
	// 	return array(
	// 		'is_show' => 'IsShow',
	// 		'id' => 'Id',
	// 		'title'
	// 	);
	// }
	// public function getSource() {
	// 	return "addon_auth_access";
	// }
	// public function getSchema() {
	// 	return "phpkit";
	// }
	public function initialize() {
		parent::initialize();
	}
}
