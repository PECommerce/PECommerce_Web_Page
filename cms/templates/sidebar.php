<?php
$uri_path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$uri_segments = explode('/', $uri_path);

?>

<div id="sidebar">
    <ul style="font-size: 15px;">

        <li class="<?php echo (isset($uri_segments[3]) && ($uri_segments[3] == 'users.php' || $uri_segments[3] == 'user_add.php' || $uri_segments[3] == 'user_edit.php' || $uri_segments[3] == 'user_view.php')) ? 'active' : '' ?>"><a href=<?php echo ROOT . "users.php"; ?>><i class=""></i> <span>Users</span></a> </li> 
        <li class="<?php echo (isset($uri_segments[3]) && ($uri_segments[3] == 'items.php' || $uri_segments[3] == 'item_add.php' || $uri_segments[3] == 'item_edit.php' || $uri_segments[3] == 'item_view.php')) ? 'active' : '' ?>"><a href=<?php echo ROOT . "items.php"; ?>><i class=""></i> <span>Items</span></a> </li> 
        <li class="<?php echo (isset($uri_segments[3]) && ($uri_segments[3] == 'booking.php' || $uri_segments[3] == 'book_view.php')) ? 'active' : '' ?>"><a href=<?php echo ROOT . "booking.php"; ?>><i class=""></i> <span>Bookings</span></a> </li> 

    </ul>
</div><!--main-container-part-->
