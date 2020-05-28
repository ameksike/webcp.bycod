
function icoUrl(row){
    let url = Bycod.router.module("theme");
    let ico = row['type']=="fixed" ? "phone-call-us" : "tmovil-black" ;
    return url + "/src/client/tpl/debug/img/icos/"+ ico + ".svg";
}

$(document).ready(function() {
    $('#phonebook').dataTable({
            "scrollX": true,
            "serverSide": true,
            "pagingType": "full_numbers",
            "ajax":  Bycod.router.action("phone/list"), 
            stateSave: true,
            "columnDefs": [
                {
                    "render": function ( data, type, row ) {
                        return '<img width="20px" src="' + icoUrl(row) + '">';
                    },
                    "targets": 0
                },{
                    "targets": [ 9 ],
                    "visible": false,
                    "searchable": true
                },
				{
                    "searchable": false,
                    "render": function ( data, type, row ) {
						var btn_edit = '<a href="' + Bycod.router.action("phone/edit/"+row['id'])  + '">' + ' <span class="fas fa-edit"> </span>  ' +'</a>';
						var btn_dele = '<a id="'+row['id']+'" href="' +  Bycod.router.action("phone/delete/"+row['id'])  + '">' + ' <span class="fas fa-trash"> </span>  ' +'</a>';
						var btn_view = '<a href="' +Bycod.router.action("phone/view/"+row['id'])  + '">' + ' <span class="fas fa-eye"> </span>  ' +'</a>';
                        return  '<div class="act">' + btn_view + btn_edit + btn_dele + '</div>';
                    },
                    "targets": 8
                }
            ],
            "columns": [
                { "data": "ico" },
                { "data": "title" },
                { "data": "value" },
                { "data": "extension" },
                { "data": "note" },
                { "data": "company" },
                { "data": "city" },
                { "data": "locale" },
                { "data": "addrees" },
                { "data": "type" }
            ],
            "language": lan
        });
} );