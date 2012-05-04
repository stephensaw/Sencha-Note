Ext.define("SenchaNote.view.Viewport",{
	extend: "Ext.Panel",

	initialize: function() {},

	config: {
		fullscreen: true,
		layout: "card",
		items: [ {xtype: "mainpanel" }, {xtype: "noteeditor"} ]
	}
});