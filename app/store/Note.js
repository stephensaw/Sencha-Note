Ext.define("SenchaNote.store.Note", {
	extend: "Ext.data.Store",
	requires: ["SenchaNote.model.Note"],
	config: {
		model: "SenchaNote.model.Note", //need full name, weird
		proxy: {
			type: "ajax",
			api: {
				create: "http://192.168.168.10:8888/SenchaNote/Note.php?action=create",
				read: "http://192.168.168.10:8888/SenchaNote/Note.php",
				update: "http://192.168.168.10:8888/SenchaNote/Note.php?action=update",
				destroy: "http://192.168.168.10:8888/SenchaNote/Note.php?action=destroy"
			},
			extraParams: {
				keyword: ""
			},
			reader: {
				type: "json",
				rootProperty: "notes",
				totalProperty: "total"
			}
		},
		pageSize: 1,
		autoLoad: true
	}
});