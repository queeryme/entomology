<?php
	header("Content-type: text/javascript; charset=utf-8");
	
	$CI=&get_instance();
	$CI->load->helper('url');
 
?>
jQuery.fn.quickchange=function(fn){
	if(!fn) $(this).trigger('quickchange');
	$(this).on('quickchange',fn);
	$(this).keyup(function(){
    var previousValue=$(this).data('quickchange.value.previous');
    if(previousValue!==$(this).val())
    	$(this).trigger('quickchange');
    $(this).data('quickchange.value.previous',$(this).val());
  });
  $(this).data('quickchange.value.previous',$(this).val());
  return this;
}
$(function(){
	
  $('input').val('');//clear the annoying old data
	$('input').validate();
  $('form.login').submit(function(){
  	var data={
    	username:$('.login .username').val(),
      password:$('.login .password').val()
    };
    $(this).find('button').attr('disabled','');
    
  	$.post('<?=base_url()?>ajax/login',data,
    function(data,status,xhr){
      $('form.login button').removeAttr('disabled');
    	window.location.reload();
    }).
    error(function(xhr){
      console.log(xhr);
      var data=$.parseJSON(xhr.responseText);
      if(data.code in errors)
      $('form.login .ui-state-error').remove();
      $('<span></span>').
        addClass('ui-state-error ui-corner-all').
        text('error!').
        prependTo('.login');
      $('form.login button').removeAttr('disabled');
    });
    
    return false;
  });
	$('form.user').submit(function(){
  	$.post('<?=base_url()?>logout',{},function(data,status,xhr){
    	window.location.reload();
    });
    return false;
  });
 
  $('.links svg.home').click(function(){
  	window.location='<?=base_url()?>';
  });
  $('.breadcrumb>div').each(function(){$(this).tooltip({
  	items: 'div[data-title]',
    content: $(this).data('title'),
    position:{
    	my: "center bottom",
      at: "center top-5"
    }
  })});
  $('.login input').each(function(){
  	$(this).tooltip({
    	content: $(this).data('title'),
      tooltipClass: 'login-tooltip'
    });
  });
  $('.links svg').each(function(){
  	$(this).tooltip({
    	content: $(this).data('title'),
      position:{
      	my: "top",
        at: "bottom+5"
      }
    })
  });
  
  
});