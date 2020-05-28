
<?php $idiom = $assist->view->idiom("theme"); ?>
<table cellpadding="5" cellspacing="0" border="0" width="95%">
    <tr>
        <td colspan="3"><h3><?php echo $idiom['person']['profile']["title"]; ?></h3></td>
    </tr>
    <tr>
        <td width="25%"><b><?php echo $idiom['person']['form']["avatar"]; ?></b></td> 
        <td><b><?php echo  $idiom['person']['profile']["denomination"]; ?></b></td>
        <td><b><?php echo  $idiom['person']['profile']["value"]; ?></b></td>
    </tr>
    <tr>
        <td rowspan="12"> <img class="profilea" src="<?php echo $data['person']['avatar'];?>"></td>
    </tr>
    <tr> 
        <td><?php echo $idiom['person']['form']["email"]; ?></td>
        <td><?php echo $data['person']['email'];?></td>
     <tr>
    <tr> 
        <td><?php echo $idiom['person']['form']["chat"]; ?></td>
        <td><?php echo $data['person']['chat'];?></td>
    <tr>
    <tr> 
        <td><?php echo $idiom['person']['form']["company"]; ?></td>
        <td><?php echo $data['person']['company'];?></td>
    <tr>
    <tr> 
        <td><?php echo $idiom['person']['form']["place"]; ?></td>
        <td><?php echo $data['person']['place'];?></td>
    <tr>
    <tr> 
        <td><?php echo $idiom['person']['form']["position"]; ?></td> 
        <td><?php echo $data['person']['position'];?></td>
    <tr>
    <tr> 
        <td><?php echo $idiom['person']['form']["category"]; ?></td>
        <td><?php echo $data['person']['category'];?></td> 
    <tr>
</table>

<?php
    if(isset($data['trait']) && is_array($data['trait'])) include __DIR__ . "/meta.trait.php";
?>
<?php
    if(isset($data['phonebook']) && is_array($data['trait'])) include __DIR__ . "/meta.phonebook.php";
?>