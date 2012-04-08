# Frankenstein

  Wannabe the [other](http://www.sinatrarb.com/) Frank.

## Instalation

  Just clone and put somewhere inside your project folder.

    $ cd myapp/vendor
    $ git clone git://github.com/thiagoalessio/frankenstein.git

## Usage

  Setup your `.htaccess` file, matching your needs.

    Options +FollowSymlinks
    
    RewriteEngine On
    RewriteBase /
    RewriteRule . index.php

  Import `frankenstein.php`, define your routes with regular expressions
  and run it and the end:

    <?php
    require_once dirname(__FILE__).'/../vendor/frankenstein/frankenstein.php';
    
    $frank->root = '/~thiagoalessio/website'; // default value is '/'
    
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

  To get more details about regular expressions, visit 
  [http://www.php.net/manual/en/reference.pcre.pattern.syntax.php](http://www.php.net/manual/en/reference.pcre.pattern.syntax.php)

## Warning

  It's still under development, please don't use it on serious projects.
