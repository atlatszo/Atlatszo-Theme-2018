(function() {
    tinymce.create("tinymce.plugins.related_button_plugin", {

        //url argument holds the absolute url of our plugin directory
        
        init : function(ed, url) {

            //add new button     
            ed.addButton("related", {
                title : "Hasonló bejegyzések beszúrása",
                cmd : "related_command"
            });

            ed.addCommand("related_command", function() {

                var return_text = '[related_content id=""]';
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

    tinymce.PluginManager.add("related_button_plugin", tinymce.plugins.related_button_plugin);
})();