<!-- custom js '. simda .'-->
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>

<?php
   $nama_opd = $this->db->get('master_opd')->row('nmOPD');
?>
<script type="text/javascript">
var SETOPD =  '<?= $nama_opd ?>';
//
// Pipelining function for DataTables. To be used to the `ajax` option of DataTables
//
$.fn.dataTable.pipeline = function(opts) {
    // Configuration options
    var conf = $.extend({
        pages: 5, // number of pages to cache
        url: '', // script url
        data: null, // function or object with parameters to send to the server
        // matching how `ajax.data` works in DataTables
        method: 'POST' // Ajax HTTP method
    }, opts);

    // Private variables for storing the cache
    var cacheLower = -1;
    var cacheUpper = null;
    var cacheLastRequest = null;
    var cacheLastJson = null;

    return function(request, drawCallback, settings) {
        var ajax = false;
        var requestStart = request.start;
        var drawStart = request.start;
        var requestLength = request.length;
        var requestEnd = requestStart + requestLength;

        if (settings.clearCache) {
            // API requested that the cache be cleared
            ajax = true;
            settings.clearCache = false;
        } else if (cacheLower < 0 || requestStart < cacheLower || requestEnd > cacheUpper) {
            // outside cached data - need to make a request
            ajax = true;
        } else if (JSON.stringify(request.order) !== JSON.stringify(cacheLastRequest.order) ||
            JSON.stringify(request.columns) !== JSON.stringify(cacheLastRequest.columns) ||
            JSON.stringify(request.search) !== JSON.stringify(cacheLastRequest.search)
        ) {
            // properties changed (ordering, columns, searching)
            ajax = true;
        }

        // Store the request for checking next time around
        cacheLastRequest = $.extend(true, {}, request);

        if (ajax) {
            // Need data from the server
            if (requestStart < cacheLower) {
                requestStart = requestStart - (requestLength * (conf.pages - 1));

                if (requestStart < 0) {
                    requestStart = 0;
                }
            }

            cacheLower = requestStart;
            cacheUpper = requestStart + (requestLength * conf.pages);

            request.start = requestStart;
            request.length = requestLength * conf.pages;

            // Provide the same `data` options as DataTables.
            if (typeof conf.data === 'function') {
                // As a function it is executed with the data object as an arg
                // for manipulation. If an object is returned, it is used as the
                // data object to submit
                var d = conf.data(request);
                if (d) {
                    $.extend(request, d);
                }
            } else if ($.isPlainObject(conf.data)) {
                // As an object, the data given extends the default
                $.extend(request, conf.data);
            }

            settings.jqXHR = $.ajax({
                "type": conf.method,
                "url": conf.url,
                "data": request,
                "dataType": "json",
                "cache": false,
                "success": function(json) {
                    cacheLastJson = $.extend(true, {}, json);

                    if (cacheLower != drawStart) {
                        json.data.splice(0, drawStart - cacheLower);
                    }
                    if (requestLength >= -1) {
                        json.data.splice(requestLength, json.data.length);
                    }

                    drawCallback(json);
                }
            });
        } else {
            json = $.extend(true, {}, cacheLastJson);
            json.draw = request.draw; // Update the echo for each response
            json.data.splice(0, requestStart - cacheLower);
            json.data.splice(requestLength, json.data.length);

            drawCallback(json);
        }
    }
};

// Register an API method that will empty the pipelined data, forcing an Ajax
// fetch on the next draw (i.e. `table.clearPipeline().draw()`)
$.fn.dataTable.Api.register('clearPipeline()', function() {
    return this.iterator('table', function(settings) {
        settings.clearCache = true;
    });
});


$.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings) {
    return {
        "iStart": oSettings._iDisplayStart,
        "iEnd": oSettings.fnDisplayEnd(),
        "iLength": oSettings._iDisplayLength,
        "iTotal": oSettings.fnRecordsTotal(),
        "iFilteredTotal": oSettings.fnRecordsDisplay(),
        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength),
        deferLoading: oSettings._iDisplayLength,
    };

};


function format ( d ) {
    return  '<div class="bg-black" style="border: 0px; border-radius: 10px; padding: 15px;">'+
            '<b>DPA/DPPA</b>: '+d.KODE_DINAS+' '+d.KEGIATAN+' '+d.REKENING+'<br>'+
            '<b>TAHUN ANGGARAN</b>: '+d.COL1+'<br>'+
            '<b>DINAS</b>: '+d.COL18+'<br>'+
            '<b>URUSAN</b>: '+d.COL16+'<br>'+
            '<hr>'+
            '<b>PROGRAM</b>: '+d.COL24+'<br>'+
            '<b>KEGIATAN</b>: '+d.COL26+'<br>'+
            '<b>'+d.COL5+'. '+d.COL6+'</b><br>'+
            '<b>'+d.COL5+'.'+d.COL7+'. '+d.COL8+'</b><br>'+
            '<b>'+d.COL5+'.'+d.COL7+'.'+d.COL9+'.  '+d.COL10+'</b><br>'+
            '<b>'+d.COL5+'.'+d.COL7+'.'+d.COL9+'.'+d.COL11+'.  '+d.COL12+'</b><br>'+
            '<b>'+d.COL5+'.'+d.COL7+'.'+d.COL9+'.'+d.COL11+'.'+d.COL13+'. '+d.COL14+'</b><br>'+
            '<hr>'+
            '<b>PEKERJAAN: <span class="text-blue">'+d.COL30+'</span></b><br>'+
            '<b>JUMLAH</b>: '+d.COL31+'<br>'+
            '<b>SATUAN</b>: '+d.COL32+'<br>'+
            '<b>@HARGA</b>: '+d.COL33+'<br>'+
        
            '<b>PAGU: <span class="text-red">'+d.COL40+'</span></b><br>'+
            '</div>'


        ;
}


//
// DataTables initialisation
//
$(document).ready(function() {
 //var groupColumn = 4;   
 var dt =  $('#mytable').DataTable({
        initComplete: function() {
            var api = this.api();
            $('#mytable_filter input')
                .off('.DT')
                .on('keyup.DT', function(e) {
                    if (e.keyCode == 13) {
                        api.search(this.value).draw();
                    }
                });
        },
        columnDefs: [
            {
                "visible": false,
                "targets": [ 3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,  20,21,22,23,24,25,28,26,  30,  32,33,34,35  ,37,38,39, ] 
                //"targets": [ 2, 3, 4, 6, 7, 9, 10, 11, 12, 13,14,15,16,17,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35,36,37,38,39,40]
            },
            {
                "searchable": false,
                "targets": [0,2, 3, 4, 6, 7, 9, 10, 11, 12, 13,14,15,16,17   ,19,20, 28,26,  36,40]
            }
           
        ],
        "search": {
            //"regex": true,
            "search": SETOPD,
        },
        oLanguage: {
            sProcessing: "</div><div class=\"overlay\">" +
                "<i class=\"fa fa-refresh fa-spin\"></i>" +
                "</div>"
        },
        "processing": true,
        "serverSide": true,
        loadingRecords: '&nbsp;',
        "ajax": $.fn.dataTable.pipeline({
            type: 'POST',
            url: 'simda/json',
            pages: 5 // number of pages to cache
        }),
        columns: [
            {
                "class": "details-control",
                "orderable":false,
                "data":null,
                "defaultContent": ""
            },
            {
                "data": "id",
                "orderable": false,
                "title": "#ID"
            },
            {
                "data": "COL1",
                "title": "TA"
            },
            {
                "data": "COL2"
            }, {
                "data": "COL3"
            }, {
                "data": "COL4"
            },
            {
                /// NOMOR REKENING PEKERJAAN SIMDA
                "data": "REKENING",
                "title": "Rekening"
            },
            {
                "data": "COL6"
            }, {
                "data": "COL7"
            }, {
                "data": "COL8"
            }, {
                "data": "COL9"
            }, {
                "data": "COL10"
            }, {
                "data": "COL11"
            }, {
                "data": "COL12"
            }, {
                "data": "COL13"
            }, {
                "data": "COL14"
            }, {
                "data": "KODE_DINAS"
            }, {
                "data": "COL16"
            }, {
                "data": "COL17"
            }, {
                "data": "COL18"
            }, {
                "data": "COL19"
            }, {
                "data": "COL20"
            }, {
                "data": "COL21"
            }, {
                "data": "COL22"
            }, {
                "data": "COL23"
            }, {
                "data": "COL24"
            }, {
                "data": "COL25"
            }, {
                "data": "COL26"
            }, {
                "data": "COL27"
            }, {
                "data": "COL28"
            }, {
                "data": "COL29"
            }, {
                "data": "COL30"
            }, {
                "data": "COL31"
            }, {
                "data": "COL32"
            }, {
                "data": "COL33"
            }, {
                "data": "COL34"
            }, {
                "data": "COL35"
            }, {
                "data": "COL36"
            }, {
                "data": "COL37"
            }, {
                "data": "COL38"
            }, {
                "data": "COL39"
            }, {
                "data": "COL40"
            },
            {
                "data": "action",
                "orderable": false,
                "className": "text-center"
            }
        ],
        order: [
            [0, 'desc']
        ],
        rowCallback: function(row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            var index = page * length + (iDisplayIndex + 1);
            $('td:eq(0)', row).html(index);
            $("#overlay").hide();
       /*
            var api = this.api();
            var rows = api.rows( {page:'current'} ).nodes();
            var last=null;
 
            api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {
                if ( last !== group ) {
                    $(rows).eq( i ).before(
                        '<tr class="group"><td colspan="5">'+group+'</td></tr>'
                    );
 
                    last = group;
                }
            } );
        */
        }
    });

/*
     // Order by the grouping
     $('#mytable tbody').on( 'click', 'tr.group', function () {
        var currentOrder = dt.order()[0];
        if ( currentOrder[0] === groupColumn && currentOrder[1] === 'asc' ) {
            dt.order( [ groupColumn, 'desc' ] ).draw();
        }
        else {
            dt.order( [ groupColumn, 'asc' ] ).draw();
        }
    } );
*/
    // Array to track the ids of the details displayed rows
    var detailRows = [];

    $('#mytable tbody').on('click', 'tr td.details-control', function() {
        var tr = $(this).closest('tr');
        var row = dt.row(tr);
        var idx = $.inArray(tr.attr('id'), detailRows);

        if (row.child.isShown()) {
            tr.removeClass('details');
            row.child.hide();

            // Remove from the 'open' array
            detailRows.splice(idx, 1);
        } else {
            tr.addClass('details');
            row.child(format(row.data())).show();

            // Add to the 'open' array
            if (idx === -1) {
                detailRows.push(tr.attr('id'));
            }
        }
    });

    // On each draw, loop over the `detailRows` array and show any child rows
    dt.on('draw', function() {
        $.each(detailRows, function(i, id) {
            $('#' + id + ' td.details-control').trigger('click');
            $('details').att
        });
    });



});
</script>

<script type="text/javascript">
// CODE HERE
</script>
<!-- custom js m_opd-->





<?php
/* End of file simda/custom_js.php */
/* Location: ./application/view/simda/custom_js.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-18 21:02:06 */
/* http://harviacode.com */

/*============================================================================*/
/* Modify by Meedun 2020 */
/* version 1.4a */
/* Generated 18 Jan 2020 */
/*Template name : template/AdminLTE */
/*============================================================================*/
?>