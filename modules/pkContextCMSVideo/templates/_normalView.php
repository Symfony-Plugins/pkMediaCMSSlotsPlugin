<?php if ($editable): ?>
  <?php // Normally we have an editor inline in the page, but in this ?>
  <?php // case we'd rather use the picker built into the media plugin. ?>
  <?php // So we link to the media picker and specify an 'after' URL that ?>
  <?php // points to our slot's edit action. Setting the ajax parameter ?>
  <?php // to false causes the edit action to redirect to the newly ?>
  <?php // updated page. ?>

  <?php slot("pk-slot-controls-$name-$permid") ?>
    <li class="pk-controls-item choose-video">
    <?php echo link_to('Choose video<span></span>',
      sfConfig::get('app_pkMedia_client_site', false) . "/media/select?" .
        http_build_query(
          array_merge(
            $options['constraints'],
            array(
            "pkMediaId" => $itemId,
            "type" => "video",
            "label" => "Select a Video",
            "after" => url_for("pkContextCMSVideo/edit") . "?" .
              http_build_query(
                array(
                  "slot" => $name, 
                  "slug" => $slug, 
                  "actual_slug" => pkContextCMSTools::getRealPage()->getSlug(),
                  "permid" => $permid,
                  "noajax" => 1)), true))),
      array('class' => 'pk-btn icon pk-video')) ?>
    </li>
  <?php end_slot() ?>
<?php endif ?>
<?php if ($item): ?>
  <ul class="pk-media-video">

  <li class="pk-media-video-embed">
	<?php $embed = str_replace(
    array("_WIDTH_", "_HEIGHT_", "_c-OR-s_", "_FORMAT_"),
    array($options['width'], 
      $options['flexHeight'] ? floor(($options['width'] / $item->width) * $item->height) : $options['height'], 
      $options['resizeType'],
      $item->format),
    $item->embed) ?>
  <?php echo $embed ?>
	</li>
  <?php if ($options['title']): ?>
    <li class="pk-media-video-title"><?php echo $item->title ?></li>
  <?php endif ?>
  <?php if ($options['description']): ?>
    <li class="pk-media-video-description"><?php echo $item->description ?></li>
  <?php endif ?>
	<?php if ($options['credit']): ?>
    <li class="pk-media-video-credit">Credit: <?php echo $item->credit ?></li>
	<?php endif ?>
  </ul>
<?php endif ?>