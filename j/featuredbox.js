(function() {
    tinymce.create("tinymce.plugins.featuredbox_button_plugin", {

        //url argument holds the absolute url of our plugin directory

        init : function(ed, url) {

            //add new button     
            ed.addButton("featuredbox", {
                title : "Kiemelt doboz beszúrása",
                cmd : "featuredbox_command"
            });

            ed.addCommand("featuredbox_command", function() {

                var return_text = '[featuredbox text="Előfizetőket keresünk – támogasd a munkánkat havi ezer forinttal!" button_text="Támogatom" link="https://atlatszo.hu/elofizetes/"]';
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

    tinymce.PluginManager.add("featuredbox_button_plugin", tinymce.plugins.featuredbox_button_plugin);
})();