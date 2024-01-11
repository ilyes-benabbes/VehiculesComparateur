    <head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-...">
    <link rel="stylesheet" type="" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" type="" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    </head>





<?php
class AdminDashboardPage{

    public function show(){
        $this->showCategories();
    }
    function showCategories(){
                 echo "<div class='adminDashboard '>";
        echo "<div class='adminDashboardCategories row g3'>";
    
        echo "<a href='admin/brands'>";
        echo "<p>Brands</p>";
        echo "<img src='./public/images/commonPictures/brands.jpg' alt='image' width=50     >";
        echo "</a>";

        echo "<a href='admin/reviews'>";
        echo "<p>Reviews</p>";
        echo "<img src='./public/images/commonPictures/reviews.svg' alt='image' width=50     >";
        echo "</a>";

        echo "<a href='admin/news'>";
        echo "<p>News</p>";
        echo "<img src='./public/images/commonPictures/news.svg' alt=''  width=50 >";
        echo "</a>";
        
        echo "<a href='admin/users'>";
        echo "<p>Users</p>";
        echo "<img src='./public/images/commonPictures/users.svg' alt='image' width=50     >";
        echo "</a>";
        echo "</div>";
        echo "</div>";

    }
}