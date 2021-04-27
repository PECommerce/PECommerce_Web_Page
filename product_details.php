<?php
ob_start();
require_once 'templates/header.php';
$id= $_GET["id"];
$check="select * from tbl_items where item_id= ".$id." and seller_id= ".$_SESSION["user_id"];
$one=mysqli_query($conn,$check);
date_default_timezone_set('Asia/Kolkata');
$sql = "SELECT u.first_name,u.last_name,t.name,t.description,t.price,t.image,t.new_price,t.status,t.created FROM tbl_items t 
    left join tbl_users u on(t.seller_id=u.user_id) where item_id=".$id;
$call="select * from tbl_booked where item_id= ".$id." and buyer_id=".$_SESSION["user_id"];
$ans=mysqli_query($conn,$call);
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_assoc($result);
$x=$row["first_name"]." ".$row["last_name"];
$sqlcheck="";
if(isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"]))
{
    $sqlcheck="select * from tbl_items where status='Y' and seller_id != ".$_SESSION["user_id"]." and item_id!=".$id." order by created desc";
}
else{
$sqlcheck="select * from tbl_items where status='Y' and item_id!=".$id." order by created desc";
}
$res=mysqli_query($conn,$sqlcheck);
$extra=mysqli_fetch_assoc($ans);
?>
	
	<section>
		<div class="container">
			<div class="row" >
				
				
				<div class="col-sm-12 padding-right" >
					<div class="product-details"><!--product-details-->
						<div class="col-sm-6 padding-left">
							<div class="view-product">
								<img src="cms/Images/<?php echo $row["image"]; ?>" style="border: 3px solid #555; height: 700px" alt="" />
							</div>
							

						</div>
						<div class="col-sm-6">
							<div class="product-information"><!--/product-information-->
								
                                                            <h1><?php echo $row["name"]; ?></h1>
								
								<span>
									<span><?php echo '&#8377 '.$row["new_price"]; ?></span>
                                                                        <?php
                                                                         if(!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"]))
{echo '<a href="login.php"><button type="button" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Book
                                                                            </button></a>';
                                                                             
                                                                         }
                                                                         else{
                                                                        if(mysqli_num_rows($one)==0 && $row["status"]=="Y")
                                                                        {
									echo '<a href="book_item.php?id='.$id.'"><button type="button" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Book
                                                                            </button></a>';
                                                                        }
                                                                        if(mysqli_num_rows($ans)>0 && $extra["order_status"]=='P')
                                                                        {
                                                                            echo '<a href="unbook.php?id='.$id.'"><button type="button" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Unbook
                                                                            </button></a>';
                                                                        }
                                                                         }
                                                                                ?>
								</span>
                                                            <p><h4 style="color: dimgray"><b style="color: black">Availability:</b> <?php if($row["status"]=="Y")
                                                                echo "In Stock";
                                                            else
                                                                echo "Out of Stock";
                                                            ?></h4></p>
                                                        <?php 
                                                        $y="";
                                                        if($extra["order_status"]=="P")
                                                        {
                                                            $y.="Pending";
                                                        }
 else {
     $y.="Completed";
 }
                                                        if(mysqli_num_rows($ans)>0)
                                                                        {
                                                            echo '<p><h4 style="color: dimgray"><b style="color: black">Order Status: </b>'.$y.'</h4></p>';
                                                        }
                                                        ?>
                                                                <p><h4 style="color: dimgray"><b style="color: black">Description:</b> <?php echo $row["description"]; ?></h4></p>
								
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					
					<div class="category-tab shop-details-tab"><!--category-tab-->
						
						<div class="tab-content">
							
							
							
							
							
							
							<div class="tab-pane fade active in" id="reviews" >
								<div class="col-sm-12">
									<ul>
										<li> <i class="fa fa-user"></i> <?php 
                                                                                 echo $x;
                                                                                ?> </li>
										<li> <i class="fa fa-clock-o"></i> <?php 
                                                                                $dtime = new DateTime($row["created"]);
                                                                                 echo $dtime->format('H:i:s');
                                                                                ?> </li>
										<li> <i class="fa fa-calendar-o"></i> <?php 
                                                                                $dtime = new DateTime($row["created"]);
                                                                                 echo $dtime->format('Y-m-d');
                                                                                 ?> </li>
									</ul>
									
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
					
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">latest items</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								 <?php
                                                            $i=0;
                                                            echo '
                                                                    <div class="item active">';
                                                            if (mysqli_num_rows($res) > 0) {
                                                    while ($ro = mysqli_fetch_array($res)) {
                                                        $book="";
                                                        if(isset($_SESSION["user_id"]) && !empty($_SESSION["user_id"]))
{
                                                            $book="book_item.php?id=".$ro["item_id"]."";
                                                        }
                                                        else
                                                        {
                                                            $book="login.php";
                                                        }
                                                        if($i<3)
                                                        {
								echo '<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<a href="product_details.php?id='.$ro["item_id"].'"><img src="cms/Images/'.$ro["image"].'" alt="" />
													<h2>&#8377 '.$ro["new_price"].'</h2>
                                                                                                        <h3 style="color: darkblue">'.$ro["name"].'</h3></a>
													<a href="'.$book.'"><button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Book</button></a>
												</div>
											</div>
										</div>
                                                                        </div>';
                                                        }
                                                        else
                                                        {
                                                            echo '</div>
                                                                       <div class="item">';
                                                            echo '<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<a href="product_details.php?id='.$ro["item_id"].'"><img src="cms/Images/'.$ro["image"].'" alt="" />
													<h2>&#8377 '.$ro["new_price"].'</h2>
                                                                                                        <h3 style="color: darkblue">'.$ro["name"].'</h3></a>
													<a href="'.$book.'"><button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Book</button></a>
												</div>
											</div>
										</div>
                                                                          </div>';
                                                            $i=0;
                                                        }
                                                        $i++;
                                                        
                                                            }
                                                            echo '</div>';
                                                    }
									?>
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev" >
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
					
				</div>
			</div>
		</div>
	</section>
	
	<?php
require_once 'templates/footer.php';
?>