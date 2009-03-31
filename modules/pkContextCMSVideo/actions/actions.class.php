<?php

class pkContextCMSVideoActions extends pkContextCMSBaseActions
{
  public function executeEdit(sfRequest $request)
  {
    $this->logMessage("====== in pkContextCMSVideoActions::executeEdit", "info");
    $this->editSetup();
    $item = pkMediaAPI::getSelectedItem($request, "app_pkContextCMS_media", "video");
    if ($item === false)
    {
      // Cancellation or error
      return $this->redirect($this->page->getUrl());
    } 
    $this->slot->value = serialize($item);
    $this->editSave();
  }
}
