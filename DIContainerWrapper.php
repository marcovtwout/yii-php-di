<?php

/**
 * @author Marco van 't Wout <marco@tremani.nl>
 * @copyright Copyright &copy; Tremani, 2015
 */

/**
 * PHP-DI integration through application component for Yii 1.
 */
class DIContainerWrapper extends CApplicationComponent
{
    /**
     * @var \DI\Container
     */
    protected $container;

    /**
     * @var array
     */
    public $definitions = array();

    /**
     * Initialize application component.
     */
    public function init()
    {
        $builder = new \DI\ContainerBuilder;

        if (!empty($this->definitions)) {
            $builder->addDefinitions(new \DI\Definition\Source\ArrayDefinitionSource($this->definitions));
        }

        // @todo, more settings depending on environment and requirements
        // @link http://php-di.org/doc/container-configuration.html
        //$builder->useAutowiring(false);
        //$builder->useAnnotations(false);
        //$builder->ignorePhpDocErrors(true);
        //$builder->setDefinitionCache(new Doctrine\Common\Cache\FilesystemCache());
        //$builder->writeProxiesToFile(true, 'tmp/proxies');

        $this->container = $builder->build();
    }

    /**
     * Forward call to \DI\Container.
     *
     * @param string $name
     * @param array $parameters
     * @return mixed
     */
    public function __call($name, $parameters)
    {
        return call_user_func_array(array($this->container, $name), $parameters);
    }

    /**
     * @return \DI\Container
     */
    public function getContainer()
    {
        return $this->container;
    }
}
