<?php

namespace Nomad\Console\Database;

use Phinx\Console\Command\Migrate as Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Migrate extends Command {

	protected function execute(InputInterface $input, OutputInterface $output) {
		$this->bootstrap($input, $output);

		$environment = $input->getOption('environment');

		if (null === $environment) {
			$environment = $this->getConfig()->getDefaultEnvironment();
		}

		$env = $this->getManager()->getEnvironment($environment);
		$prevMigrations = $env->getVersions();
		$lastVersion = end($prevMigrations);

		parent::execute($input, $output);

		$migrations = $env->getVersions();
		$migrations = array_diff($migrations, $prevMigrations);

		//Base::$redis->zadd('migrations', $lastVersion, json_encode(array_values($migrations)));
	}
}