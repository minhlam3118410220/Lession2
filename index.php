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
  <link rel="stylesheet" href="/css/style.css">
</head>

<?php
      $pd = new product();
      if(!isset($_GET['proid']) || $_GET['proid'] == NULL){
      
    }else {
        $id = $_GET['proid']; 
        $delProduct = $pd -> del_product($id); 
    }

    

?>
<body>
  <!-- Navbar -->
  <nav class=" container navbar navbar-expand-lg navbar-light  ">
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item ">
          <a class="nav-link" href="index.php" style="background-color: blue; color: white; padding: 5px 10px; border-radius: 5px;">Product </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="category.php" style="background-color: white; color: black; padding: 5px 10px; border-radius: 5px;">Categories</a>
        </li>
      </ul>
    </div>
  </nav>

   <!-- Search Form -->
  <form action="productsearch.php" method="get" class="form-inline d-flex justify-content-center mt-4">
    <div class="input-group">
    <input type="text" name="fsearch"  onfocus="this.value ='';" onblur="if (this.value == '') {this.value = 'Search Product';}">
      <div class="input-group-append">
        <input type="submit" name="search" value="Search" class="btn-primary" >
      </div>
    </div>
  </form>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
              <p class="search-results"></p>
            </div>
            <div class="col-md-6 text-right">
              <a href="productadd.php" class="add-product"><i class="fa fa-plus"></i> </a>
            </div>
          </div>
    </div>
  

  <!-- Main Content -->
  <div class="container mt-3">
    <h3>Product List</h3>
    <?php
      $pdlist = $pd->show_product();
     
      $total = mysqli_num_rows($pdlist);
      
      $limit = 10;

      $page = ceil($total/$limit);

      $cr_page = (isset($_GET['page']) ? $_GET['page'] : 1) ;

      $start = ($cr_page - 1)*$limit;

      $pdlist = $pd->getpage($start ,$limit);

     
      
    ?>
    <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th style="text-align:center">#</th>
          <th style="text-align:center" >Product Name</th>
          <th style="text-align:center">Category</th>
          <th style="text-align:center">Image</th>
          <th style="text-align:center">Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $i = 0;
          if($pdlist){					
            while ($result = $pdlist->fetch_assoc())
            {
                  $i++;	 
        ?>
        <tr>
          <td style="text-align:center"><?php echo $i?></td>
          <td style="text-align:center"><?php echo $result['productname'] ?></td>
          <td style="text-align:center">
          <?php 
            $cat = new category();
            $catId = $result['product_code'];
            $catName = $cat->getCatNameById($catId);
            echo $catName;
          ?>
          </td style="text-align:center">
          <td style="text-align:center"><img src="uploads/<?php echo $result['image'] ?>" alt="Product 1" width="80" height="80"></td>
          <td style="text-align:center">
            <a href="productedit.php?proid=<?php echo $result['productid'] ?>" class="btn btn-sm "><i class="fa fa-edit"></i></a>
            <a href="?proid=<?php echo $result['productid'] ?>" class="btn btn-sm "><i class="fa fa-trash"></i></a>
            <a href="productview.php?proid=<?php echo $result['productid'] ?>" class="btn btn-sm "><i class="fa fa-eye"></i></a>
             <a href="#" class="btn btn-sm "><i class="fa fa-file"></i></a>
          </td>
        </tr>
        <?php
             }
      }
      ?>
        
              
     </tbody>
    </table>

    <nav aria-label="Page navigation example" >
      <ul class="pagination" class="text-center">
        <?php if($cr_page - 1 > 0) {?>
        <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $cr_page - 1 ?>">Previous</a></li>
        <?php } ?>
        <?php for($i=1 ; $i <= $page ; $i++) {?>
        <li class="page-item <?php echo(($cr_page == $i) ? 'active' : '') ?>"><a class="page-link" href="index.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
        <?php } ?>
        <?php if($cr_page + 1 <= $page) {?>
        <li class="page-item"><a class="page-link" href="index.php?page=<?php echo $cr_page + 1 ?>">Next</a></li>
        <?php } ?>
      </ul>
    </nav>

    </div>
</body>
      
</html>