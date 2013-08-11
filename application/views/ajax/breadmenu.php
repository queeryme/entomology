<ul>
	<?php foreach($organism as $key=>$value):?>
	<li>
		<a href="#" data-id="<?=$value['o_id']?>">
			<?=$value['name']?>
    </a>
  </li>
	<?php endforeach;?>
</ul>