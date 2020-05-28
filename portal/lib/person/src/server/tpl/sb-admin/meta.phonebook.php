<table cellpadding="5" cellspacing="0" border="0" width="95%">
        <tr> 
            <td colspan="5"><h3><?php echo  $idiom['person']['profile']["phone"]; ?></h3></td>
        </tr>
        <tr>
            <td><b><?php echo  $idiom['person']['profile']["denomination"]; ?></b></td>
            <td><b><?php echo  $idiom['person']['profile']["number"]; ?></b></td>
            <td><b><?php echo  $idiom['person']['profile']["extension"]; ?></b></td>
            <td><b><?php echo  $idiom['person']['profile']["note"]; ?></b></td>
            <td><b><?php echo  $idiom['person']['profile']["type"]; ?></b></td>
        </tr>
        <?php
            
            $trs = '';
            if(isset($data['phonebook']) && is_array($data['trait'])) foreach($data['phonebook'] as $i){
                $trs .= '<tr>';
                $trs .= '<td>'.$i['title'].'</td>';
                $trs .= '<td>'.$i['value'].'</td>';
                $trs .= '<td>'.$i['extension'].'</td>';
                $trs .= '<td>'.$i['note'].'</td>';
                $trs .= '<td>'.(($i['type']=='fixed') ? 'Fijo':'Mobil').'</td>';
                $trs .= '</tr>';
            }
            echo  $trs;
        ?>
    </table>