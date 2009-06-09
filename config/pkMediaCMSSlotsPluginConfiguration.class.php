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
    // Register an event so we can add our buttons to the set of global CMS back end admin buttons
    // that appear when the apostrophe is clicked. 
    $this->dispatcher->connect('pkContextCMS.getGlobalButtons', array('pkMediaCMSSlotsTools', 
      'getGlobalButtons'));
  }
}
