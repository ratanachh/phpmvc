<?php
declare(strict_types=1);

namespace Core;

use DI\Container;


class Application
{

    /**
     * @var Container $di
     */
    protected $di;

    public function __construct(Container $di)
    {
        $this->di = $di;
    }

    public function handle(string $url)
    {
        $this->registerDiServices();

        
        return $this;
    }

    public function getContent()
    {
        return "hsh";
    }

    public function registerDiServices()
    {
        foreach ($this->di->getKnownEntryNames() as $entity) {
            $this->di->get($entity);
        }
    }

}