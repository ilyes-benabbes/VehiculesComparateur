$(document).ready(function () {

  alert("here");
  //! BrandsIds :
  let brandsIds = 1;

  //! here the defitino of all the functions
  function attachAddFormOnImageClick() {
    $(".addFormBox").click(function () {
      let compareButton = $("#compareButton");
      compareButton.prop("disabled", true);
      // alert("should be disabled now !");
      var clickedElement = $(this); // Save the clicked element
      $.ajax({
        url: "app/api/api.php",
        type: "POST",
        data: { action: "addForm" },
        success: function (form) {
          console.log("form.class", $(form).attr("class"));
          $(form).attr("id", "brandSelect" + brandsIds);
          clickedElement.replaceWith(form);
          aBrandIsSelected();
        },
        error: function (error) {
          // Handle errors
          console.error("Error", error);
        },
      });
    });
  }

  function attachBrandSelection() {
    $(".BrandSelect").each(function () {
      $(this).attr("id", "brandSelect" + brandsIds);
      brandsIds++;
    });
  }

  function aBrandIsSelected() {
    $("select.SelectBrand").each(function () {
      const arr = {
        BrandSelect: "",
        ModelSelect: "",
        VersionSelect: "",
        YearSelect: "",
      };
      const containerForm = $(this).parent().parent();

      const selectClicked = $(this);
      const selectType = selectClicked.attr("class");
      const selectedValue = selectClicked.val();

      selectClicked.change(() => {
        let newInput = {};
        newInput[selectType] = selectedValue;

        // select all the select inside the containerForm

        const allSelect = containerForm.find("select");

        allSelect.each(function () {
          if ($(this).attr("class") != undefined) {
            const selectType = $(this).attr("class");
            const selectedValue = $(this).val();
            newInput[selectType] = selectedValue;
            // console.log('newInput', newInput);
          }
        });

        $.ajax({
          url: "app/api/api.php",
          type: "POST",
          data: {
            action: "getNextSelect",
            payload: newInput,
            type: selectType,
          },
          success: function (nextSelect) {
            const nextSelectWrap = $(nextSelect);
            const nextNodes = selectClicked.parent().nextAll();
            nextNodes.remove();
            nextSelectWrap.insertAfter(selectClicked.parent());
            aBrandIsSelected();
            checkIfComparisonIsValid();
          },
          error: function (error) {
            // Handle errors
            console.error("Error", error);
          },
        });
      });
    });
  }

  function slidingEffect() {
    const slidesContainer = $(".slidesContainer");
    const slideWidth = $(".comparisonCard").outerWidth();
    let currentIndex = 0;

    // Handle right arrow click
    $(".rightArrow").click(function () {
      if (currentIndex < slidesContainer.children().length - 1) {
        currentIndex++;
        updateSlider();
      }
    });

    // Handle left arrow click
    $(".leftArrow").click(function () {
      if (currentIndex > 0) {
        currentIndex--;
        updateSlider();
      }
    });

    function updateSlider() {
      const newTransformValue = -currentIndex * slideWidth;
      slidesContainer.css(
        "transform",
        "translateX(" + newTransformValue + "px)"
      );
    }
  }

  function compareButton() {
    // button.prop('disabled', true);
    let button = $("#compareButton");
    $("#compareButton").click(function () {
      // it is clicked only if enabled

      let listOfModelsIds = ["1", "2", "3", "4"];
      const allSelect = $(".SelectModel");
      allSelect.each(function () {
        const selectedValue = $(this).val();
        listOfModelsIds.push(selectedValue);
      });

      console.log("listofModelsIds", listOfModelsIds);

      $.ajax({
        url: "app/api/api.php",
        type: "POST",
        data: { action: "compare", payload: listOfModelsIds },
        success: function (tableOfComparison) {
          let container = $(".formsContainer");
          // container.hide();
          container.empty();
          container.html(tableOfComparison);
        },
      });
    });
  } // fin du compareButton func

  function checkIfComparisonIsValid() {
    let button = $("#compareButton");
    let valid = true;
    let listOfModelsIds = [];
    let forms = $(".comparisonForm");
    forms.each(function () {
      const allSelect = $(this).find("select");
      allSelect.each(function () {
        if ($(this).attr("class") == "SelectModel") {
          listOfModelsIds.push($(this).val());
        }
        if ($(this).val() == null || allSelect.length != 4) {
          valid = false;
        }
      });
    });

    if (
      valid == true &&
      new Set(listOfModelsIds).size == listOfModelsIds.length
    ) {
      console.log("listOfModelsIds", listOfModelsIds);
      button.prop("disabled", false);
    } else {
      // button.prop('disabled', true);
    }
  } //  end of 

  function reviewButton() {
    let button = $("#reviewButton");
    button.click(function () {});
  } // end of function

  function handleReviewsPageOfSelectedBrand() {
    let selectedBrandsToReview = $(" .brandsToReview  .brandImage");
    selectedBrandsToReview.each(
      function () {
        $(this).click(function () {
          let brandId = $(this).attr("id");
          $.ajax({
            url: "app/api/api.php",
            type: "POST",
            data: { action: "brandSelectedForReviews", payload: brandId },
            success: function (reviews) {
              let parent = selectedBrandsToReview.parent().parent();
              parent.nextAll().empty();

              // create a container and insert it after the parent of selctedBrandsToReview
              let container = $(
                '<div class="carsToReview"> please select a car to review : </div>'
              );
              let reviewCarButton = $(
                '<button id="reviewCarButton"> review selected car </button>'
              );
              container.append(reviews);
              container.append(reviewCarButton);
              container.insertAfter(selectedBrandsToReview.parent().parent());
              handleCarToReviewClick();
            },
          });
        });
      } // end of fun)
    );
  }

  function handleCarToReviewClick() {
    let reviewButton = $("#reviewCarButton");
    reviewButton.click(function () {
      let select = $(" .carsToReview  select");
      let carId = select.val();
      if (carId != null) {
        $.ajax({
          url: "app/api/api.php",
          type: "POST",
          data: { action: "carSelectedForReviews", payload: carId },

          success: function (res) {
            console.log("res", res);
            location.href = location.href + "?carId=" + carId + "&page=1";
          },

        });
      }
    });
  }

  var itemsPerPage = 5;
  var totalItems = 25;
  var totalPages = totalItems / itemsPerPage;
  var currentPage = 1;

  // get number of items from url or i don't know
  // after that do the rest

  // Function to show/hide items based on the current page
  function updatePageItems() {
    var startItem = (currentPage - 1) * itemsPerPage;
    var endItem = Math.min(startItem + itemsPerPage, totalItems);
    if (currentPage != 1) $(".pageItem").hide();
    for (let i = startItem; i < endItem; i++) {
      $(".pageItem" + i).show();
    }
  }

  // Initial update
  updatePageItems();

  // Pagination click event for next page
  $("#nextPage").on("click", function (e) {
    e.preventDefault();
    if (currentPage < totalPages) {
      currentPage++;
      updatePageItems();
    }
  });

  // Pagination click event for previous page
  $("#previousPage").on("click", function (e) {
    e.preventDefault();
    if (currentPage > 1) {
      currentPage--;
      updatePageItems();
    }
  });


function signUp(){
  let signUpButton = $("#signUpButton");
  signUpButton.click(function(e){
    e.preventDefault();

let gender =        $(".genderSelect").val() ;
let firstName =     $("#first\\ name").val() ;
let lastName =      $("#last\\ name").val() ;
let email =         $("#email").val() ;
let birthDate =         $("#birth\\ date").val() ;
let password =      document.getElementById("password").value;
let passwordConfirmation =document.getElementById("confirm password").value;
// check that all field are not null 
    if(password == passwordConfirmation  && firstName != "" && lastName != "" && birthDate != "" && gender !="" && email != "" && password != "" && passwordConfirmation != ""){
   
      $.ajax({
        url: "app/api/api.php",
        type: "POST",
        data: { action: "signUp", payload : {firstName : firstName ,birthDate ,   lastName : lastName , email : email  , gender : gender, password : password} },
        success: function (res) {
          var currentUrl = window.location.href;
          var lastSlashIndex = currentUrl.lastIndexOf('/');

          var newUrl = currentUrl.substring(0, lastSlashIndex + 1) + 'logIn';
          window.location.href = newUrl;
        },
  
      });
    }
    else {
      alert("passwords don't match");
    }
  })
}

function logIn(){
  let logIn = $("#logInButton");
  logIn.click(function(e){
    e.preventDefault();

let email =        $("#email").val() ;
let password =        $("#password").val() ;
if (email !="" && password != ""){
  $.ajax({
    url: "app/api/api.php",
    type: "POST",
    data: { action: "logIn", payload : {email : email ,  password : password} },
    success: function (response) {
      var responseobj = $.parseJSON(response);
      if (responseobj.id) {
    
          document.location.href = "/VehiculesComparateur (ProjetWeb)/";
        
      } else {
        alert("Email or password wrong!");
        $("#loginAlert").empty();
        $("#loginAlert").append(
          '<div class="px-3 py-3 rounded-3 btn-red w-100 border-1">Email or password wrong!</div>'
        );
      }
    },
      

  });
  
}

}
  )}
  //!************************
function checkLogged() {
  if (!document.cookie.includes('logedIn_user')) {

      return false;
    
  } else {

    return true;
} }


$('.rating i').click(function () {
  // Get the selected star's data-star value
  const selectedStar = $(this).data('star');

  // Remove color from all stars
  $('.rating i').removeClass('selected');

  // Color stars up to the selected one
  for (let i = 1; i <= selectedStar; i++) {
    $('.rating i[data-star="' + i + '"]').addClass('selected');
  }
});

//!************************

  function reviewCar(){
     let reviewButton = $(".reviewCarButton");
      reviewButton.click(function(e){
        if (!checkLogged()) {
          alert("please log in to review a car");
            let container = $('<div class="topNotificationError"> please log in to review a car : </div>');
            container.insertAfter(reviewButton.parent().parent());
            container.fadeOut(1900);
          
        } else {

        e.preventDefault();
        let carId = reviewButton.attr('id'); 
        reviewButton.replaceWith('<form id="reviewForm" action="app/api/api.php" method="POST"> <label for="review">Review:</label> <input type="text" id="review" name="review" rows="4" cols="50" required></input> <label for="rating">Rating (1-5):</label> <input type="number" id="rating" name="rating" min="1" max="5" required> <input type="hidden" name="carId" value="'+carId+'"> <input type="hidden" name="action" value="reviewCar"> <button id="submitReviewButton" value="Submit"> sumbit </form>');

        let submitReviewButton = $("#submitReviewButton");
        submitReviewButton.click(function(e){
          e.preventDefault();
          let review = $("#review").val();
          let rating = $("#rating").val();

          if (review != "" && rating != "" && carId != ""){
            $.ajax({
              url: "app/api/api.php",
              type: "POST",
              data: { action: "reviewCar", payload : {review : review ,  rating : rating , carId : carId} },
              success: function (res) {
                console.log("res", res);
                alert('review added successfully');
              },
        
            });
          }
          else {
            alert('please fill all the fields');
          }
        })


      }

        


   
        

  



      })
        
    
        





        // $.ajax({
        //   url: "app/api/api.php",
          // type: "POST",
          // data: { action: "carSelectedForReviews" , payload : carId },
          // success: function (reviews) {
          //   let parent = selectedCarsToReview.parent().parent();
          //   parent.nextAll().empty();
  
          //   // create a container and insert it after the parent of selctedBrandsToReview
          //   let container = $('<div class="reviewsContainer"> please select a car to review : </div>');
          //   container.append(reviews);
  
          //   container.insertAfter(selectedCarsToReview.parent().parent());
  
          // }


  } //end of method

function initializeDataTable(){
  $("#example").DataTable();
}




//!************************

  function addToFavorites(){
    let addToFavorites = $(".addToFavorite");
    addToFavorites.click(function(e){
      
      e.preventDefault();
      let carId = addToFavorites.attr('id');
      console.log('carId', carId)
      $.ajax({
        url: "app/api/api.php",
        type: "POST",
        data: { action: "addToFavorites", payload : carId },
        success: function (res) {
          console.log("res", res);
     
        },

      });
    })
  }
  


  $(".newsDetails").click(function (e) {
    e.preventDefault();
    let newsId = $(this).attr("id");
    window.location.href = window.location.href + "/details/" + newsId; });



  //! here the calling of all the functions
  attachBrandSelection();
  checkIfComparisonIsValid();
  attachAddFormOnImageClick();
  aBrandIsSelected();
  compareButton();
  slidingEffect();
  reviewButton();
  signUp();
  logIn();
  addToFavorites();
  reviewCar();  
  // handleBrandToReviewClick();
  handleReviewsPageOfSelectedBrand();
  handleCarToReviewClick();
  // handleReviewsPageOfSelectedCar( );
  // removeForm();
  //! functions of admin pages
  initializeDataTable();
  handleDeleteButton();
  handleAddBrandButton();
  handleUpdateButton();
  handleEditButton();
  //*************************** */
  function handleDeleteButton() {
    let deleteButton = $(".deleteButton");
    deleteButton.click(function () {
      let carId = $(this).attr("id");
      $.ajax({
        url: "app/api/api.php",
        type: "POST",
        data: { action: "deleteCar", payload: carId },
        success: function (res) {
          console.log("res", res);
          location.reload();
        },
      });
    });
  }
  //*************************** */
  function handleAddBrandButton() {
    let addButton = $(".addBrandButton");
    addButton.click(function () {
      alert("hh");
      // collect all the names and values of the inputs 
      $("input").each(function () {
        let inputName = $(this).attr("name");
        let inputValue = $(this).val();
        console.log("inputName", inputName);
        console.log("inputValue", inputValue);
      });

   
      let brandId = $(this).attr("id");

      
      $.ajax({
        url: "app/api/api.php",
        type: "POST",
        data: { action: "addBrand" , payload : {brandId : brandId} },
        success: function (res) {
          console.log("res", res);
          location.reload();
        },
      });
    });
  }
  //*************************** */

  function handleUpdateButton() {
    let updateButton = $(".updateButton");
    updateButton.click(function () {
      let carId = $(this).attr("id");
      $.ajax({
        url: "app/api/api.php",
        type: "POST",
        data: { action: "updateCar", payload: carId },
        success: function (res) {
          console.log("res", res);
          location.reload();
        },
      });
    });
  }
  //*************************** */

  function handleEditButton() {
    let editButton = $(".editButton");
    editButton.click(function () {
      let carId = $(this).attr("id");
      $.ajax({
        url: "app/api/api.php",
        type: "POST",
        data: { action: "editCar", payload: carId },
        success: function (res) {
          console.log("res", res);
          location.reload();
        },
      });
    });
  }



});
