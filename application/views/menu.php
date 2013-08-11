<?php 
	# This is not intented to be used for ajax calls. use the ajax/json.php
	# instead of this if ajax is required
	
	$is_admin=isset($user)&&$user['u_type']==='a';
	
?><div class="menu taxon" style="display:none">
<form>
	<a class="view">&nbsp;</a
  ><input type="text" placeholder="filter" class="filter <?=$is_admin?"admin":""?>"
	value="" pattern="[a-z]{0,100}" /><?php if($is_admin):
	?><a class="add" href="#">&nbsp;</a>
  <?php endif;?>
  <div class="pagination">
    <a class="button previous" href="#">&nbsp;</a>
    <span class="page">
      page 
      <input type="text" value="0" maxlength="3" disabled value="0"
      		max="3" pattern="[1-9]+" class="currentpage" /> 
      of 
      <span class="maxpage">0</span>    
    </span>
    <a class="button next" href="#" >&nbsp;</a>
  </div>
  <div class="results">no results found
  </div>
</form>
</div>