<?php if(!defined('BASEPATH')) exit(header('Location: ../../../'));

?>

<!-- INICIO CONTEUDO -->
<form action="<?php echo BARRA.url_base.BARRA."teste/logar" ?>" method="POST">
    <p>
        <label>Login:</label><input type="text" name="login" >
    </p>
    <p>
        <label>Senha:</label><input type="password" name="senha" >
    </p>
    <p>
        <input type="submit" value="testCreate" >
    </p>
</form>

<!-- FIM CONTEUDO -->