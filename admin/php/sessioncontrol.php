<?php
	class sessioncontrol {
		public $sessiontimeout = 3600;

//		public function sessioncontrol() {
//			session_start();
//		}

        public function __construct() {
            session_start();
        }

		public function isValid($key) {
			if(isset($_SESSION[$key])) {
				$now = time();

				if(($now-$_SESSION['time']) <= $this->sessiontimeout) {
					$_SESSION['time'] = $now+$this->sessiontimeout;
					return true;
				} else {
					foreach ($_SESSION as $key => $value) {
						unset($_SESSION[$key]);
					}
					return false;
				}
			} else {
				return false;
			}
		}

		public function start($data) {
			foreach ($data as $key => $value) {
				$_SESSION[$key] = $value;
			}
		}

		public function redirect($url) {
			header('Location: '.$url);
		}

		public function end() {
			foreach ($_SESSION as $key => $value) {
				unset($_SESSION[$key]);
			}
		}

		public function set($key,$value) {
			$_SESSION[$key] = $value;
		}
	}
?>