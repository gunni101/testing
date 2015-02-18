/**
 * 
 */
$(function() {
	$("#showform").click(function() {
		$("#winpopup").dialog({
			draggable: true,
			modal: true,
			autoOpen: false,
			height: 'auto',
			width: 'auto',
			resizable: false,
			title: 'Tankstelle bearbeiten',
			position: { my: "top", at:"top", of: "#test"}
		});
		$("#winpopup").load($(this).attr('href'));
		$("#winpopup").dialog("open");
		
		return false;
	});
});