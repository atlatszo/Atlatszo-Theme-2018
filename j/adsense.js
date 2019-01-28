(function() {
    tinymce.create("tinymce.plugins.adsense_button_plugin", {

        //url argument holds the absolute url of our plugin directory

        init : function(ed, url) {

            //add new button

            ed.addButton("adsense", {
                title : "Google Adsense beszúrása",
                cmd : "adsense_command"
                //image : "https://cdn3.iconfinder.com/data/icons/softwaredemo/PNG/32x32/Circle_Green.png"
            });

            //button functionality.
            ed.addCommand("adsense_command", function() {
                
                /*var selected_text = ed.selection.getContent();
                var return_text = "<span style='color: green'>" + selected_text + "</span>";
                ed.execCommand("mceInsertContent", 0, return_text);*/
                
                //QTags.insertContent("[code]" +  selected_text + "[/code]");

                var return_text = "[adsense]";
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

    tinymce.PluginManager.add("adsense_button_plugin", tinymce.plugins.adsense_button_plugin);
})();