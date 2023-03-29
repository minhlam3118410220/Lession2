<?php 

    include('./models/product.php');
    include('./models/category.php');

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Product Management</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <!-- Navbar -->
  <nav class=" container navbar navbar-expand-lg navbar-light  ">
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item ">
          <a class="nav-link" href="index.php">Product </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="category.php">Categories</a>
        </li>
      </ul>
     
    </div>
  </nav>

   <!-- Search Form -->
  <form class="form-inline d-flex justify-content-center">
    <h2>Update Product</h2>
  </form>

    <?php
        $pd = new product();
    
    if(!isset($_GET['proid']) || $_GET['proid'] == NULL){
        echo "<script> window.location = 'index.php' </script>";
        
    }else {
        $id = $_GET['proid']; 

        $get_product_by_id = $pd->getproductbyid($id);
    } 

    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])){
        $updateProduct = $pd -> update_product($_POST, $_FILES, $id); 
    }
      
    ?>
                
        <?php 
         
         if($get_product_by_id)
         {
            while ($result_product = $get_product_by_id->fetch_assoc()) {
           
          ?>   
        <div class="container">

            <form action="" method="post" enctype="multipart/form-data">
                <table class="form">
                
                    <tr>
                        <td>
                            <label>Product Name</label>
                        </td>
                        <td>
                            <input name="productName" type="text" value="<?php echo $result_product['productname'] ?>"  class="medium" />
                        </td>
                    </tr>
                    
                    <tr>
                        <td>
                            <label>Category</label>
                        </td>
                        <td>
                        <select id="select" name="category">
                            <?php 
                            $cat = new category();
                            $catlist = $cat->show_category();
                            if($catlist){
                                while ($result = $catlist->fetch_assoc()){
                            
                             ?>
                            <option 
                            <?php 
                            if($result['catId']==$result_product['product_code'])
                                { echo 'selected'; }
                             ?>    
                            value=" <?php echo $result['catId'] ?> "> <?php echo $result['catName'] ?></option>
                            
                            <?php 
                            }
                             }
                             ?>
                        </select>
                        </td>
                    </tr>
                
                    <tr>
                        <td>
                            <label>Image</label>
                        </td>
                        <td>
                        <img src="uploads/<?php echo $result_product['image'] ?>" width="100"><br>
                            <input name="image" type="file" />
                        </td>
                    </tr>
                    
                    <tr>
                        <td style="vertical-align: top; padding-top: 9px;">
                            <label>Description</label>
                        </td>
                        <td>
                            <textarea name="product_desc" class="tinymce"><?php echo $result_product['product_desc'] ?></textarea>
                        </td>
                    </tr>

                    <tr>                   
                        <td>
                            <input type="submit" name="submit" class="btn-primary" Value="Update Product "/>
                        </td>
                    </tr>

                </table>
                </form>
                <?php 
                }
                }
                ?>
        
          </div>
  
 
   
</body>
      
</html>