Ext.define("SenchaNote.view.NoteEditor",{
	extend: "Ext.form.Panel",
	xtype: "noteeditor",
	requires: ["Ext.form.FieldSet", "Ext.field.Select"],
	initialize: function(){
		var toolbar = {
			xtype: "toolbar",
			docked: "top",
			title: "Add Note",
			items: [
				{
					xtype: "button",
					ui: "back",
					text: "Back", 
					handler: this.onBackTap,
					scope: this
				},
				{ xtype: "spacer" },
                {
                    xtype: "button",
                    ui: "decline",
                    text: "Destroy",
                    handler: this.onDestroyTap,
                    scope: this
                },
                {
                    xtype: "button",
                    ui: "confirm",
                    text: "Save",
                    handler: this.onSaveTap,
                    scope: this
                }
			]
		};
		this.add([
			toolbar,
			{
				xtype: "fieldset",
				defaults: {
					xtype: "textfield"
				},
				items: [
					{ name: "content", label: "Content" },
					{ name: "categoryid", label: "Category", xtype: "selectfield", store: "Category", displayField: "name", valueField: "id" }
				]
			}
		]);
	},
	config: {
		listeners: {
			show: function() { this.onShow(); }
		}
	},
	onShow: function(){
		if (this.getRecord().phantom)
			this.items.get(0).setTitle("Add Note");
		else
			this.items.get(0).setTitle("Edit Note");
	},
	onSaveTap: function() {
		this.fireEvent("saveCommand", this);
	},
	onBackTap: function() {
		this.fireEvent("backCommand",this);
	},
    onDestroyTap: function() {
        console.log("onDestroyTap");
        this.fireEvent("destroyCommand",this);
    }
});