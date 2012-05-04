Ext.define("SenchaNote.model.Note", {
	extend: "Ext.data.Model",

	config: {
		idProperty: "id",
		fields: [
			{ name: "id", type: "integer" }, //need an id field else model.phantom won't work correctly (reverse actually)
			{ name: "content" , type: "string" },
			{ name: "categoryid", type: "integer" },
			{ name: "category", type: "string" }
		],
		validations: [
			{ type: "presence", field: "id" },
			{ type: "presence", field: "content" , message: "Content?"},
			{ type: "presence", field: "categoryid" }
		]
	}
});