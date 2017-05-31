<?php
namespace phpkit\auth\models;

class AddonAuth extends \phpkit\core\BaseModel {
 
	public function initialize() {
		parent::initialize();
	}

	public function columnList(){
		 'Id'=>'Id',
		 'Title'=>'权限组名',
		 'Cate'=>'类型',
	}

}
