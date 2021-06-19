<?php
// create functions and use it to avoid repeatations 
 
// use for debugging or testing purposes
function dnd($data) {
    echo '<pre class="bg-light">';
    var_dump($data);
    echo '</pre>';
    die("Test or debugging mode");
}

function display_errors($errors) {
    $hasErrors = (!empty($errors))? ' has-errors' : '';
    $html = '<div class="form-errors"><ul class="bg-light'.$hasErrors.'">';
    foreach($errors as $field => $error) {
      $html .= '<li class="text-danger">'.$error.'</li>';
    }
    $html .= '</ul></div>';
    return $html;
  }

function sanitize($dirty) {
    return htmlentities($dirty, ENT_QUOTES, "UTF-8");
}

function page_name($name) 
{
  $html = '<div class="row">';
  $html .= '<div class="col-lg-12">';
  $html .= '<h3 class="page-header"><i class="fa fa-laptop"></i>'. $name .'</h3>';
  $html .= '</div>';
  $html .= '</div>';

  return $html;
}

function is_logged_in() {
    if (isset($_SESSION['ADMIN_USER_SESSIONS']) && $_SESSION['ADMIN_USER_SESSIONS'] > 0) {
        return true;
    } elseif (isset($_SESSION['STUDENT_USER_SESSIONS']) && $_SESSION['STUDENT_USER_SESSIONS'] > 0) {
      return true;
    }  elseif (isset($_SESSION['TEACHR_USER_SESSIONS']) && $_SESSION['TEACHR_USER_SESSIONS'] > 0) {
        return true;
    } 
        return false;
  }


function login_error_redirect($url, $pageName) {
    if(!headers_sent()) {
        $_SESSION['error_mesg_red'] = 'You must be logged in to access the <strong>'.  $pageName. '</strong> page';
        header('Location: '.$url);
        exit();
      }
}

function helper_login($table, $user_id, $url) {
  global $db;
    $date = date("Y-m-d H:i:s");
    $db->query("UPDATE '{$table}' SET last_login = '$date' WHERE id = '$user_id'");
    $_SESSION['success_mesg'] = 'You are now logined! Let\'s get started';
    header('Location: ' . $url);
    exit();
}

function login_teacher_staff($user_id) {
    $_SESSION['TEACHR_USER_SESSIONS'] = $user_id;
    helper_login('staff', $user_id, "components" . DS . "dashboard.php");
    
}

function login_addmin($admin_id) {
  $_SESSION['ADMIN_USER_SESSIONS'] = $admin_id;
  helper_login('administrators', $admin_id,  "components" . DS . "dashboard.php");
  
}

function login_stud($user_id) {
  $_SESSION['STUDENT_USER_SESSIONS'] = $user_id;
  helper_login('stud_adm_info', $user_id,  "components" . DS . "dashboard.php");
}

function redirect($location) {
    if(!headers_sent()) {
      header('Location: '.$location);
      exit();
    } else {
      echo '<script type="text/javascript">';
      echo 'window.location.href="'.$location.'";';
      echo '</script>';
      echo '<noscript>';
      echo '<meta http-equiv="refresh" content="0;url='.$location.'" />';
      echo '</noscript>';
      exit;
    }
}
function day_month($date)
{
    return date("d/m/Y", strtotime($date));
}

function time_format($date) {
  return date("D M Y", strtotime($date));

}
function selQuery($table, $id_field, $id) {
  global $db;
  $arr = array();
  $sql = $db->query("SELECT * FROM '{$table}' WHERE '{$id_field}' = '{$id}'");
  $results = mysqli_fetch_assoc($sql);
  foreach ($results as $result) {
    $result = $arr;
  }
  return $arr;
}

function stringifyAttrs($attrs){
    $string = '';
    foreach($attrs as $key => $val){
      $string .= ' ' . $key . '="' . $val . '"';
    }
    return $string;
}

function append_error_class($attrs,$errors,$name,$class){
    if(array_key_exists($name,$errors)){
      if(array_key_exists('class',$attrs)){
        $attrs['class'] .= " " . $class;
      } else {
        $attrs['class'] = $class;
      }
    }
    return $attrs;
}

// return error mesg for input fields 
function errorMsg($errors,$name){
    $msg = (array_key_exists($name,$errors))? $errors[$name] : "";
    return $msg;
}

function options_for_select($options,$selectedValue){
    $html = "";
    foreach($options as $value => $display){
      $selStr = ($selectedValue == $value)? ' selected="selected"' : '';
      $html .= '<option value="'.$value.'"'.$selStr.'>'.$display.'</option>';
    }
    return $html;
}

function hiddenInput($name,$value){
    $html = '<input type="hidden" name="'.$name.'" id="'.$name.'" value="'.$value.'" />';
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
function inputBlock($type, $label, $name, $value='', $inputAttrs=[], $divAttrs=[],$errors=[],$stringValue){
    $inputAttrs = append_error_class($inputAttrs,$errors,$name,'is-invalid');
    $divString = stringifyAttrs($divAttrs);
    $inputString = stringifyAttrs($inputAttrs);
    $id = str_replace('[]','',$name);
    $html = '<div' . $divString . '>';
    $html .= '<label class="col-sm-2 control-label" for="'.$id.'">'.$label.'</label>';
    $html .= '<div class="col-sm-10">';
    $html .= '<input type="'.$type.'" id="'.$id.'" name="'.$name.'" value="'.$value.'"'.$inputString.' />';
    $html .= '<span class="help-block">'.$stringValue.'</span>';
    $html .= '<span class="invalid-feedback">'.errorMsg($errors,$name).'</span>';
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
function submitBlock($buttonText, $inputAttrs=[], $divAttrs=[], $url){
    $divString = stringifyAttrs($divAttrs);
    $inputString = stringifyAttrs($inputAttrs);
    $html = '<div'.$divString.'>';
    $html .= '<input type="submit" class="mg-r btn btn-primary" value="'.$buttonText.'"'.$inputString.' />';
    $html .= '<a href="'.$url.'" class="btn btn-default">Cancel</a>';
    $html .= '</div>';
    return $html;
}

function selectBlock($label,$name,$value,$options,$inputAttrs=[],$divAttrs=[],$errors=[]){
  $inputAttrs = append_error_class($inputAttrs,$errors,$name,'is-invalid');
  $divString = stringifyAttrs($divAttrs);
  $inputString = stringifyAttrs($inputAttrs);
  $id = str_replace('[]','',$name);
  $html = '<div' . $divString . '>';
  $html .= '<label for="'.$id.'" class="control-label col-lg-2">' . $label . '</label>';
  $html .= '<div class="col-sm-10">';
  $html .= '<select id="'.$id.'" name="'.$name.'" '.$inputString.'>'.options_for_select($options,$value).'</select>';
  $html .= '<span class="invalid-feedback">'.errorMsg($errors,$name).'</span>';
  $html .= '</div>';
  $html .= '</div>';
  return $html;
}