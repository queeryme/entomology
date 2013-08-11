<div class="dialog taxon">
<form action="" method="post" accept-charset="utf-8">
  <div class="parent_taxon">
    <span class="label">&nbsp;</span>
    <span class="input text">&nbsp;</span>
  	<input class="parent_id" type="hidden" pattern="[0-9][1-9]{0,}" />
  </div>
	<input class="o_type" type="hidden" pattern="[kpcofgs]" />
	<input class="name" type="text" pattern="[a-z|A-Z]{1,}" placeholder="name" required />
  <input class="author_date" type="text" placeholder="date created" />
  <div class="group author_select">
  	<select class="p_id" data-max="<?=$persons['max']?>" data-required="false">
    	<option value=""></option>
    	<?php foreach($persons['results'] as $key=>$value): ?>
    	<option value="<?=$value['value']?>"><?=$value['text']?></option>
      <?php endforeach; ?>
    </select>
  	<input class="p_id" type="hidden" pattern="[0-9][1-9]{0,}"/>
    <a class="author_add button" href="#" data-title="add new author"
    		data-ui-icon="ui-icon-plus">&nbsp;</a>
  </div>
  <div class="author_add">
    <div class="group">
      <input class="first_name" type="text" placeholder="author's first name"/>
      <a class="author_select button" href="#" data-title="select existing author"
      		data-ui-icon="ui-icon-minus">&nbsp;</a>
    </div>
    <input class="last_name" type="text" placeholder="author's last name" required />
    <span class="address_label">a d d r e s s</span>
    <textarea class="address"></textarea>
    <input class="contact" type="text" placeholder="contact number" />
  </div>
</form>
</div>