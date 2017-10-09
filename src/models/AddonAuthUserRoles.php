<?php
namespace phpkit\auth\models;
class AddonAuthUserRoles extends \phpkit\base\BaseModel {
	protected $AuthIds;
	public function initialize() {
		parent::initialize();
	}

	public function setAuthIds($AuthIds = array()) {
		$this->AuthIds = is_array($AuthIds) ? implode(",", $AuthIds) : $AuthIds;
	}

	public function getAuthIds() {
		return explode(",", trim($this->AuthIds, ","));
	}

}
