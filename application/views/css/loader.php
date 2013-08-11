@keyframes animate-ui-loader{
  50%{box-shadow: 0 0 5px green,0 0 3px green inset;}
  100%{box-shadow: none;}
}
.ui-loader {
    animation: 2s ease 0s normal none infinite animate-ui-loader;
    background-color: hsl(83, 100%, 51%);
    border: 1px solid green;
    border-radius: 100% 100% 100% 100%;
    height: 10px;
    width: 10px;
    position:absolute;
    display:none;
}