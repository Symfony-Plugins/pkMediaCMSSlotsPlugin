<?php

/**
 * pkMediaCMSSlotsPlugin configuration.
 * 
 * @package     pkMediaCMSSlotsPlugin
 * @subpackage  config
 * @author      Your name here
 * @version     SVN: $Id: PluginConfiguration.class.php 12628 2008-11-04 14:43:36Z Kris.Wallsmith $
 */
class pkMediaCMSSlotsPluginConfiguration extends sfPluginConfiguration
{
  /**
   * @see sfPluginConfiguration
   */
  public function initialize()
  {
    pkContextCMSTools::addGlobalButton('Media', 'pkMedia/index', 'pk-media');
  }
}
