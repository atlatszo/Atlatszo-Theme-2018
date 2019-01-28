(function() {
    tinymce.create("tinymce.plugins.aboutblock_button_plugin", {

        //url argument holds the absolute url of our plugin directory

        init : function(ed, url) {

            //add new button     
            ed.addButton("aboutblock", {
                title : "Szerzői doboz beszúrása",
                cmd : "aboutblock_command"
            });

            ed.addCommand("aboutblock_command", function() {

                var return_text = '[aboutblock]';
                ed.execCommand("mceInsertContent", 0, return_text);
            });

        },

        createControl : function(n, cm) {
            return null;
        },

        getInfo : function() {
            return {
                longname : "Extra Buttons",
                author : "Bacsó Attila",
                version : "1"
            };
        }
    });

    tinymce.PluginManager.add("aboutblock_button_plugin", tinymce.plugins.aboutblock_button_plugin);
})();