<?php

    include_once('./lib/database.php');
 
	
?>

<?php 
	
	class category
	{
		private $db;
		
		public function __construct()
		{
			$this->db = new Database();
	
		}

        public function show_category()
		{
			$query = "SELECT * FROM tbl_cat order by catId asc ";
			$result = $this->db->select($query);
			return $result;
		}
		public function getCatNameById($id)
		{
			$query = "SELECT catName FROM tbl_cat WHERE catId = $id";
			$result = $this->db->select($query);
			if ($result->num_rows > 0) {
				$row = $result->fetch_assoc();
				return $row['catName'];
			} else {
				return null;
			}
		}

    }
    
?>