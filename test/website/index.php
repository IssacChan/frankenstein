<?php
require_once dirname(__FILE__).'/frankenstein.php';

$frank->root = '/~thiagoalessio/website';

$frank->get("/^\/home$/", function() {
  include dirname(__FILE__).'/views/home.html';
});

$frank->get("/^\/login$/", function() {
  include dirname(__FILE__).'/views/login-form.php';
});

$frank->post("/^\/login$/", function() {
  if($_POST['user'] != 'admin' && $_POST['password'] != 'secret') {
    $error = 'invalid user/password';
    include dirname(__FILE__).'/views/login-form.php';
  } else {
    include dirname(__FILE__).'/views/admin.php';
  }
});

$frank->get("/^\/(?P<year>\d+)\/(?P<month>\w+)\/(?P<post>.+)$/", function($p) {
  echo $p['post'].' was posted on '.$p['month'].' '.$p['year'];
});

$frank->run();
?>
