<?php  $logins = $this->atr_page['logins']; ?>

<table class="table">
    <tr>
        <td>Id</td>
        <td><?=$logins->id?></td>                
    </tr>
    <tr>
        <td>Nome</td>
        <td><?=$logins->user?></td>                
    </tr>
    <tr>
        <td>Password</td>
        <td><?=$logins->password?></td>                
    </tr>
</table>
    