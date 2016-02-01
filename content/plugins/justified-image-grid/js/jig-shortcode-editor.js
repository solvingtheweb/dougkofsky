(function() {
	tinymce.create('tinymce.plugins.JustifiedImageGrid', {
		init : function(ed, url){
			ed.addCommand('jig_shortcode_editor_button', function(){
				ed.windowManager.open({
					file: ajaxurl + '?action=jig_shortcode_editor',
					width : 900 + parseInt(ed.getLang('button.delta_width', 0), 10),
					height : 500 + parseInt(ed.getLang('button.delta_height', 0), 10),
					inline : 1
				}, {
					plugin_url : url
				});
			});
			ed.addButton('jig_shortcode_editor', {title : 'Justified Image Grid shortcode editor', cmd : 'jig_shortcode_editor_button', image: url.substring(0,url.lastIndexOf("/js")) + '/images/icon.gif' });
		},
		getInfo : function(){
			return {
				longname : 'Justified Image Grid shortcode editor',
				author : 'Firsh',
				authorurl : 'http://justifiedgrid.com/',
				infourl : 'http://justifiedgrid.com/',
				version : tinymce.majorVersion + "." + tinymce.minorVersion
			};
		}
	});
	tinymce.PluginManager.add('jig_shortcode_editor', tinymce.plugins.JustifiedImageGrid);
})();