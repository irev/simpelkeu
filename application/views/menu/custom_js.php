<style>
tr.group,
tr.group:hover {
    background-color: #ddd !important;
}
</style>
    <!-- custom js '. menu .'-->
    <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
    <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var groupColumn = 6;
            $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
            {
                return {
                    "iStart": oSettings._iDisplayStart,
                    "iEnd": oSettings.fnDisplayEnd(),
                    "iLength": oSettings._iDisplayLength,
                    "iTotal": oSettings.fnRecordsTotal(),
                    "iFilteredTotal": oSettings.fnRecordsDisplay(),
                    "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                    "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                };
            };

            var table  = $("#mytable").dataTable({
                "columnDefs": [
                    { "visible": false, "targets": groupColumn }
                ],
                "displayLength": 25,
                "drawCallback": function ( settings ) {
                        var api = this.api();
                        var rows = api.rows( {page:'current'} ).nodes();
                        var last=null;
            
                        api.column(groupColumn, {page:'current'} ).data().each( function ( group, i ) {
                            if ( last !== group ) {
                                $(rows).eq( i ).before(
                                    '<tr class="group"><td colspan="7"><b>'+group+'</b></td></tr>'
                                );
            
                                last = group;
                            }
                        } );
                    },
                initComplete: function() {
                    var api = this.api();
                    $('#mytable_filter input')
                            .off('.DT')
                            .on('keyup.DT', function(e) {
                                if (e.keyCode == 13) {
                                    api.search(this.value).draw();
                        }
                    });
                        $('.activ_1').text('AKTIF');
                        $('.activ_1').addClass('btn-success');
                        $('.activ_0').text('OFF');
                        $('.activ_0').addClass('btn-default');
                },
               // oLanguage: {
               //     sProcessing: "loading..."
               // },
                processing: true,
                serverSide: true,
                ajax: {"url": "menu/json", "type": "POST"},
                columns: [
                    {
                        "data": "id",
                        "orderable": false
                    },{"data": "name"},{"data": "link"},{"data": "icon"},{"data": "is_active"},{"data": "is_parent"},{"data": "group"},
                    {
                        "data" : "action",
                        "orderable": false,
                        "className" : "text-center"
                    }
                ],
                order: [[0, 'desc']],
                rowCallback: function(row, data, iDisplayIndex) {
                    var info = this.fnPagingInfo();
                    var page = info.iPage;
                    var length = info.iLength;
                    var index = page * length + (iDisplayIndex + 1);
                    $('td:eq(0)', row).html(index);   
                }
            });

            $('#mytable tbody').on( 'click', 'tr.group', function () {
                var currentOrder = table.order()[0];
                if ( currentOrder[0] === groupColumn && currentOrder[1] === 'asc' ) {
                    table.order( [ groupColumn, 'desc' ] ).draw();
                }
                else {
                    table.order( [ groupColumn, 'asc' ] ).draw();
                }
            });
        });
    </script>
    

    <script type="text/javascript">
        // CODE HERE
        //$.get('https://raw.githubusercontent.com/FortAwesome/Font-Awesome/fa-4/src/icons.yml', function(data) {
        $.get('<?= base_url()?>assets/font-awesome-4.3.0/icons.yml', function(data) {
        var parsedYaml = jsyaml.load(data);
        var options = new Array();
        $.each(parsedYaml.icons, function(index, icon){
            options.push({
                id: 'fa fa-fw fa-'+icon.id,
                text: '<i class="fa fa-fw fa-' + icon.id + '"></i> ' + icon.id
            });
        });
        
        $('.select-icon').select2({
            data: options,
            escapeMarkup: function(markup) {
                return markup;
            }
        });
        $("#icon").html('<i class="fa fa-2x fa-' + $('.select-icon').val() + '"></i>');
        });

        // Detect any change of option
        $(".select-icon").change(function(){
        var icono = $(this).val();
        $("#icon").html('<i class="fa fa-2x fa-' + icono + '"></i>');
        });
    </script>
    <!-- custom js m_opd-->
    <script>
        $('#is_active').on('change', function(){
        this.value = this.checked ? 1 : 0;
        // alert(this.value);
        }).change();




    </script>




<?php
/* End of file menu/custom_js.php */
/* Location: ./application/view/menu/custom_js.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-16 20:08:23 */
/* http://harviacode.com */

/*============================================================================*/
/* Modify by Meedun 2020 */
/* version 1.4a */
/* Generated 16 Jan 2020 */
/*Template name : template/AdminLTE */
/*============================================================================*/
?>
