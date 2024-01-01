 <?php

 class Menu {
    function render(){
$request = isset($_GET['url']) ? $_GET['url'] : '';

    $menu =
        '
<div class="row g3 border menu">
<a href="' .'news">News</a>
<a href="'.  'brands">Brands</a>
<a href="'.  'buyingGuide">Buying guide</a>
<a href="'.  'reviews">Reviews</a>
<a href="'.  'contact">Contact us</a>
<a href="'.  'comparator">Comparator</a>

</div>
';

    echo $menu;}
 }