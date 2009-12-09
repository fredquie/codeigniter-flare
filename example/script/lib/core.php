<?php
/**
 * Ignition - a selection of command-line
 * scripts and application development helpers
 * for PHP or CodeIgniter applications.
 *
 * @package ignition
 * @author Jamie Rumbelow
 */
 
class Ignition {
  
  private $CI;
  
  public function __construct(&$CI) {
    $this->ci =& $CI;
  }
  
  public function run($task) { 
    $this->__before();
    $this->$task(); 
    $this->__after();
  }
  
  public function help() {
    echo $this->__tasks();
  }
  
  protected function __before() {}
  protected function __after()  {}
  protected function __tasks()  {}
  
}