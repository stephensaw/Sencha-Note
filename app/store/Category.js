Ext.define("SenchaNote.store.Category",{
	extend: "Ext.data.Store",

	requires: ["SenchaNote.model.Category"],

	config: {
		model: "SenchaNote.model.Category",
		proxy: {
			type: "ajax",
			url: "http://192.168.168.10:8888/SenchaNote/categorylist.php",
			reader: {
				type: "json",
				rootProperty: "categories"
			}
		},
		autoLoad: true
	}
});