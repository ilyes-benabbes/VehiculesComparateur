 <?php
$request = isset($_GET['url']) ? $_GET['url'] : '';

    $menu =
        '
<div class="row g3 border">
<a href="'.  $request .'news">News</a>
<a href="'.  $request .'brands">Brands</a>
<a href="'.  $request .'buyingGuide">Buying guide</a>
<a href="'.  $request .'reviews">Reviews</a>
<a href="'.  $request .'contact">Contact us</a>
<a href="'.  $request .'comparator">Comparator</a>

</div>
';

    echo $menu;
