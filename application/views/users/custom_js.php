
    <!-- custom js '. users .'-->
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
                    sProcessing: "loading..."
                },
                processing: true,
                serverSide: true,
                ajax: {"url": "users/json", "type": "POST"},
                columns: [
                    {
                        "data": "id",
                        "orderable": false
                    },{"data": "ip_address"},{"data": "username"},{"data": "password"},{"data": "email"},{"data": "activation_selector"},{"data": "activation_code"},{"data": "forgotten_password_selector"},{"data": "forgotten_password_code"},{"data": "forgotten_password_time"},{"data": "remember_selector"},{"data": "remember_code"},{"data": "created_on"},{"data": "last_login"},{"data": "active"},{"data": "first_name"},{"data": "last_name"},{"data": "company"},{"data": "phone"},
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
/* End of file users/custom_js.php */
/* Location: ./application/view/users/custom_js.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-15 21:27:31 */
/* http://harviacode.com */

/*============================================================================*/
/* Modify by Meedun 2020 */
/* version 1.4a */
/* Generated 15 Jan 2020 */
/*Template name : template/AdminLTE */
/*============================================================================*/
?>
