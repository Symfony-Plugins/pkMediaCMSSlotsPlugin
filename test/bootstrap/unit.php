<?php

if (!isset($_SERVER['SYMFONY']))
{
  throw new RuntimeException('Could not find symfony core libraries.');
}

require_once $_SERVER['SYMFONY'].'/autoload/sfCoreAutoload.class.php';
sfCoreAutoload::register();

$configuration = new sfProjectConfiguration(dirname(__FILE__).'/../fixtures/project');
require_once $configuration->getSymfonyLibDir().'/vendor/lime/lime.php';

function pkMediaCMSSlotsPlugin_autoload_again($class)
{
  $autoload = sfSimpleAutoload::getInstance();
  $autoload->reload();
  return $autoload->autoload($class);
}
spl_autoload_register('pkMediaCMSSlotsPlugin_autoload_again');

require_once dirname(__FILE__).'/../../config/pkMediaCMSSlotsPluginConfiguration.class.php';
$plugin_configuration = new pkMediaCMSSlotsPluginConfiguration($configuration, dirname(__FILE__).'/../..');
