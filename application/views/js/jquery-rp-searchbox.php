//force strict mode
"use strict";

(function( $, undefined ) {

var
	selectBaseClasses = 
		"ui-button ui-widget ui-state-default " + 
		"ui-corner-all ui-button-text-icon-secondary",
	selectStateClasses = "ui-state-hover ui-state-active ";

	//attach a delegate to everything that is focusable

	//This code snippet came from "TIM DOWN" at timdown.co.uk
	jQuery.isPrintableEvent = function(event){
    if (typeof event.which == "undefined") {
        // This is IE, which only fires keydown events for printable keys
        return true;
    } else if (typeof event.which == "number" && event.which > 0) {
        // In other browsers except old versions of WebKit, evt.which is
        // only greater than zero if the keydown is a printable key.
        // We need to filter out backspace and ctrl/alt/meta key combinations
        return !event.ctrlKey && !event.metaKey && !event.altKey && event.which != 8;
    }
    return false;		
	}
	
	$.widget( "rp.paginate" , {
		options: {
			current: 0,
			max: 0,
			pattern: "^[0-9]$",
		},
		
		_options:{
			elements:{
				prevPage: $("<a>&nbsp;</a>"),
				nextPage: $("<a>&nbsp;</a>"),
				currentPage: $("<input type=text />"),
				maxPage: $("<span>0</span>"),
			}
		},
		_create: function(){
		
			if(this.element.is("span")==false)
				throw "Invalid element to create pagination";
				
			var that = this;
			
			var prevPageElement = that._options.elements.prevPage;
			var pageElement = $("<span></span>");
			var currentPageElement = that._options.elements.currentPage;
			var maxPageElement = that._options.elements.maxPage;
			var nextPageElement = that._options.elements.nextPage;
			
			var paginateElement = 
			this.options.paginateElement = that.element.
				addClass("rp-paginate");
			
			prevPageElement.
				addClass("rp-previous").
				attr("href","#").
				button({
					text:false,
					disabled: true,
					icons:{
						primary:"ui-icon-triangle-1-w"
					}
				}).
				appendTo(this.element).
				bind("click"+that.eventNamespace,function(){
					that.page(that.options.current-1);
					//namespacing the change event causes change event to not be triggered
					var event=jQuery.Event("change");
					that.element.trigger(event,that.options.current);
				});
			
			pageElement.
				addClass("rp-page").
				appendTo(this.element).
				append(currentPageElement).
				append(maxPageElement);
				//html("page <input type='text'/> of <span>0</span>");
			
			nextPageElement.
				addClass("rp-next").
				attr("href","#").
				button({
					text:false,
					disabled: true,
					icons:{
						primary:"ui-icon-triangle-1-e"
					}
				}).
				appendTo(this.element).
				bind("click"+that.eventNamespace,function(event){
					that.page(that.options.current+1);
					var newEvent=jQuery.Event("change");
					that.element.trigger(newEvent,that.options.current);
				});
			
			currentPageElement.
				addClass("rp-current-page").
				before("page ").
				after(" of ").
				attr({
					pattern:this.options.pattern,
					disabled:"",
					max:"3",
					maxlength:"3"
				}).
				val(that.options.current).
				bind("focus"+that.eventNamespace,function(){
					$(this).data(that.widgetFullName+"-previous-value",$(this).val());
				}).
				bind("blur"+that.eventNamespace,function(){
					var pattern = that.options.pattern;
					var previousValue=$(this).data(that.widgetFullName+"-previous-value");
					var intVal=parseInt($(this).val());
					if($(this).val().match(pattern)==null||
						intVal==NaN ||
						intVal>that.options.max||
						(intVal==0&&that.options.max!=0)||
						intVal==previousValue){
						$(this).val(previousValue);
						return;
					}
					
					that.page(parseInt($(this).val()));
					var event=jQuery.Event("change");
					that.element.trigger(event,that.options.current);
				});
				
			maxPageElement.
				addClass("rp-max-page");
			
			that.page(0);
		},
		page: function(newPage){
			if(newPage === undefined)return this.options.current;
			var that =this;
			
			if(typeof newPage == "string" &&
					newPage.match(/^(\+|\-)(\d)+$/gi)!=null){
				var increment=parseInt(newPage.slice(1));
				var newPage=newPage[0]=="+"?
					that.options.current+increment:
					that.options.current-increment;
				if(newPage<0)newPage=0;
			}
			
			if(typeof newPage != "number" )
				return;
			if(newPage>this.options.max)
				newPage=this.options.max;
			that._options.elements.currentPage.val(newPage);
			that._options.elements.nextPage.button("enable").attr("href","#");
			that._options.elements.prevPage.button("enable").attr("href","#");
			if(newPage==this.options.max)
				that._options.elements.nextPage.
					button("disable").
					removeAttr("href").
					blur();
			if(newPage<=1)
				that._options.elements.prevPage.
					button("disable").
					removeAttr("href").
					blur();
			this.options.current = newPage;
			$(this).data(that.widgetFullName+"-previous-value",newPage);
		},
		max: function(newMax){
			if(newMax === undefined) 
				return this.options.max;
			
			var that=this;
			if(typeof newMax != "number" ||
					newMax === this.options.max ||
					newMax<0)
				return;
			if(this.options.current > newMax)
				this.page(newMax);
			if(newMax<=1){
				that._options.elements.nextPage.
					button("disable").
					removeAttr('href').
					blur();
				that._options.elements.prevPage.
					button("disable").
					removeAttr('href').
					blur();
			}else{
				
				//check what the current page is
				if(that.options.current<newMax)
					that._options.elements.nextPage.
						button("enable").
						attr('href','#');
				if(that.options.current>1)
					that._options.elements.prevPage.
						button("enable").
						attr('href','#');
			}
			this.options.max = newMax;
			that._options.elements.maxPage.text(newMax);
			if(newMax<=1)
				that._options.elements.currentPage.
					attr("disabled","");
			else
				that._options.elements.currentPage.
					removeAttr("disabled");
		},
		pattern: function(newPattern){
			if(newPattern === undefined) return this.options.pattern;
			this.options.pattern=new RegExp(newPattern);
			that._options.elements.currentPage.attr("pattern",newPattern.toString());
		},
		prevPageElement: function(){return this._options.elements.prevPage},
		nextPageElement: function(){return this._options.elements.nextPage},
		currentPageElement: function(){return this._options.elements.currentPage},
		maxPageElement: function(){return this._options.elements.maxPage},
	});
	
	$.widget( "rp.searchbox", {
		options: {
			paged: true,
			items: 4,
			value: '',
			dropdown: "hide",
			required: true,
			disabled: false,//TODO
			filter: '',
			url: '',	//refer to itself
			send: {},
			resultFormatter:function(element,data,index){
				//reason for using element as parameter instead of dynamic calling function..
				var that=this;//this always refer to widget, dangerous but worth it
				var html=data.text;
				if(that.options.filter!=""){
					html=html.
						split(that.options.filter).
						join('<span>'+that.options.filter+'</span>');
				}
				element.
					html(html).
					click(function(event){
						that.value($(this).data('value'));
					});
				return element;
			},
			width: "200px",
			height: "22px",
			wait: 750,//time to wait upon end of keydown before querying for new data
		},

		//extremely private variables
		_options: {
			elements: {
				searchBox: $("<a></a>"),
				dropdown:$("<div></div>"),
				select: $("<div></div>"),
				resultList: $("<div></div>"),
				dropIcon: $("<span></span>"),
				clearIcon: $("<span></span>"),
				filter: $("<input/>"),
				paginate: $("<span></span>").paginate(),
				label: $("<span></span>"),
			},
			timers: { //these are set/clearTimeout ID holders
				filter:{
					keydown: null,
				}
			},
			ajax: {
				xhr: null,
				data: {
					send: null,
					receive: null,
					sendComplete: null,
				},
				resultHandler: null,
			},
			text: '',
		},
		
		//public functions
		required: function(newRequired){
			if(newRequired===undefined)
				return this.options.required;
			newRequired=!!newRequired;
			
			this.options.required=newRequired;
			console.log('requiring');
			if(newRequired==false){
				if(this.element.children().filter(function(){
					return $(this).val()=='';
				}).length==0){
				var newOption=$('<option></option>').
					val('');
					this.element.prepend(newOption);
				}
				if(this.value())
					this._options.elements.clearIcon.show();
				console.log('hiding');
			}
			else if(newRequired==true){
				this.element.children().filter(function(){return $(this).val()==''}).
					remove();
				this.value(this.element.children().first().val());
				this._options.elements.clearIcon.hide();
			}
		},
		filter: function(newFilter){
			if(newFilter==undefined)return this.options.filter;
			if (newFilter==this.options.filter||
					typeof newFilter != "string")
				return;//do nothing
			
			this._options.elements.filter.val(newFilter);
			this._handleFilter();
		},
		value: function(value){
			if(value === undefined)
				return this.options.value;
			if(value == '' && this.options.required==false){
				this.options.value=value;
				this.element.val(value);
				this._options.elements.clearIcon.hide();
				this._text('');
				this._options.elements.resultList.children().
					removeClass('rp-selected');
				return;
			}
			else if(value == ''||value==null)
				return;
			
			var selectedElement = this._options.elements.resultList.children().
				removeClass('rp-selected').
				filter(function(index){
					return $(this).data('value')==value;
				}).
				addClass('rp-selected');
				
			//search for the option with this value
			var valueElement = this.element.children().filter(function(index){
				return $(this).val()===value;
			});
			
			if(this.options.required==false)
				this._options.elements.clearIcon.show();
			this.element.val(value);
			this._text(selectedElement.data('text'));
			this.options.value = value;
		},
		dropdown: function(message,callback){
			
			var that = this;
			if(message === undefined)
				return this.options.dropdown;
				
			if(typeof message !="string")return;
			if(message=="show")
				this._showDropdown(callback);
			else if(message=="hide")
				this._hideDropdown(callback);
			else
				return this.options.dropdown;
			return this;
		},
		paged: function(isPaged){
			if(isPaged==undefined)
				return this.options.paged;
			else if(typeof isPaged=="boolean");
			else
				return;
			this.options.paged=isPaged;
			
			if(isPaged==true)this._options.elements.paginate.hide();
			else this._options.elements.paginate.show();
		},
		enable: function(){this._isDisabled(false)},
		disable: function(){this._isDisabled(true)},
		width: function(width){
			if(width===undefined)
				return this.options.width;
			this.options.width=width;
			this.element.css('width',width);
		},
		height: function(height){
			if(height===undefined)
				return this.options.height;
			this.options.height=height;
			this.element.css('height',height);
		},
		
		//private functions
		_create: function(){
			if(this.element.is("select")==false)
				throw "Invalid Element";
			
			var that = this;
			
			var searchBoxElement = that._options.elements.searchBox;
			var labelElement = that._options.elements.label;
			var dropIconElement = that._options.elements.dropIcon;
			var filterElement = that._options.elements.filter;
			var paginateElement = that._options.elements.paginate;
			var currentPageElement = paginateElement.paginate('currentPageElement');
			var resultListElement = that._options.elements.resultList;
			var dropdownElement = that._options.elements.dropdown;
			var selectElement = that._options.elements.select;
			var clearIconElement = that._options.elements.clearIcon;
			
			that.element.hide();
			
			that.options.value = that.element.find("option:selected").val();
			that._options.text = that.element.find("option:selected").text();
			
			searchBoxElement.
				attr("href","#").
				css("width",this.options.width).
				css("height",this.options.height).
				addClass("rp-select").
				attr("id","rp-select-"+that.uuid).
				bind("mouseenter"+that.eventNamespace,function() {
					if(that.options.disabled==true)return;
					$(this).find("[role = select]").addClass("ui-state-hover");
				}).
				bind("mouseleave"+that.eventNamespace,function() {
					if(that.options.disabled==true)return;
					$(this).find("[role = select]").removeClass("ui-state-hover");
				}).
				bind("focus"+that.eventNamespace,function(event){
					if(that.options.disabled==true)return;
					$(this).find("[role = select]").addClass("ui-state-focus");
					var originalTarget=$('body').data('rp.focus.originalTarget');
					
					if(originalTarget && 
							originalTarget != searchBoxElement &&
							that.element.find(originalTarget).length==0){{
						//clear the explicitOriginalTarget to prevent bubbling
						$('body').removeData('rp.focus.originalTarget');
						that.dropdown('show');
						}
					}
				}).
				bind("blur"+that.eventNamespace,function(){
					if(that.options.disabled==true)return;
					$(this).find("[role = select]").removeClass("ui-state-focus");
				}).
				bind("click"+that.eventNamespace,function(){
					if(that.options.disabled==true)return;
					if(that.dropdown()=="show")
						that.dropdown("hide",function(){
							searchBoxElement.focus();
						});
					else
						that.dropdown("show");
					return false;
				}).
				bind("keydown"+that.eventNamespace,function(event){
					if(that.options.disabled==true)return;
					if(that.dropdown()=='show')return;
					
					var filter=that.filter();
					switch(event.keyCode){
					case $.ui.keyCode.DOWN:
							this.click();
						break;
					case $.ui.keyCode.TAB:
						break;
					case $.ui.keyCode.BACKSPACE:
						if(event.ctrlKey==true)
							that.filter('');
						else 
							that.filter(filter.substring(0,filter.length-1));
						that.dropdown('show');
						break;
					case $.ui.keyCode.DELETE:
						that.value('');
						break;
					default:
						if($.isPrintableEvent(event)){
							that.dropdown('show');
						}
					}
				}).
				delegate("*","keydown"+that.eventNamespace,function(event){
					if(that.options.disabled==true)return;
					switch(event.keyCode){
					case $.ui.keyCode.ESCAPE:
						that.dropdown('hide',function(){searchBoxElement.focus()});
						event.stopImmediatePropagation();
						return false;
					}
				});
			
			//this delegates on events that occured outside this widget
			//delegating on document for it to work on all browsers instead of the body
			$(document).delegate(
					"*:not(.rp-select#rp-select-"+that.uuid+
					"):not(.rp-select#rp-select-"+that.uuid+" *)","click",function(event){
				if(that.options.disabled==true)return;
				if(searchBoxElement.find(event.target).length!==0||
					searchBoxElement===event.target){
					return;
				}
				that.dropdown("hide");
			});
			
			clearIconElement.
				addClass("ui-button-icon-primary ui-icon ui-icon-close").
				click(function(event){
					if(that.options.disabled==true)return;
					that.value('');
					that._hideDropdown();
					return false;
				});
			if(that.options.value=='')
				clearIconElement.hide();
				
			labelElement.
				addClass("ui-button-text").
				text(this._options.text);
			
			dropIconElement.
				addClass("ui-button-icon-secondary ui-icon ui-icon-triangle-1-s");
			
			filterElement.
				attr("type","text").
				attr("placeholder","filter").
				addClass("rp-filter").
				bind("click"+that.eventNamespace,function(event){
					if(that.options.disabled==true)return;
					return false;//do not propagate
				}).
				//bind to keydown instead of keydown, chrome bug doesn't detect keydown
				bind("keydown"+that.eventNamespace,function(event){
					if(that.options.disabled==true)return;
					var lastResultElement = that._options.elements.resultList.children().last();
					var firstResultElement = that._options.elements.resultList.children().first();
					var currentPageElement = that._options.elements.paginate.paginate('currentPageElement');
					switch(event.keyCode){
					case $.ui.keyCode.ENTER:
						console.log(firstResultElement);
						firstResultElement.click();
						return false;
					case $.ui.keyCode.UP:
						if(lastResultElement.length!=0)
							lastResultElement.focus();
						else if(currentPageElement.is(":disabled")==false)
							currentPageElement.focus();
						return;
					case $.ui.keyCode.DOWN:
						if(currentPageElement.is(":disabled")==false)
							currentPageElement.focus();
						else if(firstResultElement.length!=0)
							firstResultElement.focus();
						return;
					case $.ui.keyCode.TAB:
						if(event.shiftKey)
							that.dropdown('hide');
						else{
								event.preventDefault();
							if(currentPageElement.is(":disabled")==false)
								currentPageElement.focus();
							else if(firstResultElement.length!=0)
								firstResultElement.focus();
							else{
								var focusables=$(":focusable");
								var index=focusables.index(filterElement);
								//change focus after hiding the dropdown
								that._hideDropdown(function(){
									//ignore z-index and traverse automatically.
									$(focusables[index+1<focusables.length-1?index+1:0]).focus();
								});
							}
						}
						return;

					}
					
				}).
				bind("keyup"+that.eventNamespace,function(event){
					if(that.options.disabled==true)return;
					//get the last keyup
					var lastKeyup=$(this).data('keyup');
					
					that._handleFilter();
				});
			
			paginateElement.
				bind("change",function(event){
					if(that.options.disabled==true)return;
					that.element.trigger('ajax.retrieve'+that.eventNamespace);
				});
				
			currentPageElement.
				bind("keydown"+that.eventNamespace,function(event){
					if(that.options.disabled==true)return;
					switch(event.keyCode){
					case $.ui.keyCode.UP:
						filterElement.focus();
						break;
					case $.ui.keyCode.DOWN:
						var firstResultElement = resultListElement.children().first();
						
						if(firstResultElement.length!=0)
							firstResultElement.focus();
						else 
							filterElement.focus();
						
						break;
					}
				});
			
			resultListElement.
				addClass("rp-result-list").
				delegate("a.rp-result-element","keydown"+that.eventNamespace,function(event){
					if(that.options.disabled==true)return;
					var resultElement=$(event.target);
					var index=resultListElement.index(resultElement);
					switch(event.keyCode){
					case $.ui.keyCode.UP:
						if(resultElement.prev().length!=0)
							resultElement.prev().focus();
						else if(currentPageElement.attr('disabled')==undefined)
							currentPageElement.focus();
						else
							that._options.elements.filter.focus();
						
						break;
					case $.ui.keyCode.DOWN:
						if(resultElement.next().length!=0)
							resultElement.next().focus();
						else
							filterElement.focus();
							
						break;
					case $.ui.keyCode.LEFT:
						paginateElement.paginate('prevPageElement').click();
						
						break;
					case $.ui.keyCode.RIGHT:
						paginateElement.paginate('nextPageElement').click();
						break;
					case $.ui.keyCode.TAB:
						if(event.shiftKey==true)
							break;
						if(resultElement.is(":last-child")){
							//if this is a retargetted event, don't hide
							if(event.retarget==this||event.originalEvent.retarget==this)
								break;
							event.preventDefault();
							var focusables=$(":focusable");
							var index=focusables.index($('.rp-result-element:last-child'));
							//change focus after hiding the dropdown
							that._hideDropdown(function(){
								//ignore z-index and traverse automatically.
								$(focusables[index+1<focusables.length-1?index+1:0]).focus();
							});
						}
						break;
					}
					
				});
			
			dropdownElement.
				addClass("rp-dropdown").
				addClass("ui-corner-br ui-corner-bl").
				attr("id","rp-dropdown-"+this.uuid).
				css("width",this.options.width).
				hide().
				bind("click"+that.eventNamespace,function(event){
					//stop propagation
					return false;
				}).
				append(filterElement).
				append(paginateElement).
				append(resultListElement);
			
			//this is the select button
			selectElement.
				addClass(selectBaseClasses).
				attr("role","select").
				append(labelElement).
				append(dropIconElement).
				append(clearIconElement);
			
			searchBoxElement.
				append(selectElement).
				append(dropdownElement);
			
			this.element.
				after(searchBoxElement).
				bind('ajax.complete'+that.eventNamespace,function(event,receivedData){
					that._options.ajax.data.receive=receivedData;
					paginateElement.paginate('max',receivedData.max);
					paginateElement.paginate('page',receivedData.page);
					if(receivedData.max==0){
						resultListElement.html('no results found');
						return;
					}
					//check if the resultListElements has focus
					var index=resultListElement.children().index($(':focus'));
					
					resultListElement.text('').children('a.rp-result-element').remove();
					
					that.element.children().filter(function(index){
						if(that.options.required==false&&$(this).val()=='')
							return false;
						return $(this).val()!=that.options.value;
					}).remove();
					
					if(receivedData.page==0)
						resultListElement.text('no results found');
					
					
					//iterate over the results...
					for(var i in  receivedData.results){
						var result=receivedData.results[i];
						
						//if the element doesn't exist in the current results
						if(that.element.children().filter(function(index){
							return $(this).val()==result.value;
						}).length==0){
							var optionElement=$('<option></option>').
								val(result.value).
								text(result.text);
							that.element.append(optionElement);
						}
						var resultElement=$('<a></a>').
							addClass('rp-result-element').
							attr('href','#').
							data(result).
							click(function(event){
								that.dropdown('hide',function(){that._options.elements.searchBox.focus()});
							});
							
						if(result.value==that.options.value)
							resultElement.addClass('rp-selected');
						
						that.options.
							resultFormatter.
							call(that,resultElement,result,i);
						resultListElement.append(resultElement);
					}
					
					//refocus if the focus is lost due to changing of elements
					if(index>=0&&receivedData.results.length>0){
						var newChildren=resultListElement.children();
						index=index>newChildren.length-1?newChildren.length-1:index;
						$(newChildren[index]).focus();
					}
					paginateElement.
						paginate('max',receivedData.max).
						paginate('page',receivedData.page);
						
				}).
				bind('ajax.retrieve'+that.eventNamespace,function(event){
				
					var xhr = that._options.ajax.xhr;
					var sendData=$.extend(
						{},
						that._options.ajax.data.send,
						that.options.send);
					var url=that.options.url;
						
					sendData.filter=that.options.filter;
					sendData.page=paginateElement.paginate('page');
					xhr&&xhr.abort();
					console.log(that._options.ajax.data.sendComplete);
					
					//do nothing on equal requests
					if(_.isEqual(that._options.ajax.data.sendComplete,sendData))
						return;
					that._options.ajax.xhr = $.post(url,sendData,function(receivedData,status,xhr){
						receivedData=$.parseJSON(receivedData);
						
						//validate the data received
						if(receivedData &&
								parseInt(receivedData.page) >= 0 &&
								parseInt(receivedData.max) >= 0 &&
								$.isArray(receivedData.results));//do nothing, it is a valid data
						else if(receivedData==null||receivedData.results==null)
							receivedData={max:0,page:0,results:[]};//normalize
						else throw "Invalid received data";
						
						if(receivedData.page>receivedData.max)
							receivedData.page=receivedData.max;//normalize
						
						that._options.ajax.data.sendComplete=sendData;
						
						//don't namespace this so users can attach their own handlers
						that.element.trigger('ajax.complete',receivedData);
					}).
					error(function(xhr){
						console.log(xhr);
						
						//don't namespace this so users can attach their own handlers
						if(xhr.statusText!="abort"){
						
							//clear the sendComplete
							that._options.ajax.data.sendComplete=null;
							that.element.trigger('ajax.error',xhr);
						}
					});
				}).
				bind('ajax.abort'+that.eventNamespace,function(event){
					var xhr = that._options.ajax.xhr
					xhr&&xhr.abort();
				}).
				bind('ajax.error'+that.eventNamespace,function(event,xhr){
					paginateElement.paginate('max',0);
					resultListElement.children().remove();
					if(xhr.status==0)
						resultListElement.text("server not found (0)");
					else
						resultListElement.text(xhr.statusText+" ("+xhr.status+")");
				});
			
			//build the receivedData from the initial options
			var receivedData = 
			that._options.ajax.data.receive = 
				{page:0,max:0,results:[]};
			var simulateSend=$.extend({},that.options.send,{filter:'',page:1});
			if(that.element.children().length==0){
				//simulate a send request
				that._options.ajax.data.send=simulateSend;
				that._options.ajax.data.sendComplete=simulateSend;
				this.element.trigger('ajax.complete'+this.eventNamespace,receivedData);
			}
			else{
				receivedData = 
				that._options.ajax.data.receive = 
					{page:1,max:that.element.data('max')||0,results:[]};
				that.element.children().each(function(index,element){
					if($(element).val()=='')return;
					receivedData.results[index]=$(this).data();
					receivedData.results[index].text=$(this).text();
					receivedData.results[index].value=$(this).val();
				});
				
				//simulate a send request
				that._options.ajax.data.send=simulateSend;
				that._options.ajax.data.sendComplete=simulateSend;
				this.element.trigger('ajax.complete'+this.eventNamespace,receivedData);
			}
			
			that._isDisabled(that.options.disabled);
			that.required(that.options.required);
		},
		_handleFilter: function(){
			var that=this;
			var filterElement = that._options.elements.filter;
			
			//waiting 750ms is done to prevent a lot of xhr requests
			clearTimeout(that._options.timers.filter.keydown);
			that._options.timers.filter.keydown =
			setTimeout(function(){
				var isChanged=filterElement.val()!=that.options.filter;
				that.options.filter=filterElement.val();
				if(isChanged)
					that.element.
						trigger("ajax.abort"+that.eventNamespace).
						trigger("ajax.retrieve"+that.eventNamespace);
			},that.options.wait);
		},
		_text: function(text){
			var that=this;
			if(text === undefined)
				return this._options.text;
				
			if(typeof text !=="string")return;
			
			this._options.text = text;
			that._options.elements.label.html(text);
		},
		_hideDropdown: function(callback){
			var that = this;

			if($(this._options.elements.dropdown).filter(":animated").length!==0)
				return false;//do not show dropdown if it is still animating
			this._options.elements.dropdown.slideUp(200,function(){
				that._options.elements.dropIcon.
					removeClass("ui-icon-triangle-1-n").
					addClass("ui-icon-triangle-1-s");
				that._options.elements.select.
					removeClass("ui-state-active ui-corner-tr ui-corner-tl").
					attr("href","#").
					addClass("ui-corner-all");
				that._options.elements.searchBox.
					attr("href","#");		
				if(typeof callback=="function")
					callback();
			});
			this.options.dropdown="hide";
		},
		_showDropdown: function(callback){
			var that = this;
			if($(this._options.elements.dropdown).filter(":animated").length!==0)
				return false;//do not show dropdown if it is still animating
			this._options.elements.dropIcon.
				removeClass("ui-icon-triangle-1-s").
				addClass("ui-icon-triangle-1-n");
			this._options.elements.select.
				addClass("ui-state-active ui-corner-tr ui-corner-tl").
				removeClass("ui-corner-all");
			this._options.elements.searchBox.
				removeAttr("href");
			this._options.elements.dropdown.slideDown(200,callback);
			this._options.elements.filter.focus();
			this.options.dropdown="show";
		},
		_isDisabled: function(disabled){
			var that=this;
			this.options.disabled=disabled;
			
			if(disabled)
				this._hideDropdown(function(){
					that._options.elements.searchBox.removeAttr('href');
					that._options.elements.select.
						addClass("ui-button-disabled ui-state-disabled");
					that.element.attr('disabled','');
				});
			else{
					that._options.elements.searchBox.attr('href','#');
				this._options.elements.select.
					removeClass("ui-button-disabled ui-state-disabled");
				that.element.removeAttr('disabled');
			}
			
		},
	
		//TODO: create the "_refresh" and "_destroy" methods
	});
	
}( jQuery ) );

$(function(){

  //simulates mozilla's explicitOriginalTarget
	//into a global singleton target, since there can only be
	//at most a single focused target
	//another assumption is that focus will not be bubbled up
	//if bubbling is to be done, do not remove the data from the body
	//until the end of the bubble
  $('body').
	delegate(":focusable",'keydown',function(event){
		if(event.target&&event.keyCode == $.ui.keyCode.TAB)
			$('body').data('rp.focus.originalTarget',event.target);
    else
    	$('body').removeData('rp.focus.originalTarget');
	});
});