<?php
/**
 * Ignition - a selection of command-line
 * scripts and application development helpers
 * for PHP or CodeIgniter applications.
 *
 * @package ignition
 * @author Jamie Rumbelow
 */
 
class IgnitionGenerator extends Ignition {
  
  public function migration() {
    echo "\n=== Generating Migration File ===\n\n";

    if (!file_exists(APPPATH . 'migrations')) {
	  @mkdir(APPPATH . 'migrations');
      echo "created: ".APPPATH . "migrations\n";
    } else {
      echo "exists: ".APPPATH . "migrations\n";
    }

	$migno	   = $this->get_last_migration() + 1;
    $file_name = $migno . '_migration.php';
    
    $migration = '<?php
/* DATABASE MIGRATION */

function migration_'.$migno.'_up($CI) {
  // Up Migration
}

function migration_'.$migno.'_down($CI) {
  // Down Migration
}';
    
    if (!file_exists(APPPATH . 'migrations/'.$file_name)) {
      $f = fopen(APPPATH . 'migrations/'.$file_name, 'w+');
      fwrite($f, $migration);
      fclose($f);
      
      echo "created: ".APPPATH . 'migrations/'.$file_name."\n";
      echo "\nMigration generated successfully\n";
    }
  }
  
   protected function __tasks() {
      return "
=== Generator Ignition ===

  Tasks

    controller
      Generates a controller template in your
      application/controllers folder, with associated
      test files and view files.
      
      Pass through the name of the controller as the first
      parameter and any further parameters as action names.

    model
      Generates a model template in your
      application/models folder with associated tests.
      
      The first parameter is the name of the model. You can
      optionally pass through the --crud flag to extend from
      the MY_Model class and generate/pull that into the 
      application/libraries folder for a base CRUD interface.   

    migration
      Generates a new database migration.
";
    }

	private function get_last_migration() {
		$dir = @scandir(APPPATH . 'migrations');
		array_shift($dir);
		array_shift($dir);
		
		$files = array();
		
		foreach ($dir as $file) {
			$files[] = (int)str_replace('_migration.php', '', $file);
		}
		
		sort($files);
		
		return end($files);
	}
  
}