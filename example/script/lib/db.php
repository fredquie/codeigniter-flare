<?php
/**
 * Ignition - a selection of command-line
 * scripts and application development helpers
 * for PHP or CodeIgniter applications.
 *
 * @package ignition
 * @author Jamie Rumbelow
 */
 
class IgnitionDB extends Ignition {
  
  public function migrate() {
    echo "\n=== Running Migrations ===\n\n";
    
    $latest = $this->_get_current_version();
    $version = ($latest) ? $latest : 0 ;
    
    if (!isset($_SERVER['argv'][2]) || $_SERVER['argv'][2] == 'top') {    
      foreach (@scandir(APPPATH . 'migrations') as $file) {
        $file = str_replace('_migration.php', '', $file);
        
        if ((int)$file > $version) {
          require_once APPPATH . 'migrations/' . $file . '_migration.php';
        
          $CI =& get_instance();
          $CI->load->database();
          $CI->load->dbforge();
        
          $function = 'migration_'.$file.'_up';
          $function($CI);
        
          $version = $file;
          $this->_set_version_number($file);
        
          echo "Migrated to version $file\n";
          $latest = $file;
        }
      }
    } elseif ($_SERVER['argv'][2] == 'up') {    
      $done = FALSE;
      $dir = scandir(APPPATH . 'migrations');
      $i = 0;
      
      array_shift($dir);
      array_shift($dir);
      
      sort($dir);
    
      while ($done == FALSE) {
        $file = $dir[$i];
        $file = str_replace('_migration.php', '', $file);
        
        if ((int)$file > $version) {
          require_once APPPATH . 'migrations/' . $file . '_migration.php';
        
          $CI =& get_instance();
          $CI->load->database();
          $CI->load->dbforge();
        
          $function = 'migration_'.$file.'_up';
          $function($CI);
        
          $this->_set_version_number($file);
        
          echo "Migrated to version $file\n";
          $done = TRUE;
        }
        
        if ($i == count($dir)-1) {
          $done = TRUE;
        }
        
        $i++;
      }
    } elseif ($_SERVER['argv'][2] == 'down') {
      require_once APPPATH . 'migrations/' . $version . '_migration.php';
      
      $CI =& get_instance();
      $CI->load->database();
      $CI->load->dbforge();
      
      $function = 'migration_'.$version.'_down';
      $function($CI);
      
      $dir      = scandir(APPPATH . 'migrations');
      $versions = array();
      
      foreach ($dir as $file) {
        $file = str_replace('_migration.php', '', $file);
        
        if ($file[0] !== '.') {
          $versions[] = $file;
        }
      }
      
      $cur_version = $this->_get_current_version();
      $min_version = min($versions);
      
      if (count($versions) !== 1) {
        sort($versions);
        $version = $versions[count($versions)-2];
        
        if ($cur_version == $min_version) {
          $version = 0;
        }
      } else {
        $version = 0;
      }
      
      $this->_set_version_number($version);
    }
    
    echo "At version $version\n\n";
  }
  
  public function reset() {
    
  }
  
  public function create() {
    
  }
  
  public function schema() {
    
  }
  
  protected function __before() {
    $this->ci->load->database();
    $this->ci->load->dbforge();
  }
  
  protected function __tasks() {
    return "
=== Database Ignition ===

  Tasks
  
    migrate
      Runs the database migrations found in
      application/migrations. Defaults to 'top'
      
      Parameters:
        top  - migrate to the most current version
        up   - migrate up one version
        down - migrate down one version
        
    reset
      Empties the database and runs all the 
      migrations to the most current version
      
    create
      Creates the database found in the 
      config/database.php config file
      
    schema
      Dumps the schema to application/migrations/schema.php.
      
";
  }
  
  private function _get_current_version() {
    if (!$this->ci->db->table_exists('database_migrations')) {
      $this->ci->dbforge->add_field('id');
      $this->ci->dbforge->add_field(array('version' => array('type' => 'VARCHAR', 'constraint' => '200')));
      $this->ci->dbforge->create_table('database_migrations');
    }
    
    $query = $this->ci->db->limit(1)
                          ->order_by('id DESC')
                          ->get('database_migrations');
	return ($query->num_rows() > 0) ? $query->row()->version : 0;
  }
  
  private function _set_version_number($version) {
    $data = array(
      'version' => $version
    );
    
    return $this->ci->db->insert('database_migrations', $data);
  }
  
}