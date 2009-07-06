<?php

class pkContextCMSVideoActions extends pkContextCMSBaseActions
{
  public function executeEdit(sfRequest $request)
  {
    $this->logMessage("====== in pkContextCMSVideoActions::executeEdit", "info");
    $this->editSetup();
    $item = pkMediaAPI::getSelectedItem($request, "video");
    if ($item === false)
    {
      // Cancellation or error
      return $this->redirectToPage();
    } 
    $this->slot->value = serialize($item);
    $this->editSave();
  }
}
