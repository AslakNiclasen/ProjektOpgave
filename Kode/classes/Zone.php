<?php
	class Zone {
		private $db; //Database connection

		//Constructor
		function __construct($db) {
			$this->db = $db;
		}
		
		//Method for creating a zone
		public function create($zone_name, $site_id) {
			if ($zone_name && $site_id) {
				if ($this->db->query("INSERT INTO zones (site_id, name) VALUES('". $site_id ."', '". $zone_name ."')")) {
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
	}
?>