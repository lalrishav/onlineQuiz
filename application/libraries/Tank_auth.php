<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

require_once('phpass-0.1/PasswordHash.php');

define('STATUS_ACTIVATED', '1');
define('STATUS_NOT_ACTIVATED', '0');

class Tank_auth {
	private $error = array();

	function __construct() {
		$this->ci =& get_instance();

		$this->ci->load->config('tank_auth', TRUE);

		$this->ci->load->library('session');
		$this->ci->load->database();
		
		$this->ci->load->model('user_model');
		$this->ci->load->model('group_model');
		$this->ci->load->model('privilege_model');
		
		// Try to autologin
		$this->autologin();
	}

	function login($login, $password, $remember, $login_by_username, $login_by_email, $bypass=false) {
		if ((strlen($login) > 0) AND ((strlen($password) > 0) || $bypass)) {

			if ($login_by_username AND $login_by_email) {
				$get_user_func = 'get_user_by_login';
			} else if ($login_by_username) {
				$get_user_func = 'get_user_by_username';
			} else {
				$get_user_func = 'get_user_by_email';
			}
			
			if (!is_null($user = $this->ci->user_model->$get_user_func($login))) {	// login ok

				$hasher = new PasswordHash($this->ci->config->item('phpass_hash_strength', 'tank_auth'), $this->ci->config->item('phpass_hash_portable', 'tank_auth'));
				if ($hasher->CheckPassword($password, $user->password) || $bypass) {

					if ($user->banned == 1) {
						$this->error = array('banned' => $user->ban_reason);

					} else {
						
						$this->set_session($user);
						
						log_action('login');

						if ($user->activated == 0) {
							$this->error = array('not_activated' => '');

						} else {
							if ($remember) {
								$this->create_autologin($user->id);
							}

							$this->clear_login_attempts($login);

							$this->ci->user_model->update_login_info(
									$user->id,
									$this->ci->config->item('login_record_ip', 'tank_auth'),
									$this->ci->config->item('login_record_time', 'tank_auth'));
							return TRUE;
						}						
					}
				} else {
					$this->increase_login_attempt($login);
					$this->error = array('password' => 'auth_incorrect_password');
				}
			} else {
				$this->increase_login_attempt($login);
				$this->error = array('login' => 'auth_incorrect_login');
			}
		}
		return FALSE;
	}

	function logout() {
	

		$this->delete_autologin();

		$this->ci->session->set_userdata(array('user_id' => '', 'username' => '', 'status' => ''));

		$this->ci->session->sess_destroy();
		
	}
	
	function set_session($user) {
	
		$group = $this->ci->group_model->get(array('slug'=>$user->group_slug));
		$privileges = $this->ci->privilege_model->get_privileges('user', $user->id);
		$this->ci->session->set_userdata(array(
				'user_id'			=> $user->id,
				'firstname'			=> $user->firstname,
				'lastname'			=> $user->lastname,
				'username'			=> $user->username,
				'status'			=> ($user->activated == 1) ? STATUS_ACTIVATED : STATUS_NOT_ACTIVATED,
				'last_login'		=> $user->last_login,
				'group'				=> $group,
				'privileges'		=> $privileges,
		));
	}

	function is_logged_in($activated = TRUE) {
		return $this->ci->session->userdata('status') === ($activated ? STATUS_ACTIVATED : STATUS_NOT_ACTIVATED);
	}
	
	function get_user_id() {
		return $this->ci->session->userdata('user_id');
	}
	
	function get_username() {
		return $this->ci->session->userdata('username');
	}

	function get_firstname() {
		return $this->ci->session->userdata('firstname');
	}

	function get_lastname() {
		return $this->ci->session->userdata('lastname');
	}

	function get_fullname() {
		return $this->ci->session->userdata('firstname') . " " . $this->ci->session->userdata('lastname');
	}
	
	function get_privileges() {
		return $this->ci->session->userdata('privileges');
	}
	
	function get_last_login_time() {
		return strtotime($this->ci->session->userdata('last_login'));
	}
	
	function is_privileged($privilege) {
		return in_array($privilege, $this->ci->session->userdata('privileges'));
	}
	
	function is_admin() {
		$group = $this->ci->session->userdata('group');
		return (bool) $group['is_admin'];
	}
	
	function get_unread_message_count() {
		return $this->ci->session->userdata('unread_messages');
	}
	
	function get_group($key="") {
		$group = $this->ci->session->userdata('group');
		if ($key)
			return $group[$key];
		return $group;
	}

	function create_user($username, $firstname, $lastname, $email, $password, $email_activation, $profile=array(), $group='', $meta=array()) {
	
		if ((strlen($username) > 0) AND !$this->ci->user_model->is_username_available($username)) {
			$this->error = array('username' => 'auth_username_in_use');

		} elseif (!$this->ci->user_model->is_email_available($email)) {
			$this->error = array('email' => 'auth_email_in_use');

		} else {
			// Hash password using phpass
			$hasher = new PasswordHash($this->ci->config->item('phpass_hash_strength', 'tank_auth'), $this->ci->config->item('phpass_hash_portable', 'tank_auth'));
			$hashed_password = $hasher->HashPassword($password);

			$group = $this->ci->group_model->get(array('slug'=>$group));
			
			$data = array(
				'firstname'	=> $firstname,
				'lastname'	=> $lastname,
				'username'	=> $username,
				'password'	=> $hashed_password,
				'email'		=> $email,
				'last_ip'	=> $this->ci->input->ip_address(),
				'group_id' 	=> $group['id'],
			);

			if ($email_activation) {
				$data['new_email_key'] = md5(rand().microtime());
			}
			if (!is_null($res = $this->ci->user_model->create_user($data, !$email_activation, $profile, $meta))) {
				$data['user_id'] = $res['user_id'];
				$data['password'] = $password;
				unset($data['last_ip']);
				
				log_action('register', '', $data['user_id']);
				
				return $data;
			}
		}
		return NULL;
	}

	function is_username_available($username) {
		return ((strlen($username) > 0) AND $this->ci->user_model->is_username_available($username));
	}

	function is_email_available($email) {
		return ((strlen($email) > 0) AND $this->ci->user_model->is_email_available($email));
	}

	function change_email($email) {
	
		$user_id = $this->ci->session->userdata('user_id');

		if (!is_null($user = $this->ci->user_model->get_user_by_id($user_id, FALSE))) {

			$data = array(
				'user_id'	=> $user_id,
				'username'	=> $user->username,
				'email'		=> $email,
			);
			if (strtolower($user->email) == strtolower($email)) {		// leave activation key as is
				$data['new_email_key'] = $user->new_email_key;
				return $data;

			} elseif ($this->ci->user_model->is_email_available($email)) {
				$data['new_email_key'] = md5(rand().microtime());
				$this->ci->user_model->set_new_email($user_id, $email, $data['new_email_key'], FALSE);
				return $data;

			} else {
				$this->error = array('email' => 'auth_email_in_use');
			}
		}
		return NULL;
	}
	
	function activate_user($user_id, $activation_key, $activate_by_email = TRUE) {
		$this->ci->user_model->purge_na($this->ci->config->item('email_activation_expire', 'tank_auth'));

		if ((strlen($user_id) > 0) AND (strlen($activation_key) > 0)) {
			return $this->ci->user_model->activate_user($user_id, $activation_key, $activate_by_email);
		}
		return FALSE;
	}

	function forgot_password($login) {
		if (strlen($login) > 0) {
			if (!is_null($user = $this->ci->user_model->get_user_by_login($login))) {

				$data = array(
					'user_id'		=> $user->id,
					'username'		=> $user->username,
					'email'			=> $user->email,
					'new_pass_key'	=> md5(rand().microtime()),
				);
				
				$this->ci->user_model->set_password_key($user->id, $data['new_pass_key']);
				log_action('forgot_password', '', $user->id);
				return $data;

			} else {
				$this->error = array('login' => 'auth_incorrect_email_or_username');
			}
		}
		return NULL;
	}

	function can_reset_password($user_id, $new_pass_key) {
		if ((strlen($user_id) > 0) AND (strlen($new_pass_key) > 0)) {
			return $this->ci->user_model->can_reset_password(
				$user_id,
				$new_pass_key,
				$this->ci->config->item('forgot_password_expire', 'tank_auth'));
		}
		return FALSE;
	}


	function reset_password($user_id, $new_pass_key, $new_password) {
	
		if ((strlen($user_id) > 0) AND (strlen($new_pass_key) > 0) AND (strlen($new_password) > 0)) {

			if (!is_null($user = $this->ci->user_model->get_user_by_id($user_id, TRUE))) {

				$hasher = new PasswordHash($this->ci->config->item('phpass_hash_strength', 'tank_auth'), $this->ci->config->item('phpass_hash_portable', 'tank_auth'));
				$hashed_password = $hasher->HashPassword($new_password);

				if ($this->ci->user_model->reset_password(
						$user_id,
						$hashed_password,
						$new_pass_key,
						$this->ci->config->item('forgot_password_expire', 'tank_auth'))) {	// success

					$this->ci->load->model('tank_auth/user_autologin');
					$this->ci->user_autologin->clear($user->id);
					
					log_action('reset_password', '', $user_id);
					
					return array(
						'user_id'		=> $user_id,
						'username'		=> $user->username,
						'email'			=> $user->email,
						'new_password'	=> $new_password,
					);
				}
			}
		}
		return NULL;
	}

	function change_password($old_pass, $new_pass) {
	
		$user_id = $this->ci->session->userdata('user_id');

		if (!is_null($user = $this->ci->user_model->get_user_by_id($user_id, TRUE))) {

			$hasher = new PasswordHash($this->ci->config->item('phpass_hash_strength', 'tank_auth'), $this->ci->config->item('phpass_hash_portable', 'tank_auth'));
			if ($hasher->CheckPassword($old_pass, $user->password)) {

				$hashed_password = $hasher->HashPassword($new_pass);

				$this->ci->user_model->change_password($user_id, $hashed_password);
				return TRUE;

			} else {
				$this->error = array('old_password' => 'auth_incorrect_password');
			}
		}
		return FALSE;
	}

	function set_new_email($new_email, $password) {
	
		$user_id = $this->ci->session->userdata('user_id');

		if (!is_null($user = $this->ci->user_model->get_user_by_id($user_id, TRUE))) {

			$hasher = new PasswordHash($this->ci->config->item('phpass_hash_strength', 'tank_auth'), $this->ci->config->item('phpass_hash_portable', 'tank_auth'));
			if ($hasher->CheckPassword($password, $user->password)) {

				$data = array(
					'user_id'	=> $user_id,
					'username'	=> $user->username,
					'new_email'	=> $new_email,
				);

				if ($user->email == $new_email) {
					$this->error = array('email' => 'auth_current_email');

				} elseif ($user->new_email == $new_email) {
					$data['new_email_key'] = $user->new_email_key;
					return $data;

				} elseif ($this->ci->user_model->is_email_available($new_email)) {
					$data['new_email_key'] = md5(rand().microtime());
					$this->ci->user_model->set_new_email($user_id, $new_email, $data['new_email_key'], TRUE);
					return $data;

				} else {
					$this->error = array('email' => 'auth_email_in_use');
				}
			} else {
				$this->error = array('password' => 'auth_incorrect_password');
			}
		}
		return NULL;
	}

	function activate_new_email($user_id, $new_email_key) {
		if ((strlen($user_id) > 0) AND (strlen($new_email_key) > 0)) {
			return $this->ci->user_model->activate_new_email(
					$user_id,
					$new_email_key);
		}
		return FALSE;
	}

	function delete_user($password) {
		$user_id = $this->ci->session->userdata('user_id');

		if (!is_null($user = $this->ci->user_model->get_user_by_id($user_id, TRUE))) {

			$hasher = new PasswordHash(
					$this->ci->config->item('phpass_hash_strength', 'tank_auth'),
					$this->ci->config->item('phpass_hash_portable', 'tank_auth'));
			if ($hasher->CheckPassword($password, $user->password)) {

				$this->ci->user_model->delete_user($user_id);
				$this->logout();
				return TRUE;

			} else {
				$this->error = array('password' => 'auth_incorrect_password');
			}
		}
		return FALSE;
	}

	function get_error_message() {
		return $this->error;
	}

	private function create_autologin($user_id) {
		$this->ci->load->helper('cookie');
		$key = substr(md5(uniqid(rand().get_cookie($this->ci->config->item('sess_cookie_name')))), 0, 16);

		$this->ci->load->model('tank_auth/user_autologin');
		$this->ci->user_autologin->purge($user_id);

		if ($this->ci->user_autologin->set($user_id, md5($key))) {
			set_cookie(array(
					'name' 		=> $this->ci->config->item('autologin_cookie_name', 'tank_auth'),
					'value'		=> serialize(array('user_id' => $user_id, 'key' => $key)),
					'expire'	=> $this->ci->config->item('autologin_cookie_life', 'tank_auth'),
			));
			return TRUE;
		}
		return FALSE;
	}

	private function delete_autologin() {
		$this->ci->load->helper('cookie');
		if ($cookie = get_cookie($this->ci->config->item('autologin_cookie_name', 'tank_auth'), TRUE)) {

			$data = unserialize($cookie);

			$this->ci->load->model('tank_auth/user_autologin');
			$this->ci->user_autologin->delete($data['user_id'], md5($data['key']));

			delete_cookie($this->ci->config->item('autologin_cookie_name', 'tank_auth'));
		}
	}

	private function autologin() {
		if (!$this->is_logged_in() AND !$this->is_logged_in(FALSE)) {

			$this->ci->load->helper('cookie');
			if ($cookie = get_cookie($this->ci->config->item('autologin_cookie_name', 'tank_auth'), TRUE)) {

				$data = unserialize($cookie);

				if (isset($data['key']) AND isset($data['user_id'])) {

					$this->ci->load->model('tank_auth/user_autologin');
					if (!is_null($user = $this->ci->user_autologin->get($data['user_id'], md5($data['key'])))) {

						$user = $this->ci->user_model->get_user_by_id($user->id, TRUE);
						
						$this->set_session($user);

						set_cookie(array(
								'name' 		=> $this->ci->config->item('autologin_cookie_name', 'tank_auth'),
								'value'		=> $cookie,
								'expire'	=> $this->ci->config->item('autologin_cookie_life', 'tank_auth'),
						));

						$this->ci->user_model->update_login_info(
								$user->id,
								$this->ci->config->item('login_record_ip', 'tank_auth'),
								$this->ci->config->item('login_record_time', 'tank_auth'));
						return TRUE;
					}
				}
			}
		}
		return FALSE;
	}

	function is_max_login_attempts_exceeded($login) {
		if ($this->ci->config->item('login_count_attempts', 'tank_auth')) {
			$this->ci->load->model('tank_auth/login_attempts');
			return $this->ci->login_attempts->get_attempts_num($this->ci->input->ip_address(), $login)
					>= $this->ci->config->item('login_max_attempts', 'tank_auth');
		}
		return FALSE;
	}

	private function increase_login_attempt($login) {
		if ($this->ci->config->item('login_count_attempts', 'tank_auth')) {
			if (!$this->is_max_login_attempts_exceeded($login)) {
				$this->ci->load->model('tank_auth/login_attempts');
				$this->ci->login_attempts->increase_attempt($this->ci->input->ip_address(), $login);
			}
		}
	}

	private function clear_login_attempts($login) {
		if ($this->ci->config->item('login_count_attempts', 'tank_auth')) {
			$this->ci->load->model('tank_auth/login_attempts');
			$this->ci->login_attempts->clear_attempts(
					$this->ci->input->ip_address(),
					$login,
					$this->ci->config->item('login_attempt_expire', 'tank_auth'));
		}
	}
}

/* End of file Tank_auth.php */
/* Location: ./application/libraries/Tank_auth.php */