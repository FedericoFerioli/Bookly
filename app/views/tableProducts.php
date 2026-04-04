<?php  
defined('APP') or die('Acceso negato');
?>
<table style="border: 1">
        <tr>
            <?php
            $keys = ["id", "name", "brand", "amount", "price", "category_id"];
            foreach($keys as $key)
                echo "<th>$key</th>";
            ?>
        </tr>
        <?php
            foreach($table as $record){
                echo "<tr>";
                foreach($record as $value){
                    echo "<td>$value</td>";
                }
                echo "/<tr>";
            }      
    ?>
</table>