<?php 

    include './models/product.php';
    include './models/category.php';
  

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
          <a class="nav-link" href="index.php" >Product </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="category.php">Category</a>
        </li>
      </ul>
     
    </div>
  </nav>

   <!-- Search Form -->
  <form class="form-inline d-flex justify-content-center">
    <h2>Product View</h2>
  </form>

   <?php      
        $pd = new product();
    
        if(!isset($_GET['proid']) || $_GET['proid'] == NULL){
            echo "<script> window.location = 'index.php' </script>";
            
        }else {
            $id = $_GET['proid']; 

            $get_product_by_id = $pd->getproductbyid($id);
        } 

        if($get_product_by_id)
         {
            while ($result_product = $get_product_by_id->fetch_assoc()) {
              
          ?>   
    <div class="container">
    <table class="table table-bordered">
           
            <tbody>
                <tr>
                  <th scope="row">Product Name</th>
                  <td><?php echo $result_product['productname'] ?></td>               
                </tr>
                <tr>
                  <th scope="row">Category</th>
                  <td>
                  <?php 
                    $cat = new category();
                    $catId = $result_product['product_code'];
                    $catName = $cat->getCatNameById($catId);
                    echo $catName;
                  ?>
                  </td>           
                </tr>
                <tr>
                  <th scope="row">Image</th>
                  <td><img src="uploads/<?php echo $result_product['image'] ?>" width="100" height="100"></td>
                </tr>
                <tr>
                  <th scope="row">Description</th>
                  <td><?php echo $result_product['product_desc'] ?></td>
                </tr>
            </tbody>
            </table>
             
            <?php 
            }
            }
             ?>
        
          </div>

</body>
      
</html>