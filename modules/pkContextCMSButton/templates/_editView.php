<?php if ($invalid): ?>
  <p>Invalid URL. A valid example: http://www.punkave.com/</p>
<?php endif ?>
<p>
URL: <?php echo input_tag("url", $url, array_merge(array("id" => "$id-value", 'class' => 'pkContextCMSButtonSlot'))) ?>
</p>