
<?php $idiom = $assist->view->idiom("theme"); ?>
<form role="form" class="myform">
    <div class="col-md-6 col-sm-12">
        <div class="form-group">
            <label for="exampleInputEmail1"><?php echo $idiom['news']['form']['title']; ?></label>
            <input type="text" class="form-control"  name="title"  placeholder="Enter email" value="<?php  echo $data['model']["title"]; ?>">
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1"><?php echo $idiom['news']['form']['date']; ?></label>
            <input type="date" class="form-control"  name="date"  placeholder="Password" value="<?php  echo $data['model']["date"]; ?>" >
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1"><?php echo $idiom['news']['form']['author']; ?></label>
            <input type="text" class="form-control"  name="author"  placeholder="Password" value="<?php  echo $data['model']["author"]; ?>" >
        </div>
        <div class="form-group">
            <label for="exampleInputPassword1"><?php echo $idiom['news']['form']['category']; ?></label>
            <select class="form-control"  name="status">
                <option value="normal" <?php  echo ($data['model']["status"]=="normal" || $data['model']["status"]=="") ? "selected" : ""; ?> >Normal</option>
                <option value="relevant" <?php  echo ($data['model']["status"]=="relevant") ? "selected" : ""; ?> >Relevante</option>
            </select>
        </div>
    </div>

    <div class="col-md-4 col-sm-12">
        <div class="col-md-6 col-sm-12"> 
            <h1> <?php echo $idiom['news']['form']['Icon']; ?> </h1> 
            <img   id="imgico"  src="<?php echo (!empty($data['model']["imgico"])) ? $data['model']["imgico"] : $assist->view->url("lib/theme/src/client/tpl/debug/img/icos/estadistica.svg");  ?>"  width="50%">
            <input id="imgicoF" style="display:none;" type="file" >
            <input id="imgicoS" name="imgico" style="display:none;" type="text" value="<?php  echo $data['model']["imgico"]; ?>" >
        </div>
        
        <div class="col-md-6 col-sm-12"> 
            <h1> <?php echo $idiom['news']['form']['cover']; ?> </h1>
            <img   id="imgfront"  src="<?php echo (!empty($data['model']["imgfront"])) ? $data['model']["imgfront"] : $assist->view->url("lib/theme/src/client/tpl/debug/img/icos/estadistica.svg");  ?>"  width="50%">
            <input id="imgfrontF" style="display:none;" type="file" >
            <input id="imgfrontS" name="imgfront" style="display:none;" type="text" value="<?php  echo $data['model']["imgfront"]; ?>" >
        </div>
    </div>

    <div class="form-group">
        <label for="exampleInputPassword1"><?php echo $idiom['news']['form']['sumary']; ?></label>
        <textarea id="sumary" class="form-control"  name="sumary"> <?php  echo $data['model']["sumary"]; ?></textarea>
    </div>

    <div class="form-group">
        <label for="exampleInputPassword1"><?php echo $idiom['news']['form']['description']; ?></label>
        <textarea id="description" class="form-control"  name="description"> <?php  echo $data['model']["description"]; ?></textarea> 
    </div>

    <div>
        <input type="text" style="display:none;" name="id" value="<?php  echo $data['model']["id"]; ?>" />
        <input type="text" style="display:none;" name="url" value="<?php  echo $data['model']["url"]; ?>" />
    </div>

    <button type="submit"  class="btn btn-primary" name="btnSafe" id="btnSafe" value="Salvar" ><?php echo $idiom['news']['form']['btn']; ?></button>

</form>
