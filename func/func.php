<?php
// create functions and use it to avoid repeatations 

// use for debugging or testing purposes
function dnd($data)
{
  echo '<pre class="bg-light">';
  var_dump($data);
  echo '</pre>';
  die("Test or debugging mode");
}

function display_errors($errors)
{
  $hasErrors = (!empty($errors)) ? ' has-errors' : '';
  $html = '<div class="form-errors"><ul class="bg-light' . $hasErrors . '">';
  foreach ($errors as $field => $error) {
    $html .= '<li class="text-danger">' . $error . '</li>';
  }
  $html .= '</ul></div>';
  return $html;
}

function sanitize($dirty)
{
  return htmlentities($dirty, ENT_QUOTES, "UTF-8");
}

function page_name($name)
{
  $html = '<div class="row">';
  $html .= '<div class="col-lg-12">';
  $html .= '<h3 class="page-header"><i class="fa fa-laptop"></i>' . $name . '</h3>';
  $html .= '</div>';
  $html .= '</div>';

  return $html;
}

function is_logged_in()
{
  if (isset($_SESSION['ADMIN_USER_SESSIONS']) && $_SESSION['ADMIN_USER_SESSIONS'] > 0) {
    return true;
  } elseif (isset($_SESSION['STUDENT_USER_SESSIONS']) && $_SESSION['STUDENT_USER_SESSIONS'] > 0) {
    return true;
  } elseif (isset($_SESSION['TEACHR_USER_SESSIONS']) && $_SESSION['TEACHR_USER_SESSIONS'] > 0) {
    return true;
  }
  return false;
}


function login_error_redirect($url, $pageName)
{
  if (!headers_sent()) {
    $_SESSION['error_mesg_red'] = 'You must be logged in to access the <strong>' .  $pageName . '</strong> page';
    header('Location: ' . $url);
    exit();
  }
}

function helper_login($table, $user_id, $url)
{
  global $db;
  $date = date("Y-m-d H:i:s");
  $db->query("UPDATE '{$table}' SET last_login = '$date' WHERE id = '$user_id'");
  $_SESSION['success_mesg'] = 'You are now logined! Let\'s get started';
  header('Location: ' . $url);
  exit();
}

function login_teacher_staff($user_id)
{
  $_SESSION['TEACHR_USER_SESSIONS'] = $user_id;
  helper_login('staff', $user_id, "components" . DS . "dashboard.php");
}

function login_addmin($admin_id)
{
  $_SESSION['ADMIN_USER_SESSIONS'] = $admin_id;
  helper_login('administrators', $admin_id,  "components" . DS . "dashboard.php");
}

function login_stud($user_id)
{
  $_SESSION['STUDENT_USER_SESSIONS'] = $user_id;
  helper_login('stud_adm_info', $user_id,  "components" . DS . "dashboard.php");
}

function redirect($location)
{
  if (!headers_sent()) {
    header('Location: ' . $location);
    exit();
  } else {
    echo '<script type="text/javascript">';
    echo 'window.location.href="' . $location . '";';
    echo '</script>';
    echo '<noscript>';
    echo '<meta http-equiv="refresh" content="0;url=' . $location . '" />';
    echo '</noscript>';
    exit;
  }
}
function day_month($date)
{
  return date("d/m/Y", strtotime($date));
}

function time_format($date)
{
  return date("D M, Y", strtotime($date));
}
function selQuery($table, $id_field, $id)
{
  global $db;
  $arr = array();
  $sql = $db->query("SELECT * FROM '{$table}' WHERE '{$id_field}' = '{$id}'");
  $results = mysqli_fetch_assoc($sql);
  foreach ($results as $result) {
    $result = $arr;
  }
  return $arr;
}

function stringifyAttrs($attrs)
{
  $string = '';
  foreach ($attrs as $key => $val) {
    $string .= ' ' . $key . '="' . $val . '"';
  }
  return $string;
}

function append_error_class($attrs, $errors, $name, $class)
{
  if (array_key_exists($name, $errors)) {
    if (array_key_exists('class', $attrs)) {
      $attrs['class'] .= " " . $class;
    } else {
      $attrs['class'] = $class;
    }
  }
  return $attrs;
}

// return error mesg for input fields 
function errorMsg($errors, $name)
{
  $msg = (array_key_exists($name, $errors)) ? $errors[$name] : "";
  return $msg;
}
