<?php if ($editable): ?>
  <?php // Normally we have an editor inline in the page, but in this ?>
  <?php // case we'd rather use the picker built into the media plugin. ?>
  <?php // So we link to the media picker and specify an 'after' URL that ?>
  <?php // points to our slot's edit action. Setting the ajax parameter ?>
  <?php // to false causes the edit action to redirect to the newly ?>
  <?php // updated page. ?>
  <?php // Wrap controls in a slot to be inserted in a slightly different ?>
  <?php // context by the _area.php template ?>

  <?php // Very short labels so sidebar slots don't have wrap in their controls. ?>
  <?php // That spoils assumptions that are being made elsewhere that they will ?>
  <?php // amount to only one row. TODO: find a less breakage-prone solution to that problem. ?>
  <?php slot("pk-slot-controls-$name-$permid") ?>
  	<li class="pk-controls-item choose-image">
    <?php echo link_to('Image',
      sfConfig::get('app_pkMedia_client_site', false) . "/media/select?" .
        http_build_query(
          array_merge(
            $constraints,
            array(
            "pkMediaId" => $itemId,
            "type" => "image",
            "label" => "Select an Image",
            "after" => url_for("pkContextCMSButton/image") . "?" .
              http_build_query(
                array(
                  "slot" => $name, 
                  "slug" => $slug, 
                  "actual_slug" => pkContextCMSTools::getRealPage()->getSlug(),
                  "permid" => $permid,
                  "noajax" => 1)), true))),
      array('class' => 'pk-btn icon pk-media')) ?>
  	</li>

    <?php include_partial('pkContextCMS/simpleEditButton',
      array('name' => $name, 'permid' => $permid, 'label' => 'URL', 'title' => 'Set URL', 'controlsSlot' => false)) ?>
  <?php end_slot() ?>
<?php endif ?>

<?php if ($item): ?>
  <ul>
    <li class="pk-context-image">
    <?php $embed = str_replace(
      array("_WIDTH_", "_HEIGHT_", "_c-OR-s_", "_FORMAT_"),
      array($dimensions['width'], 
        $dimensions['height'],
        $dimensions['resizeType'],
        $dimensions['format']),
      $item->embed) ?>
    <?php if ($link): ?>
      <?php $embed = "<a href=\"$link\">$embed</a>" ?>
    <?php endif ?>
    <?php echo $embed ?>
    </li>
    <?php if ($title): ?>
      <li class="pk-image-title"><?php echo $item->title ?></li>
    <?php endif ?>
    <?php if ($description): ?>
      <li class="pk-image-description"><?php echo $item->description ?></li>
    <?php endif ?>
  </ul>
<?php else: ?>
  <?php if ($defaultImage): ?>
    <ul>
      <li class="pk-context-image">
        <?php echo image_tag($defaultImage) ?>
      <li>
    </ul>
  <?php endif ?>
<?php endif ?>
