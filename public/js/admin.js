$(document).ready(function () {
  alert("hello");
 
  function handleAddVersion() {

    let versionBtn = $("#addVersion");
    $("#addVersion").click(function () {
      
      // versionBtn.parent().empty();
      let inputText = `<input type="text" name="version" id="newVersion" class="form-control" placeholder="Version" ">`;
      //create save button 
      let saveBtn = `<button type="button" class="btn btn-primary" id="saveVersion">Save</button>`;
      //append save button to versionBtn parent
      versionBtn.parent().append(inputText);
      versionBtn.parent().append(saveBtn);
      $('#saveVersion').click(function (e) {
        e.preventDefault();
        let version = $("#newVersion").val();
        $.ajax({
          url: "../../app/api/api.php",
          type: "POST",
          data: { action: "addVersion", payload: version },
          success: function (res) {
            console.log("res", res);
            location.reload();
          },
        });
      })
    });


  }
  function handleAddFeature() {
    let btn = $("#addFeature");
    $("#addFeature").click(function () {

          
          // versionBtn.parent().empty();
          let inputText = `<input type="text" name="feature" id="newFeature" class="form-control" placeholder="Feature" ">`;
          //create save button 
          let saveBtn = `<button type="button" class="btn btn-primary" id="saveFeature">Save</button>`;
          //append save button to versionBtn parent
          btn.parent().append(inputText);
          btn.parent().append(saveBtn);
          $('#saveFeature').click(function (e) {
            e.preventDefault();
            let feature = $("#newFeature").val();
            $.ajax({
              url: "../../app/api/api.php",
              type: "POST",
              data: { action: "addFeature", payload: feature },
              success: function (res) {
                console.log("res", res);
                location.reload();
              },
            });
          })

        })
    }

    // $('input').change(function () {
    //   alert("change");
    //   let inputName = $(this).attr("name");
    //   let inputValue = $(this).val();
    //   $(this).attr("value" , inputValue) ;
    //   console.log(inputName, inputValue);
    // });


    function deleteImage() {
      let deleteBtn = $(".delete");
      deleteBtn.click(function (e) {
        e.preventDefault();
        prompt("Are you sure you want to delete this image?");

        let imageId = $(this).parent().find("img").attr("id");
        let action = $(this).parent().find("img").attr("action");
        let id = $(this).parent().find("img").attr("carId");
        alert(imageId);
        $.ajax({
          url: "/VehiculesComparateur%20(ProjetWeb)/app/api/api.php",
          type: "POST",
          data: { action: action, payload: {image : imageId , id : id  } },
          success: function (res) {
            console.log("res", res);
            // location.reload();
          },
        });
      });
    }
 
    //*************************** */
    function handleDeleteCarButton() {
      let deleteButton = $(".deleteCarButton");
      deleteButton.click(function () {
        let carId = $(this).attr("id");
        $.ajax({
          url: "/VehiculesComparateur%20(ProjetWeb)/app/api/api.php",
          type: "POST",
          data: { action: "deleteCar", payload: carId },
          success: function (res) {
            console.log("res", res);
            // location.reload();
          },
        });
      });
    }
    function handleDeleteBrandButton() {
      let deleteButton = $(".deleteBrandButton");
      deleteButton.click(function () {
        let carId = $(this).attr("id");
        $.ajax({
          url: "/VehiculesComparateur%20(ProjetWeb)/app/api/api.php",
          type: "POST",
          data: { action: "deleteBrand", payload: carId },
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
      let action = addButton.attr("action");
      let id = addButton.attr("id");
      addButton.click(function (e) {
        e.preventDefault();
        let payload = {};
        // collect all the names and values of the inputs 
        $("input").each(function () {
          let inputName = $(this).attr("name");
          let inputValue = $(this).val();
            payload[inputName] = inputValue;  
        });
        let facts = []
        $("input.facts").each(function () {
            let fact = $(this).val();
            facts.push(fact);
        });
        let awards = []
        $("input.awards").each(function () {
            let fact = $(this).val();
            awards.push(fact);       
        });
        payload["facts"] = facts;
        payload["awards"] = awards;
        $.ajax({
          url: "/VehiculesComparateur%20(ProjetWeb)/app/api/api.php",
          type: "POST",
          data: { action: action , payload : payload  , id : id },
          success: function (res) {
            console.log("res", res);
            location.reload();
          },
        });
      });} 
    function handleAddCarButton() {
        let addButton = $(".addCarButton");
        addButton.click(function (e) {
          alert("add car");
          e.preventDefault();
          let payload = {};
          // collect all the names and values of the inputs 
          $("input").each(function () {
            let inputName = $(this).attr("name");
            let inputValue = $(this).val();
              payload[inputName] = inputValue;
          });
          $("select").each(function () {
            let inputName = $(this).attr("name");
            let inputValue = $(this).val();
              payload[inputName] = inputValue;
          });

          let images = [];
          const input = document.getElementById('imageInput');
          const files = input.files;
          for (let i = 0; i < files.length; i++) {
              console.log('Selected file:', files[i].name);
              images.push(files[i].name);
          }
          payload["images"] = images;
       
    
          
          console.log('payload', payload);
        //   payload = 
        //   {
        //   acceleration
        //   : 
        //   "0-100 in 5secons" , 
        //   brand
        //   : 
        //   "4",
        //   capacity
        //   : 
        //   "150",
        //   cargo_space
        //   : 
        //   "100L",
        //   consumption
        //   : 
        //   "4.3L",
        //   engine_power
        //   : 
        //   "635 HP",
        //   features
        //   : 
        //    ['1', '2', '3'] ,
        //   height
        //   : 
        //   "2m",
        //   image
        //   : 
        //   "C:\\fakepath\\ford-mustang-2024-685572.jpg" ,
        //   images
        //   : 
        //    ['ford-mustang-2024-685573.jpg', 'ford-mustang-2024-685574.jpg'] ,
        //   length
        //   : 
        //   "4m" ,
        //   max_speed
        //   : 
        //   "350Km" ,
        //   number_of_seats
        //   : 
        //   "4" ,
        //   origin
        //   : 
        //   "Ford Mustang" ,
        //   price
        //   : 
        //   "35000 $" ,
        //   type
        //   : 
        //   "sedan" ,
        //   version
        //   : 
        //   "2" ,
        //   warranty
        //   : 
        //   "2 years" ,
        //   weight
        //   : 
        //   "350 kg",
        //   width
        //   : 
        //   "1.4m",
        //   year
        //   : 
        //   "2022"
        // }
    
          
          $.ajax({
            url: "/VehiculesComparateur%20(ProjetWeb)/app/api/api.php",
            type: "POST",
            data: { action: "addCar" , payload : payload  },
            success: function (res) {
              console.log("res", res);
              // location.reload();
            },
          });
        });
      }
    //*************************** */
    function handleUpdateBrandButton() {
    }
    function handleUpdateCarButton() {
    }
    //*************************** */
  
    function handleEditCarButton() {
      let editButton = $("button.editCarButton");


      editButton.click(function (e) {
        e.preventDefault();


      let payload = {};
      // collect all the names and values of the inputs 
      $("input").each(function () {
        let inputName = $(this).attr("name");
        let inputValue = $(this).val();
          payload[inputName] = inputValue;  
      });

        let carId = $(this).attr("id");
        // get all the check inboxes
        let features = [];
        $("input.feature").each(function () {
          if ($(this).is(":checked")) {
            features.push($(this).val());
          }
        });

        let colors = [];
        $("input.color").each(function () {
          if ($(this).is(":checked")) {
            colors.push($(this).val());
          }
        });

        $('select').each(function () {
          let inputName = $(this).attr("name");
          let inputValue = $(this).val();
            payload[inputName] = inputValue;
        }
        );
        

        alert("load comming soon ");
        payload["features"] = features;
        payload["colors"] = colors;

        console.log('payload', payload)



        $.ajax({
          url: "/VehiculesComparateur%20(ProjetWeb)/app/api/api.php",
          type: "POST",
          data: { action: "editCar", payload: payload , id : carId },
          success: function (res) {
            console.log("res", res);
            // location.reload();
          },
        });
     
      });
    }

    //*************************** */
    function handleEditBrandButton() {
      let editButton = $("button.editBrandButton");
      editButton.click(function (e) {
        e.preventDefault();
        let payload = {};
        // collect all the names and values of the inputs 
        $("input").each(function () {
          let inputName = $(this).attr("name");
          let inputValue = $(this).val();
            payload[inputName] = inputValue;  
        });
        let facts = []
        $("input.facts").each(function () {
            let fact = $(this).val();
            facts.push(fact);
        });
        let awards = []
        $("input.awards").each(function () {
            let fact = $(this).val();
            awards.push(fact);       
        });
        payload["facts"] = facts;
        payload["awards"] = awards;
        $.ajax({
          url: "/VehiculesComparateur%20(ProjetWeb)/app/api/api.php",
          type: "POST",
          data: { action: "editCarButton", payload: payload },
          success: function (res) {
            console.log("res", res);
            location.reload();
          },
        });
      });
    }
    //*************************** */

    handleEditBrandButton();
    handleDeleteCarButton();
    deleteImage();
    handleAddFeature();
    handleAddVersion();
    // handleDeleteButton();
    handleAddBrandButton();
    handleUpdateCarButton();
     
    handleEditCarButton();
    handleAddCarButton();
    handleUpdateBrandButton();
    handleDeleteBrandButton();
    handleUpdateCarButton();
}
)