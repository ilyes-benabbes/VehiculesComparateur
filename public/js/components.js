$(document).ready(function () {
    //! BrandsIds : 
    let brandsIds = 1;
  
      //! here the defitino of all the functions
      function attachAddFormOnImageClick(){
        
        $(".addFormBox").click(function(){
          
          let  compareButton = $('#compareButton');
          compareButton.prop('disabled', true);
        // alert("should be disabled now !");
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
        $('.BrandSelect').each(function() {
          $(this).attr('id', 'brandSelect' + brandsIds);
            brandsIds++;});
    }
  
    function aBrandIsSelected(){
  
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
                if ($(this).attr('class') != undefined){
                 const selectType = $(this).attr('class');
                  const selectedValue = $(this).val();
                  newInput[selectType] = selectedValue;
                  // console.log('newInput', newInput);
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
                  checkIfComparisonIsValid();
                
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
    
    function updateSlider() {
      const newTransformValue = -currentIndex * slideWidth;
      slidesContainer.css('transform', 'translateX(' + newTransformValue + 'px)');
    }
    
  }

  function compareButton(){
    // button.prop('disabled', true);
    let button =  $('#compareButton') ;
    $('#compareButton').click(function(){
      // it is clicked only if enabled
      
        let listOfModelsIds = [ "1" ,"2" , "3" , "4"];
        const allSelect = $('.SelectModel');
        allSelect.each(function(){
            const selectedValue = $(this).val();
            listOfModelsIds.push(selectedValue);
          }

          )
          
          console.log('listofModelsIds', listOfModelsIds);

        $.ajax({
          url: "app/api/api.php",
          type: "POST",
          data: { action: "compare" , payload : listOfModelsIds },
          success: function (tableOfComparison) {
            let container = $('.formsContainer');
            // container.hide();
            container.empty();
            container.html(tableOfComparison);
      } 

    })}
    )} // fin du compareButton func

      function checkIfComparisonIsValid(){
        let button =  $('#compareButton') ;
        let valid = true ; 
        let listOfModelsIds = [ ];
         let forms = $(".comparisonForm") ; 
         forms.each(function(){
          const allSelect = $(this).find('select');
          allSelect.each(function(){
            if ($(this).attr('class') == "SelectModel"){
              listOfModelsIds.push($(this).val());
            }
            if ($(this).val() == null || allSelect.length != 4){
              valid = false ; 
            }
          })
        
         })

    if (valid == true && new Set(listOfModelsIds).size == listOfModelsIds.length) {
      console.log('listOfModelsIds', listOfModelsIds);
          button.prop('disabled', false);
  } else {  
    // button.prop('disabled', true);  
  }
} //  end of method 


function reviewButton(){
  let button =  $('#reviewButton') ;
  button.click(function(){
            
  })  }// end of function




  
      //! here the calling of all the functions
      attachBrandSelection();
      checkIfComparisonIsValid(); 
      attachAddFormOnImageClick();
      aBrandIsSelected();
      compareButton();
      slidingEffect();
      reviewButton();

      // removeForm();

}); 
  