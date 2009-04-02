<?php if ($editable): ?>
  <?php // Normally we have an editor inline in the page, but in this ?>
  <?php // case we'd rather use the picker built into the media plugin. ?>
  <?php // So we link to the media picker and specify an 'after' URL that ?>
  <?php // points to our slot's edit action. Setting the ajax parameter ?>
  <?php // to false causes the edit action to redirect to the newly ?>
  <?php // updated page. ?>
  <?php echo link_to('Choose images<span></span>',
    sfConfig::get('app_pkContextCMS_media_site', false) . "/media/select?" .
      http_build_query(
        array("multiple" => true,
        "pkMediaIds" => implode(",", $itemIds),
        "type" => "image",
        "after" => url_for("pkContextCMSSlideshow/edit") . "?" . 
          http_build_query(
            array(
              "slot" => $name, 
              "slug" => $slug, 
              "permid" => $permid,
              "actual_slug" => pkContextCMSTools::getRealPage()->getSlug(),
              "noajax" => 1)), true)),
    array('class' => 'pk-btn pk-context-media-choose')) ?>
<br class="c"/>
<?php endif ?>

<?php if (count($items) > 1): ?>
<div class="pk-context-media-show-controls">
	<?php echo link_to_function('Previous', '', array('class' => 'pk-context-media-show-controls-previous pk-btn arrow-left icon', )) ?>
	<?php echo link_to_function('Next', '', array('class' => 'pk-context-media-show-controls-next pk-btn arrow-right icon	', )) ?>	
</div>
<?php endif ?>

<ul class="pk-context-media-show">
<?php $first = true; $n=0; foreach ($items as $item): ?>
  <?php $embed = str_replace(
    array("_WIDTH_", "_HEIGHT_", "_c-OR-s_", "_FORMAT_"),
    array($width, 
      $flexHeight ? (($width / $item->width) * $item->height) : $height, 
      $resizeType,
      $item->format),
    $item->embed) ?>
  <li class="pk-context-media-show-item shadow" id="pk-context-media-show-item-<?php echo $n ?>" style="height:<?php echo $height ?>"><?php echo $embed ?></li>
<?php $first = false; $n++; endforeach ?>
</ul>

<?php if (count($items) > 1): ?>
<script type='text/javascript'>
$(function() {
	
	var position = 0;
	var img_count = <?php echo count($items) ?>-1;
		
  $('.pk-context-media-show li.pk-context-media-show-item').click(function() {
		
		$(this).attr('title','Click For Next Image &rarr;');
		
		if (position <= img_count)
		{
			position++;
			if (position == img_count+1 ) { position = 0; }
			$('.pk-context-media-show-item').hide();
			$('#pk-context-media-show-item-'+position).fadeIn('slow');	
		}
  });

	$('.pk-context-media-show-controls-previous').click(function(event){
		event.preventDefault();
		if (position >= 0)
		{
			position--;
			if (position < 0 ) { position = img_count; }
			$('.pk-context-media-show-item').hide();
			$('#pk-context-media-show-item-'+position).fadeIn('slow');			
		}
	});

	$('.pk-context-media-show-controls-next').click(function(event){
		event.preventDefault();
		if (position <= img_count)
		{
			position++;
			if (position == img_count+1 ) { position = 0; }
			$('.pk-context-media-show-item').hide();
			$('#pk-context-media-show-item-'+position).fadeIn('slow');			
		}
	});

});
</script>
<?php endif ?>