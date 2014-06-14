<?php if(!defined('BASEPATH')) exit(header('Location: ../../../'));

?>

<!-- INICIO CONTEUDO -->
<form action="<?php echo BARRA.url_base.BARRA."teste/metodo" ?>" method="POST">
    <p>
        <label>Login:</label><input type="text" name="user" >
    </p>
    <p>
        <label>Senha:</label><input type="password" name="password" >
    </p>
    <p>
        <input type="submit" value="testCreate" >
    </p>
</form>

<!-- FIM CONTEUDO -->