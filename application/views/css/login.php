  .login{
      position: absolute;
      right: 10px;
      top: 10px;
      transition: opacity 500ms ease 0s;
  }
  .login .ui-state-error {
      font-size: calc(1em / 1.2);
      padding: 0.2em;
  }
  .login button {
      background-color: <?=$JQ["fcContent"]?>;
      border: none;
      border-top-right-radius: 1em;
      border-bottom-right-radius: 1em;
      color: <?=$JQ["bgColorContent"]?>;
      cursor: pointer;
      transition: background-color 0.5s ease 0s;
      font-size: 13px;
  }
  .login button:hover,
  .login button:focus{
      background-color: hsl(56, 100%, 63%);
  }
  .login input[type="text"], 
  .login input[type="password"],
  div.input {
    width: 140px;
    color: <?=$JQ["bgColorContent"]?>;
    font-size: 13px;
    font-weight: bold;
    transition: background-color 0.5s ease 0s;
  }
  .login input{
    height: 25px;
  }
  .login .username {
      border-top-left-radius: 1em;
      border-bottom-left-radius: 1em;
  }
  .login button {
      height: 27px;
      width: 60px;
      vertical-align: bottom;
  }
  .login input{
      text-align: center;
  }