<?php
class Select {
    function render($label, $optionsList,  $valueKey = 'id', $textKey = 'name') {
        echo '<div class="col"  >' ;
        $input = '<label for="' . strtolower($label) . '">' . $label . '</label>';
        $input .= '<select class="' .$label . '" name="' . strtolower($label) . '">';

        foreach ($optionsList as $option) {
            $value = $option[$valueKey];
            $text = $option[$textKey];
            $input .= '<option value="' . htmlspecialchars($value) . '">' . htmlspecialchars($text) . '</option>';
        }

        $input .= '</select>';
        echo $input;
        echo "</div>";
    }
}

// E