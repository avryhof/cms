CKEDITOR.editorConfig = function( config ) {
    config.language = 'en';
    config.uiColor = '#FFFFFF';
	// config.plugins = 'wysiwygarea,toolbar,basicstyles,justify,menubutton,link,sourcearea,image2,widget';
    config.extraPlugins = 'iframe,iframe,leaflet,mediaembed,autogrow,codemirror,oembed,widgetbootstrap,widgettemplatemenu';
	config.autoGrow_minHeight = 300;
	config.toolbarCanCollapse = true;
	config.toolbar = [
		{ name: 'document', items: [ 'Print', 'Preview' ] },
		{ name: 'spelling', items: [ 'Scayt' ] },
		{ name: 'clipboard', items: [ 'Cut','Copy','Paste','PasteText','PasteFromWord','RemoveFormat' ] },
		{ name: 'history', items: [ 'Undo','Redo' ] },
		{ name: 'links', items : [ 'Link','Unlink','Anchor' ] },
		{ name: 'insert', items : [ 'Image','Table','HorizontalRule','SpecialChar' ] },
		{ name: 'editing', items : [ 'Find','Replace','-','SelectAll', 'ShowBlocks' ] },
		{ name: 'embedding', items : [ 'WidgetTemplateMenu','Iframe', 'MediaEmbed' ] },
		'/',
		{ name: 'styles', items : [ 'Styles','Format','Font','FontSize' ] },
		{ name: 'basicstyles', items : [ 'Bold','Italic','Underline' ] },
		{ name: 'paragraph', items : [ 'JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','NumberedList','BulletedList','-','Outdent','Indent', 'TextColor' ] },
		{ name: 'code', items : [ 'Source' ] }
	];
};