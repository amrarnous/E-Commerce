<nav class="navbar navbar-inverse">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-nav" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="dashboard.php"><?php echo lang("admin"); ?></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
          <?php
            echo $_SESSION["Username"];
          ?>
          <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="memmbers.php?action=Edit&id=<?php echo $_SESSION["ID"];  ?>"><?php echo lang("edit_profile"); ?></a></li>
            <li><a href="#"><?php echo lang("sett");?></a></li>
            <li><a href="logout.php"><?php echo lang("sign_out");?></a></li>
          </ul>
        </li>
      </ul>
    <div class="collapse navbar-collapse" id="app-nav">
      <ul class="nav navbar-nav">
        <li><a href="#"><?php echo lang("sections"); ?></a></li>
        <li><a href="#"><?php echo lang("items"); ?></a></li>
        <li><a href="memmbers.php"><?php echo lang("memmbers"); ?></a></li>
        <li><a href="#"><?php echo lang("statistic"); ?></a></li>
        <li><a href="#"><?php echo lang("logs"); ?></a></li>
      </ul>
    </div>
  </div>
</nav>