CKEDITOR.editorConfig = function( config ) {
    config.language = 'en';
    config.uiColor = '#FFFFFF';
    config.extraPlugins = 'codemirror,autogrow';
	config.autoGrow_minHeight = 300;
	//config.autoGrow_maxHeight = 800;
	config.toolbarCanCollapse = true;
	config.toolbar = [
		{ name: 'basicstyles', items : [ 'Bold','Italic','Underline', 'TextColor' ] },
		{ name: 'links', items : [ 'Link','Unlink' ] },
		{ name: 'history', items: [ 'Undo','Redo' ] },
		{ name: 'clipboard', items: [ 'Cut','Copy','Paste','PasteText','PasteFromWord','RemoveFormat' ] },
		{ name: 'source', items: [ 'Source' ] }
	];
};