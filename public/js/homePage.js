$(document).ready(function () {
 // this function to  make clicking on logos , take you into the brand.
    $("img").click(function () {
      $.ajax({
        url: "app/controllers/homeController.php",
        type: "POST",
        data: { action: "showImages" },
        success: function (response) {
        
            console.log("success");
        },
        error: function (error) {
            // Handle errors
            console.error("Error", error);
        },
    });
    



    });
  });

