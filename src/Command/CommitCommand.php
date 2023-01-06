<?php

declare(strict_types=1);
/**
 * happy coding!!!
 */
namespace Kit\Command;

use Kit\ApplicationContext;
use Kit\Exception\ParameterErrorException;

class CommitCommand extends AbstractCommand
{
    protected function handle(array $parameter = [])
    {
        // 1、根据暂存区内容生成tree对象，并保存
        $stagingArea = ApplicationContext::getApplication()->getRepository()->getStagingArea();
        $index = $stagingArea->load()->getIndex();

        // 2、生成commit对象，包含tree对象，并保存

        // 3、清空暂存区
    }

    protected function validated(array $parameter = []): array
    {
        $message = $parameter[0] ?? '';
        if (! $message) {
            throw new ParameterErrorException('The submission information cannot be empty.');
        }
        return $parameter;
    }
}
