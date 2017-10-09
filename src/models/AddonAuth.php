<?php
namespace phpkit\auth\models;

class AddonAuth extends \phpkit\base\BaseModel {
	protected $GroupName;
	protected $GroupList;
	public function initialize($db = '') {
		parent::initialize();
	}

	//所有权限
	public function getAuthList() {
		$lists = $this->select()->toArray();
		$groupList = array();
		$this->GroupList = $this->getGroupList();
		foreach ($this->GroupList as $key => $value) {
			$groupList[$value['Id']] = $value;
		}
		foreach ($lists as $key => $value) {
			$groupList[$value['GroupId']]['scat'][] = $value;
		}
		return $groupList;
	}

	public function getGroupName() {
		$model = new AddonAuthGroup();
		$res = $model->load($this->GroupId);
		return $res->Title;
	}

	public function getGroupList() {
		$model = new AddonAuthGroup();
		$res = $model->select();
		return $res->toArray();
	}

}
