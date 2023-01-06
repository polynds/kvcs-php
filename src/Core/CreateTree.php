<?php

namespace Kit\Core;

use Kit\ApplicationContext;

class CreateTree
{
    /**
     * 根据暂存区内容生成tree对象，并保存
     */
    public function create(){
        $stagingArea = ApplicationContext::getApplication()->getRepository()->getStagingArea();
        $indexs = $stagingArea->load()->getIndex();
        foreach ($indexs as $index){

        }

    }
}