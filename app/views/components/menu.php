 <?php

 class Menu {
    function render(){

        if (isset($_COOKIE['logedIn_user'])){
            $menu =
            '
            <div class="frow g3 border menu">
            <a href="' .'news">News</a>
            <a href="'.  'brands">Brands</a>
            <a href="'.  'buyingGuide">Buying guide</a>
            <a href="'.  'reviews">Reviews</a>
            <a href="'.  'contact">Contact us</a>
            <a href="'.  'comparator">Comparator</a>
            <a href="'.  'myProfile">My profile</a>
            </div>
            ';
        }else {

    $menu =
        '
<div class="frow g3 border menu">
<a href="' .'news">News</a>
<a href="'.  'brands">Brands</a>
<a href="'.  'buyingGuide">Buying guide</a>
<a href="'.  'reviews">Reviews</a>
<a href="'.  'contact">Contact us</a>
<a href="'.  'comparator">Comparator</a>
<a href="'.  'signUp">signUp</a>
<a href="'.  'logIn">Log In</a>


</div>
';
        }

    echo $menu;}
 }