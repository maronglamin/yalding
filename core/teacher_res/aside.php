    <!--sidebar start-->
    <aside>
      <div id="sidebar" class="nav-collapse ">
        <!-- sidebar menu start-->
        <ul class="sidebar-menu">
          <li class="active">
            <a class="" href="dashboard.php">
              <i class="icon_house_alt"></i>
              <span>Dashboard</span>
            </a>
          </li>
          <li>
            <a class="" href="<?= PROOT ?>teacher/components/plans.php">
              <i class="icon_genius"></i>
              <span>My plans</span>
            </a>
          </li>
          <li class="sub-menu">
            <a href="javascript:;" class="">
              <i class="icon_document_alt"></i>
              <span>Lesson Plan</span>
              <span class="menu-arrow arrow_carrot-right"></span>
            </a>
            <ul class="sub">
              <li><a class="" href="form_component.html">My class1 plan</a></li>
              <li><a class="" href="form_validation.html">My class2 plan</a></li>
            </ul>
          </li>
          <li class="sub-menu">
            <a href="javascript:;" class="">
              <i class="icon_desktop"></i>
              <span>Scheme Work</span>
              <span class="menu-arrow arrow_carrot-right"></span>
            </a>
            <ul class="sub">
              <li><a class="" href="general.html">class1</a></li>
              <li><a class="" href="buttons.html">class</a></li>
            </ul>
          </li>
          <li>
            <a class="" href="widgets.html">
              <i class="icon_genius"></i>
              <span>My classes</span>
            </a>
          </li>
          <li class="sub-menu">
            <a href="javascript:;" class="">
              <i class="icon_table"></i>
              <span>Grade</span>
              <span class="menu-arrow arrow_carrot-right"></span>
            </a>
            <ul class="sub">
              <li><a class="" href="basic_table.html">Assign class1</a></li> vc
              <li><a class="" href="basic_table.html">Assign class2</a></li>

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

        if (isset($_SESSION['error_mesg'])) {
          echo '<div class="alert alert-danger alert-dismissible text-center" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><strong>Warning!</strong>' . ' ' . $_SESSION['error_mesg'] . '</div>';
          unset($_SESSION['error_mesg']);
        }

        ?>