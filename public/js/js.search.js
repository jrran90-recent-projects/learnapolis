$(function() {

/*
--------- Search
*/


var s_fullName = new Bloodhound({
		datumTokenizer: function (data) {
			return Bloodhound.tokenizers.obj.whitespace('data.firstname')
		},
		queryTokenizer: Bloodhound.tokenizers.whitespace,
		remote: {
			// url: 'http://' + window.location.host + '/search/%QUERY',
			url: 'search/%QUERY', // local
			filter: function ( response ) {
				return $.map(response, function (obj) {
					return { id: obj._id, name: obj.firstname+ " " +obj.lastname, type: 'user' }
				});
			}
		}
	});

var s_groupJoined = new Bloodhound({
		datumTokenizer: function (d) {
			return Bloodhound.tokenizers.obj.whitespace('d.name')
		},
		queryTokenizer: Bloodhound.tokenizers.whitespace,
		remote: {
			// url: 'http://' + window.location.host + '/search-group/%QUERY',
			url: 'search-group/%QUERY', // local
			filter: function ( response ) {
				return $.map(response, function (obj) {
					return { id: obj._id, group: obj.name, type: 'group' }
				});
			}
		}
	});


s_fullName.initialize();
s_groupJoined.initialize();


$('#mainSearch').typeahead({ highlight: true },
	{
		displayKey: 'name',
		source: s_fullName.ttAdapter(),
		templates: {
			header: '<h3 class="t_headerSearch">Name</h3>'
		}
	},
	{
		displayKey: 'group',
		source: s_groupJoined.ttAdapter(),
		templates: {
			header: '<h3 class="t_headerSearch">Group</h3>'
		}
	}
	).on('typeahead:selected', function(obj, datum) {
		switch ( datum.type ) {
			case 'user': 	window.location.href = 'user/'+datum.id;	break;
			case 'group': 	window.location.href = 'group/'+datum.id;	break;
			default: //
		}
		// window.location.href = 'group/'+datum.id;
		$("#mainSearch").focus();
});


});