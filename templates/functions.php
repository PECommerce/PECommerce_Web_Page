<?php
function cmspaging($item_per_page, $current_page, $numRows, $total_pages, $page_url)
{
    $pagination = '';
    if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages){ //verify total pages and current page number
        $pagination .= '<ul class="pagination">';
        
        $right_links    = $current_page + 3;
        $previous       = $current_page - 1; //previous link 
        $next           = $current_page + 1; //next link
        $first_link     = true; //boolean var to decide our first link
        
        if($current_page >= 1){
			$previous_link = ($previous==0)?1:$previous;
            $pagination .= '<li><a href="'.$page_url.'?page=1" title="First">«</a></li>';
            $pagination .= '<li><a href="'.$page_url.'?page='.$previous_link.'" title="Previous"><</a></li>'; //previous link
                for($i = ($current_page-2); $i < $current_page; $i++){ //Create left-hand side links
                    if($i > 0){
                        $pagination .= '<li><a href="'.$page_url.'?page='.$i.'">'.$i.'</a></li>';
                    }
                }   
            $first_link = false; //set first link to false
        }
        
            $pagination .= '<li class="active"><a href="'.$page_url.'?page='.$current_page.'">'.$current_page.'</a></li>';
                
        for($i = $current_page+1; $i < $right_links ; $i++){ //create right-hand side links
            if($i<=$total_pages){
                $pagination .= '<li><a href="'.$page_url.'?page='.$i.'">'.$i.'</a></li>';
            }
        }
        if($current_page <= $total_pages){ 
            $i = $current_page+1;
				$next_link = ($i > $total_pages)? $total_pages : $i;
                $pagination .= '<li><a href="'.$page_url.'?page='.$next_link.'" >></a></li>'; //next link
                $pagination .= '<li><a href="'.$page_url.'?page='.$total_pages.'" title="Last">»</a></li>'; //last link
        }
        
        $pagination .= '</ul>'; 
    }
    return $pagination; //return pagination links
}

