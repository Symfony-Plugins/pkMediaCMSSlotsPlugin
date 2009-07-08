<?php if ($options['arrows'] && (count($items) > 1)): ?>
<ul id="pk-slideshow-controls-<?php echo $id ?>" class="pk-slideshow-controls">
	<li><?php echo link_to_function('Previous', '', array('class' => 'pk-slideshow-controls-previous pk-btn pk-arrow-left icon nobg', )) ?></li>
	<li><?php echo link_to_function('Next', '', array('class' => 'pk-slideshow-controls-next pk-btn pk-arrow-right icon	nobg', )) ?></li>
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
    <ul>
      <li class="pk-slideshow-image" style="height:<?php echo $options['height'] ?>;<?php echo ($n==0)? 'display:block':'' ?>"><?php echo $embed ?></li>
      <?php if ($options['title']): ?>
        <li class="pk-slideshow-title"><?php echo $item->title ?></li>
      <?php endif ?>
      <?php if ($options['description']): ?>
        <li class="pk-slideshow-description"><?php echo $item->description ?></li>
      <?php endif ?>
    </ul>
  </li>
<?php $first = false; $n++; endforeach ?>
</ul>

<?php if (count($items) > 1): ?>
<script type='text/javascript'>
$(function() {

	var position = 0;
	var img_count = <?php echo count($items) ?>-1;
	$('#pk-slideshow-item-<?php echo $id ?>-'+position).show();

	var intervalEnabled = <?php echo ($options['interval'])? 1:0; ?>;
	
  $('#pk-slideshow-<?php echo $id ?> .pk-slideshow-item').click(function() {
	  
		$(this).attr('title','Click For Next Image &rarr;');
	  intervalEnabled = false;
	  next();
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
    if (intervalEnabled)
    {
  	  intervalTimeout = setTimeout(next, <?php echo $options['interval'] ?> * 1000);
  	}
  }
  interval();
});
</script>
<?php elseif (count($items) == 1): ?>
<script>
  <?php // Make sure a single-image slideshow is not hidden entirely ?>
        $('#pk-slideshow-item-<?php echo $id ?>-0').show();  
</script>
<?php endif ?>