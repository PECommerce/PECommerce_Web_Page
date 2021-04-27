<?php
require_once 'templates/header.php';
require_once 'templates/sidebar.php';
$item_per_page = 6;
if(isset($_GET["page"]) && !empty($_GET["page"])){
    $current_page = $_GET["page"];
}else{
    $current_page = 1;
}
$where="";
if(isset($_GET["filter_name"]) && !empty($_GET["filter_name"])){
    $where = " and (t.name like '%".$_GET["filter_name"]."%')" ;
}
$sqlcheck="SELECT b.booked_id,b.order_status,u.user_id,t.item_id,u.first_name,u.last_name,t.name,t.image,t.new_price,b.created,u1.first_name as seller_fname,u1.last_name as seller_lname,u1.user_id as sel FROM tbl_booked b 
    left join tbl_users u on(b.buyer_id=u.user_id)
    left join tbl_items t on(b.item_id=t.item_id)
    left join tbl_users u1 on(t.seller_id=u1.user_id) where u.user_id = ".$_SESSION["user_id"]."".$where;
$res=mysqli_query($conn,$sqlcheck);
$numRows = mysqli_num_rows($res);
    
    $total_pages = ceil($numRows/$item_per_page);
    $offset = ($current_page-1)*$item_per_page;
    $sqlcheck .= " Limit ".$offset.", ".$item_per_page."";
    
    $result = mysqli_query($conn, $sqlcheck);
    $page_url = $_SERVER["PHP_SELF"];
?>
	
	
				<div class="col-sm-9 padding-right">
    <div class="features_items"><!--features_items-->
						<h2 class="title text-center">Bookings List</h2>
                                                
                                                
                                                <?php
                                                if (mysqli_num_rows($result) > 0) {
                                                    while ($row = mysqli_fetch_array($result)) {
                                                        $y="Order Status:- ";
                                                        if($row["order_status"]=="P")
                                                        {
                                                            $y.="Pending";
                                                        }
 else {
     $y.="Completed";
 }
                                                        $x="Seller Name:- ".$row["seller_fname"]." ".$row["seller_lname"];
                                                        if($row["order_status"]=="P")
                                                        {
                                                        echo '<div class="col-sm-6" style="padding-left:30px;">
                                                                <div class="product-image-wrapper">
                                                                        <div class="single-products">
                                                                                <div class="productinfo text-center">
                                                                                        <img src="cms/Images/'.$row["image"].'" style="height: 400px" alt="" />
                                                                                        <h2>&#8377 '.$row["new_price"].'</h2>
                                                                                        <p>'.$row["name"].'</p>
                                                                                         <p>'.$x.'</p>
                                                                                             <p>'.$y.'</p>
                                                                                         <a href="product_details.php?id='.$row["item_id"].'" class="btn btn-default add-to-cart"><i class="fa fa-crosshairs"></i>View</a>
                                                                                             <a href="details.php?id='.$row["sel"].'" class="btn btn-default add-to-cart"><i class="fa fa-male"></i>Seller Info</a>
                                                                                        <a href="unbook.php?id='.$row["item_id"].'" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Unbook</a>
                                                                                </div>
                                                                                <div class="product-overlay">
                                                                                        <div class="overlay-content">
                                                                                                <h2>&#8377 '.$row["new_price"].'</h2>
                                                                                                <p>'.$row["name"].'</p>
                                                                                                 <p>'.$x.'</p>
                                                                                                     <p>'.$y.'</p>
                                                                                                <a href="product_details.php?id='.$row["item_id"].'" class="btn btn-default add-to-cart"><i class="fa fa-crosshairs"></i>View</a>
                                                                                                    <a href="details.php?id='.$row["sel"].'" class="btn btn-default add-to-cart"><i class="fa fa-male"></i>Seller Info</a>
                                                                                                <a href="unbook.php?id='.$row["item_id"].'" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Unbook</a>
                                                                                        </div>
                                                                                </div>
                                                                        </div>

                                                                </div>
                                                        </div>';
                                                        }
 else {
     echo '<div class="col-sm-6" style="padding-left:30px;">
                                                                <div class="product-image-wrapper">
                                                                        <div class="single-products">
                                                                                <div class="productinfo text-center">
                                                                                        <img src="cms/Images/'.$row["image"].'" alt="" />
                                                                                        <h2>&#8377 '.$row["new_price"].'</h2>
                                                                                        <p>'.$row["name"].'</p>
                                                                                         <p>'.$x.'</p>
                                                                                             <p>'.$y.'</p>
                                                                                         <a href="product_details.php?id='.$row["item_id"].'" class="btn btn-default add-to-cart"><i class="fa fa-crosshairs"></i>View</a>
                                                                                             <a href="details.php?id='.$row["sel"].'" class="btn btn-default add-to-cart"><i class="fa fa-male"></i>Seller Info</a>
                                                                                        
                                                                                </div>
                                                                                <div class="product-overlay">
                                                                                        <div class="overlay-content">
                                                                                                <h2>&#8377 '.$row["new_price"].'</h2>
                                                                                                <p>'.$row["name"].'</p>
                                                                                                 <p>'.$x.'</p>
                                                                                                     <p>'.$y.'</p>
                                                                                                <a href="product_details.php?id='.$row["item_id"].'" class="btn btn-default add-to-cart"><i class="fa fa-crosshairs"></i>View</a>
                                                                                                    <a href="details.php?id='.$row["sel"].'" class="btn btn-default add-to-cart"><i class="fa fa-male"></i>Seller Info</a>
                                                                                                
                                                                                        </div>
                                                                                </div>
                                                                        </div>

                                                                </div>
                                                        </div>';
 }
                                                    }
                                                }
                                                else
                                                {
                                                    echo '<a href="index.php" style="color: blue; background-color: transparent;"><h4 style="text-align: center; padding-right: 15px">No Bookings Found. You can continue your Shopping Experience by Clicking Here.</h4></a>';
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