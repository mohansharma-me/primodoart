$.adminDocumentReady=function() {
	$.editLink=function() {
		var t=$(this);
		var attr=$(t).attr("data-edit");
		var titl=$(t).attr("title");
		var currentLoader=$('<img id="currentLoader" src="/images/loader.gif" />');
		$(t).replaceWith(currentLoader);
		$.ajax({
			url:"/cpu",
			data:{
					job:"edit-link",
					edit:attr, title:titl
			},
			type:"post",
			error:function(e) {
				alert("ASD");
			},
			success:function(data) {
				try {
					var $dialog = $('<div></div>')
					.html(data)
					.dialog({
						autoOpen: false,
						resizable:true,
						modal:true,
						title: titl,
						close:function() {
							$dialog.remove();
						}
					});
					$($dialog).dialog('open');
				} catch(e) {
					alert("Oops, something went wrong, please contact developer team.\n"+data);
				}
			},
			complete:function() {
				$(currentLoader).replaceWith(t);
				$(t).click($.editLink);
			}
		});
		return false;
	};
	
	$.newService=function() {
		var t=$(this);
		$(t).replaceWith('<img id="loadingGif" src="/images/loader.gif" />');
		$.ajax({
			url:"/cpu",
			data:{
				job:"service"
			},
			type:"post",
			success: function(data) {
				try {
					var $dialog = $('<div></div>')
					.html(data)
					.dialog({
						autoOpen: false,
						resizable:true,
						modal:true,
						title: "New Service",
						close:function() {
							$dialog.remove();
						}
					});
					$($dialog).dialog('open');
				} catch(e) {
					alert("Oops, unknown error occured.");
				}
			},
			error: function(data) {
				alert("Sorry, unknown error occured may be due to weak Internet Connection.\nPlease try again.");
			},
			complete: function(data) {
				$("#loadingGif").replaceWith(t);
				$(t).click($.newService);
			}
		});
		return false;
	};
	
	$.editService=function() {
		var t=$(this);
		var edit=$(t).attr("data-edit");
		$(t).replaceWith('<img id="loadingGif" src="/images/loader.gif" />');
		$.ajax({
			url:"/cpu",
			data:{
				job:"service",
				id:edit
			},
			type:"post",
			success: function(data) {
				try {
					var $dialog = $('<div></div>')
					.html(data)
					.dialog({
						autoOpen: false,
						resizable:true,
						modal:true,
						title: "Edit Service",
						close:function() {
							$dialog.remove();
						}
					});
					$($dialog).dialog('open');
				} catch(e) {
					alert("Oops, unknown error occured.");
				}
			},
			error: function(data) {
				alert("Sorry, unknown error occured may be due to weak Internet Connection.\nPlease try again.");
			},
			complete: function(data) {
				$("#loadingGif").replaceWith(t);
				$(t).click($.editService);
			}
		});
		return false;
	};
	
	$.deleteService=function() {
		var t=$(this);
		var edit=$(t).attr("data-edit");
		$(t).replaceWith('<img id="loadingGif" src="/images/loader.gif" />');
		$.ajax({
			url:"/cpu",
			data:{
				job:"service",
				id:edit,
				action:"delete"
			},
			type:"post",
			success: function(data) {
				try {
					var $dialog = $('<div></div>')
					.html(data)
					.dialog({
						autoOpen: false,
						resizable:true,
						modal:true,
						title: "Delete Service",
						close:function() {
							$dialog.remove();
						}
					});
					$($dialog).dialog('open');
				} catch(e) {
					alert("Oops, unknown error occured.");
				}
			},
			error: function(data) {
				alert("Sorry, unknown error occured may be due to weak Internet Connection.\nPlease try again.");
			},
			complete: function(data) {
				$("#loadingGif").replaceWith(t);
				$(t).click($.deleteService);
			}
		});
		return false;
	};
	
	$.newPortfolio=function() {
		var t=$(this);
		$(t).replaceWith('<img id="loadingGif" src="/images/loader.gif" />');
		$.ajax({
			url:"/cpu",
			data:{
				job:"portfolio"
			},
			type:"post",
			success: function(data) {
				try {
					var $dialog = $('<div></div>')
					.html(data)
					.dialog({
						autoOpen: false,
						resizable:true,
						modal:true,
						title: "Upload Portfolio",
						close:function() {
							$dialog.remove();
						}
					});
					$($dialog).dialog('open');
				} catch(e) {
					alert("Oops, unknown error occured.");
				}
			},
			error: function(data) {
				alert("Sorry, unknown error occured may be due to weak Internet Connection.\nPlease try again.");
			},
			complete: function(data) {
				$("#loadingGif").replaceWith(t);
				$(t).click($.newPortfolio);
			}
		});
		return false;
	};
	
	$.editPortfolio=function() {
		var t=$(this);
		var edit=$(t).attr("data-edit");
		$(t).replaceWith('<img id="loadingGif" src="/images/loader.gif" />');
		$.ajax({
			url:"/cpu",
			data:{
				job:"portfolio",
				id:edit
			},
			type:"post",
			success: function(data) {
				try {
					var $dialog = $('<div></div>')
					.html(data)
					.dialog({
						autoOpen: false,
						resizable:true,
						modal:true,
						title: "Edit Portfolio",
						close:function() {
							$dialog.remove();
						}
					});
					$($dialog).dialog('open');
				} catch(e) {
					alert("Oops, unknown error occured.");
				}
			},
			error: function(data) {
				alert("Sorry, unknown error occured may be due to weak Internet Connection.\nPlease try again.");
			},
			complete: function(data) {
				$("#loadingGif").replaceWith(t);
				$(t).click($.editPortfolio);
			}
		});
		return false;
	};
	
	$.deletePortfolio=function() {
		var t=$(this);
		var edit=$(t).attr("data-edit");
		$(t).replaceWith('<img id="loadingGif" src="/images/loader.gif" />');
		$.ajax({
			url:"/cpu",
			data:{
				job:"portfolio",
				id:edit,
				action:"delete"
			},
			type:"post",
			success: function(data) {
				try {
					var $dialog = $('<div></div>')
					.html(data)
					.dialog({
						autoOpen: false,
						resizable:true,
						modal:true,
						title: "Delete Portfolio",
						close:function() {
							$dialog.remove();
						}
					});
					$($dialog).dialog('open');
				} catch(e) {
					alert("Oops, unknown error occured.");
				}
			},
			error: function(data) {
				alert("Sorry, unknown error occured may be due to weak Internet Connection.\nPlease try again.");
			},
			complete: function(data) {
				$("#loadingGif").replaceWith(t);
				$(t).click($.deletePortfolio);
			}
		});
		return false;
	};
	
	$.newClient=function() {
		var t=$(this);
		$(t).replaceWith('<img id="loadingGif" src="/images/loader.gif" />');
		$.ajax({
			url:"/cpu",
			data:{
				job:"clients"
			},
			type:"post",
			success: function(data) {
				try {
					var $dialog = $('<div></div>')
					.html(data)
					.dialog({
						autoOpen: false,
						resizable:true,
						modal:true,
						title: "Upload Client",
						close:function() {
							$dialog.remove();
						}
					});
					$($dialog).dialog('open');
				} catch(e) {
					alert("Oops, unknown error occured.");
				}
			},
			error: function(data) {
				alert("Sorry, unknown error occured may be due to weak Internet Connection.\nPlease try again.");
			},
			complete: function(data) {
				$("#loadingGif").replaceWith(t);
				$(t).click($.newClient);
			}
		});
		return false;
	};
	
	$(".new-client-button").click($.newClient);
	$(".edit-portfolio-button").click($.editPortfolio);
	$(".delete-portfolio-button").click($.deletePortfolio);
	$(".edit-link").click($.editLink);
	$(".new-service-button").click($.newService);
	$(".edit-service-button").click($.editService);
	$(".delete-service-button").click($.deleteService);	
	$(".upload-portfolio-button").click($.newPortfolio);
};

$(document).ready($.adminDocumentReady);