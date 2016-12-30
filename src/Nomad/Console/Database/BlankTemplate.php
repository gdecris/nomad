<?php

namespace Nomad\Console\Database;

use Phinx\Migration\CreationInterface;

class BlankTemplate implements CreationInterface {

	/**
	 * Get the migration template.
	 * This will be the content that Phinx will amend to generate the migration file.
	 *
	 * @return string The content of the template for Phinx to amend.
	 */
	public function getMigrationTemplate() {
		return file_get_contents(__DIR__ . '/stubs/Blank.template.php.dist');
	}

	/**
	 * Post Migration Creation.
	 * Once the migration file has been created, this method will be called, allowing any additional
	 * processing, specific to the template to be performed.
	 *
	 * @param string $migrationFilename The name of the newly created migration.
	 * @param string $className The class name.
	 * @param string $baseClassName The name of the base class.
	 * @return void
	 */
	public function postMigrationCreation($migrationFilename, $className, $baseClassName) {
		// TODO: Implement postMigrationCreation() method.
	}
}