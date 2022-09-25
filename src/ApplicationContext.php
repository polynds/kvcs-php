<?php

declare(strict_types=1);
/**
 * happy coding.
 */
namespace Kit;

class ApplicationContext
{
    protected static Application $application;

    public static function getApplication(): Application
    {
        return self::$application;
    }

    public static function setApplication(Application $application)
    {
        self::$application = $application;
    }
}
