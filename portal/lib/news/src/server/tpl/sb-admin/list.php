<?php $idiom = $assist->view->idiom("theme"); ?>
<a id="btnAdd"  href="<?php echo $assist->view->url("$idiomId/news/add"); ?>" class="btn btn-primary">btnAdd</a>
<table id="newsList" class="display" cellspacing="1" width="100%">
    <thead>
        <tr>
            <th><?php  if(isset($idiom['news']['list']['date'])) echo $idiom['news']['list']['date']; ?></th>
            <th><?php  if(isset($idiom['news']['list']['title'])) echo $idiom['news']['list']['title']; ?></th>
            <th><?php  if(isset($idiom['news']['list']['sumary'])) echo $idiom['news']['list']['sumary']; ?></th>
            <th><?php  if(isset($idiom['news']['list']['actions'])) echo $idiom['news']['list']['actions']; ?></th>
        </tr>
    </thead>

    <tfoot>
        <tr>
            <th><?php  if(isset($idiom['news']['list']['date'])) echo $idiom['news']['list']['date']; ?></th>
            <th><?php  if(isset($idiom['news']['list']['title'])) echo $idiom['news']['list']['title']; ?></th>
            <th><?php  if(isset($idiom['news']['list']['sumary'])) echo $idiom['news']['list']['sumary']; ?></th>
            <th><?php  if(isset($idiom['news']['list']['actions'])) echo $idiom['news']['list']['actions']; ?></th>
        </tr>
    </tfoot>

    <tbody></tbody>
</table>