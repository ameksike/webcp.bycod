<table cellpadding="5" cellspacing="0" border="0" width="95%">
        <tr>
            <td colspan="3"><h3><?php echo  $idiom['person']['profile']["trails"]; ?></h3></td>
        </tr>
        <tr>
            <td><b><?php echo  $idiom['person']['profile']["denomination"]; ?></b></td>
            <td><b><?php echo  $idiom['person']['profile']["value"]; ?></b></td>
            <td><b><?php echo  $idiom['person']['profile']["description"]; ?></b></td>
        </tr>

        
            <?php
                $trs = '';
                if(isset($data['trait']) && is_array($data['trait'])) foreach($data['trait'] as $i){
                    $trs .= '<tr>';
                    $trs .= '<td>'.$i['title'].'</td>';
                    $trs .= '<td>'.$i['value'].'</td>';
                    $trs .= '<td>'.$i['note'].'</td>';
                    $trs .= '</tr>';
                }
                echo  $trs;
            ?>
    </table>