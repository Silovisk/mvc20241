<html>
    <body>
        <h2>Professores</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
            </tr>
            <?php
                
                foreach($param['lista'] as $v){
                    ?>
                    <tr>
                        <td><?= $v['idprofessor'] ?></td>
                        <td><?= $v['nome'] ?></td>
                    </tr>
                    <?
                }
            ?>
        </table>
     
    </body>
</html>