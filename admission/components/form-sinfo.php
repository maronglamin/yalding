<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/yalding/core/init.php';
$id = $user_data['stud_id'];
$errors = [];
?>

<section class="wrapper">
    <div class="row">
        <div class="col-lg-6 col-sm-offset-3">
            <ol class="breadcrumb">
                <li><i class="fa fa-home"></i><a href="<?= PROOT ?>index.php">Home</a></li>
                <li><i class="fa fa-desktop"></i>Student personal information</li>
            </ol>
            <h3 class="page-header"><i class="fa fa-file-text-o"></i> enrollment information</h3>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-sm-offset-3">
            <section class="panel">
                <header class="panel-heading">Student Admission Process</header>
                <div class="panel-body">
                    <form class="form-horizontal" action="#" method="POST" enctype="multipart/form-data">
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                            $filename =  $_FILES['pasphoto']['name'];
                            // get the file extension
                            $extension = pathinfo($filename, PATHINFO_EXTENSION);
                            $destination = '..' . '/stud_passImage/' . $filename;
                            // the physical file on a temporary uploads directory on the server
                            $file = $_FILES['pasphoto']['tmp_name'];
                            $size = $_FILES['pasphoto']['size'];
                            // allowed extensions
                            if (!in_array($extension, ['jpg', 'png'])) {
                                $errors[] .= 'Photo format isn\'t allowed';
                            }
                            // upload size 
                            elseif ($_FILES['pasphoto']['size'] > 1000000) {
                                $errors[] .= 'file shouldn\'t be larger than 1Megabyte';
                            }
                            // if no file is selected
                            if ($filename == '') {
                                $errors[] .= 'No passport size photo selected';
                            }
                            // display error if it occurs 
                            if (!empty($errors)) {
                                echo display_errors($errors);
                            } else {
                                if (move_uploaded_file($file, $destination)) {
                                    //save data from applicant
                                    $destination = ltrim($destination, '..');
                                    $db->query("UPDATE `stud_adm_info` SET `path` = '{$destination}' WHERE `stud_id` = '{$id}'");
                                    $_SESSION['success_mesg'] .= 'All done! time to check';
                                    redirect("dashboard.php");
                                }
                            }
                        }

                        print inputBlock('file', 'Passport Photo*', 'pasphoto', '', ['class' => 'form-control'], ['class' => 'form-group'], [], 'upload the most recent passport photo of you');
                        print submitBlock('Submit', ['class' => "btn btn-primary"], [], '#')
                        ?>


                    </form>
                </div>
            </section>
        </div>
    </div>
    <!-- Basic Forms & Horizontal Forms-->