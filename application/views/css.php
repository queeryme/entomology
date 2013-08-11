<?php
	header("Content-type: text/css; charset=utf-8");
?>
/* CSS Document */

 	*{font-family: Arial, Helvetica, sans-serif;}
	body {
			margin: 0;
			padding: 0;
	}
  .input.text {
    background: none repeat scroll 0 0 hsl(83, 100%, 51%);
    border-radius: <?=$JQ["cornerRadius"]?>;
    color: hsl(34, 78%, 20%);
	}
  input[type="text"],
  input[type="password"],
  input[type="date"],
  input[type="number"],
  textarea{
  	background-color:<?=$JQ["bgColorDefault"]?>;
    box-shadow: 1px 1px 3px <?=$JQ["bgColorShadow3"]?> inset;
    border: none;
    border-radius: <?=$JQ["cornerRadius"]?>;
    transition: background-color .5s;
    color: hsl(34,78%,20%);
  }
	input[type="text"]:focus,
  input[type="password"]:focus,
  input[type="date"]:focus,
  input[type="number"]:focus,
  textarea:focus{
  	background-color:<?=$JQ["bgColorFocus"]?>;
    box-shadow: 1px 1px 3px <?=$JQ["bgColorShadow3"]?> inset;
  }
  button{
  	font-weight: bold;
  	border-radius: <?=$JQ["cornerRadius"]?>;
  }
	input.rp-error,
	textarea.rp-error{
    outline: 1px dotted red;
	}
	.header {
		background-color: <?=$JQ["bgColorContent"]?>;
		color: <?=$JQ["fcContent"]?>;
		font-family: arial;
		font-size: 44px;
		height: 100px;
		width: 100%;
	}
	.header .text {
		-moz-user-select: none;
		cursor: default;
		left: 20px;
		position: absolute;
		top: 28px;/*calc(50px - 0.5em)*/
	}
	
	.links{
		position: absolute;
		right: 25px;
		top: 47px;
		width: 318px;
	}
	.links svg {
  	fill:<?=$JQ["fcContent"]?>;
    cursor: pointer;
    margin-right: 20px;
    transition: fill 0.5s ease 0s;
	}
  .links svg:hover{
  	fill:hsl(56, 100%, 63%);
  }
  .ui-tooltip .notes{
  	font-size: 0.7em;
    text-align: center;
  }
  .ui-tooltip.login-tooltip{
  	text-align: center;
  }
  .breadcrumb{
  	background:  <?=$JQ["bgImgUrlHeader"]?> <?=$JQ["fcContent"]?>;
    width:100%;
    height:36px;
	}
	.breadcrumb>div{
  	display:inline-block;
    vertical-align:middle;
    padding: 0 15px 0 15px;
    cursor: pointer;
    float:left;
    height:inherit;
    line-height: 2em;
    
  }
  .breadcrumb > div:hover {
      background: none repeat scroll 0 0 hsla(56, 100%, 63%, 0.5);
  }
  .breadcrumb > div:active,
  .breadcrumb > div.ui-active {
  	background: <?=$JQ['bgColorHeader']?>;
    transition: none;
  }
  .breadcrumb > div {
      cursor: pointer;
      display: inline-block;
      float: left;
      font-size:18px;
      height: inherit;
      line-height: 2em;
      padding: 0 15px;
      transition: background-color 0.5s ease 0s;
      vertical-align: middle;
      color:<?=$JQ['bgColorContent']?>;
      fill:<?=$JQ['bgColorContent']?>;
  }


















  