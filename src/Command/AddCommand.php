<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Command;

use Kit\ApplicationContext;
use Kit\Core\IndexEntry;
use Kit\Core\Objects\Blob;

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
        // 收集文件和目录信息放入暂存区，再数据库中保存为一个文件
        $indexs = [];
        foreach ($files as $file) {
            if ($file->getType()->isDirectory()) {
                $blob = new Blob(file_get_contents($file->getPath()));
                $indexs[] = (new IndexEntry())
                    ->setFileHash($file->getHashString())
                    ->setMtime($file->getMtime())
                    ->setCtime($file->getCtime());
            } else {
                var_dump($file->getName());
                $blob = new Blob(file_get_contents($file->getPath()));
                ApplicationContext::getApplication()->getRepository()->getObjectDatabase()->store($blob);
                $indexs[] = (new IndexEntry())
                    ->setFileHash($blob->getHashString())
                    ->setMtime($file->getMtime())
                    ->setCtime($file->getCtime());
            }
        }

        foreach ($indexs as $index) {
            ApplicationContext::getApplication()->getRepository()->getStagingArea()->addIndex($index);
        }
        ApplicationContext::getApplication()->getRepository()->getStagingArea()->store();
    }
}
