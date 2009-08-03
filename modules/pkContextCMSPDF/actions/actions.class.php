<?php

class pkContextCMSPDFActions extends pkContextCMSBaseActions
{
  public function executeEdit(sfRequest $request)
  {
    $this->logMessage("====== in pkContextCMSPDFActions::executeEdit", "info");
    $this->editSetup();
    $item = pkMediaAPI::getSelectedItem($request, "pdf");
    if ($item === false)
    {
      // Cancellation or error
      return $this->redirectToPage();
    } 
    $this->slot->value = serialize($item);
    $this->editSave();
  }
}
