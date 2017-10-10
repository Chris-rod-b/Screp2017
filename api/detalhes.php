<?php
    include 'connect.php';
    $sql = 'SELECT '."'".'Botton'."'".'||'."' '".'||estampa.nome||'."' '".'||cor.nome AS nome, item.quantidade, item.preco_botton, item.quantidade*item.preco_botton AS subtotal FROM item, botton, cor, estampa WHERE botton.codigo = item.codigo_botton AND cor.codigo = botton.codigo_cor AND estampa.codigo = botton.codigo_estampa AND item.codigo_venda = $1 ORDER BY estampa.nome, cor.nome';
?>
<table>
    <thead>
        <tr>
            <th>Nome</th>
            <th>Quantidade</th>
            <th>Preço Unitário</th>
            <th>Subtotal</th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach(pg_fetch_all(pg_query_params($connection, $sql, [$_GET['codigo']])) as $row)
            {
                ?>
                    <tr>
                        <td><?php echo $row['nome']; ?></td>
                        <td><?php echo $row['quantidade']; ?></td>
                        <td>R$ <?php echo number_format($row['preco_botton'], 2, ',', '.'); ?></td>
                        <td>R$ <?php echo number_format($row['subtotal'], 2, ',', '.'); ?></td>
                    </tr>
                <?php
            }
        ?>
    </tbody>
</table>
