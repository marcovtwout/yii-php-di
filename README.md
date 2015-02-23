# yii-php-di
PHP-DI integration for Yii 1.
@see http://php-di.org/

## Requirements

- Yii 1.1.x
- PHP-DI http://php-di.org/doc/getting-started.html

## Installation

1. Place the wrapper in your application. (@todo: Composer install)
2. Add the application component in config/main.php:

```
'components' => array(
    ...
    'container' => array(
        'class' => 'path.to.DIContainerWrapper',
        //'definitions' => array()
    ),
    ...
```

## Usage

Only call the container from your controllers. Don't call or inject the container on a lower level (into models or components), or you are not really using Dependency Injection.

```
Yii::app()->container->get('MyClass');
```

