<?php

namespace AndreasWeber\YealinkWorkflow\Script;

use AndreasWeber\YealinkWorkflow\Application;

abstract class BaseScript
{
    /**
     * @var Application The application
     */
    protected $app;

    /**
     * __construct()
     *
     * @param Application $app The application
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    /**
     * Returns the application.
     *
     * @return Application
     */
    public function getApplication()
    {
        return $this->app;
    }

    /**
     * Executes the script with the supplied query as argument.
     *
     * @param string $query The query
     *
     * @return null
     */
    abstract public function invoke();
}
