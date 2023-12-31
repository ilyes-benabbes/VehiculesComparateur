$(document).ready(function () {
  //! BrandsIds : 
  let brandsIds = 1;
 // this function to  make clicking on logos , take you into the brand.
    // $("img").click(function () {
    //   $.ajax({
    //     url: "app/controllers/homeController.php",
    //     type: "POST",
    //     data: { action: "showImages" },
    //     success: function (response) {
    //         console.log('response', response)
    //     },
    //     error: function (error) {
            
    //         console.error("Error", error);
    //     },
    // });
    


    //! here the defitino of all the functions
    function attachAddFormOnImageClick(){
      $(".addFormBox").click(function(){
        var clickedElement = $(this); // Save the clicked element
        $.ajax({
          url: "app/api/api.php",
          type: "POST",
          data: { action: "addForm" },
          success: function (form) {
            console.log('form.class', $(form).attr('class'));
            $(form).attr('id', 'brandSelect' + brandsIds);
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
      alert("called attach brand selecttion");
      $('.BrandSelect').each(function() {
        // alert("found")
        $(this).attr('id', 'brandSelect' + brandsIds);
          brandsIds++;
      });
  }

  function aBrandIsSelected(){
    // get the next select , and if a change happens , remove all the next node , and after that insert the new result

    $('select').each(function() {
      const arr = {"BrandSelect": "", "ModelSelect" : "", "VersionSelect" : "", "YearSelect" : ""};
          const containerForm =  $(this).parent().parent();

          const selectClicked = $(this); 
          const selectType = selectClicked.attr('class');
          const selectedValue = selectClicked.val(); 
         
          selectClicked.change(()=>{
            let newInput = { }; 
            newInput[selectType] = selectedValue;

                // select all the select inside the containerForm 

            const allSelect = containerForm.find('select');

            allSelect.each(function(){
                    alert("prev")
              if ($(this).attr('class') != undefined){
               const selectType = $(this).attr('class');
                const selectedValue = $(this).val();
                newInput[selectType] = selectedValue;
                console.log('newInput', newInput);
              }
            }
            );






            $.ajax({
              url: "app/api/api.php",
              type: "POST",
              data: { action: "getNextSelect" , payload : newInput , type : selectType },
              success: function (nextSelect) {

                const nextSelectWrap =  $(nextSelect)
                const nextNodes = selectClicked.parent().nextAll(); 
                nextNodes.remove();
                nextSelectWrap.insertAfter(selectClicked.parent());
                aBrandIsSelected();
              
              },
              error: function (error) {
                  // Handle errors
                  console.error("Error", error);
              },
            })
            

          })






    })
  } 

  function slidingEffect(){
  const slidesContainer = $('.slidesContainer');
  const slideWidth = $('.comparisonCard').outerWidth();
  let currentIndex = 0;

  // Handle right arrow click
  $('.rightArrow').click(function () {
      if (currentIndex < slidesContainer.children().length - 1) {
          currentIndex++;
          updateSlider();
      }
  });

  // Handle left arrow click
  $('.leftArrow').click(function () {
      if (currentIndex > 0) {
          currentIndex--;
          updateSlider();
      }
  });
}

  function updateSlider() {
      const newTransformValue = -currentIndex * slideWidth;
      slidesContainer.css('transform', 'translateX(' + newTransformValue + 'px)');
  }


    //! here the calling of all the functions
    attachBrandSelection();
    attachAddFormOnImageClick();
    aBrandIsSelected();
    slidingEffect();
  });

