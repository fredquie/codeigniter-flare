<?php
/**
 * Flare is a very simple, elegant yet powerful
 * Object Relational Mapper for CodeIgniter applications.
 *
 * @package Flare
 * @license GPLv3 <http://www.gnu.org/licenses/gpl-3.0.txt>
 * @link http://github.com/jamierumbelow/flare
 * @version 0.1.0
 * @author Jamie Rumbelow <http://jamierumbelow.net>
 * @copyright Copyright (c) 2009, Jamie Rumbelow <http://jamierumbelow.net>
 */
 
class Flare {
  
  private $__flare__attributes = array();
  
  private $__flare__ci;
  
  public function __construct() {
    $this->__flare__ci =& get_instance();
  }
  
  public function __get($var) {
    if (array_key_exists($var, $this->__flare__attributes)) {
      return $this->__flare__atrributes[$var];
    }
  }
  
  public function __set($var, $val) {
    $this->__flare__atrributes[$var] = $val;
  }
  
  public function __call($method, $args = array()) {
    
  }
  
}