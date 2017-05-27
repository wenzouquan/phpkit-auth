<?php
namespace phpkit\auth;
use phpkit\core\Phpkit;

class Auth extends Base {
	/**
	 * 权限限制
	 * @return
	 */
	public function check($user_id, $authcode) {
		header("Content-type: text/html; charset=utf-8");
		$addon_auth = Phpkit::BaseModel("addon_auth");
		$addon_auth->Title = '测试4';
		$addon_auth->Id = 4492;
		//$addon_auth->Authcode = 'er';
		//$addon_auth->GroupId = '2';
		if ($addon_auth->create() == false) {
			echo "Umh, We can't store robots right now: \n";
			foreach ($addon_auth->getMessages() as $message) {
				echo $message, "\n";
			}
		} else {
			echo "Great, a new robot was saved successfully!";
		}
		//$res1 = $addon_auth->load(array('conditions' => "Id = ?1", 'bind' => array('1' => 236), 'order' => 'Id'));

		// $res2 = $addon_auth->load(23);
		//var_dump($res1->toArray());
		//var_dump($res1->Id);
		// $addon_auth_access = Phpkit::BaseModel("addon_auth_access");
		// // var_dump($addon_auth_access);
		// $res2 = $addon_auth_access->load(131);
		// // $res2 = $addon_auth_access->load(array(
		// // 	"conditions" => "AdminId = ?1",
		// // 	"bind" => array(1 => 131),
		// // 	//'order' => 'Id desc',
		// // ));
		// // var_dump($res2->AdminId);
		exit();
		$AddonAuth = new models\AddonAuth();
		$res = $AddonAuth->load(array(
			"conditions" => "Id = ?1",
			"bind" => array(1 => 244),
			'order' => 'Id desc',
		));
		// var_dump($res->Id);
		// foreach ($res as $key => $value) {
		// 	var_dump($value->Id);
		// }
		//var_dump($auths->IsShow2);
		// $res = $AddonAuth::find(array(
		// 	"id = '244'",
		// 	"order" => "id",
		// ));
		var_dump($res->Id);
		exit();
		// Render a view and return its contents as a string
		//$this->view->setVar("username", 'wen');
		// $this->view->setVars(
		// 	[
		// 		"username" => 'wen',
		// 	]
		// );
		//添加本地css资源
		$this->assets
			->addCss('css/style.css')
			->addCss('css/style2.css');
		//添加本地js资源
		$this->assets
			->addJs('js/jquery.js')
			->addJs('js/bootstrap.min.js');
		$this->view->outputCss = $this->assets->outputCss();
		$this->view->outputJs = $this->assets->outputJs();
		$this->view->username = 'wen';
		//	echo $this->view->render("welcomeMail");

		//var_dump($this->App->db->fetchAll($sql));
		exit();
		$where = "authcode in ('$authcode1','$authcode2','$authcode3')";
		$r = BoxModel("addon_auth")->where($where)->select();
		if (!$r) {
			return;
		}
		$admin_id = session("admin_id");
		$auths = BoxModel("addon_auth_access")->where("admin_id='$admin_id'")->find();
		$access = explode(",", $auths['access']);
		$falg = 1;
		foreach ($r as $one) {
			if (in_array($one['id'], $access)) {
				$falg = $falg * 0;
			}
		}
		if ($falg == 1) {
			return false;
		} else {
			return true;
		}
	}

}
