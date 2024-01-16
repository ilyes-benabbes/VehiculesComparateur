<?php 
Class ContactPage {
    function show(){
    echo '
        <div class =" g3 w-50 mx-auto mb-5 position-relative row">
        <img src="/VehiculesComparateur%20(ProjetWeb)/public/images/commonPictures/contactBg.jpg" width="500px" height="500px" class="rounded-4 opacity-25 d-block mx-auto position-absolute bottom-0" />
       

        <div c="bluredBox  d-flex justify-content-between pt-5 px-4 position-relative">
            <div c="col-6 pb-4">
            <h1 c="artFont my-auto h1 text-center pt-3 text-warning">Nos Informations</h1>
             
                <div c="bluredBox d-flex justify-content-center w-50 mx-auto px-3 py-2 my-2">
                    <a href="tel:0560 68 65 72" c="  text-decoration-none text-light ">+213 7 95 95 15 19</a>
                </div>
                <div c="bluredBox d-flex justify-content-center w-50 mx-auto px-3 py-2 my-2">
                    <a href="tel:0560 68 65 72" c="  text-decoration-none text-light ">+213 7 95 95 15 19</a>
                </div>
                <div c="h5 d-flex justify-content-center w-50 mx-auto px-3 py-2 my-2">
                    <span>ki_benabbes@esi.dz</span>
                </div>


            </div>
            <div c="col-6 position-relative h-100 px-5 pt-5">
                <div c=" my-auto  text-center ">Comparator of vehicules , all rights reserved</div>
            </div>
        </div>
    </div>';
    
    }
}