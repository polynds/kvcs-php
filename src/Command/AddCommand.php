<?php

declare(strict_types=1);
/**
 * happy coding.
 */
namespace Kit\Command;

use Kit\ApplicationContext;

class AddCommand extends AbstractCommand implements CommandContract
{
    public function execute(array $parameter = [])
    {
        dump($parameter);
        $files = ApplicationContext::getApplication()->getWorkSpace()->readFiles();
        dump($files);
    }
}
