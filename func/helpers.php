<?php

function options_for_select($options, $selectedValue)
{
    $html = "";
    foreach ($options as $value => $display) {
        $selStr = ($selectedValue == $value) ? ' selected="selected"' : '';
        $html .= '<option value="' . $value . '"' . $selStr . '>' . $display . '</option>';
    }
    return $html;
}

function hiddenInput($name, $value)
{
    $html = '<input type="hidden" name="' . $name . '" id="' . $name . '" value="' . $value . '" />';
    return $html;
}

/*
string     $type       type of input ie text, password, phone ...
string     $label      The label that will be displayed for the input
string     $name       The id and name of the input will be set to this value
string     $value      (optional) The value of the input
array      $inputAttrs (optional) attributes of input
array      $divAttrs   (optional) attributes of surrounding div
array      $errors     (optional) array of all form errors
*/
function inputBlock($type, $label, $name, $value = '', $inputAttrs = [], $divAttrs = [], $errors = [], $stringValue)
{
    $inputAttrs = append_error_class($inputAttrs, $errors, $name, 'is-invalid');
    $divString = stringifyAttrs($divAttrs);
    $inputString = stringifyAttrs($inputAttrs);
    $id = str_replace('[]', '', $name);
    $html = '<div' . $divString . '>';
    $html .= '<label class="col-sm-2 control-label" for="' . $id . '">' . $label . '</label>';
    $html .= '<div class="col-sm-10">';
    $html .= '<input type="' . $type . '" id="' . $id . '" name="' . $name . '" value="' . $value . '"' . $inputString . ' />';
    $html .= '<span class="help-block">' . $stringValue . '</span>';
    $html .= '<span class="invalid-feedback">' . errorMsg($errors, $name) . '</span>';
    $html .= '</div>';
    $html .= '</div>';
    return $html;
}

/**
 * Creates a submit block
 * @method submitBlock
 * @param  string      $buttonText Text that will be displayed on button
 * @param  array       $inputAttrs (optional) Attributes for input
 * @param  array       $divAttrs   (optional) Atributes for surrounding div
 * @return string                  Returns an html string for submit block
 */
function submitBlock($buttonText, $inputAttrs = [], $divAttrs = [], $url)
{
    $divString = stringifyAttrs($divAttrs);
    $inputString = stringifyAttrs($inputAttrs);
    $html = '<div' . $divString . '>';
    $html .= '<input type="submit" class="mg-r btn btn-primary" value="' . $buttonText . '"' . $inputString . ' />';
    $html .= '<a href="' . $url . '" class="btn btn-default">Cancel</a>';
    $html .= '</div>';
    return $html;
}

function selectBlock($label, $name, $value, $options, $inputAttrs = [], $divAttrs = [], $errors = [])
{
    $inputAttrs = append_error_class($inputAttrs, $errors, $name, 'is-invalid');
    $divString = stringifyAttrs($divAttrs);
    $inputString = stringifyAttrs($inputAttrs);
    $id = str_replace('[]', '', $name);
    $html = '<div' . $divString . '>';
    $html .= '<label for="' . $id . '" class="control-label col-lg-2">' . $label . '</label>';
    $html .= '<div class="col-sm-10">';
    $html .= '<select id="' . $id . '" name="' . $name . '" ' . $inputString . '>' . options_for_select($options, $value) . '</select>';
    $html .= '<span class="invalid-feedback">' . errorMsg($errors, $name) . '</span>';
    $html .= '</div>';
    $html .= '</div>';
    return $html;
}


function table_th($th)
{
    $string = '';
    foreach ($th as $val) {
        $string .= '<th>' . $val . '</th>';
    }
    return $string;
}

function table_td($arr_data, $index = [], $url, $getVariable)
{
    $string = '';
    $lastIndex = end($index);
    while ($result = mysqli_fetch_assoc($arr_data)) {
        foreach ($index as $val) {
            if ($val === $lastIndex) {
                $id = $result['stud_id'];
                $string .= '<td><a href="' . $url . '.php?' . $getVariable . '=' . $id . '" class="btn btn-primary">Details</a></td>';
            } else {
                $string .= '<td>' . $result[$val] . '</td>';
            }
        }
        $string .= '</tr>';
    }
    return $string;
}

function tableDataNoActon($arr_data, $index = [])
{
    $string = '';
    while ($result = mysqli_fetch_assoc($arr_data)) {
        foreach ($index as $val) {
            $string .= '<td>' . $result[$val] . '</td>';
        }
    }
    $string .= '</tr>';
    return $string;
}

/* header content of the table with a one line mesg for the Variable $table_header_mesg
*  @params $table_header_mesg
*  return $html html string values
*/
function table_wrapper($table_header_mesg)
{
    $html = '<div class="col-lg-12">';
    $html .= '<section class="panel">';
    if ($table_header_mesg != '') {
        $html .= '<div class="panel-body progress-panel">';
        $html .= '<div class="row">';
        $html .= '<div class="col-lg-8 task-progress pull-left">';
        $html .= '<h1>' . $table_header_mesg . '</h1></div>';
        $html .= '</div>';
        $html .= '</div>';
    }
    return $html;
}

function htmlTableActionBtn($th = [], $queryStatement, $index = [], $url, $getVariable)
{
    $html = '<table class="table table-hover personal-task"><thead>';
    $html .=  table_th($th);
    $html .= '</thead>';
    $html .= '<tbody>';
    $html .= table_td($queryStatement, $index, $url, $getVariable);
    $html .= '</tbody></table>';
    $html .= '</section></div>';
    return $html;
}

function htmlTable($th = [], $queryStatement, $index = [])
{
    $html = '<table class="table table-hover personal-task"><thead>';
    $html .=  table_th($th);
    $html .= '</thead>';
    $html .= '<tbody>';
    $html .= tableDataNoActon($queryStatement, $index);
    $html .= '</tbody></table>';
    $html .= '</section></div>';
    return $html;
}

function htmlCard($divAttrs = [])
{
    $divString = stringifyAttrs($divAttrs);
    $html = '<div' . $divString . '>';
    $html .= '<section class="panel">';
    $html .= '<div class="panel-body progress-panel">';
    $html .= '<div class="row">';
    $html .= '<div class="col-lg-8 task-progress pull-left"><h1>Review information</h1>';
    $html .= '</div></div></div>';
    return $html;
}
