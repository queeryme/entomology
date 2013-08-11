  .menu {
      background-color: hsl(65, 100%, 80%);
      color: hsl(34, 79%, 30%);
      left: 0;
      padding: 4px;
      position: absolute;
      width: 200px;
  }
  .menu input.filter {
      background-color: hsl(83, 100%, 61%);
      border: medium none;
      border-radius: 0 4px 4px 0;
      box-shadow: 1px 1px 3px hsl(34, 78%, 20%) inset;
      color: hsl(34, 78%, 20%);
      font-weight: bold;
      margin-bottom: 4px;
      padding: 2px;
      text-align: center;
      transition: all 0.5s ease 0s;
      width: 172px;/*calc(100% - 4px)*/
  }  
  .menu .view {
      border-radius: 4px 0 0 4px;
      font-size: 9.25px;
      vertical-align: top;
      margin-right: 1px;
  }
  <?php if(isset($user)&&$user['u_type']==='a'):?>
  .menu input.filter.admin {
    border-radius: 0 0 0 0;
    vertical-align: top;
    width: 148px;
    padding-top: 0;
    margin-top: 0;
    height: 18px;
  }
  .menu .add {
      border-radius: 0 4px 4px 0;
      font-size: 9.25px;
      vertical-align: top;
      margin-left:1px;
  }
  <?php endif; ?>
  .menu input.filter:focus {
      background-color: hsl(83, 100%, 51%);
  }
  .menu .results {
      background: none repeat scroll 0 0 hsl(83, 100%, 71%);
      border: 1px solid;
      font-size: 14px;
      text-align:center;
  }
  .menu .results .organism.selected {
    background-color: lightblue;
	}
  .menu .results:not(:last-child){
      margin-bottom: 4px;
  }
  
  .menu .results .organism {
      color: hsl(34, 79%, 30%);
      cursor: pointer;
      display: block;
      padding: 2px;
      text-decoration: none;
      text-align:left;
      transition: background-color 0.5s ease 0s;
  }
	.menu .results .organism:hover, 
  .menu .results .organism:focus {
   	  background: none repeat scroll 0 0 hsl(83, 100%, 51%);
	}

  .menu .results span {
      color: hsl(34, 78%, 20%);
      font-weight: bold;
  }
  
  .menu .pagination:not(:last-child) {
      text-align: center;
      margin-bottom: 6px;
  }
  .menu .pagination .button.previous {
      float: left;
  }
  .menu .pagination .button.next {
      float: right;
  }
  .menu .pagination input.currentpage {
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

  .menu .pagination input.currentpage:hover:not(:disabled),
  .menu .pagination input.currentpage:focus:not(:disabled) {
      background-color: <?=$JQ["bgColorFocus"]?>;
      box-shadow: 1px 1px 3px hsl(34, 78%, 20%) inset;
      color: hsl(34, 78%, 20%);
  }
  .menu .pagination .button {
      font-size: 10px;
  }





















