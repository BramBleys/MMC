<?php
function haalCssOp($css) {
    $CI = &get_instance();
    $CI->load->helper('url');

    return "<link rel=\"stylesheet\" type=\"text/css\" href=\"" .
        base_url("assets/css/" . $css) .
        "\" />";
}

function haalJavascriptOp($js) {
    $CI = & get_instance();
    $CI->load->helper('url');

    return "<script src=\"" . base_url("assets/js/" . $js) . "\"></script>";
}
