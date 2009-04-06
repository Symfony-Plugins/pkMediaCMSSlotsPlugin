<?php

class pkContextCMSImageComponents extends pkContextCMSBaseComponents
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
    $this->link = $this->getOption('link', false);
    $this->flexHeight = $this->getOption('flexHeight');
    // Behave well if it's not set yet!
    if (strlen($this->slot->value))
    {
      $this->item = unserialize($this->slot->value);
      $this->itemId = $this->item->id;
    }
    else
    {
      $this->item = false;
      $this->itemId = false;
    }
  }
}
