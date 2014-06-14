<table class="dataTable">
    <thead>
        <th>Id</th>
        <th>Nome</th>
        <th>Senha</th>
        <th>Operação</th>
    </thead>
    <tbody>
      <?php
        foreach ($this->atr_page['logins'] as $logins){ 
            echo  "<tr>"
                . "<td>{$logins->id}</td>"
                . "<td>{$logins->user}</td>"
                . "<td>{$logins->password}</td>"
                . "<td>"
                    . "<a href=\"".BARRA.url_base.BARRA."logins/read/id/{$logins->id}\"><span class=\"glyphicon glyphicon-eye-open\" title=\"Visualizar\"></span></a> "
                    . "<a href=\"".BARRA.url_base.BARRA."logins/edit/id/{$logins->id}\"><span class=\"glyphicon glyphicon-pencil\" title=\"Editar\"></span></a> "
                    . "<a href=\"".BARRA.url_base.BARRA."logins/delete/id/{$logins->id}\"><span class=\"glyphicon glyphicon-trash\" title=\"Excluir\"></span></a>"
                . "</td>"
                . "</tr>"
                ;
        } ?>  
    </tbody>
</table>