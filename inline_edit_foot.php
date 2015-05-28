<? if (!empty($_COOKIE['admin_logged_in']) && intval($curpage['id'] > 0)) { ?>
<div id="admin-buttons" title="Admin">
	<? if (empty($curpage['alt_url'])) { ?> 
    <a href="#" id="edit_page_button" class="btn btn-primary btn-block" data-toggle="tooltip" data-placement="left" title="Edit Page"><span class="glyphicon glyphicon-pencil"></span> Edit</a>
    <a href="#" id="cancel_page_button" class="btn btn-warning btn-block" data-toggle="tooltip" data-placement="left" title="Cancel"><span class="glyphicon glyphicon-remove"></span> Cancel</a>
    <a href="#" id="save_page_button" class="btn btn-default btn-block" data-toggle="tooltip" data-placement="left" title="Save Changes"><span class="glyphicon glyphicon-save"></span> Save</a>
    <a href="#" id="widget_button" class="btn btn-info btn-block" data-toggle="tooltip" data-placement="left" title="Widgets"><span class="glyphicon glyphicon-th"></span> Widgets</a>
    <a href="<?= $admin_folder ?>/page.php?id=<?= $curpage['id']; ?>" class="btn btn-default btn-block" data-toggle="tooltip" data-placement="left" title="Switch to Backend"><span class="glyphicon glyphicon-list-alt"></span> Admin</a>
    <a href="<?= $admin_folder ?>/index.php" class="btn btn-default btn-block" data-toggle="tooltip" data-placement="left" title="Switch to Backend"><span class="glyphicon glyphicon-list-alt"></span> Pages</a>
    <? } else { ?>
    <? if (isset($admin_module) && !empty($admin_module)) { ?>
    <a href="<?= $admin_folder; ?>/<?= $admin_module; ?>" class="btn btn-primary btn-block" data-toggle="tooltip" data-placement="left" title="Manage Content in Admin"><span class="glyphicon glyphicon-list-alt"></span> Manage</a>
    <? } ?>
    <a href="<?= $admin_folder ?>/page.php?id=<?= $curpage['id']; ?>" class="btn btn-default btn-block" data-toggle="tooltip" data-placement="left" title="Page Properties"><span class="glyphicon glyphicon-cog"></span> Properties</a>
    <? } ?>
</div>

<div id="widgets">
<? 
	foreach(glob("widgets/*.json") as $widget_button) { 
		$widget_info = json_decode(file_get_contents($widget_button));
?>
	<a href="#" class="btn btn-default" id="<?= $widget_info->name; ?>"><?= $widget_info->label; ?></a>
<? } ?>
</div>

<script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.0/jquery.bootstrap-growl.min.js"></script>
<script src="../admin/ckeditor/ckeditor.js"></script>
<script>
CKEDITOR.disableAutoInline = true;
$(document).ready(function(e) {
    $("#admin-buttons").dialog({
        position: { my: "left top", at: "right top", of: document.getElementById("main-container") },
        resizable: false
    });
    $("#admin-buttons").dialog('open');
	
	$("#widgets").dialog({
        resizable: true
    });
	$("#widgets").dialog('close');
	$("#widget_button").click(function(e) {
        e.preventDefault();
		$("#widgets").dialog('open');
    });
    
	$("#save_page_button,#cancel_page_button,#widget_button").hide();
    $("#edit_page_button").click(function(e) {
        e.preventDefault();
        var elementid = 'page_<?= $curpage['id']; ?>_content';
        
        $("#" + elementid).attr("contenteditable","true");
        $("#" + elementid).css("border","2px dashed #cccccc");
        
        var editor = CKEDITOR.inline( document.getElementById(elementid), {
            filebrowserBrowseUrl: '<?= $admin_folder; ?>/elfinder/ck_elfinder.html',
			allowedContent: true,
            on: {
                blur: function( event ) {
                    var data = event.editor.getData();
                    // savePage(data);
                    // $("#" + elementid).css("border","none");
                }
            },
            toolbar: [
              { name: 'document', items: [ 'WidgetTemplateMenu' ] },
              { name: 'spelling', items: [ 'Scayt' ] },
              { name: 'clipboard', items: [ 'Cut','Copy','Paste','PasteText','PasteFromWord','RemoveFormat' ] },
              { name: 'history', items: [ 'Undo','Redo' ] },
                { name: 'links', items : [ 'Link','Unlink','Anchor' ] },
                { name: 'insert', items : [ 'Image','Table','HorizontalRule','SpecialChar' ] },
                { name: 'editing', items : [ 'Find','Replace','-','SelectAll', 'ShowBlocks' ] },
                { name: 'embedding', items : [ 'Iframe', 'MediaEmbed' ] },
                '/',
                { name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
                { name: 'basicstyles', items : [ 'Bold','Italic','Underline' ] },
                { name: 'paragraph', items : [ 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','NumberedList','BulletedList','-','Outdent','Indent', 'TextColor' ] },
                { name: 'code', items : [ 'Maximize', 'Source' ] }
              ]
          });
      
      $("#edit_page_button").hide();
      $("#save_page_button,#cancel_page_button,#widget_button").show();

      $.bootstrapGrowl("Edit mode Enabled", {
            ele: 'body', // which element to append to
            type: 'info', // (null, 'info', 'danger', 'success')
            offset: {from: 'bottom', amount: 20}, // 'top', or 'bottom'
            align: 'right', // ('left', 'right', or 'center')
            width: 250, // (integer, or 'auto')
            delay: 5000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
            allow_dismiss: true, // If true then will display a cross to close the popup.
            stackup_spacing: 10 // spacing between consecutively stacked growls.
        });
    });		
    $("#save_page_button").click(function(e) {
        e.preventDefault();
        var elementid = 'page_<?= $curpage['id']; ?>_content';
        savePage();
        CKEDITOR.instances.page_<?= $curpage['id']; ?>_content.destroy();
        $("#" + elementid).attr("contenteditable","false");
        $("#" + elementid).css("border","none");
        $("#save_page_button,#cancel_page_button,#widget_button").hide();
		$("#widgets").dialog('close');
        $("#edit_page_button").show();
    });
    
    $("#cancel_page_button").click(function(e) {
        e.preventDefault();
        var elementid = 'page_<?= $curpage['id']; ?>_content';
        CKEDITOR.instances.page_<?= $curpage['id']; ?>_content.destroy();
        $("#" + elementid).attr("contenteditable","false");
        $("#" + elementid).css("border","none");
        $("#save_page_button,#cancel_page_button,#widget_button").hide();
		$("#widgets").dialog('close');
        $("#edit_page_button").show();
    });
	
	$("#widgets .btn").click(function(e) {
        e.preventDefault();
		window.open("<?= $admin_folder; ?>/widget_add.php?page=<?= $curpage['id']; ?>&widget="+$(this).attr("id"),"InsertWidget","width=400,height=600,menubar=no,location=no,resizable=yes,scrollbars=yes,status=no");
    });
});

function savePage(htmldata) {
    if (!htmldata || htmldata == '') {
        var htmldata = CKEDITOR.instances.page_<?= $curpage['id']; ?>_content.getData();
    }
    $.ajax({
        type: "POST",
        url: '<?= $admin_folder; ?>/page_api.php',
        data: {
            action: 'inlinesave',
            id: <?= $curpage['id']; ?>,
            content: htmldata
        },
        success: function( retn ) {
            console.log(retn);
            $.bootstrapGrowl("Page data saved", {
                ele: 'body', // which element to append to
                type: 'success', // (null, 'info', 'danger', 'success')
                offset: {from: 'bottom', amount: 20}, // 'top', or 'bottom'
                align: 'right', // ('left', 'right', or 'center')
                width: 250, // (integer, or 'auto')
                delay: 5000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
                allow_dismiss: true, // If true then will display a cross to close the popup.
                stackup_spacing: 10 // spacing between consecutively stacked growls.
            });
        },
        dataType: "json"
    });
}
</script>
<? } elseif (!empty($_COOKIE['admin_logged_in']) && intval($curpage['id']) < 1) { ?>
<div id="admin-buttons" title="Admin">
    <a href="<?= $admin_folder; ?>/page.php?action=add" class="btn btn-primary btn-block" data-toggle="tooltip" data-placement="left" title="Add Page"><span class="glyphicon glyphicon-plus"></span> Add Page</a>
    <a href="<?= $admin_folder ?>/pages.php" class="btn btn-default btn-block" data-toggle="tooltip" data-placement="left" title="Switch to Backend"><span class="glyphicon glyphicon-list-alt"></span> Admin</a>
</div>
<script src="//code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script><br>
<script>
$(document).ready(function(e) {
    $("#admin-buttons").dialog({
        position: { my: "left top", at: "right top", of: document.getElementById("main-container") },
        resizable: false
    });
    $("#admin-buttons").dialog('open');
});
</script>
<? } ?>