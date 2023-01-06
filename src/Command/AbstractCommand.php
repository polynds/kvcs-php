<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Command;

use Kit\Command\Formater\DefaultFormater;
use Kit\Command\Formater\FormaterContract;
use Kit\Command\Formater\LogFormater;

abstract class AbstractCommand implements CommandContract
{
    public function execute(array $parameter = [])
    {
        $this->handle($this->validated($parameter));
    }

    abstract protected function handle(array $parameter = []);

    abstract protected function validated(array $parameter = []): array;

    protected function output(FormaterContract $formater = null, ...$msg): void
    {
        if (is_null($formater)) {
            $formater = new DefaultFormater();
        }
        $fp = fopen('php://stdout', 'w');
        if ($fp) {
            $message = '';
            foreach ($msg as $item) {
                $message .= $formater->format($item);
            }
            fwrite($fp, $message);
            fclose($fp);
        }
    }

    protected function print(...$msg): void
    {
        $this->output(null, ...$msg);
    }

    protected function log(...$msg): void
    {
        $this->output(new LogFormater(), ...$msg);
    }
}
