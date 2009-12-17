<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class PluginpkContextCMSButtonSlot extends BasepkContextCMSButtonSlot
{
  public function refreshSlot()
  {
    $slot = $this;
    if (!strlen($slot->value))
    {
      // Not yet set
      return;
    }
    $info = unserialize($slot->value);
    if (!isset($info['image']))
    {
      throw new sfException('No image key in info hash for button slot ' . $slot->value);
    }
    $item = $info['image'];
    $api = new pkMediaAPI();
    $results = $api->getItems(array($item->id));
    if ($results === false)
    {
      echo("Warning: no valid response for slot " . $slot->id . ", leaving it alone on this pass\n");
      return;
    }
    if (!is_array($result))
    {
      throw new sfException('Result should have been array or false, received something else');
    }
    if (!count($results))
    {
      // The item is gone
      echo("Removing reference to deleted item id " . $item->id);
      $slot->value = null;
    }
    else
    {
      $info['image'] = $results[0];
      $slot->value = serialize($info);
    }
    $slot->save();
  }
}