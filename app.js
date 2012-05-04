Ext.application({
	name: "SenchaNote",
	icon: "resources/images/app-icon.png",
    phoneIcon: "resources/images/app-iphone-icon.png",

    controllers: ["Note"],
    models: ["Note","Category"],
    stores: ["Note","Category"],
    views: ["Viewport","MainPanel", "NoteListContainer", "NoteEditor", "AboutPanel"],

	launch : function() {
		Ext.create("SenchaNote.view.Viewport");
	}
});