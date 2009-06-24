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
      sfConfig::get('app_pkContextCMS_media_site', false) . "/media/select?" .
        http_build_query(
          array_merge(
            $constraints,
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
		<?php // Next/Prev Arrows Duplicated for Logged in View ?>
		<?php /* if (count($items) > 1): ?>
		<li><?php echo link_to_function('Previous', '', array('class' => 'pk-context-media-show-controls-previous pk-btn arrow-left icon', )) ?></li>
		<li><?php echo link_to_function('Next', '', array('class' => 'pk-context-media-show-controls-next pk-btn arrow-right icon	', )) ?></li>
		<?php endif */ ?>
  <?php end_slot() ?>
<?php endif ?>

<?php if ($arrows && (count($items) > 1)): ?>
<ul id="pk-slideshow-controls-<?php echo $id ?>" class="pk-slideshow-controls">
	<li><?php echo link_to_function('Previous', '', array('class' => 'pk-slideshow-controls-previous pk-btn pk-arrow-left icon', )) ?></li>
	<li><?php echo link_to_function('Next', '', array('class' => 'pk-slideshow-controls-next pk-btn pk-arrow-right icon	', )) ?></li>
</ul>
<?php endif ?>

<ul id="pk-slideshow-<?php echo $id ?>" class="pk-slideshow">
<?php $first = true; $n=0; foreach ($items as $item): ?>
  <?php $iwidth = $width ?>
  <?php $iheight = $flexHeight ? floor(($width / $item->width) * $item->height) : $height ?>
  <?php if (($iwidth > $item->width) || ($iheight > $item->height)): ?>
    <?php $iwidth = $item->width ?>
    <?php $iheight = $item->height ?>
  <?php endif ?>
  <?php $embed = str_replace(
    array("_WIDTH_", "_HEIGHT_", "_c-OR-s_", "_FORMAT_"),
    array($iwidth, 
      $iheight, 
      $resizeType,
      $item->format),
    $item->embed) ?>
  <li class="pk-slideshow-item" id="pk-slideshow-item-<?php echo $id ?>-<?php echo $n ?>" style="height:<?php echo $height ?>;<?php echo ($n==0)? 'display:block':'' ?>">
    <?php echo $embed ?></li>
    <?php if ($title): ?>
      <?php // These are pre-escaped HTML ?>
      <p class="pk-slideshow-title"><?php echo $item->title ?></p>
      <p class="pk-slideshow-description"><?php echo $item->description ?></p>
    <?php endif ?>
  </li>
<?php $first = false; $n++; endforeach ?>
</ul>

<?php if (count($items) > 1): ?>
<script type='text/javascript'>
$(function() {
	
	var position = 0;
	var img_count = <?php echo count($items) ?>-1;
	
	$('#pk-slideshow-item-<?php echo $id ?>-'+position).show();
		
  $('#pk-slideshow-<?php echo $id ?> .pk-slideshow-item').click(function() {
		
		$(this).attr('title','Click For Next Image &rarr;');
		
		if (position <= img_count)
		{
			position++;
			if (position == img_count+1 ) { position = 0; }
			$('#pk-slideshow-<?php echo $id ?> .pk-slideshow-item').hide();
			$('#pk-slideshow-item-<?php echo $id ?>-'+position).fadeIn('slow');	
		}
  });

	$('#pk-slideshow-controls-<?php echo $id ?> .pk-slideshow-controls-previous').click(function(event){
		event.preventDefault();
		previous();
	});

	$('#pk-slideshow-controls-<?php echo $id ?> .pk-slideshow-controls-next').click(function(event){
		event.preventDefault();
		next();
	});

  function previous() 
  {
  	if (position >= 0)
		{
			position--;
			if (position < 0 ) { position = img_count; }
			$('#pk-slideshow-<?php echo $id ?> .pk-slideshow-item').hide();
			$('#pk-slideshow-item-<?php echo $id ?>-'+position).fadeIn('slow');			
		}
		interval();
  }
  
  function next()
  {
  	if (position <= img_count)
  	{
  		position++;
  		if (position == img_count+1 ) { position = 0; }
  		$('#pk-slideshow-<?php echo $id ?> .pk-slideshow-item').hide();
  		$('#pk-slideshow-item-<?php echo $id ?>-'+position).fadeIn('slow');			
  	}
  	interval();
  }
  var intervalTimeout = null;
  function interval()
  {
    if (intervalTimeout)
    {
      clearTimeout(intervalTimeout);
    }
  	<?php if ($interval > 0): ?>
  	  intervalTimeout = setTimeout(next, <?php echo $interval ?> * 1000);
    <?php endif ?>
  }
  interval();
});
</script>
<?php endif ?>
