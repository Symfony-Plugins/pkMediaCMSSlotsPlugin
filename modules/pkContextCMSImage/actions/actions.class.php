<?php

class pkContextCMSImageActions extends pkContextCMSBaseActions
{
  public function executeEdit(sfRequest $request)
  {
    $this->logMessage("====== in pkContextCMSImageActions::executeEdit", "info");
    $this->editSetup();
    $item = pkMediaAPI::getSelectedItem($request, "app_pkContextCMS_media", "image");
    if ($item === false)
    {
      // Cancellation or error
      return $this->redirectToPage();
    } 
    $this->slot->value = serialize($item);
    $this->editSave();
  }
}
