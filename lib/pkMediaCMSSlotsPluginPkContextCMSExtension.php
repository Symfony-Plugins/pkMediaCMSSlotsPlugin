<?php

class pkMediaCMSSlotsPluginPkContextCMSExtension
{
  // You too can do this in a plugin dependent on pkContextCMS, see the provided stylesheet 
  // for how to correctly specify an icon to go with your button
  static public function getGlobalButtons()
  {
    return array(
      new pkContextCMSGlobalButton('Media', 'pkMedia/index', 'pk-media'));
  }
}
