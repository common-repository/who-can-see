(function() {
    tinymce.PluginManager.add('custom_mce_button', function(editor, url) {
        editor.addButton('custom_mce_button', {
            text: false,
            icon: 'custom-mce-icon',
            onclick: function() {
                var content = editor.selection.getContent()
                editor.insertContent('[whocansee only="visitors"]'+ content+'[/whocansee]')
            }
        })
    })
})()