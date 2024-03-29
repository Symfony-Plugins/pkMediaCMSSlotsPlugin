<?php

/**
 * This class has been auto-generated by the Doctrine ORM Framework
 */
abstract class PluginpkContextCMSImageSlot extends BasepkContextCMSImageSlot
{
  public function isOutlineEditable()
  {
    return false;
  }
  public function refreshSlot()
  {
    return self::refreshImageSlot($this);
  }
  // We do it this way as poor man's inheritance as Doctrine column aggregation inheritance
  // doesn't play well with deep inheritance trees
  static public function refreshImageSlot($slot)
  {
    if (!strlen($slot->value))
    {
      // Not yet set
      return;
    }
    $item = unserialize($slot->value);
    $api = new pkMediaAPI();
    $results = $api->getItems(array($item->id));
    if ($results === false)
    {
      echo("Warning: no valid response for slot " . $slot->id . ", leaving it alone on this pass\n");
      return;
    }
    if (!is_array($results))
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
      $slot->value = serialize($results[0]);
    }
    $slot->save();
  }
}
