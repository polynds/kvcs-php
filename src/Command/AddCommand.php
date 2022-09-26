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
        $ignoreDirs = ApplicationContext::getApplication()->getKitIgnore()->reload()->getIgnoreDirs();
        $ignoreFiles = ApplicationContext::getApplication()->getKitIgnore()->reload()->getIgnoreFiles();
        var_dump(array_merge($ignoreDirs, $ignoreFiles));
        $files = ApplicationContext::getApplication()->getWorkSpace()->readFiles(array_merge($ignoreDirs, $ignoreFiles));
        dump($files);
    }
}
