<?php
class Select {
    function render($label, $className, $optionsList,  $valueKey = 'id', $textKey = 'name') {
        echo '<div class="col"  >' ;
        $input = '<label for="' . strtolower($label) . '">' . $label . '</label>';
        $input .= '<select class="' .$className . '" name="' . strtolower($label) . '">';
    
        $input .= '<option value="" disabled selected>    ------------------</option>';


        foreach ($optionsList as $option) {
            if (   isset($option[$valueKey]) ){
                $value = $option[$valueKey];
            }else {
                $value = "";
            }
            $text = $option[$textKey];
            $input .= '<option value="' . htmlspecialchars($value) . '">' . htmlspecialchars($text) . '</option>';
        }

        $input .= '</select>';
        echo $input;
        echo "</div>";
    }

    function renderDisabled($label){
        
        $input = '<label for="' . strtolower($label) . '">' . $label . '</label>';
        $input .= '<select class="' .$label . '" name="' . strtolower($label) . ' " disabled>';
        $input .= '</select>';
        echo $input ;

    }
}

