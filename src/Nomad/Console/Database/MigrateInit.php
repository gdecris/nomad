<?php

namespace Nomad\Console\Database;

use Phinx\Console\Command\Init as Command;

class MigrateInit extends Command {

	protected function configure() {
		parent::configure();

		$this->setDescription('Initialize the application for migrations');
	}
}