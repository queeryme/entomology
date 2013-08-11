	.user .input.text{
  	font-size:13px;
    font-weight: bold;
    height: 23px;
    line-height: 27px;
    padding: 2px;
    text-align: center;
    width: 146px;
  }  
  .user .position{
  	color:  <?=$JQ["fcContent"]?>;
    font-size: 20px;
  }
  .user button{
      background-color: <?=$JQ["bgColorActive"]?>;
      border: none;
      border-top-right-radius: 1em;
      border-bottom-right-radius: 1em;
      color: <?=$JQ["fcDefault"]?>;
      cursor: pointer;
      transition: background-color 0.5s ease 0s;
      font-size: 13px;
  }
  .user{
      position: absolute;
      right: 10px;
      top: 10px;
      transition: opacity 500ms ease 0s;
  }
  .user > * {
      display: inline-block;
  }  
  .user .username{
      width: 146px;
  }

  .user .username{
      width: 146px;
      text-align: center;
  }
  .user button {
      height: 27px;
      width: 60px;
      vertical-align: bottom;
  }
  .user button:hover,
  .user button:focus {
      background-color: hsl(56, 100%, 63%);
  }