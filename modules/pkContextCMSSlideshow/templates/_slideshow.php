<?php if ($options['arrows'] && (count($items) > 1)): ?>
<ul id="pk-slideshow-controls-<?php echo $id ?>" class="pk-slideshow-controls">
	<li class="pk-slideshow-controls-previous pk-btn pk-arrow-left icon nobg">Previous</li>
	<li class="pk-slideshow-controls-next pk-btn pk-arrow-right icon nobg">Next</li>
</ul>
<?php endif ?>

<ul id="pk-slideshow-<?php echo $id ?>" class="pk-slideshow">
<?php $first = true; $n=0; foreach ($items as $item): ?>
  <?php $dimensions = pkDimensions::constrain(
    $item->width, 
    $item->height,
    $item->format, 
    array("width" => $options['width'],
      "height" => $options['flexHeight'] ? false : $options['height'],
      "resizeType" => $options['resizeType'])) ?>
  <?php $embed = str_replace(
    array("_WIDTH_", "_HEIGHT_", "_c-OR-s_", "_FORMAT_"),
    array($dimensions['width'], 
      $dimensions['height'], 
      $dimensions['resizeType'],
      $dimensions['format']),
    $item->embed) ?>

  <li class="pk-slideshow-item" id="pk-slideshow-item-<?php echo $id ?>-<?php echo $n ?>">
		<?php include_partial('pkContextCMSSlideshow/slideshowItem', array('item' => $item, 'id' => $id, 'embed' => $embed,  'options' => $options)) ?>
	</li>
<?php $first = false; $n++; endforeach ?>
</ul>

<?php if (count($items) > 1): ?>
<script type="text/javascript" charset="utf-8">
	$(document).ready(function() {

			var position = 0;
			var img_count = <?php echo count($items) ?>-1;
			var slideshowItems = $('#pk-slideshow-<?php echo $id ?> .pk-slideshow-item');
			$('.pk-context-media-show-item').hide();
			$('#pk-slideshow-item-<?php echo $id ?>-'+position).show();

			var intervalEnabled = <?php echo ($options['interval'])? 1:0; ?>;

		slideshowItems.attr('title', 'Click For Next Image');
	
		$('#pk-slideshow-<?php echo $id ?>').bind('showImage', function(e, num){
			position = num;
			slideshowItems.hide();
			$('#pk-slideshow-item-<?php echo $id ?>-'+position).fadeIn('slow');
		});
		
	  slideshowItems.click(function(event) {
			event.preventDefault();
			$(this).attr('title','Click For Next Image');
			if (position <= img_count)
			{
				position++;
				if (position == img_count+1 ) { position = 0; }
				slideshowItems.hide();
				$('#pk-slideshow-item-<?php echo $id ?>-'+position).fadeIn('slow');	
			}
	  });

		$('#pk-slideshow-controls-<?php echo $id ?> .pk-slideshow-controls-previous').click(function(event){
			event.preventDefault();
			intervalEnabled = false;
			previous();
		});

		$('#pk-slideshow-controls-<?php echo $id ?> .pk-slideshow-controls-next').click(function(event){
			event.preventDefault();
			intervalEnabled = false;
			next();
		});

		$('.pk-slideshow-controls li').hover(function(){
			$(this).css('background-position','0 -20px');		
		},function(){
			$(this).css('background-position','0 0');					
		})

		// Catch the anchor click and unset the parent click!
		$('.pk-slideshow-description a').mouseup(function(){
			$(this).parents('.pk-slideshow-item').unbind('click');
		});

	  function previous() 
	  {
	  	if (position >= 0)
			{
				position--;
				if (position < 0 ) { position = img_count; }
				slideshowItems.hide();
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
	  		slideshowItems.hide();
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
	    if (intervalEnabled)
	    {
	  	  intervalTimeout = setTimeout(next, <?php echo $options['interval'] ?> * 1000);
	  	}
	  }
	  interval();
	
	});
</script>
<?php elseif (count($items) == 1): ?>
<script type="text/javascript" charset="utf-8">
  <?php // Make sure a single-image slideshow is not hidden entirely ?>
	$(document).ready(function() {
     $('#pk-slideshow-item-<?php echo $id ?>-0').show();
	});
</script>
<?php endif ?>