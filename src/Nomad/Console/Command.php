<?php

namespace Nomad\Console;

use Symfony\Component\Console\Command\Command as SymfonyCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

abstract class Command extends SymfonyCommand {

    /**
     * Name of the console command
     *
     * @var string
     */
    protected $name;

    /**
     * Description of what the console command does
     *
     * @var string
     */
    protected $description;

    /**
     * The input interface implementation.
     *
     * @var \Symfony\Component\Console\Input\InputInterface
     */
    protected $input;

    /**
     * The output interface implementation.
     *
     * @var \Symfony\Component\Console\Output\OutputInterface
     */
    protected $output;

    /**
     * Instance of an application to use within console commands
     *
     * @var
     */
    public $app;

    public function __construct() {
        parent::__construct($this->name);

        $this->setDescription($this->description);

        $this->addParameters();
    }

    protected function addParameters() {
        foreach ( $this->getArguments() as $arguments ) {
            call_user_func_array([$this, 'addArgument'], $arguments);
        }

        foreach ( $this->getOptions() as $options ) {
            call_user_func_array([$this, 'addOption'], $options);
        }
    }

    public function run(InputInterface $input, OutputInterface $output) {
        $this->input = $input;

        $this->output = $output;

        return parent::run($input, $output);
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $method = method_exists($this, 'handle') ? 'handle' : 'fire';

        return $this->$method();
    }

    public function argument($key = null) {
        if ( is_null($key) ) {
            return $this->input->getArguments();
        }

        return $this->input->getArgument($key);
    }

    public function option($key = null) {
        if ( is_null($key) ) {
            return $this->input->getOptions();
        }

        return $this->input->getOption($key);
    }

    protected function getArguments() {
        return [];
    }

    protected function getOptions() {
        return [];
    }
}