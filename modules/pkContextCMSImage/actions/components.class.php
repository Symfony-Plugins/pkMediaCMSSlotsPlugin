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
    $this->defaultImage = $this->getOption('defaultImage');
    $this->title = $this->getOption('title');
    $this->description = $this->getOption('description');
    // Behave well if it's not set yet!
    if (strlen($this->slot->value))
    {
      $this->item = unserialize($this->slot->value);
      $this->itemId = $this->item->id;
      $this->dimensions = pkDimensions::constrain(
        $this->item->width, 
        $this->item->height,
        $this->item->format, 
        array("width" => $this->width,
          "height" => $this->flexHeight ? false : $this->height,
          "resizeType" => $this->resizeType));
    }
    else
    {
      $this->item = false;
      $this->itemId = false;
    }
  }
}
