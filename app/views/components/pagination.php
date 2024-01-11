a<?php

class Pagination {
    private $totalItems;
    private $totalItemsToRender;
    private $itemsPerPage;
    private $currentPage;

    public function __construct($totalItems, $itemsPerPage, $currentPage) {
        $this->totalItems = count($totalItems);
        $this->totalItemsToRender = $totalItems;
        $this->itemsPerPage = $itemsPerPage;
        $this->currentPage = $currentPage;
    }


    public function render() {
        
        $totalPages = ceil($this->totalItems / $this->itemsPerPage);
    
        // Basic pagination HTML
        $output = '<ul class="pagination">';
        
        // Previous page button
        
        // Display items for the current page
        $startItem = ($this->currentPage - 1) * $this->itemsPerPage;
        $endItem = min($startItem + $this->itemsPerPage, $this->totalItems);
        
        for ($i = 0; $i < count($this->totalItemsToRender); $i++) {
            // echo '<li>' . $this->totalItemsToRender[$i] . '</li>';
            // if item is out of this page range make it hidden
            if($i < $startItem || $i >= $endItem){
                echo '<div class=" pageItem pageItem'.$i.'" style="display:none;" >'; 
                // $this->totalItemsToRender[$i]->render();
                echo '</div>';
                continue;
            }
            echo '<div class="row border g3 pageItem"  >'; 
            // $this->totalItemsToRender[$i]->render();
            echo '</div>';
            
        }
        
        $output .=
        '<div class="row border g3" ';
        
        if ($this->currentPage > 0) {
            echo "----------------------";
            $output .= '<li><a id="previousPage" ' . '">Previous</a></li>';
        }
        // Page links
        for ($i = 1; $i <= $totalPages; $i++) {
            $output .= '<li  ' . ($i == $this->currentPage ? 'class="active paginationLink"' : 'class="paginationLink"') . '><a ' . '">' . $i . '</a></li>';
        }
    
        // Next page button
        if ($this->currentPage < $totalPages) {

            $currentUrl = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';

            // Parse the URL to get its components
            $urlParts = parse_url($currentUrl);
            
            // Parse the query string to get its parameters
            parse_str(isset($urlParts['query']) ? $urlParts['query'] : '', $queryParams);
            
            // Modify the 'page' parameter
            $queryParams['page'] = $this->currentPage + 1;
            
            // Rebuild the query string
            $newQueryString = http_build_query($queryParams);
            
            // Build the new URL
            $newUrl = $urlParts['path'] . '?' . $newQueryString;
            
            // Output the link with the updated 'page' parameter
            $output .= '<li><a id="nextPage"] '  . '">Next</a></li>';




        }
        $output .= '</div>';
    
        $output .= '</ul>';
        echo $output;
    }
    
}
