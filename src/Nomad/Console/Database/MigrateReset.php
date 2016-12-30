<?php

namespace Nomad\Console\Database;

use Nomad\Console\Command;
use Symfony\Component\Console\Input\ArrayInput;

class MigrateReset extends Command {

	protected $name = 'migrate:reset';

	protected $description = 'Rollback all database migrations';

	public function handle() {
		$command = $this->getApplication()->find('migrate:rollback');

		$arguments = [
			'command' => 'migrate:rollback',
			'--target' => '0'
		];

		$resetInput = new ArrayInput($arguments);

		$returnCode = $command->run($resetInput, $this->output);
	}
}