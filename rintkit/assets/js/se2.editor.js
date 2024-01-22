function se2_paste_html(id, html) {
	oEditors.getById[id].exec("PASTE_HTML", [html]);
}

function se2_editor_contents(id) {
	oEditors.getById[id].exec("UPDATE_CONTENTS_FIELD", []);
}