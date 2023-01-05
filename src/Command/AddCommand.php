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
        $indexs = $this->stageFiles($files);
        $stagingArea = ApplicationContext::getApplication()->getRepository()->getStagingArea();
        foreach ($indexs as $index) {
            $stagingArea->addIndex($index);
        }
        $stagingArea->store();
    }

    public function stageFiles(array $files): array
    {
        // 收集文件和目录信息放入暂存区，再数据库中保存为一个文件
        $indexs = [];
        $objectDatabase = ApplicationContext::getApplication()->getRepository()->getObjectDatabase();
        foreach ($files as $file) {
            if ($file->getType()->isDirectory()) {
                $blob = new Blob(file_get_contents($file->getPath()));
                $indexs[] = (new IndexEntry())
                    ->setFileName($file->getName())
                    ->setMtime($file->getMtime())
                    ->setCtime($file->getCtime());
            } else {
                $blob = new Blob(file_get_contents($file->getPath()));
                $objectDatabase->store($blob);
                $indexs[] = (new IndexEntry())
                    ->setFileHash($blob->getHashString())
                    ->setFileName($file->getName())
                    ->setMtime($file->getMtime())
                    ->setCtime($file->getCtime());
            }
        }
        return $indexs;
    }
}
