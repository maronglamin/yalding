    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
          <li class="active">
            <a class="" href="<?= PROOT ?>admin/components/dashboard.php">
              <i class="icon_house_alt"></i>
              <span>Dashboard</span>
            </a>
          </li>
          <li class="sub-menu">
            <a href="javascript:;" class="">
              <i class="icon_document_alt"></i>
              <span>Admission</span>
              <span class="menu-arrow arrow_carrot-right"></span>
            </a>
            <ul class="sub">
              <li><a class="" href="<?= PROOT ?>admin/components/admission_list.php">Enrollment</a></li>
              <li><a class="" href="<?= PROOT ?>admin/components/enrolled.php">Enrolled</a></li>
            </ul>
          </li>
          <li>
            <a class="" href="<?= PROOT ?>admin/components/class.php">
              <i class="icon_genius"></i>
              <span>Assign classes</span>
            </a>
          </li>
          <li class="sub-menu">
            <a href="javascript:;" class="">
              <i class="icon_document_alt"></i>
              <span>Classes</span>
              <span class="menu-arrow arrow_carrot-right"></span>
            </a>
            <ul class="sub">
              <?php while ($result = mysqli_fetch_assoc($class)) : ?>
                <li><a class="" href="<?= PROOT ?>admin/components/level.php?class=<?= $result['class_id'] ?>"><?= $result['grade_name']; ?></a></li>
              <?php endwhile; ?>
            </ul>
          </li>
          <li>
            <a class="" href="<?= PROOT ?>admin/components/teacher.php">
              <i class="icon_genius"></i>
              <span>Assign teachers</span>
            </a>
          </li>
          <li class="sub-menu">
            <a href="javascript:;" class="">
              <i class="icon_document_alt"></i>
              <span>Subject Teacher</span>
              <span class="menu-arrow arrow_carrot-right"></span>
            </a>
            <ul class="sub">
              <?php while ($result = mysqli_fetch_assoc($class_plan)) : ?>
                <li><a class="" href="<?= PROOT ?>admin/components/teacher_list.php?class=<?= $result['class_id'] ?>"><?= $result['grade_name']; ?></a></li>
              <?php endwhile; ?>
            </ul>
          </li>
          <li class="sub-menu">
            <a href="javascript:;" class="">
              <i class="icon_desktop"></i>
              <span>Scheme Work</span>
              <span class="menu-arrow arrow_carrot-right"></span>
            </a>
            <ul class="sub">
              <li><a class="" href="form_component.html">Grade 9</a></li>
              <li><a class="" href="form_validation.htmlGrade">Grade 8</a></li>
              <li><a class="" href="form_validation.htmlGrade">Grade 7</a></li>
            </ul>
          </li>
          <li class="sub-menu">
            <a href="javascript:;" class="">
              <i class="icon_table"></i>
              <span>Get Grades</span>
              <span class="menu-arrow arrow_carrot-right"></span>
            </a>
            <ul class="sub">
              <li><a class="" href="form_component.html">Grade 9</a></li>
              <li><a class="" href="form_validation.htmlGrade">Grade 8</a></li>
              <li><a class="" href="form_validation.htmlGrade">Grade 7</a></li>

            </ul>
          </li>
        </ul>
        <!-- sidebar menu end-->
      </div>
    </aside>
    <!--main content start-->
    <section id="main-content">
      <section class="wrapper">
        <?php
        if (isset($_SESSION['success_mesg'])) {
          echo '<div class="alert alert-success alert-dismissible text-center" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Message!</strong>' . ' ' . $_SESSION['success_mesg'] . '</div>';
          unset($_SESSION['success_mesg']);
        }



        ?>