<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Command;

use Kit\ApplicationContext;

class InitCommand extends AbstractCommand
{
    protected function handle(array $parameter = [])
    {
        ApplicationContext::getApplication()->getRepository()->init();

        // TODO 如果当前目录下存在了很多的文件是否要自动执行add呢？
    }

    protected function validated(array $parameter = []): array
    {
        return [];
    }
}
