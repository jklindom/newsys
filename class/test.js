// JavaScript Document

			$(document).ready(function() {
				oTable = $('#tb1,#tb2').dataTable({
					"bJQueryUI": true,
					"sPaginationType": "full_numbers",
					"aaSorting": [[ 3, "desc" ]]
				});
			} );