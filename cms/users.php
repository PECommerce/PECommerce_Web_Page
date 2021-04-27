<?php include_once 'templates/header.php'; ?>
<?php include_once 'templates/sidebar.php'; ?>
<?php

$item_per_page = 10;

if(isset($_GET["page"]) && !empty($_GET["page"])){
    $current_page = $_GET["page"];
}else{
    $current_page = 1;
}

if($_SESSION["user_type"]=="Admin")
    $where =" where tbl_users.username != 'admin' ";
else 
    $where=" where tbl_users.user_id = ".$_SESSION["user_id"]; 
if(isset($_GET["filter_name"]) && !empty($_GET["filter_name"])){
    $where .= "and (tbl_users.username like '%".$_GET["filter_name"]."%')" ;
}
if(isset($_GET["field_start_date"]) && !empty($_GET["field_start_date"]) && isset($_GET["field_end_date"]) && !empty($_GET["field_end_date"])){
    
    $sdate = date("Y-m-d H:i:s",strtotime($_GET["field_start_date"]));
    $edate = date("Y-m-d 23:59:59",strtotime($_GET["field_end_date"]));
    
    $where.= "and created >= '".$sdate."' and created <= '".$edate."'"; 
}
    $sql = "select * from tbl_users ".$where;

    $res = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($res);
    
    $total_pages = ceil($numRows/$item_per_page);
    $offset = ($current_page-1)*$item_per_page;
    $sql .= " Limit ".$offset.", ".$item_per_page."";
    
    $result = mysqli_query($conn, $sql);
    $page_url = $_SERVER["PHP_SELF"];
    
?>
<div id="content">
    <div id="content-header">
        <div id="breadcrumb"> <a href="users.php" title="Go to Users" class="tip-bottom"><i class="icon-home"></i> Users</a></div>
        <h1>Users</h1>
    </div>
    <div class="container-fluid">
        <hr>    
        <div class="row-fluid text-right"><button class="btn btn-primary" <?php if($_SESSION["user_type"]!="Admin") echo'style="display: none;"';  ?> onclick="document.location.href = 'user_add.php'"><a href="user_add.php" style="color:#fff">Add Users</a></button></div>    
        <div class="row-fluid">
            <div class="span12">
                <div class="control-group" <?php if($_SESSION["user_type"]!="Admin") echo'style="display: none;"';  ?>>

                    <fieldset class="scheduler-border span12" style="border: 2px solid #f0f0f0;padding:0 18px 0 0;margin: 5px 0">
<form>                  <div class="span2 m-wrap input-append date datepicker" data-date="12-02-2012" >
		<label><strong>From Date :</strong></label>
                <input placeholder="mm/dd/yyyy" data-date-format="<?php echo date("m/d/Y"); ?>" value="<?php echo $_GET["field_start_date"] ?>" style="height:35px" class="span11  m-wrap" type="text" name="field_start_date" id="field_start_date">
		<span class="add-on"  style="height:25px; text-align: center;" ><i class="fa fa-calendar"  style="font-size:22px; "></i></span>
	    </div> 
	    <div class="span2 m-wrap input-append date datepicker" data-date="12-02-2012">		     
		<label><strong>To Date :</strong></label>
		<input placeholder="mm/dd/yyyy"  data-date-format="<?php echo date("m/d/Y"); ?>" value="<?php echo $_GET["field_end_date"] ?>" style="height:35px" class="span11  m-wrap" type="text" name="field_end_date" id="field_end_date">
		<span class="add-on"  style="height:25px; text-align: center;" ><i class="fa fa-calendar"  style="font-size:22px"></i></span>			
	    </div>
                        <div class="span2 m-wrap">
                            
                            <label><strong>Username :</strong></label>
                            <input class="span11 m-wrap"  type="text" placeholder="Search" name="filter_name" id="filter_name"  value = "<?php echo $_GET["filter_name"] ?>" style="height:35px;width:100%">
                           
                        </div>

                        <div class="span1 m-wrap" style="margin: 3px;">		     
                            <label>&nbsp;</label>
                            <input class="btn btn-primary" id="filter_election_list" type="submit" value="Search" name="btnSubmit"></input>	
                        </div>
                            </form>

                    </fieldset>	
                </div>
                
                <div class="widget-box">
                    <div class="widget-title"> <span class="icon" id="filtericon"><i class="fa fa-th"></i></span>
                        <h5>Users Listing</h5>
                    </div>
                    <div class="widget-content nopadding">
                        <table class="table table-bordered data-table">
                            <thead>

                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Username</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>Email id</th>
                                    <th>Contact No.</th>
                                    <th>Address</th>
                                    <th>Date Time Created</th>
                                    <th>User Type</th>
                                    <th>Is Active</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody id="filtered_news"> 
<?php
$inc = ($current_page-1)*$item_per_page+1;
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {

        /*$collect="select * from country where country_id=".$row["Country_ID"];
        $k=mysqli_query($conn,$collect);
        $co=mysqli_fetch_array($k);*/
      
        if($_SESSION["user_type"]=="Admin")
    $ale ="Are you sure you want to delete this user? This will also delete all the booking and items related to him.";
else 
    $ale="Are you sure you want to delete your account. It will delete all your data, booking and items."; 

if($_SESSION["user_type"]=="Admin")
{
        echo '<tr class="rows" user_id="row'.$row["user_id"].'">
        <td>' . $inc++ . '</td>
        <td>' . $row["username"] . '</td>
            <td>' . $row["first_name"] . '</td>
                <td>' . $row["last_name"] . '</td>
        <td>' . $row["email_id"] . '</td>
        <td>' . $row["contact"] . '</td>
        <td>' . $row["address"] . '</td>
        <td>' . $row["created"] . '</td>
        <td>'.$row["user_type"].'</td>';
        if($row["user_id"]!=$_SESSION["user_id"])
           {
           if ($row["active"] == 1) {
           echo '<td id="published' . $row["user_id"] . '"> <div class="onoffswitch">
        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch' . $row["user_id"] . '" checked onclick="updateUserStatus(\'' . ROOT . 'ajax.php?s=0&sid=' . $row["user_id"] . '\')">
        <label class="onoffswitch-label" for="myonoffswitch' . $row["user_id"] . '">
            <span class="onoffswitch-inner"></span>
            <span class="onoffswitch-switch"></span>
        </label>
    </div></td>';
                                        } else {
                                            echo '<td id="published' . $row["user_id"] . '"> <div class="onoffswitch">
        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch' . $row["user_id"] . '" onclick="updateUserStatus(\'' . ROOT . 'ajax.php/?s=1&sid=' . $row["user_id"] . '\')">
        <label class="onoffswitch-label" for="myonoffswitch' . $row["user_id"] . '">
            <span class="onoffswitch-inner"></span>
            <span class="onoffswitch-switch"></span>
        </label>
    </div></td>';
                                        }
           }
           else{ 
               echo '<td>Active</td>';
           }
        echo '<td class="center"><div class="btn-group"><button data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Action <span class="caret"></span></button><ul class="dropdown-menu"><li><a  href="user_edit.php?id=' . $row["user_id"] . '">Edit</a></li><li><a  href="user_view.php?id=' . $row["user_id"] . '">View</a></li><li><a class="res_del" href="user_delete.php?id=' . $row["user_id"] . '" onclick="return confirm(\''.$ale.'\');">Delete</a></li><li><a class="res_del" href="deactivate.php?id=' . $row["user_id"] . '" onclick="return confirm(\'Are you sure you want to deactivate this account.\');">Deactivate</a></li></ul></div></td>
        </tr>';
}
 else {
    echo '<tr class="rows" user_id="row'.$row["user_id"].'">
        <td>' . $inc++ . '</td>
        <td>' . $row["username"] . '</td>
            <td>' . $row["first_name"] . '</td>
                <td>' . $row["last_name"] . '</td>
        <td>' . $row["email_id"] . '</td>
        <td>' . $row["contact"] . '</td>
        <td>' . $row["address"] . '</td>
        <td>' . $row["created"] . '</td>
        <td>'.$row["user_type"].'</td>';
           if($row["user_id"]!=$_SESSION["user_id"])
           {
         if ($row["active"] == 1) {
           echo '<td id="published' . $row["user_id"] . '"> <div class="onoffswitch">
        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch' . $row["user_id"] . '" checked onclick="updateUserStatus(\'' . ROOT . 'ajax.php?s=0&sid=' . $row["user_id"] . '\')">
        <label class="onoffswitch-label" for="myonoffswitch' . $row["user_id"] . '">
            <span class="onoffswitch-inner"></span>
            <span class="onoffswitch-switch"></span>
        </label>
    </div></td>';
                                        } else {
                                            echo '<td id="published' . $row["user_id"] . '"> <div class="onoffswitch">
        <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch' . $row["user_id"] . '" onclick="updateUserStatus(\'' . ROOT . 'ajax.php/?s=1&sid=' . $row["user_id"] . '\')">
        <label class="onoffswitch-label" for="myonoffswitch' . $row["user_id"] . '">
            <span class="onoffswitch-inner"></span>
            <span class="onoffswitch-switch"></span>
        </label>
    </div></td>';
                                        }
           }
           else{ 
               echo '<td>Active</td>';
           }
           


        echo '<td class="center"><div class="btn-group"><button data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Action <span class="caret"></span></button><ul class="dropdown-menu"><li><a  href="user_edit.php?id=' . $row["user_id"] . '">Edit</a></li><li><a  href="user_view.php?id=' . $row["user_id"] . '">View</a></li><li><a class="res_del" href="user_delete.php?id=' . $row["user_id"] . '" onclick="return confirm(\''.$ale.'\');">Delete</a></li></ul></div></td>
        </tr>';
}
    }
}
?>
                                </tbody>
                        </table>
                        </div>
                </div>
                        <?php echo cmspaging($item_per_page, $current_page, $total_records, $total_pages, $page_url); ?>
                        <!--<p id="paging"><a href="http://lh-webcms.htmedia.in/mongocms/news/newslisting/20" data-ci-pagination-page="2" rel="prev">&lt;</a><a href="http://lh-webcms.htmedia.in/mongocms/news/newslisting" data-ci-pagination-page="1" rel="start">1</a><a href="http://lh-webcms.htmedia.in/mongocms/news/newslisting/20" data-ci-pagination-page="2">2</a><strong>3</strong><a href="http://lh-webcms.htmedia.in/mongocms/news/newslisting/60" data-ci-pagination-page="4">4</a><a href="http://lh-webcms.htmedia.in/mongocms/news/newslisting/80" data-ci-pagination-page="5">5</a><a href="http://lh-webcms.htmedia.in/mongocms/news/newslisting/60" data-ci-pagination-page="4" rel="next">&gt;</a><a href="http://lh-webcms.htmedia.in/mongocms/news/newslisting/980" data-ci-pagination-page="50">Last ›</a></p>-->
                    
            </div>
        </div>
    </div>
</div>
<?php 
include_once 'templates/footer.php'; ?>


<script>
function updateUserStatus(url) {
    $.get(url, successUserdata);
}
function successUserdata(res) {
        var returnedData = JSON.parse(res);
    if (returnedData.status == "1") {
        $("#published" + returnedData.id).html('<div class="onoffswitch"><input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" checked id="myonoffswitch' + returnedData.id + '" onclick="updateUserStatus(\'./ajax.php?s=0&sid=' + returnedData.id + '/\')"><label class="onoffswitch-label" for="myonoffswitch' + returnedData.id + '"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label></div>');
    } else {
        $("#published" + returnedData.id).html('<div class="onoffswitch"><input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch' + returnedData.id + '" onclick="updateUserStatus(\'./ajax.php?s=1&sid=' + returnedData.id + '/\')"><label class="onoffswitch-label" for="myonoffswitch' + returnedData.id + '"><span class="onoffswitch-inner"></span><span class="onoffswitch-switch"></span></label></div>');
    }
    //$("#myonoffswitch"+returnedData.id).removeProp("disabled");
}
</script>
