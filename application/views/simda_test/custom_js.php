
    <!-- custom js '. simda_test .'-->
    <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
    <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
    <script type="text/javascript">
        $(document).ready(function() {
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

            var t = $("#mytable").dataTable({
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
                oLanguage: {
                    //sProcessing: "loading..."
                    sProcessing: "</div><div class='overlay'>" +
                                        "<i class='fa fa-refresh fa-spin'></i>" +
                                    "</div>"
                },
                processing: true,
                serverSide: true,
                ajax: {"url": "simda_test/json", "type": "POST"},
                columns: [
                    {
                        "data": "id",
                        "orderable": false
                    },{"data": "COL1"},{"data": "COL2"},{"data": "COL3"},{"data": "COL4"},{"data": "COL5"},{"data": "COL6"},{"data": "COL7"},{"data": "COL8"},{"data": "COL9"},{"data": "COL10"},{"data": "COL11"},{"data": "COL12"},{"data": "COL13"},{"data": "COL14"},{"data": "COL15"},{"data": "COL16"},{"data": "COL17"},{"data": "COL18"},{"data": "COL19"},{"data": "COL20"},{"data": "COL21"},{"data": "COL22"},{"data": "COL23"},{"data": "COL24"},{"data": "COL25"},{"data": "COL26"},{"data": "COL27"},{"data": "COL28"},{"data": "COL29"},{"data": "COL30"},{"data": "COL31"},{"data": "COL32"},{"data": "COL33"},{"data": "COL34"},{"data": "COL35"},{"data": "COL36"},{"data": "COL37"},{"data": "COL38"},{"data": "COL39"},{"data": "COL40"},{"data": "tglDPA"},{"data": "noDPA"},
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
/* Generated by Harviacode Codeigniter CRUD Generator 2020-02-01 04:56:22 */
/* http://harviacode.com */

/*============================================================================*/
/* Modify by Meedun 2020 */
/* version 1.4a */
/* Generated 01 Feb 2020 */
/*Template name : template/AdminLTE */
/*============================================================================*/
?>
