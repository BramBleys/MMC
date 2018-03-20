<?php
    function haalCssOp($css) {
        $CI = &get_instance();
        $CI->load->helper('url');

        return "<link rel=\"stylesheet\" type=\"text/css\" href=\"" .
            base_url("assets/css/" . $css) .
            "\" />";
    }

    function toonAfbeelding($afbeelding, $attributen = '') {
        $CI = &get_instance();
        $CI->load->helper('url');

        return "<img src=\"" . base_url("assets/images/" . $afbeelding) .
            "\"" . _stringify_attributes($attributen) . " />";
    }