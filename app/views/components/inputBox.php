<?php
class InputBox {
    function render($label, $type) {
        $input = '<label for="' . strtolower($label) . '">' . $label . '</label>';
        $input .= '<input type="' . $type . '" id="' . strtolower($label) . '" name="' . strtolower($label) . '" />';
        echo $input;
    }

    function clone() {
        echo "cloning !!!";
    }
}