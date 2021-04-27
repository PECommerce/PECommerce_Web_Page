<?php
require_once 'templates/header.php';
$item_per_page = 12;
if(isset($_GET["page"]) && !empty($_GET["page"])){
    $current_page = $_GET["page"];
}else{
    $current_page = 1;
}
$where="";
if(isset($_GET["filter_name"]) && !empty($_GET["filter_name"])){
    $where = " and (tbl_items.name like '%".$_GET["filter_name"]."%')" ;
}
if(isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"]))
{
$sqlcheck="select * from tbl_items where status='Y' and seller_id != ".$_SESSION["user_id"]." ".$where;
}
else
{
    $sqlcheck="select * from tbl_items where status='Y'".$where;
}
$res=mysqli_query($conn,$sqlcheck);
$numRows = mysqli_num_rows($res);
    
    $total_pages = ceil($numRows/$item_per_page);
    $offset = ($current_page-1)*$item_per_page;
    $sqlcheck .= " Limit ".$offset.", ".$item_per_page."";
    
    $result = mysqli_query($conn, $sqlcheck);
    $page_url = $_SERVER["PHP_SELF"];
?>
	
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-12 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Items List</h2>
                                                
                                                
                                                <?php
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        $book="";
                                                        if(isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"]))
{
                                                            $book="book_item.php?id=".$row["item_id"]."";
                                                        }
                                                        else
                                                        {
                                                            $book="login.php";
                                                        }
                                                        echo '<div class="col-sm-4">
                                                                <div class="product-image-wrapper">
                                                                        <div class="single-products">
                                                                                <div class="productinfo text-center">
                                                                                        <img src="cms/Images/'.$row["image"].'"  style="height: 400px" alt="" />
                                                                                        <h2>&#8377 '.$row["new_price"].'</h2>
                                                                                        <p>'.$row["name"].'</p>
                                                                                         <a href="product_details.php?id='.$row["item_id"].'" class="btn btn-default add-to-cart"><i class="fa fa-crosshairs"></i>View</a>
                                                                                        <a href="'.$book.'" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Book</a>
                                                                                </div>
                                                                                <div class="product-overlay">
                                                                                        <div class="overlay-content">
                                                                                                <h2>&#8377 '.$row["new_price"].'</h2>
                                                                                                <p>'.$row["name"].'</p>
                                                                                                <a href="product_details.php?id='.$row["item_id"].'" class="btn btn-default add-to-cart"><i class="fa fa-crosshairs"></i>View</a>
                                                                                                <a href="'.$book.'" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Book</a>
                                                                                        </div>
                                                                                </div>
                                                                        </div>

                                                                </div>
                                                        </div>';
                                                    }
                                                    
                                                }
                                                else
                                                    {
                                                        echo '<a href="index.php" style="color: blue; background-color: transparent;"><h4 style="text-align: center; padding-right: 15px">No Items Found.</h4></a>';
                                                    }
                                                 ?>
						
                                             
						
					</div><!--features_items-->
                                        <?php echo cmspaging($item_per_page, $current_page, $total_records, $total_pages, $page_url); ?>
				</div>
			</div>
		</div>
	</section>
	<?php
require_once 'templates/footer.php';
?>