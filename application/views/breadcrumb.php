<?php
$last_value="";
?>
<div class="breadcrumb">
	<?php foreach(OrganismModel::$lookup as $key=>$value):?>
  <?php if(!isset(${$key})){$last_value=$value;break;}?>
  <?php if(isset(${$key})):?>
  <?php $last_value=$value;?>
  <div class="<?=$value?> organism" data-id="<?=${$key}['o_id']?>" 
  		data-title="<?=$value?>" data-type="<?=$key?>" 
      data-type-value="<?=$value?>" data-value="<?=${$key}['name']?>">
  	<?=${$key}['name']?>
  </div>
  <?php endif;?>
  <?php endforeach; ?>
  <div class="<?=$value?>" data-title="select a <strong><?=$last_value?></strong>"
  		 data-type="<?=$key?>" data-type-value="<?=$last_value?>">
  	<svg style="enable-background:new 0 0 36 36;" viewBox="0 0 36 36" height="36px" width="36px">
  <path d="M14.982,14.001c-2.802,1.483-4.124,4.479-2.955,6.69c1.165,2.199,4.387,2.793,7.189,1.309
  c2.801-1.482,4.133-4.484,2.967-6.685C21.014,13.105,17.785,12.518,14.982,14.001z M18.598,17.348
  c-0.796,0.421-1.712,0.25-2.039-0.369c-0.333-0.628,0.042-1.481,0.837-1.902c0.796-0.421,1.711-0.25,2.045,0.377
  C19.768,16.073,19.395,16.927,18.598,17.348z"/>
  <path d="M18,3C9.72,3,3,9.72,3,18c0,8.29,6.72,15,15,15c8.28,0,15-6.71,15-15C33,9.72,26.28,3,18,3z M21.3,28.01
  c-2.6-1.529-3.74-0.689-6.08,1.04c-1.78,1.32-4.6,0.681-6.06-0.78c-1.7-1.71-1.73-3.989-0.78-6.06c0.98-2.13,0.83-3.75-0.62-5.62
  c-3.43-4.41,0.71-10.5,6.06-7.85c2.29,1.14,4.82-0.77,6.75-1.89c4.33-2.53,8.33,2.12,7.3,5.84c-0.09,0.64-0.34,1.3-0.771,1.98
  c-1.71,2.67-0.659,4.03,1.04,6.5C31.07,25.42,25.44,30.45,21.3,28.01z"/>
  </svg>
  </div>
</div>