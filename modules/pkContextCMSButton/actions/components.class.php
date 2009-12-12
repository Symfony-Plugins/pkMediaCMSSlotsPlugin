<?php

class pkContextCMSButtonComponents extends pkContextCMSBaseComponents
{
  public function executeEditView()
  {
    $this->setup();
    // Careful, don't clobber a form object provided to us with validation errors
    // from an earlier pass
    if (!isset($this->form))
    {
      $this->form = new pkContextCMSButtonForm($this->id);
      $value = $this->slot->getArrayValue();
      if (isset($value['url']))
      {
        $this->form->setDefault('url', $value['url']);      
      }
    }
  }
  public function executeNormalView()
  {
    // Mostly identical to pkContextCMSImage, but we have the URL to contend with too
    $this->setup();
    $this->constraints = $this->getOption('constraints', array());
    $this->width = $this->getOption('width', 440);
    $this->height = $this->getOption('height', 330);
    $this->resizeType = $this->getOption('resizeType', 's');
    $this->flexHeight = $this->getOption('flexHeight');
    $this->defaultImage = $this->getOption('defaultImage');
    $this->title = $this->getOption('title');
    $this->description = $this->getOption('description');
    // Behave well if it's not set yet!
    $data = $this->slot->getArrayValue();
    $this->link = false;
    if (isset($data['url']))
    {
      $this->link = $data['url'];
    }
    $this->item = false;
    $this->itemId = false;
    if (isset($data['image']))
    {
      $this->item = $data['image'];
      $this->itemId = $this->item->id;
      $this->dimensions = pkDimensions::constrain(
        $this->item->width, 
        $this->item->height,
        $this->item->format, 
        array("width" => $this->width,
          "height" => $this->flexHeight ? false : $this->height,
          "resizeType" => $this->resizeType));
    }
  }
}
