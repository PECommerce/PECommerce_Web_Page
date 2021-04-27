<?php
function cmspaging($item_per_page, $current_page, $numRows, $total_pages, $page_url)
{
    $pagination = '';
    if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages){ //verify total pages and current page number
        $pagination .= '<p id="paging">';
        
        $right_links    = $current_page + 3;
        $previous       = $current_page - 1; //previous link 
        $next           = $current_page + 1; //next link
        $first_link     = true; //boolean var to decide our first link
        
        if($current_page >= 1){
			$previous_link = ($previous==0)?1:$previous;
            $pagination .= '<a href="'.$page_url.'?page=1" title="First">«</a>';
            $pagination .= '<a href="'.$page_url.'?page='.$previous_link.'" title="Previous"><</a>'; //previous link
                for($i = ($current_page-2); $i < $current_page; $i++){ //Create left-hand side links
                    if($i > 0){
                        $pagination .= '<a href="'.$page_url.'?page='.$i.'">'.$i.'</a>';
                    }
                }   
            $first_link = false; //set first link to false
        }
        
            $pagination .= '<a href="'.$page_url.'?page='.$current_page.'" style="background-color: darkblue; color: white;">'.$current_page.'</a>';
                
        for($i = $current_page+1; $i < $right_links ; $i++){ //create right-hand side links
            if($i<=$total_pages){
                $pagination .= '<a href="'.$page_url.'?page='.$i.'">'.$i.'</a>';
            }
        }
        if($current_page <= $total_pages){ 
            $i = $current_page+1;
				$next_link = ($i > $total_pages)? $total_pages : $i;
                $pagination .= '<a href="'.$page_url.'?page='.$next_link.'" >></a>'; //next link
                $pagination .= '<a href="'.$page_url.'?page='.$total_pages.'" title="Last">»</a>'; //last link
        }
        
        $pagination .= '</p>'; 
    }
    return $pagination; //return pagination links
}

