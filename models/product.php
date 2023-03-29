<?php

    include_once('./lib/database.php');
   
	
?>

<?php 
	
	class product
	{
		private $db;
	
		public function __construct()
		{
			$this->db = new Database();
			
		}
        public function insert_product($data,$files)
		{
			
			$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
			$category = mysqli_real_escape_string($this->db->link, $data['category']);
			$product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);		
			
            $permited = array('jpg','jpeg','png','gif');
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];
			
			$div =explode('.', $file_name);
			$file_ext = strtolower(end($div));
			$unique_image = substr(md5(time()), 0,10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;

			if($category =='' || $productName == ""  || $product_desc == ""  || $file_name == ""){
				$alert = "<span class='error'>không được để trống</span>";
				return $alert;
			}else{
				move_uploaded_file($file_temp, $uploaded_image);
				$query = "INSERT INTO tbl_product(productname,product_code,image,product_desc) 
				VALUES('$productName','$category','$unique_image','$product_desc') ";

				$result = $this->db->insert($query);
				if($result){
					$alert = "<span class='success'>Đã được thêm thành công</span>";
					return $alert;
				}else {
					$alert = "<span class='error'>Thêm không thành công</span>";
					return $alert;
				}

				}
		}

        public function show_product()
		{
			
			$query = "SELECT * FROM tbl_product  ";
			$result = $this->db->select($query);
			return $result;
		}
        public function getproductbyid($id)
		{	
			$id = mysqli_real_escape_string($this->db->link ,$id);
			$query = "SELECT * FROM tbl_product where productid = '$id' ";
			$result = $this->db->select($query);
			return $result;
		}

        public function update_product($data,$files,$id)
		{
	
			$productName = mysqli_real_escape_string($this->db->link, $data['productName']);
            $product_desc = mysqli_real_escape_string($this->db->link, $data['product_desc']);
			$category = mysqli_real_escape_string($this->db->link, $data['category']);
			
			
            $permited  = array('jpg', 'jpeg', 'png', 'gif');
			$file_name = $_FILES['image']['name'];
			$file_size = $_FILES['image']['size'];
			$file_temp = $_FILES['image']['tmp_name'];

			$div = explode('.', $file_name);
			$file_ext = strtolower(end($div));
			//$file_current = strtolower(current($div));
			$unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
			$uploaded_image = "uploads/".$unique_image;


			if($category == "" || $productName==""   || $product_desc=="" ){
				$alert = "<span class='error'>Không được để trống</span>";
				return $alert; 
			}
			else
			{	
					if(!empty($file_name)){
					if (in_array($file_ext, $permited) === false) 
						{     
						$alert = "<span class='success'>You can upload only:-".implode(', ', $permited)."</span>";
						return $alert;
						}
					move_uploaded_file($file_temp,$uploaded_image);
					
					$query = "UPDATE tbl_product SET 
					productname ='$productName',		
					product_code = '$category',
					product_desc = '$product_desc',
					image = '$unique_image'
					 WHERE productid = $id
					 ";
					}
					else
					{
					$query = "UPDATE tbl_product SET 
					productname ='$productName',		
					product_code = '$category',
					product_desc = '$product_desc'
					 WHERE productid = $id
					 ";
					}
					
				$result = $this->db->update($query);

				if($result){
					$alert = "<span class='success'>Đã cập nhật thành công</span>";
					return $alert;
				}else {
					$alert = "<span class='error'>Chưa được cập nhật </span>";
					return $alert;
				}
				
			}

		}

        public function del_product($id)
		{	
			$id = mysqli_real_escape_string($this->db->link,$id);
			$query = "DELETE  FROM tbl_product where productid = '$id' ";
			$result = $this->db->delete($query);
			if($result){
				$alert = "<span class='success'>Sản phẩm xóa thành công</span>";
				return $alert;
			}else {
				$alert = "<span class='success'>Xóa sản phẩm thất bại</span>";
				return $alert;
			}
		}

        public function search_product($str)
		{
		$query = "SELECT * FROM tbl_product WHERE LOWER (productName) LIKE '%$str%'";
		$result = $this->db->select($query);
		return $result;
		}

		public function getpage($start ,$limit)
		{	
			
			$query = "SELECT * FROM tbl_product LIMIT $start , $limit";
			
			$result = $this->db->select($query);
			return $result;
		}


    }

?>