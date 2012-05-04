Ext.define("SenchaNote.model.Category",{
	extend: "Ext.data.Model",

	config: {
		idProperty: "id",
		fields: [
			{ name: "id", type: "integer" }, //need an id field else model.phantom won't work correctly
			{ name: "name", type: "string" }
		],
		validations: [
			{ type: "presense", field: "id" },
			{ type: "presense", field: "name" }
		]
	}
});