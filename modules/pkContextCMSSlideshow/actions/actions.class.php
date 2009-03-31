<?php

class pkContextCMSSlideshowActions extends pkContextCMSBaseActions
{
  public function executeEdit(sfRequest $request)
  {
    $this->logMessage("====== in pkContextCMSSlideshowActions::executeEdit", "info");
    $this->editSetup();
    $items = pkMediaAPI::getSelectedItems($request, "app_pkContextCMS_media", false, 'image');
    if ($items === false)
    {
      // Cancellation or error
      return $this->redirect($this->page->getUrl());
    } 
    $this->slot->value = serialize($items);
    $this->editSave();
  }
}
