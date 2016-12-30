<?php

namespace Nomad\Console\Database;

use Nomad\Console\Command;
use Symfony\Component\Console\Input\ArrayInput;

class MigrateRefresh extends Command {

	protected $name = 'migrate:refresh';

	protected $description = 'Reset and re-run all migrations';
	public function handle() {
		$command = $this->getApplication()->find('migrate:rollback');

		$arguments = [
			'command' => 'migrate:rollback',
			'--target' => '0'
		];

		$resetInput = new ArrayInput($arguments);
		$command->run($resetInput, $this->output);

		// Get migrate command
		$command = $this->getApplication()->find('migrate');

		// Run the command
		$migrateInput = new ArrayInput([]);
		$command->run($migrateInput, $this->output);
	}
}