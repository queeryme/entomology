<form class="user">
  <div class="position"><?=$user['u_type']==='a'?'administrator':'coordinator'?>:</div>
  <div class="username input text"><?=$user['username']?></div>
  <button class="logout" value="button">logout</button>
</form>
