<?php
namespace phpkit\auth;
use phpkit\core\Phpkit;

class Auth extends Base {
	/**
	 * 权限限制
	 * @return
	 */
	public function check($UserId, $authcode) {
		//查出权限ID
		$this->AuthCheckMsg = array();
		$AddonAuth = new models\AddonAuth();
		$this->AuthInfo = $AddonAuth->load(array(
			"conditions" => "AuthCode = ?1",
			"bind" => array(1 => $authcode),
			'order' => 'Id desc',
		));
		if (empty($this->AuthInfo)) {
			$this->AuthCheckMsg['msg'] = '当前' . $AddonAuth . '权限没有配置到数据库';
			return true;
		}
		$this->AuthCheckMsg['AuthInfo'] = $this->AuthInfo->toArray();
		//用户属于的用户组
		$AddonAuthUser = new models\AddonAuthUser();
		$this->AuthUser = $AddonAuthUser->load($UserId);
		if (empty($this->AuthUser)) {
			$this->AuthCheckMsg['msg'] = '当前:' . $UserId . '用户不属于任何用户组';
			return false;
		}
		$this->AuthCheckMsg['AuthUser'] = $this->AuthUser->toArray();
		//用户组里的权限
		$AddonAuthUserRoles = new models\AddonAuthUserRoles();
		$this->UserRoles = $AddonAuthUserRoles->load($this->AuthUser->RoleId);
		if (empty($this->UserRoles)) {
			$this->AuthCheckMsg['msg'] = '当前:' . $this->AuthUser->RoleId . '用户组没有配置权限';
			return false;
		}
		//验证权限id是否在权限组里
		$this->AuthCheckMsg['UserRoles'] = $this->UserRoles->toArray();
		$access = explode(",", $this->UserRoles->AuthIds);
		if (in_array($this->AuthInfo->Id, $access)) {
			return true;
		} else {
			$this->AuthCheckMsg['msg'] = '当前:' . $authcode . '，不在用户组里';
			return false;
		}
	}

}
