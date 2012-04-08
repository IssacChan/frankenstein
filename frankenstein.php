<?php

class Frankenstein {

  var $root   = '/';
  var $routes = array();

  function run() {
    foreach($this->routes[$_SERVER['REQUEST_METHOD']] as $route => $function) {
      $url  = parse_url($_SERVER['REQUEST_URI']);
      $path = str_replace($this->root, '', $url['path']);
      if(preg_match($route, $path, $args)) return $function($args);
    }
    echo "404 - Page not found.";
  }

  function addRoute() {
    $args = func_get_args();
    $this->routes[$args[0]][$args[1]] = $args[2];
  }

  function get($route, $handler)  { $this->addRoute('GET',  $route, $handler); }
  function post($route, $handler) { $this->addRoute('POST', $route, $handler); }
}

$frank = new Frankenstein;
?>
