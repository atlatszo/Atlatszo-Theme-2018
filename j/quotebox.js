(function() {
    tinymce.create("tinymce.plugins.quotebox_button_plugin", {

        //url argument holds the absolute url of our plugin directory

        init : function(ed, url) {

            //add new button

            ed.addButton("quotebox", {
                title : "Idézet doboz beszúrása",
                cmd : "quotebox_command"
            });

            ed.addCommand("quotebox_command", function() {

                var return_text = '[quotebox text="Az idézet helye" author="Név" title="Titulus" date="2018.01.01"]';
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

    tinymce.PluginManager.add("quotebox_button_plugin", tinymce.plugins.quotebox_button_plugin);
})();