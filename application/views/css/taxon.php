  .dialog.taxon{
    display:none;
  }
  .dialog.taxon input{
    width: 100%;
    text-align: center;
  }
  .dialog.taxon form>input,
  .dialog.taxon form>.parent_taxon,
  .dialog.taxon form>.author_add>*,
  .dialog.taxon form>.author_select{
  	margin: 2px 0;
    box-sizing: border-box;
    width:100%;
  }
  .dialog.taxon form textarea.address{
    float: right;
    height: 100px;
    width: 245px;
    resize: none;
  }
  .dialog.taxon div.author_add{
    display:none;
  }
  .dialog.taxon .parent_taxon .label{
      display: inline-block;
      float: left;
      height: 23px;
      vertical-align: middle;
      width: 40%;
  }
	.dialog.taxon a.author_select,
  .dialog.taxon a.author_add {
    border: 0 none;
    font-size: 9.8px;
    margin-right: 0;
    vertical-align: top;
  }
  .dialog.taxon .rp-select input{
  	border-radius: 0px;
  }
  .dialog.taxon .author_name,
  .dialog.taxon div.author_add .first_name{
      width: 245px;
  }
  .dialog.taxon form .address_label {
      display: block;
      float: left;
      height: 100px;
      letter-spacing: 40px;
      line-height: 0.95;
      padding-left: 8px;
      width: 17px;
  }
  .dialog.taxon .parent_taxon .input.text {
      -moz-box-sizing: border-box;
      -o-box-sizing: border-box;
      -webkit-box-sizing: border-box;
      -ms-box-sizing: border-box;
      box-sizing: border-box;
      display: inline-block;
      font-weight: bold;
      height: 22px;
      padding: 2px;
      text-align: center;
      width: 60%;
  }
  
  .rp-select{
  	display: inline-block;
  } 
  
	.rp-select>.ui-button-text-icon-secondary .ui-button-text {
      border: 0 none;
      height: 100%;
      width: 100%;
  }
  .rp-select>.ui-button.ui-state-default{
  		width: 100%;
      height:100%;
      border: 0 none;
  }
  .rp-select>.ui-button.ui-state-active>.ui-button-text{
  	color:hsl(34, 78%, 20%);
    font-weight: bold;
  }
  .rp-select > .ui-button > .ui-button-text {
      -moz-box-sizing: border-box;
      -o-box-sizing: border-box;
      -webkit-box-sizing: border-box;
      -ms-box-sizing: border-box;
      box-sizing: border-box;
      height: 100%;
      margin-top: -0.6em;
      overflow: hidden;
      padding: 0 22px;
      position: relative;
      text-overflow: ellipsis;
      top: 50%;
      vertical-align: middle;
      white-space: nowrap;
      width: 100%;
  }
  .rp-select>.ui-button.ui-state-active{
  	background-color: hsl(65, 100%, 80%);
  }
  .rp-select > .rp-dropdown {
      background-color: hsl(65, 100%, 80%);
      color: hsl(34, 78%, 20%);
      display: block;
      position: absolute;
      text-align: center;
      z-index: 1;
      cursor: auto;
      -moz-box-sizing: border-box;
      -o-box-sizing: border-box;
      -webkit-box-sizing: border-box;
      box-sizing: border-box;
      padding: 2px;
  }

  .rp-paginate{
      text-align: center;
      margin-bottom: 6px;
      display: block;
  }
  .rp-paginate .rp-previous{
  	float: left;
  }
  .rp-paginate .rp-next{
  	float: right;
  }
  .rp-paginate input.rp-current-page{
      background: none repeat scroll 0 0 transparent;
      border: medium none;
      border-radius: <?=$JQ["cornerRadius"]?>;
      color: inherit;
      font-size: inherit;
      font-weight: bold;
      text-align: center;
      transition: all 0.5s ease 0s;
      width: 2em;
      box-shadow: none;
  }
  .rp-paginate input.rp-current-page:hover:not(:disabled),
  .rp-paginate input.rp-current-page:focus:not(:disabled){
      background-color: <?=$JQ["bgColorFocus"]?>;
      box-shadow: 1px 1px 3px hsl(34, 78%, 20%) inset;
      color: hsl(34, 78%, 20%);
  }
  .rp-paginate a.ui-button{
  	font-size: 10px;
  }
  .rp-select .rp-dropdown>*{
  	margin-bottom: 2px;
  }
  .rp-result-list .rp-result-element.rp-selected {
      background-color: hsl(110, 100%, 71%);
      font-style: italic;
  }
  .rp-result-list .rp-result-element {   
      -moz-box-sizing: border-box;
      -o-box-sizing: border-box;
      -webkit-box-sizing: border-box;
      -ms-box-sizing: border-box;
      box-sizing: border-box;
      overflow: hidden;
      padding: 0 2px;
      text-overflow: ellipsis;
      white-space: nowrap;
      background-color: hsl(83, 100%, 61%);
      color: hsl(34, 78%, 20%);
      display: block;
      transition: background-color 0.5s ease 0s;
  }
  .rp-result-list {
      background-color: hsl(83,100%,61%);
      border: 1px solid;
      margin-top: 5px;
  }
  .rp-result-element{
  	text-decoration: none;
  }
  .rp-result-element>span{
  	font-weight:bold;
  }
  
  .rp-result-list .rp-result-element:hover,
  .rp-result-list .rp-result-element:focus{
  	background-color:hsl(83,100%,51%);
  }
  .rp-result-list {
      background-color: hsl(83, 100%, 61%);
      border: 1px solid hsl(34, 78%, 20%);
      color: hsl(0, 0%, 27%);
      margin-top: 5px;
  }
  .rp-dropdown > input.rp-filter { 
   width: 100%;
   box-sizing: border-box;
  }

