<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Command;

use Kit\ApplicationContext;
use Kit\Cache\IndexEntry;
use Kit\Objects\Blob;

class AddCommand extends AbstractCommand implements CommandContract
{
    public function execute(array $parameter = [])
    {
        $file = $parameter[0] ?? '';
        $ignore = ApplicationContext::getApplication()->getKitIgnore()->reload();
        $ignoreDirs = $ignore->getIgnoreDirs();
        $ignoreFiles = $ignore->getIgnoreFiles();
        $ignoreFiles = array_merge($ignoreDirs, $ignoreFiles);
        $files = ApplicationContext::getApplication()->getWorkSpace()->readFiles($file, $ignoreFiles)->scan();
        dump($files);
        // 文件生成blob对象，目录生成tree对象，放入暂存区
        foreach ($files as $file) {
            if ($file->getType()->isDirectory()) {

            } else {
                var_dump($file->getName());
                $blob = new Blob(file_get_contents($file->getPath()));
                ApplicationContext::getApplication()->getRepository()->getObjectDatabase()->store($blob);
                $index = (new IndexEntry())->setFileHash($blob->getHashString());
                ApplicationContext::getApplication()->getRepository()->getStagingArea()->addIndex($index);
            }
        }
    }
}
