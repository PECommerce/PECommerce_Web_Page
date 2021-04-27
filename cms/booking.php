<?php include_once 'templates/header.php'; ?>
<?php include_once 'templates/sidebar.php'; ?>
<?php
$item_per_page = 10;

if(isset($_GET["page"]) && !empty($_GET["page"])){
    $current_page = $_GET["page"];
}else{
    $current_page = 1;
}
$order="order by created desc";
if($_SESSION["user_type"]=="Seller")
{
    $where=" where u1.user_id = ".$_SESSION["user_id"]." "; 
}
if(isset($_GET["btnSubmit"]) && !empty($_GET["btnSubmit"])){
    if(isset($where) && !empty($where))
    $where .= "and (t.name like '%".$_GET["filter_name"]."%')" ;
    else
        $where = " where (t.name like '%".$_GET["filter_name"]."%')";
}
if(isset($_GET["field_start_date"]) && !empty($_GET["field_start_date"]) && isset($_GET["field_end_date"]) && !empty($_GET["field_end_date"])){
    
    $sdate = date("Y-m-d H:i:s",strtotime($_GET["field_start_date"]));
    $edate = date("Y-m-d 23:59:59",strtotime($_GET["field_end_date"]));
    
    if(isset($where) && !empty($where))
    $where.= " and b.created >= '".$sdate."' and b.created <= '".$edate."'";
    else
        $where = " where b.created >= '".$sdate."' and b.created <= '".$edate."'";
}
    $sql = "SELECT b.booked_id,b.order_status,u.user_id,t.item_id,u.first_name,u.last_name,t.name,b.created,u1.first_name as seller_fname,u1.last_name as seller_lname,u1.user_id as sel FROM tbl_booked b 
    left join tbl_users u on(b.buyer_id=u.user_id)
    left join tbl_items t on(b.item_id=t.item_id)
    left join tbl_users u1 on(t.seller_id=u1.user_id)".$where." ".$order;
    
    $result = mysqli_query($conn, $sql);

    $numRows = mysqli_num_rows($result);
    
    $total_pages = ceil($numRows/$item_per_page);
    $offset = ($current_page-1)*$item_per_page;
    $sql .= " Limit ".$offset.", ".$item_per_page."";
    
    $result = mysqli_query($conn, $sql);
    $page_url = $_SERVER["PHP_SELF"];

?>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="booking.php" title="Go to Booking" class="tip-bottom"><i class="icon-home"></i> Bookings</a></div>
        <h1>Bookings</h1>
    </div>
    <div class="container-fluid">
        <hr>    
        <div class="row-fluid">
            <div class="span12">
               <fieldset class="scheduler-border span12" style="border: 2px solid #f0f0f0;padding:0 18px 0 0;margin: 5px 0">
<form>      <div class="span2 m-wrap input-append date datepicker" data-date="12-02-2012" >
		<label><strong>From Date :</strong></label>
                <input placeholder="mm/dd/yyyy" data-date-format="<?php echo date("m/d/Y"); ?>" value="<?php echo $_GET["field_start_date"] ?>" style="height:35px" class="span11  m-wrap" type="text" name="field_start_date" id="field_start_date">
		<span class="add-on"  style="height:25px; text-align: center;" ><i class="fa fa-calendar"  style="font-size:22px; "></i></span>
	    </div> 
	    <div class="span2 m-wrap input-append date datepicker" data-date="12-02-2012">		     
		<label><strong>To Date :</strong></label>
		<input placeholder="mm/dd/yyyy"  data-date-format="<?php echo date("m/d/Y"); ?>" value="<?php echo $_GET["field_end_date"] ?>" style="height:35px" class="span11  m-wrap" type="text" name="field_end_date" id="field_end_date">
		<span class="add-on"  style="height:25px; text-align: center;" ><i class="fa fa-calendar"  style="font-size:22px"></i></span>			
	    </div>
    <div class="span1 m-wrap" style="margin: 6px; padding-left: 40px">		     
                            <label>&nbsp;</label>
                            <input class="btn btn-primary" id="filter_election_list" type="submit" value="Search" name="btnSubmit">	
                        </div>
</form>
               </fieldset>
                
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon" id="filtericon"><i class="fa fa-th"></i></span>
                        <h5>Bookings Listing</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>

                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Item Name</th>
                                    <th>Seller Name</th>
                                    <th>Buyer Name</th>
                                    <th>Order Status</th>
                                    <th>Created</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="filtered_news"> 
<?php
$inc = ($current_page-1)*$item_per_page+1;
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $x=$row["first_name"]." ".$row["last_name"];
        $y=$row["seller_fname"]." ".$row["seller_lname"];
        $k="";
        if($row["order_status"] == "P")
        {
            $k="Pending";
        }
        else {
     
     $k="Completed";
    }
        echo '<tr class="rows" user_id="row'.$row["user_id"].'">
        <td>' . $inc++ . '</td>
        <td><a href="item_view.php?id=' . $row["item_id"] . '">' . $row["name"] . '</a></td>
        <td><a href="user_view.php?id=' . $row["sel"] . '">' . $y . '</a></td>
        <td><a href="user_view.php?id=' . $row["user_id"] . '">' . $x . '</a></td>
            <td>'.$k.'</td>
        <td>'.$row["created"].'</td>
        <td class="center"><div class="btn-group"><button data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Action <span class="caret"></span></button><ul class="dropdown-menu"><li><a  href="book_view.php?id=' . $row["booked_id"] . '">View</a></li><li><a class="res_del" href="booking_delete.php?id=' . $row["booked_id"] . '"onclick="return confirm(\'Are you sure you want to delete this booking?\');">Delete</a></li>';
        if($row["order_status"]=="P")
        {
            echo '<li><a class="res_del" href="complete.php?id=' . $row["item_id"] . '"onclick="return confirm(\'Have you delivered the order? Click yes only if order is delivered.\');">Order Completed</a></li>';
        }
        echo '</ul></div></td>
        </tr>';
    }
}
?>
                                </tbody>
                        </table>
                        </div>
                </div>
                        <?php echo cmspaging($item_per_page, $current_page, $total_records, $total_pages, $page_url); ?>
                    
            </div>
        </div>
    </div>
</div>

<?php include_once 'templates/footer.php'; ?>
