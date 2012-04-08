<?php
require_once dirname(__FILE__).'/../vendor/poor-test/poor-test.php';
require_once dirname(__FILE__).'/../vendor/curl-browser/curl-browser.php';

class TestFrankenstein extends PoorTest {

  var $browser;
  var $website;

  function beforeAll() {
    $this->browser = new CurlBrowser;

    /* you'll need to change these lines to run tests on your environment */
    exec('ln -s frankenstein/test/website ~/Sites/website');
    $this->website = 'http://localhost/~thiagoalessio/website';
  }

  function afterAll() { exec('rm ~/Sites/website'); }

  function testGetRoute() {
    $this->browser->get("$this->website/home");
    $expectedMessage = "Hi, this is a Frankenstein-powered website!";
    return strstr($this->browser->content, $expectedMessage);
  }

  function testPostRoute() {
    $badCredentials = array('user' => 'foo', 'password' => 'bar');
    $this->browser->post("$this->website/login", $badCredentials);
    if(!strstr($this->browser->content, "invalid user/password")) return false;

    $goodCredentials = array('user' => 'admin', 'password' => 'secret');
    $this->browser->post("$this->website/login", $goodCredentials);
    return strstr($this->browser->content, "Welcome, admin");
  }

  function testExtractArgumentsFromUrl() {
    $this->browser->get("$this->website/2012/april/hello-frank");
    $expectedResponse = "hello-frank was posted on april 2012";
    return strstr($this->browser->content, $expectedResponse);
  }

  function testNotFound() {
    $this->browser->get("$this->website/non-existent-page");
    return strstr($this->browser->content, "404 - Page not found.");
  }
}
new TestFrankenstein();
?>
