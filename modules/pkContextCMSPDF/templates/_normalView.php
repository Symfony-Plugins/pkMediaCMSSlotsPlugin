<?php if ($editable): ?>
  <?php // Normally we have an editor inline in the page, but in this ?>
  <?php // case we'd rather use the picker built into the media plugin. ?>
  <?php // So we link to the media picker and specify an 'after' URL that ?>
  <?php // points to our slot's edit action. Setting the ajax parameter ?>
  <?php // to false causes the edit action to redirect to the newly ?>
  <?php // updated page. ?>
  <?php // Wrap controls in a slot to be inserted in a slightly different ?>
  <?php // context by the _area.php template ?>

<?php slot("pk-slot-controls-$name-$permid") ?>
	<li class="pk-controls-item choose-pdf">
  <?php echo link_to('Choose PDF',
    sfConfig::get('app_pkMedia_client_site', false) . "/media/select?" .
      http_build_query(
        array_merge(
          $constraints,
          array(
          "pkMediaId" => $itemId,
          "type" => "pdf",
          "label" => "Select a PDF Document",
          "after" => url_for("pkContextCMSPDF/edit") . "?" .
            http_build_query(
              array(
                "slot" => $name, 
                "slug" => $slug, 
                "actual_slug" => pkContextCMSTools::getRealPage()->getSlug(),
                "permid" => $permid,
                "noajax" => 1)), true))),
    array('class' => 'pk-btn icon pk-pdf')) ?>
	</li>
<?php end_slot() ?>

<?php endif ?>

<?php if ($item): ?>
  <div class="pk-context-media-pdf">
    <a href="<?php echo $item->original ?>">
      <?php // JOHN: make the PDF-ness visible here, perhaps as a semiopaque overlay ?>
      <?php // of the Adobe PDF icon ?>
      <?php $embed = str_replace(
        array("_WIDTH_", "_HEIGHT_", "_c-OR-s_", "_FORMAT_"),
        array($dimensions['width'], 
          $dimensions['height'],
          $dimensions['resizeType'],
          $dimensions['format']),
        $item->embed) ?>
      <?php echo $embed ?>
    </a>
  </div>

	<script type="text/javascript" charset="utf-8">
		$(document).ready(function() {
			$("#pk-slot-<?php echo $id ?> .pk-context-media-pdf a").prepend('<div class="pk-media-pdf-icon-overlay">Click to Download PDF</div>').attr('title','Click to Download PDF')
		});
	</script>

<?php else: ?>
  <?php if ($defaultImage): ?>
    <div class="pk-context-media-pdf">
      <?php echo image_tag($defaultImage) ?>
    </div>
  <?php endif ?>
<?php endif ?>