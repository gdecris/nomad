<?php

namespace Nomad\Console\Database;

use Phinx\Console\Command\Status as Command;

class MigrateStatus extends Command {

	protected function configure() {
		parent::configure();

		$this->setName('migrate:status');
	}
}