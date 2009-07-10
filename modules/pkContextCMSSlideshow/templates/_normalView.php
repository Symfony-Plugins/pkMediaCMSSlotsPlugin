<?php if ($editable): ?>
  <?php // Normally we have an editor inline in the page, but in this ?>
  <?php // case we'd rather use the picker built into the media plugin. ?>
  <?php // So we link to the media picker and specify an 'after' URL that ?>
  <?php // points to our slot's edit action. Setting the ajax parameter ?>
  <?php // to false causes the edit action to redirect to the newly ?>
  <?php // updated page. ?>

  <?php slot("pk-slot-controls-$name-$permid") ?>
    <li class="pk-controls-item choose-images">
    <?php echo link_to('Choose images',
      sfConfig::get('app_pkMedia_client_site', false) . "/media/select?" .
        http_build_query(
          array_merge(
            $options['constraints'],
            array("multiple" => true,
            "pkMediaIds" => implode(",", $itemIds),
            "type" => "image",
            "label" => "Create a Slideshow",
            "after" => url_for("pkContextCMSSlideshow/edit") . "?" . 
              http_build_query(
                array(
                  "slot" => $name, 
                  "slug" => $slug, 
                  "permid" => $permid,
                  "actual_slug" => pkContextCMSTools::getRealPage()->getSlug(),
                  "noajax" => 1)), true))),
      array('class' => 'pk-btn icon pk-media')) ?>
    </li>
  <?php end_slot() ?>
<?php endif ?>

<?php include_component('pkContextCMSSlideshow', 'slideshow', array('items' => $items, 'id' => $id, 'options' => $options)) ?>

