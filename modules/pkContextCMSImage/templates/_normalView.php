<?php if ($editable): ?>
  <?php // Normally we have an editor inline in the page, but in this ?>
  <?php // case we'd rather use the picker built into the media plugin. ?>
  <?php // So we link to the media picker and specify an 'after' URL that ?>
  <?php // points to our slot's edit action. Setting the ajax parameter ?>
  <?php // to false causes the edit action to redirect to the newly ?>
  <?php // updated page. ?>
  <?php // Wrap controls in a div for styling purposes ?>
  <?php echo link_to('Choose image<span></span>',
    sfConfig::get('app_pkContextCMS_media_site', false) . "/media/select?" .
      http_build_query(
        array_merge(
          $constraints,
          array(
          "pkMediaId" => $itemId,
          "type" => "image",
          "label" => "Select an Image",
          "after" => url_for("pkContextCMSImage/edit") . "?" .
            http_build_query(
              array(
                "slot" => $name, 
                "slug" => $slug, 
                "actual_slug" => pkContextCMSTools::getRealPage()->getSlug(),
                "permid" => $permid,
                "noajax" => 1)), true))),
    array('class' => 'pk-btn pk-context-media-choose')) ?>
  <br class="c" />
<?php endif ?>
<?php if ($item): ?>
  <div class="pk-context-media-image">
  <?php $embed = str_replace(
    array("_WIDTH_", "_HEIGHT_", "_c-OR-s_", "_FORMAT_"),
    array($width, 
      $flexHeight ? floor(($width / $item->width) * $item->height) : $height, 
      $resizeType,
      $item->format),
    $item->embed) ?>
  <?php if ($link): ?>
    <?php $embed = "<a href=\"$link\">$embed</a>" ?>
  <?php endif ?>
  <?php echo $embed ?>
  </div>
<?php endif ?>
