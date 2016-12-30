<?php

namespace Nomad\Console\Database;

use Phinx\Console\Command\Rollback as Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MigrateRollback extends Command {

	protected function configure() {
		parent::configure();

		$this->setName('migrate:rollback');
	}

	protected function initialize(InputInterface $input, OutputInterface $output) {
		$target = $input->getOption('target');

		//if ( $target == '' ) {
		//	$versions = Base::$redis->zrevrangebyscore('migrations', '+inf', '-inf', 'WITHSCORES', 'LIMIT', 0, 1);
		//	$target = reset($versions);
        //
		//	Base::$redis->zremrangebyscore('migrations', $target, '+inf');
        //
		//	$input->setOption('target', $target);
		//} else {
		//	if ( $target == 0 ) {
		//		Base::$redis->del('migrations');
		//	} else {
		//		Base::$redis->zremrangebyscore('migrations', $target, '+inf');
		//	}
		//}
	}
}