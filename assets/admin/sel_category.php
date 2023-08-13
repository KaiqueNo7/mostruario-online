<?php 
$sql = "SELECT id_categoria, nome_categoria"
    ." FROM categoria"
    ." WHERE id_usuario = " . $id_usuario
    ." AND apresentacao <> 1";
$rs = $conn->query($sql);

print "<select type='text' name='id_categoria' id='id_categoria_price' required>";
    print "<option value=''>Selecione a categoria</option>";
    while($row = $rs->fetch_assoc()){
        print "<option value='" . $row['id_categoria'] . "'>" . $row['nome_categoria'] . "</option>";
    }
print "</select>";                 
?>