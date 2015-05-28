	/*
	var typkitID = 'meh8ump';
	CKEDITOR.on(
	   'instanceReady',
	   function(ev) {
		  var $script = document.createElement('script'),
			 $editor_instance = CKEDITOR.instances[ev.editor.name];
	 
		  $script.src = '//use.typekit.com/'+typkitID+'.js';
		  $script.onload = function() {
			 try{$editor_instance.window.$.Typekit.load();}catch(e){}
		  };
	 
		  $editor_instance.document.getHead().$.appendChild($script);
	   }
	);
	*/
	function datetimePicker(datefield) {
		if ($(datefield).length > 1) {
			/* Recursively call this function for each element specified */
			$(datefield).each(function(index, element) {
				datetimePicker('#' + $(this).attr("id"));
            });
		} else {
			var pickerelement = datefield+'_picker';
			
			/* Create the Picker Div if it doesn't exist */
			if ($(pickerelement).length == 0) {
				$(datefield).after('<div id="'+pickerelement.replace('#','')+'"></div>');
			}
			
			/* Initialize the Picker */
			$(pickerelement).datetimepicker({
				inline: true,
				sideBySide: true
			});
			
			/* When the Date changes for the picker, sync it with the field */
			$(pickerelement).on('dp.change',function(e) { 
				$(datefield).val(e.date.format('YYYY-MM-DD h:mm a'));
			});
			
			/* For when there are multiple fields, we hide inactive ones so it is less confusing */
			$(pickerelement).hide();
			$(datefield).focus(function(e) { $(pickerelement).show(); });
			$(datefield).blur(function(e) { $(pickerelement).hide(); });
		}
	}

    function editor(editorId) {
      CKEDITOR.replace( editorId, {
        width: '100%',
        contentsCss: ['../vendor/twbs/bootstrap/dist/css/bootstrap.css','../css/style.css','../css/admincss.css'],
        allowedContent: true,
        filebrowserBrowseUrl: 'elfinder/ck_elfinder.html',
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
    }
    
    function editorLite(editorId) {
      CKEDITOR.replace( editorId, {
        filebrowserBrowseUrl: 'elfinder/ck_elfinder.html',
        toolbar: [
          { name: 'basicstyles', items : [ 'Bold','Italic','Underline' ] },
		  { name: 'paragraph', items : [ 'JustifyLeft','JustifyCenter','JustifyRight','-','NumberedList','BulletedList' ] },
          { name: 'links', items : [ 'Link','Unlink' ] },
          { name: 'history', items: [ 'Undo','Redo' ] },
          { name: 'clipboard', items: [ 'Cut','Copy','Paste','PasteText','PasteFromWord','RemoveFormat' ] },
      		{ name: 'code', items : [ 'Source' ] }
	      ]
      });
    }