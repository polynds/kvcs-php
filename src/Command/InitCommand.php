<?php

declare(strict_types=1);
/**
 * happy coding.
 */
namespace Kit\Command;

use Kit\ApplicationContext;

class InitCommand extends AbstractCommand implements CommandContract
{
    public function execute(array $parameter = [])
    {
        //创建目录
        ApplicationContext::getApplication()->getRepository()->init();
        //读取工作区，并生成对象
    }
}
