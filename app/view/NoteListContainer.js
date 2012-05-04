Ext.define("SenchaNote.view.NoteListContainer",{
	extend: "Ext.Panel",
	xtype: "notelistcontainer",

	requires: ["SenchaNote.view.NoteList","SenchaNote.view.SearchBar"],

	initialize: function() {
		var toolbar = {
			xtype: "toolbar",
			docked: "top",
			title: "Note List",
			items: [
				{ xtype: "spacer" },
				{
					xtype: "button",
					text: "Add",
					handler: this.onAddNoteTap,
					scope: this
				}
			]
		};

		this.add([toolbar, { xtype: "searchbar" }, { xtype: "notelist"}]);
	},

	config: {
		layout: "fit", //critical for list to show
		title: "Note List",
		iconCls: "home"
	},

	onAddNoteTap: function() {
		this.fireEvent("addNoteCommand",this);
	}
});