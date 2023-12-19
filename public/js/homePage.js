$(document).ready(function () {
  //! BrandsIds : 
  let brandsIds = 1;
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

  // $(".button").each(function(event){
  //   // alert(brandsIds);
  //   $(this).click(function (event){
  //     alert("hellothere");
  //     event.preventDefault();
      
  //     brandsIds++; 

  //   })
  // })

    //! here the defitino of all the functions
    
function attachAddFormOnImageClick(){
  $(".addFormImage").click(function(){
    $.ajax({
      url: "app/controllers/homeController.php",
      type: "POST",
      data: { action: "addForm" },
      success: function (response) {
        console.log("success" , response);
      
      },
      error: function (error) {
          // Handle errors
          console.error("Error", error);
      },
  });    



        //? add a from box , send the request to the controller i think 
        //? add an id to it 
  });

}

    
    function attachBrandSelection() {
      $('.Brands').each(function() {
        $(this).attr('id', 'brandSelect' + brandsIds);
          brandsIds++;
      });
  }
    
    //! here the call of all the functions
    // Call the function to attach the click event handler
    attachBrandSelection();
    attachAddFormOnImageClick()
  });

