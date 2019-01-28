(function() {
    tinymce.create("tinymce.plugins.tamogatoibox_button_plugin", {

        //url argument holds the absolute url of our plugin directory

        init : function(ed, url) {

            //add new button

            ed.addButton("tamogatoibox", {
                title : "Támogatói doboz beszúrása",
                cmd : "tamogatoibox_command"
            });

            ed.addCommand("tamogatoibox_command", function() {

                var return_text = '[tamogatoibox blokk_hivatkozasi_nev="koztukvagy"]';
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

    tinymce.PluginManager.add("tamogatoibox_button_plugin", tinymce.plugins.tamogatoibox_button_plugin);
})();