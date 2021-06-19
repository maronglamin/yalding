<?php

function table_th($th) {
    $string = '';
    foreach($th as $val){
        $string .= '<th>'.$val.'</th>';
    }
    return $string;
}

function table_td($td) {
    $string = '';
    foreach($td as $val){
        $string .= '<th>'.$val.'</th>';
    }
    return $string;
}

function html_table($th=[],$td=[],$table_header_mesg) {
    $html = '<div class="col-lg-12">';
    $html .= '<section class="panel">';
    $html .= '<div class="panel-body progress-panel">';
    $html .= '<div class="row">';
    $html .= '<div class="col-lg-8 task-progress pull-left">';
    $html .= '<h1>'.$table_header_mesg.'</h1></div></div></div>';
    $html .= '<table class="table table-hover personal-task"><thead>';
    $html .=  table_th($th);
    $html .= '</thead>';
    $html .= '<tbody><tr>';
    $html .= table_td($td);
    $html .= '</tr></tbody></table>';
    $html .= '</section></div>';
    return $html;
}