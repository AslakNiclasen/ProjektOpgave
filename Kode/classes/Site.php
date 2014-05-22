<?php
	class Site {
		private $db; //Database connection

		//Constructor
		function __construct($db) {
			$this->db = $db;
		}

		//Method for creating a site
		public function create($site_name, $site_url, $access_token) {
			if ($site_name && $site_url && $access_token) {
				if ($this->db->query("INSERT INTO sites (name, url, access_token) VALUES('". $site_name ."', '". $site_url ."', '". $access_token ."')")) {
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		}

		//Method for editing a site
		public function edit($id, $site_name, $site_url) {
			if ($id && $site_name && $site_url) {
				if ($this->db->query("UPDATE sites SET name = '". $site_name ."', url = '". $site_url ."' WHERE id = '". $id ."'")) {
					return true;
				} else {
					return false;
				}
			} else {
				return false;
			}
		}

		//Method for getting information about a site
		public function get_site($id) {
			if ($id) {
				return $this->db->query("SELECT * FROM sites WHERE id = '". $id ."'")->fetch_assoc();	
			} else {
				return false;
			}
		}

		//Method for getting information about all sites
		public function get_all_sites() {
			return $this->db->query("SELECT * FROM sites");
		}

		//Method for special queries
		public function get_special($sql) {
			return $this->db->query("SELECT * FROM zones WHERE id = '10'")->fetch_assoc();
		}
	}
?>