<?php  $logins = $this->atr_page['logins']; ?>

<form action="<?php echo BARRA . url_base . BARRA . "logins/update/id/{$logins->id}" ?>" method="POST" >
    
    <div class="form-group">

        <label for="user">user</label>

        <input type="text" class="form-control" id="user" name="user" placeholder="user" value="<?=$logins->user?>">

    </div>

    <div class="form-group">

        <label for="password">Password</label>

        <input type="password" class="form-control" id="password" name="password" placeholder="Password" value="<?=$logins->user?>">

    </div>

    <button type="submit" class="btn btn-primary">Editar</button>

</form>

