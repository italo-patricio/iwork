<?php if(!defined('BASEPATH')) exit(header('Location: ../../../'));
           
        foreach ($val as $array) {
           foreach ($array as $key => $value) {
                   if( $key == 'usuario_list') $list_usu = ($value); 
           }         
         } 
    
?>

<form action="<?php echo BARRA.url_base.BARRA."teste/inserir_editar" ?>" method="POST">
    <p>
        <label>Id:</label><input type="text" name="id" >
    </p>
    <p>
        <label>Nome:</label><input type="text" name="nome" >
    </p>
    <p>
        <label>Login:</label><input type="text" name="login" >
    </p>
    <p>
        <label>Senha:</label><input type="password" name="senha" >
    </p>
    <p>
        <input type="submit" name="excluir" value="Excluir" >
        <input type="submit" name="editar" value="Editar" >
        <input type="submit" name="inserir" value="Inserir" >

    </p>
</form>

<table class="">
    <thead>
        <th>
            <td>Id</td>
            <td>Nome</td>
            <td>Login</td>

        </th>
    </thead>
    <tbody>
        <?php foreach ($list_usu as $value){ ?>
        <tr>
            <td><?php echo $value->id; ?></td>
            <td><?php echo $value->nome; ?></td>
            <td><?php echo $value->login; ?></td>
        </tr>
        <?php }?>
    </tbody>
</table>
