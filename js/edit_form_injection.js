var jquery = $.noConflict();

function y() {
			jquery('.modal-body').load('student/edit', function() {
				jquery('#editModal').modal({show:true});
			});
		}