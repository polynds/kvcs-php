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
        $file = $parameter[0] ?? '';
        dump($parameter);
        $ignoreDirs = ApplicationContext::getApplication()->getKitIgnore()->reload()->getIgnoreDirs();
        $ignoreFiles = ApplicationContext::getApplication()->getKitIgnore()->reload()->getIgnoreFiles();
        $ignoreFiles = array_merge($ignoreDirs, $ignoreFiles);
        var_dump($ignoreFiles);
        $files = ApplicationContext::getApplication()->getWorkSpace()->readFiles($file,$ignoreFiles);
        dump($files);
    }
}
