<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Command;

use Kit\ApplicationContext;

class ReadTreeCommand extends AbstractCommand
{
    protected function handle(array $parameter = [])
    {
        $stagingArea = ApplicationContext::getApplication()->getRepository()->getStagingArea();
        $indexs = $stagingArea->load()->getIndex();
        foreach ($indexs as $index) {
            $this->print((string) $index);
        }
    }

    protected function validated(array $parameter = []): array
    {
        return [];
    }
}
