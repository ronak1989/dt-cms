<?php
require_once _CONST_CLASS_PATH . 'class.database.php';
require_once _CONST_CLASS_PATH . 'class.formrender.php';
require_once _CONST_CLASS_PATH . 'swiftmailer/lib/swift_required.php';
class authenticateModel extends Database {

	public function __construct($siteId = NULL, $siteParams = array()) {
		parent::__construct();
	}

	private function checkEmailExists($email_id) {
		$this->_whereCondition = NULL;
		$this->_modelQuery = "SELECT count(1) as cnt FROM cms_users WHERE mail=:user_id";
		$this->query($this->_modelQuery);
		$this->bindByValue('user_id', $email_id);
		$this->_queryResult = $this->single();
		return $this->_queryResult['cnt'];
	}

	private function sendChangePasswordMailer($user_id, $password) {
		$subject = 'Dalal Times CMS Password changed';
		$from = array('subscription@dalaltimes.com' => 'Dalal Times');
		$to = array(
			$user_id => '',
		);
		$html = '<!DOCTYPE HTML>
              <html>
              <head>
              <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
              <title>Untitled Document</title>
              </head>

              <body >
              <div style="width:650px;margin: 0px auto;padding-top:20px;border:1px solid #e1e1e1;font-family:Verdana;font-size:12px;">
              <div style="margin:0 25px;">
                  <div style="display:inline-block;vertical-align:middle;width:49%;">
                      <div style="float:left;">
                          <img src="http://magazine.dalaltimes.com/public/images/mailer-dtlogo.png" style="vertical-align:middle;display:inline-block; text-align:right;">
                      </div>
                  </div>
              </div>
              <div style="margin:0 25px;">
                <div style="margin-top:40px;text-align:center;border-bottom:1px solid #e1e1e1;color:#00a7dd; font-size:20px; text-transform:uppercase;">
                    Change Password Confirmation
                  </div>
                  <div style="color:#434343;">
                  <p>Your password has been changed successfully.</p>
                	<p>
                        New Password – [[NEW-PASSWORD]]
                      </p>
                  <p>You can change your password by logging in to your account </p>
                  </div>
              </div>

              </div>
              </body>
              </html>';
		$html = str_replace(array('[[NEW-PASSWORD]]'), array($password), $html);
		$transport = Swift_SmtpTransport::newInstance('smtp.mandrillapp.com', 587);
		$transport->setUsername('ronak.shah@dalaltimes.com');
		$transport->setPassword('0-8np7jSlC_pDxQNp4JPSA');

		$swift = Swift_Mailer::newInstance($transport);

		$message = new Swift_Message($subject);
		$message->setFrom($from);
		$message->setBody($html, 'text/html');
		$message->setTo($to);

		if ($recipients = $swift->send($message, $failures)) {
			return true;
		} else {
			return false;
		}

	}

	private function generatePassword($user_id) {
		return substr(md5($user_id), rand(0, 26), 6);
	}

	private function updatePassword($user_id, $newPassword = NULL, $type = 'system') {
		if ($type == 'system') {
			$_generatedPassword = $this->generatePassword($user_id);
			$this->_modelQuery = 'UPDATE cms_users set `password` = :newpassword where mail=:user_id';
			$this->query($this->_modelQuery);
			$this->bindByValue('user_id', $user_id);
			$this->bindByValue('newpassword', password_hash($_generatedPassword, PASSWORD_BCRYPT));
			if ($this->execute()) {
				$this->sendChangePasswordMailer($user_id, $_generatedPassword);
				return true;
			} else {
				return false;
			}
		} else {
			$this->_modelQuery = 'UPDATE cms_users set `password` = :newpassword where mail=:user_id';
			$this->query($this->_modelQuery);
			$this->bindByValue('user_id', $user_id);
			$this->bindByValue('newpassword', password_hash($newPassword, PASSWORD_BCRYPT));
			if ($this->execute()) {
				$this->sendChangePasswordMailer($user_id, $newPassword);
				return true;
			} else {
				return false;
			}
		}
	}

	private function loadUserSession($user_id, $password) {
		$this->_whereCondition = NULL;
		$this->_modelQuery = "SELECT cms_id, employee_id, employee_name, mail, designation, password FROM cms_users WHERE mail=:user_id";
		$this->query($this->_modelQuery);
		$this->bindByValue('user_id', $user_id);
		$this->_queryResult = $this->single();
		if (password_verify($password, $this->_queryResult['password'])) {
			$_SESSION['_loggedIn'] = 1;
			$_SESSION['_cmsId'] = base64_encode($this->_queryResult['cms_id']);
			$_SESSION['_employeeId'] = base64_encode($this->_queryResult['employee_id']);
			$_SESSION['_employeeName'] = base64_encode($this->_queryResult['employee_name']);
			$_SESSION['_mail'] = base64_encode($this->_queryResult['mail']);
			$_SESSION['_designation'] = base64_encode($this->_queryResult['designation']);
		}
	}

	private function verifyUserCredentials($_userId, $_Password) {
		$this->_modelQuery = "SELECT cms_id, mail, password FROM cms_users WHERE mail=:user_id";
		$this->query($this->_modelQuery);
		$this->bindByValue('user_id', $_userId);
		$this->_queryResult = $this->single();
		return password_verify($_Password, $this->_queryResult['password']);
	}

	protected function loginUser($_userId, $_Password) {
		/**
		 * check if the records exists into the DB
		 * if it exists register session else throw error
		 */
		if ($this->verifyUserCredentials($_userId, $_Password) == true) {
			/**
			 * Load User Session
			 */
			$this->loadUserSession($_userId, $_Password);
			return 'success';
		} else {
			$_SESSION['error']['login'][] = "Invalid UserID or Password";
			return 'error';
		}
	}

	protected function logoutUser() {
		unset($_SESSION);
		session_destroy();
		return 'success';
		//echo json_encode($this->_details);
	}

	protected function resetPassword($user_id) {
		if ((int) $this->checkEmailExists($user_id) == (int) 1) {
			if ($this->updatePassword($user_id, NULL, 'system') == true) {
				$_SESSION['success']['forgotpassword'][] = "Your Password has been reset. Please check your inbox for the new password";
				return 'success';
			} else {
				$_SESSION['error']['forgotpassword'][] = "Error while resetting your password. Please try again!!!";
				return 'error';
			}
		} else {
			$_SESSION['error']['forgotpassword'][] = "The User Id doesnt exist in the system";
			return 'generic';
		}
	}

	protected function changeUserPassword($oldPassword, $newPassword, $confirmNewPassword) {
		if (!isset($_SESSION['_loggedIn'])) {
			$_SESSION['error']['changepassword'][] = 'You need to log in to change password';
		} else {
			if ($newPassword != $confirmNewPassword) {
				$_SESSION['error']['changepassword'][] = 'Your New Password & the confirm New password does not match ';
			} else {
				if ($this->verifyUserCredentials(base64_decode($_SESSION['_mail']), $oldPassword) == true) {
					if ($this->updatePassword(base64_decode($_SESSION['_mail']), $newPassword, 'user') == true) {
						$_SESSION['success']['changepassword'][] = 'Your password has been changed successfully.';
					} else {
						$_SESSION['error']['changepassword'][] = 'Error while changing your password. Please Try Again!!!';
					}
				} else {
					$_SESSION['error']['changepassword'][] = 'Error while changing your password. Please Try Again!!!';
				}
			}
		}
	}
}
?>
