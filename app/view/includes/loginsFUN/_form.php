<form action="<?php echo BARRA.url_base.BARRA."logins/create" ?>" method="POST" >
    
    <div class="form-group">

        <label for="user">user</label>

        <input type="text" class="form-control" id="user" name="user" placeholder="user">

    </div>

    <div class="form-group">

        <label for="password">Password</label>

        <input type="password" class="form-control" id="password" name="password" placeholder="Password">

    </div>

    <button type="submit" class="btn btn-primary">Login</button>

</form>
