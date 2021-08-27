<?php
  include_once 'config/init.php';

  $template = new Template('templates/frontpage.php');

  $template->title = "Latest Job";
  echo $template;
