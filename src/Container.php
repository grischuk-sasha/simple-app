<?php
use src\components\base\Container,
    src\components\base\CompilerPass,
    Symfony\Component\DependencyInjection\Loader\YamlFileLoader as DependencyLoader,
    Symfony\Component\DependencyInjection\Dumper\PhpDumper
    ;
if (file_exists($file = BASE_DIR .'var/cache/container.php') && !DEBUG) {
    require_once $file;
    $container = new ServiceContainerCache();
} else {
    $container = new Container();
    $container->register('file_locator', 'Symfony\Component\Config\FileLocator')
        ->setArguments([__DIR__.'/configs']);
    (new DependencyLoader($container, $container->get('file_locator')))->load('services.yml');
    $container->addCompilerPass(new CompilerPass());
    $container->compile();
    $dumper = new PhpDumper($container);
    file_put_contents($file, $dumper->dump(['class' => 'ServiceContainerCache']));
}
return $container;