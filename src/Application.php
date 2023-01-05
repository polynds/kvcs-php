<?php

declare(strict_types=1);
/**
 * happy coding!!!
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

    protected string $basePath;

    protected Repository $repository;

    protected WorkSpace $workSpace;

    protected KitIgnore $kitIgnore;

    public function __construct(string $basePath)
    {
        $this->basePath = $basePath;
        $this->repository = new Repository($basePath);
        $this->workSpace = new WorkSpace($basePath);
        $this->kitIgnore = new KitIgnore($basePath);
        $this->addCommands();
    }

    public function getCommands(): array
    {
        return $this->commands;
    }

    public function getBasePath(): string
    {
        return $this->basePath;
    }

    public function getRepository(): Repository
    {
        return $this->repository;
    }

    public function getWorkSpace(): WorkSpace
    {
        return $this->workSpace;
    }

    public function getKitIgnore(): KitIgnore
    {
        return $this->kitIgnore;
    }

    public function f(){

    }

    public function run(string $name, array $parmas)
    {
        $command = $this->matchCommand($name);
        if (is_null($command)) {
            throw new CommandDoesNotExistException();
        }
        $command->execute($parmas);
    }

    public function addCommands(): void
    {
        $this->addCommand('init', new InitCommand());
        $this->addCommand('add', new AddCommand());
        $this->addCommand('commit', new CommitCommand());
        $this->addCommand('push', new PushCommand());
        $this->addCommand('pull', new PullCommand());
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
