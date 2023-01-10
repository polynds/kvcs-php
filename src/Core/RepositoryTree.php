<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Core;

use Kit\ApplicationContext;
use Kit\Core\ObjectDatabase\Objects\AbstractKitObject;

class RepositoryTree
{
    /**
     * 根据暂存区内容生成tree对象，并保存.
     */
    public function create()
    {
        $stagingArea = ApplicationContext::getApplication()->getRepository()->getStagingArea();
        $indexs = $stagingArea->load()->getIndex();
//        var_dump($indexs);
        foreach ($indexs as $index) {

            $object = $this->find($index->getFileHash());
            if(is_null($object)){

            }
            var_dump($index->getFileName() . '------' . $index->getPath());
        }
    }

    public function find(string $name): ?AbstractKitObject
    {
        $objectDatabase = ApplicationContext::getApplication()->getRepository()->getObjectDatabase();
        return $objectDatabase->read((new Hash($name))->getHashString());
    }
}
