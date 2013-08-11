<form class="login">
  <input type="text" pattern="[a-z]{5,15}" placeholder="username" 
      min="5" max="12" maxlength="12" class="username" required title=""
      data-title="input username here<div class='notes'>5-15 alphabeth characters only</div>" />
  <input type="password" pattern="[a-z|0-9]{5,15}" placeholder="password" 
      min="5" max="12" maxlength="12" class="password" required title=""
      data-title="input password here<div class='notes'>5-15 characters, from a-z or 0-9</div>"/>
  <button>login</button>
</form>