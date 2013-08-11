$(function(){
  $('.menu.taxon .add').
  		button({icons:{primary:"ui-icon-plus"},text:false}).
      tooltip({
      	content:function(){return "add new <strong>"+$('.breadcrumb>.ui-active').data('type-value')+"</strong>"},
        position:{my:"left top",at:"right-5 bottom+5"},collision:"flipfit"
      }).
			click(function(event){
      	$(this).trigger('dialog.add');
			});
  $('.menu.taxon .view').
  		button({icons:{primary:"ui-icon-arrowreturnthick-1-n"},text:false}).
      tooltip({
      	content:function(){
        	var text=$('.breadcrumb>.ui-active').text();
          if(text==null||text.trim()=="") return "";
        	return "view <strong>"+text+"</strong> specimens"
        },
        position:{my:"right top",at:"left+5 bottom+5",collision:"flipfit"},
      });
  $('.menu.taxon .button:last-child').button({text:false,icons:{primary:"ui-icon-triangle-1-e"}});
  $('.menu.taxon .button:first-child').button({text:false,icons:{primary:"ui-icon-triangle-1-w"}});
  $('.menu.taxon>form').submit(function(){
  	//abort the previous request that failed
    if($(this).data('xhr'))
    	$(this).data('xhr').abort();
			
  	var data={
    	filter:$('.menu.taxon input.filter').val(),
      page:$('.menu.taxon input.currentpage').val(),
      o_type:$('.menu.taxon>form').data('type')
    }
    
    //show a loading info
    $('.ui-loader').
   		show().
    	position({
    		my:"right center",
        at:"right-2 center",
        of:$('.breadcrumb>div[data-type='+data.o_type+']')
      }).
      hide().
      fadeIn(200);
    
    var parent_o_id=$('.breadcrumb>div[data-type='+data.o_type+']').prev().data('id');
    if(parent_o_id)data.parent_o_id=parent_o_id
    
		//handle the specimen button
		var parent=$('.breadcrumb>div[data-type='+data.o_type+']');
		if(parent.data('id')==null||parent.next().data('id')==null){
			$('.menu.taxon .view').removeAttr('href');
			$('.menu.taxon .view').button('disable');
		}
		else{
			$('.menu.taxon .view').attr('href','<?=base_url()?>organism/'+parent.data('id'));
			$('.menu.taxon .view').button('enable');
		}
		
    var xhr=$.post('<?=base_url()?>ajax/organism',data,
    function(receiveData,status,xhr){
    	if(receiveData) receiveData=$.parseJSON(receiveData);
    	//receiveData={pages,rows,current_page,results:[{name,o_id},...{name,o_id}]}
      
      //manage data and variables
      if(receiveData==null)receiveData={pages:0,rows:0,current_page:0,results:null};
      var resultsData=receiveData.results;
      var metaData={
      	pages:receiveData.pages,
        rows:receiveData.rows,
        current_page:receiveData.current_page
      };
      
      //handle the results
      var result=$('<div></div>');
      var sendData=$('.menu.taxon>form').data('xhr.sendData');
      for(i in resultsData){
      	if(sendData.filter!=null&&sendData.filter!=="")
      		resultsData[i].name2=
          	resultsData[i].
          		name.
              split(sendData.filter).
              join('<span>'+sendData.filter+'</span>');
				else resultsData[i].name2=resultsData[i].name;
      	var row=$('<a></a>').
        	html(resultsData[i].name2).
          attr('href','<?=base_url()?>organism/'+resultsData[i].o_id).
          data('id',resultsData[i].o_id).
          data('name',resultsData[i].name).
          addClass('organism');
				if($('.breadcrumb .ui-active').text().trim()===resultsData[i].name)
					row.addClass('selected');
        row.appendTo(result);
      }
      var text='';
      if(resultsData==null||resultsData.length===0)
      	text='no results found';
      $('.menu.taxon .results').text(text);
      $('.menu.taxon .results').append(result.children());
      
      //handle the current page
      $('.menu.taxon .currentpage').val(metaData.current_page);
      $('.menu.taxon .maxpage').val(metaData.pages);
			if(receiveData.pages>1) $('.menu.taxon .currentpage').removeAttr('disabled');
			else $('.menu.taxon .currentpage').attr('disabled','');
      
      //handle the maxpage
      $('.menu.taxon span.maxpage').text(receiveData.pages);
      
      //handle the buttons
			$('.menu.taxon .button').button('enable');
      if(metaData.pages<=1) $('.menu.taxon .button').button('disable');
      else if(metaData.current_page<=1) $('.menu.taxon .button.previous').button('disable');
      else if(metaData.current_page==metaData.pages) $('.menu.taxon .button.next').button('disable');
      
      var parent=$('.breadcrumb>div[data-type='+sendData.o_type+']');
			
      //handle showing of menu
      if($('.menu.taxon>form').data('event')!=='keypress')
        $('.menu.taxon').
            css('display','block').
            position({my:'left top',at:'left bottom',of:parent}).
            css('display','none').
            slideDown();
            
      $('input.filter')[0].focus();
      
      //remove the xhr from the menu
    	$('.menu.taxon>form').removeData('xhr');
      $('.menu.taxon>form').removeData('xhr.sendData');
      $('.menu.taxon>form').removeData('event');
      $('.ui-loader').fadeOut(200);
    }).
    error(function(xhr){
      if($('.menu.taxon>form').data('event')!=='keypress')
      	$('.menu.taxon .results').text('Error: '+xhr.statusText+' ('+xhr.status+')');
    
      //handle showing of menu
      var parent=$('.breadcrumb>div[data-type='+data.o_type+']');
      $('.menu.taxon .currentpage').val(0);
			console.log(xhr);
      if($('.menu.taxon>form').data('event')!=='keypress'&&xhr.statusText!=='abort')
        $('.menu.taxon').
            css('display','block').
            position({my:'left top',at:'left bottom',of:parent}).
            css('display','none').
            slideDown();
						
      //remove the xhr from the menu
			$('.menu.taxon>form').removeData('xhr');
      $('.menu.taxon>form').removeData('xhr.sendData');
      $('.menu.taxon>form').removeData('event');
      $('.ui-loader').hide('fade');
    	return this;
    });
    
    $(this).data('xhr',xhr);
    $(this).data('xhr.sendData',data);
  	return false;
  });
  $('.breadcrumb>div').click(function(){
  	if($(this).hasClass('ui-active')===false){
      if($('.menu.taxon>form').data('type')===$(this).data('type'))
       	$('.menu.taxon').slideDown();
      else{
				if($('.menu.taxon>form').data('xhr'))
					$('.menu.taxon>form').data('xhr').abort();
        $('.menu.taxon>form').data('type',$(this).data('type'));
        $('.menu.taxon .filter').val('');
				$('.menu.taxon').slideUp();
        $('.menu.taxon>form').submit();
      }
    }
    else{
			var xhr=$('.menu.taxon>form').data('xhr');
			xhr&&xhr.abort();
    	$('.menu.taxon').slideUp();
    }
  	$(this).
    		toggleClass('ui-active').
        siblings().
        removeClass('ui-active').
        tooltip('close');
    if($('.menu.taxon').attr('display')==='none');
	});
  $('.menu.taxon input.filter').quickchange(function(){
		var xhr=$('.menu.taxon>form').data('xhr');
		if(xhr)
			$('.menu.taxon>form').data('xhr').abort();
					
  	$('.menu.taxon>form').data('event','keypress');
 		$('.menu.taxon>form').submit();
  });
  $('.menu.taxon input.currentpage').quickchange(function(event){
  	var maxpage=parseInt($('.menu.taxon span.maxpage').text());
    var currentpage=parseInt($(this).val());
  	var pattern=$(this).attr('pattern');
    if(pattern)var regexp=new RegExp('^'+pattern+'$');
    if($(this).val().match(regexp)&&currentpage<=maxpage){
			if($('.menu.taxon>form').data('xhr'))
				$('.menu.taxon>form').data('xhr').abort();
			
  		$('.menu.taxon>form').data('event','keypress');
  		$('.menu.taxon>form').submit();
    }
  }).
  focusin(function(){
  	var maxpage=parseInt($('.menu.taxon span.maxpage').text());
    var currentpage=parseInt($(this).val());
  	var pattern=$(this).attr('pattern');
    if(pattern)var regexp=new RegExp('^'+pattern+'$');
    if($(this).val().match(regexp)&&currentpage<=maxpage)
  		$(this).data('value.previous',$(this).val());
  }).
  focusout(function(){
  	var maxpage=parseInt($('.menu.taxon span.maxpage').text());
    var currentpage=parseInt($(this).val());
  	var pattern=$(this).attr('pattern');
    if(pattern)var regexp=new RegExp('^'+pattern+'$');
    if($(this).val().match(regexp)&&currentpage<=maxpage);
    else
    	$(this).val($(this).data('value.previous'));
  });
  $('.menu.taxon .button.previous').click(function(){
  	var currentpage=parseInt($('.menu.taxon .currentpage').val());
    if(currentpage>=2){
    	currentpage--;
			$('.menu.taxon input.currentpage').val(currentpage);
			$('.menu.taxon input.currentpage').quickchange();
		}
  });
  $('.menu.taxon .button.next').click(function(){
  	var currentpage=parseInt($('.menu.taxon .currentpage').val());
  	var maxpage=parseInt($('.menu.taxon .maxpage').text());
    if(currentpage < maxpage){
    	currentpage++;
			$('.menu.taxon input.currentpage').val(currentpage);
			$('.menu.taxon input.currentpage').quickchange();
		}
  });
});