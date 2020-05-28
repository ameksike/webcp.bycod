$(document).ready(function() {
        var table = $('.display').DataTable({
            "scrollX": true,
            "serverSide": true,
            "pagingType": "full_numbers",
            "ajax": Bycod.router.action("person/list"),
            "stateSave": true,   
            "columnDefs": [
                {
                    "render": function ( data, type, row ) {
                        return '<img width="20px" src="' + row['avatar'] + '">';
                    },
                    "targets": 1
                },{
                    "searchable": false,
                    "render": function ( data, type, row ) {
						var btn_edit = '<a href="' + Bycod.router.action("person/edit/"+row['id'])  + '">' + ' <span class="fas fa-edit"> </span>  ' +'</a>';
						var btn_dele = '<a id="'+row['id']+'" href="' +  Bycod.router.action("person/delete/"+row['id'])  + '">' + ' <span class="fas fa-trash"> </span>  ' +'</a>';
						var btn_view = '<a href="' +Bycod.router.action("person/view/"+row['id'])  + '">' + ' <span class="fas fa-eye"> </span>  ' +'</a>';
                        return  '<div class="act">' + btn_view + btn_edit + btn_dele + '</div>';
                    },
                    "targets": 8
                },{
                    "targets": 9, "visible": false, "searchable": true
                },{
                    "targets": 10, "visible": false, "searchable": true
                },{
                    "targets": 11, "visible": false, "searchable": true
                }
            ],
            "columns": [
                {
                "className":      'details-control',
                "orderable":      false,
                "data":           null,
                "defaultContent": ''
                },
                { "data": "avatar", "className": 'avatar' },
                { "data": "firstname" },
                { "data": "lastname" },
                { "data": "alias" },
                { "data": "sex" },
                { "data": "user" },
                { "data": "domain" },
                { "data": "company" },
                { "data": "place" },
                { "data": "position" },
                { "data": "category" }
            ],
            "language": lan
        });


        $('#person tbody').on('click', 'td.details-control', function () {
            var tr = $(this).closest('tr');
            var row = table.row( tr );
            if ( row.child.isShown() ) {
                row.child.hide();
                tr.removeClass('shown');
            }
            else {
                var objp = row.data();
                $.ajax({
                    type: "POST",
                    url: Bycod.router.action("person/meta/" + objp.id),
                    success: function(msg){
                        row.child( msg).show();
                        tr.addClass('shown');
                    }
                });
            }
        } );

        $('#person tbody').on('click', 'td.avatar', function () {
            var tr = $(this).closest('tr');
            var row = table.row( tr );
            var objp = row.data();
            $( "#dialog" ).empty();
            $( "#dialog" ).append('<img width="100%" src="' + objp['avatar'] + '">');
            // ( "#dialog" ).replaceWith('<div id="dialog" title="Foto">' +'<img width="100%" src="' + objp['avatar'] + '">'+'</div>');
            $( "#dialog" ).dialog();
        } );
} );

