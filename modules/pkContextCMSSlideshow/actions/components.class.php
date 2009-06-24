<?php

class pkContextCMSSlideshowComponents extends pkContextCMSBaseComponents
{
  public function executeEditView()
  {
    // Just a stub, we don't really utilize this for this slot type,
    // we have an external editor instead
    $this->setup();
  }
  public function executeNormalView()
  {
    $this->setup();
    $this->constraints = $this->getOption('constraints', array());
    $this->width = $this->getOption('width', 440);
    $this->height = $this->getOption('height', 330);
    $this->resizeType = $this->getOption('resizeType', 's');
    $this->flexHeight = $this->getOption('flexHeight');
    $this->title = $this->getOption('title');
    $this->description = $this->getOption('description');
    $this->interval = $this->getOption('interval', false) + 0;
    $this->arrows = $this->getOption('arrows', ($this->interval <= 0));
    $this->transition = $this->getOption('transition');
    // Behave well if it's not set yet!
    if (strlen($this->slot->value))
    {
      $this->items = unserialize($this->slot->value);
      $this->itemIds = array();
      foreach ($this->items as $item)
      {
        $this->itemIds[] = $item->id;
      }
    }
    else
    {
      $this->items = array();
      $this->itemIds = array();
    }
  }
}
