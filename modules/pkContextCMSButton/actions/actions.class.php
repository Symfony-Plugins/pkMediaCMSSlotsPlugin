<?php

class pkContextCMSButtonActions extends pkContextCMSBaseActions
{
  // Image association is handled by a separate action
  public function executeImage(sfRequest $request)
  {
    $this->logMessage("====== in pkContextCMSImageActions::executeImage", "info");
    $this->editSetup();
    $item = pkMediaAPI::getSelectedItem($request, "image");
    if ($item === false)
    {
      // Cancellation or error
      return $this->redirectToPage();
    } 
    $value = $this->slot->getArrayValue();
    $value['image'] = $item;
    $this->slot->setArrayValue($value);
    $this->editSave();
  }
  
  // Use the edit view for the URL (and any other well-behaved fields that may arise) 
  public function executeEdit(sfRequest $request)
  {
    $this->logMessage("====== in pkContextCMSImageActions::executeEdit", "info");
    $this->editSetup();
    $url = $request->getParameter('url');
    // sfValidatorUrl doesn't accept mailto, deal with local URLs at all, etc.
    // Let's take a stab at a more forgiving approach. Also, if the URL
    // begins with the site's prefix, turn it back into a local URL just before
    // save time for better data portability. TODO: let this stew a bit then
    // turn it into a validator and use a form here
    $prefix = $request->getUriPrefix();
    if (substr($url, 0, 1) === '/')
    {
      $url = "$prefix$url";
    }
    $this->validationData['invalid'] = false;
    // Borrowed and extended from sfValidatorUrl
    if (!preg_match(  
      '~^
        (
          (https?|ftps?)://                       # http or ftp (+SSL)
          (
            [\w\-\.]+             # a domain name (tolerate intranet short names)
              |                                   #  or
            \d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}    # a IP address
          )
          (:[0-9]+)?                              # a port (optional)
          (/?|/\S+)                               # a /, nothing or a / with something
          |
          mailto:\S+
        )
      $~ix', $url))
    {
      $this->validationData['invalid'] = true;
      $this->validationData['value'] = $url;
      return $this->editRetry();
    }
    else
    {
      // Convert URLs back to local if they have the site's prefix
      if (substr($url, 0, strlen($prefix)) === $prefix)
      {
        $url = substr($url, strlen($prefix));
      }
      $value = $this->slot->getArrayValue();
      $value['url'] = $url;
      $this->slot->setArrayValue($value);
      return $this->editSave();
    }
  }
}
