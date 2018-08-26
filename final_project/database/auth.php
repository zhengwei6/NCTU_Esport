<?php
	
	include __DIR__ . '/database.php';

	// extending the class database/Database makes sure your connection of DB.
	class Auth extends Database
	{
		public function login($account, $password) {

			// $query = 'Your-Query';
			// $result = $this->db->query($query);


			// return something you like
		}
	}

?>