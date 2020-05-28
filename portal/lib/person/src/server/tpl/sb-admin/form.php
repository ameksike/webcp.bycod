
<?php $idiom = $assist->view->idiom("theme"); ?>
<form role="form" class="myform">

    <div class="col-md-6 col-sm-12"> 
        <h1> <?php echo $idiom['news']['form']['cover']; ?> </h1>
        <img   id="imgfront"  src="<?php echo (!empty($data['model']["avatar"])) ? $data['model']["avatar"] : $assist->view->url('.') . "data/user/user_" . $data['model']["sex"] . ".svg"; ?>"  width="50%">
        <input id="imgfrontF" style="display:none;" type="file" >
        <input id="imgfrontS" name="avatar" style="display:none;" type="text" value="<?php  echo $data['model']["avatar"]; ?>" >
    </div>

    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $idiom['person']['form']['firstname']; ?></label>
            <input type="text" class="form-control"  name="firstname"  placeholder="<?php echo $idiom['person']['form']['firstname']; ?>" value="<?php  echo $data['model']["firstname"]; ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1"><?php echo $idiom['person']['form']['lastname']; ?></label>
            <input type="text" class="form-control"  name="lastname"  placeholder="<?php echo $idiom['news']['form']['lastname']; ?>" value="<?php  echo $data['model']["lastname"]; ?>" >
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1"><?php echo $idiom['person']['form']['alias']; ?></label>
            <input type="text" class="form-control"  name="alias"  placeholder="<?php echo $idiom['person']['form']['alias']; ?>" value="<?php  echo $data['model']["alias"]; ?>" >
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1"><?php echo $idiom['person']['form']['user']; ?></label>
            <input type="text" class="form-control"  name="user"  placeholder="<?php echo $idiom['person']['form']['user']; ?>" value="<?php  echo $data['model']["user"]; ?>" >
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1"><?php echo $idiom['person']['form']['sex']; ?></label>
            <select class="form-control"  name="sex">
                <option value="M" <?php  echo ($data['model']["sex"]=="M" || $data['model']["sex"]=="") ? "selected" : ""; ?> ><?php  echo $idiom['person']['sex']["M"]; ?></option>
                <option value="F" <?php  echo ($data['model']["sex"]=="F") ? "selected" : ""; ?> ><?php  echo $idiom['person']['sex']["F"]; ?></option>
            </select>
        </div>
    </div>

    <div class="form-group">
        <label for="exampleInputPassword1"><?php echo $idiom['person']['form']['domain']; ?></label>
        <input type="text" class="form-control"  name="domain"  placeholder="<?php echo $idiom['person']['form']['domain']; ?>" value="<?php  echo $data['model']["domain"]; ?>" >
    </div>
<!--
    "avatar" => "",
          
            "user" => "",
            "domain" => "",
            "company" => "",
            "place" => "",
            "position" => "",
            "category" => "",
-->
    <div>
        <input type="text" style="display:none;" name="id" value="<?php  echo $data['model']["id"]; ?>" />
    </div>

    <button type="submit"  class="btn btn-primary" name="btnSave" id="btnSafe" value="save" ><?php echo $idiom['news']['form']['btn']; ?></button>

</form>
