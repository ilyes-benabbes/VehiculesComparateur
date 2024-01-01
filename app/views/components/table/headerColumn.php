<?php
class HeaderColumn {
    function render($column){
        echo '<div class="headerColumn col">';
        foreach($column as $key => $value){
            echo '<div class="headerColumnItem">';
            echo $value;
            echo '</div>';
        }
        echo '</div>';
    }
}