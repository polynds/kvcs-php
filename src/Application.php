<?php

declare(strict_types=1);
/**
 * happy coding.
 */
namespace Kit;

use Kit\Command\AddCommand;
use Kit\Command\CommandContract;
use Kit\Command\CommitCommand;
use Kit\Command\InitCommand;
use Kit\Command\PullCommand;
use Kit\Command\PushCommand;
use Kit\Exception\CommandDoesNotExistException;

class Application
{
    /**
     * @var CommandContract[]
     */
    protected array $commands;

    public function __construct()
    {
        $this->addCommand('init', new InitCommand());
        $this->addCommand('add', new AddCommand());
        $this->addCommand('commit', new CommitCommand());
        $this->addCommand('push', new PushCommand());
        $this->addCommand('pull', new PullCommand());
    }

    public function run(string $name, array $parmas)
    {
        $command = $this->matchCommand($name);
        if (is_null($command)) {
            throw new CommandDoesNotExistException();
        }
        $command->execute($parmas);
    }

    protected function matchCommand(string $name): ?CommandContract
    {
        return $this->commands[$name] ?? null;
    }

    protected function addCommand(string $name, CommandContract $command): Application
    {
        $this->commands[$name] = $command;
        return $this;
    }
}
