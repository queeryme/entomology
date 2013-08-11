$(function(){
	$('.dialog.taxon a.author_add').
  add('.dialog.taxon a.author_select').
  each(function(){
    $(this).
    button({
      icons:{primary:$(this).data('ui-icon')},
      text:false
    }).
    tooltip({
      content: $(this).data('title'),
    })
  });
  $('.dialog.taxon a.author_add').click(function(){
    $('.dialog.taxon div.author_add').slideDown();
    $('.dialog.taxon div.author_select').slideUp();
  });
  $('.dialog.taxon a.author_select').click(function(){
    $('.dialog.taxon div.author_add').slideUp();
    $('.dialog.taxon div.author_select').slideDown();
  });
  $('.menu.taxon .add').on('dialog.add',function(){
    var taxon=$('.breadcrumb .ui-active');
    var parent_taxon=$('.dialog.taxon .parent_taxon');
    //handle the parent taxon
    if(taxon.prev().length===0) parent_taxon.hide();
    else{
      parent_taxon.
        show().
        children('.label').
        text('parent '+taxon.prev().data('type-value')+': ');
			parent_taxon.parent().find('input.o_type').val(taxon.data('type'));
      parent_taxon.children('.input').text(taxon.prev().data('value'));
      parent_taxon.children('.parent_id').val(taxon.prev().data('id'));
    }
    
    $('.dialog.taxon').dialog({
      resizable: false,
      modal: true,
      buttons:{
        'add':function(){
					$('form',this).submit();
        }
      },
      title: "ADD NEW TAXON: "+taxon.data('type-value').toUpperCase()
    });
    
    return;
  });
	
	$('.dialog.taxon form input.author_date').validate('add','date_valid',{
		message: 'Input could not be converted to a date.',
		validate:function(){
			var value=$(this).val();
			if(value==''||//ignore empty inputs
				Date.parseExact(value,'MMMM yyyy')!=null||
				Date.parseExact(value,'MMMM dd, yyyy')!=null||
				Date.parseExact(value,'MMMM dd,yyyy')!=null||
				Date.parseExact(value,'dd-MM-yyyy')!=null||
				Date.parseExact(value,'yyyy')!=null||
				Date.parseExact(value,'dd/MM/yyyy')!=null
			)return true;
			return false;
		}
	});
	
	$('.dialog.taxon form').submit(function(event){
		var that=this;
		var sendData={
			o_type: $('input.o_type',this).val(),
			parent_o_id: $('input.parent_id',this).val(),
			author_dt: $('form input.author_date',this).val(),
			name: $('input.name',this).val(),
			p_id: $('select.p_id',this).val(),
		};
		
		var url='insert';
		if($('.author_select.group').is(':hidden')){
			
			console.log('with new person');
			
			//check if all its inputs are valid
			var isValid=true;
			for(var i=0;i<this.length;i++)
				if($(this[i]).validate().validate('valid')==false){
					if($(this).is(":hidden")==false){
						$(this[i]).keyup().focus();
						isValid=false;
						break;
					}
					isValid=false;
				}
			if(isValid==false)return false;
			
			
			url+='WithNewPerson';
			sendData=$.extend({},sendData,{
				first_name: $(this).find('input.first_name').val(),
				last_name: $(this).find('input.last_name').val(),
				address: $(this).find('textarea.address').val(),
				contact: $(this).find('input.contact').val(),
			});
		}
		else{
			console.log('without new person');
			
			var isValid=true;
			for(var i=0;i<this.length;i++)
				if($(this).hasClass('last_name'));//ignore last_name
				else if($(this[i]).validate().validate('valid')==false){
					if($(this).is(":hidden")==false){
						$(this[i]).keyup().focus();
						isValid=false;
						break;
					}
					isValid=false;
				}
			if(isValid==false)return false;
			
			sendData.p_id=null;
		}
		console.log(event);
		
		var xhr=$.post('<?=base_url()?>ajax/organism/'+url,sendData,
		function(receivedData,status,xhr){
			
		},'json').
		error(function(){
		
		});
		return false;
	});
	
  $('.dialog.taxon .author_select select').searchbox({
  	url:'<?=base_url()?>ajax/person/filter',
    width: '245px',
    required: false,
  });
  
})