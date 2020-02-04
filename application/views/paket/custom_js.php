
    <!-- custom js '. paket .'-->
    <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
    <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
   
<?php 
//// daatkan bidang user
    $bidang = $this->session->userdata('userBidang');
    $user_id = $this->session->userdata('user_id');
    //print_r($bidang[0]->name);
    $user_groups = $this->ion_auth->get_users_groups($user_id)->result();
    print_r($user_groups[0]);
    $userBidang = $user_groups[0];
    $get_bidang = $this->input->get('bidang');
        if($get_bidang !=''){
              if(!$this->ion_auth->is_admin()){
                  $json_url = 'paket/json/'.$userBidang->id;
              }else{
                  $json_url = 'paket/json/'.$get_bidang;
              }
          }else{
                $json_url = 'paket/json';
          }
?>
 <script type="text/javascript">
$(document).ready(function() {
///// DATE datepicker-year untuk form 
$('.datepicker-year').datepicker( {
                //changeDate:  false,
                //changeMonth: false,
                //chumShowDay: false, 
                //sebelumShowMonth: false, 
                //beforeShowYear: true,
                //showButtonPanel: true,
                //toggleActive:true,
                //todayHighlight:true,
                
                /*defaultViewDate:'year',
                todayBtn:true,
                //defaultViewDate:'today',
                orientation: 'top',
                format: 'yyyy',
                onClose: function(dateText, inst) { 
                    var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                    var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                    $(this).datepicker('setDate', new Date(year,'01','01'));
                }*/
                orientation: 'bottom',
                format: "yyyy",
                viewMode: "years", 
                minViewMode: "years",
                todayHighlight:true,
                todayBtn:true,
            });
////////////////////////////////////////////////////////////////////////////////////////////////////////
function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
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
                ajax: {"url": "<?= $json_url ?>", "type": "POST"},
                columns: [
                    {
                        "data": "kdPaket",
                        "orderable": false
                    },
                    {"data": "nmPaket"},
                    {
                        "data": function (params) {
                          if(params['pagu']!=null){
                            return numberWithCommas(params['pagu'])
                          }else{
                            return 0;
                          }
                          
                        },
                        "className" : "text-right"
                    },
                    {"data": "tahun"},{"data": "bidang"},
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


///////////////////////////////////////

// panggil data simda
<?php
//echo $this->uri->segment(3);
$this->db->select('kdpekerjaan, tbpaket.nmPaket as paket, COL30 as name, COL40 as pagu ');
$this->db->join('tbpaket','tbpaket.kdPaket=paket_detail.kdPaket');
$this->db->join('simda','simda.id=paket_detail.kdpekerjaan');
$getIDPekerjaan = $this->db->get_where('paket_detail', ['paket_detail.kdpaket' => $this->uri->segment(3)]);
$pek = $getIDPekerjaan->result_array();
//print_r($getIDPekerjaan->result_array());
?>
 //// seting format select2 SIMDA    
function formatSimda (repo) {
  if (repo.loading) {
    return repo.text;
  }

  var $container = $(
    "<div class='select2-result-repository clearfix'>" +
      "<div class='select2-result-repository__meta'>" +
        "<div class='select2-result-repository__dinas'><i class='fa fa-home'></i> </div>" +
        "<div class='select2-result-repository__pekerjaan'></div>" +
        "<div class='col-md-6'>"+
        "<b>Info Pekerjaan : </b>" +
        "<div class='select2-result-repository__program'></div>" +
        "<div class='select2-result-repository__kegiatan'></div>" +
        "<div class='select2-result-repository__pagu'></div>" +
        "</div>"+
        "<div class='col-md-6'>"+
        "<div class='select2-result-repository__statistics'>" +
        "<div class='select2-result-repository__belanja'><i class='fa fa-shopping-cart'></i> </div>" +
                "<div class='select2-result-repository__belanja_dua'><i class='fa fa-shopping-cart'></i> </div>" +
                "<div class='select2-result-repository__belanja_tiga'><i class='fa fa-shopping-cart'></i> </div>" +
                "<div class='select2-result-repository__belanja_empat'><i class='fa fa-shopping-cart'></i> </div>" +
                "<div class='select2-result-repository__belanja_lima'><i class='fa fa-shopping-cart'></i> </div>" +
        "</div>" +
        "</div>" +
      "</div>" +
    "</div>"  +
    "<hr>"

  );

  $container.find(".select2-result-repository__program").append('<b>Program  : </b> <b class="text-success">'+ repo.COL23+'</b> - <b class="text-success">'+repo.COL24+'</b>');
  $container.find(".select2-result-repository__kegiatan").append('<b>Kegiatan  : </b> <b class="text-success"> '+repo.COL23+'.'+ repo.COL25+ '</b>  - <b class="text-success">'+ repo.COL26+'</b>');
  $container.find(".select2-result-repository__pekerjaan").append('<b>Pekerjaan : <br><hr></b> <b style="font-size:2em;">'+repo.COL23+'.'+ repo.COL25+ '.  '+repo.COL5+'.'+repo.COL7 + '.' +repo.COL9 +'.'+repo.COL11 +'.' +repo.COL13 +' - '+ repo.COL30+'</b><hr>');
  $container.find(".select2-result-repository__pagu").append('<b>Pagu  : </b> <b class="text-danger">'+repo.COL40+' TA '+repo.COL1 +'</b>');
  $container.find(".select2-result-repository__belanja").append('<b>'+ repo.COL7 + '</b> - '+repo.COL6);
  $container.find(".select2-result-repository__belanja_dua").append('<b>'+repo.COL5+'.'+repo.COL7 + '</b> - ' +repo.COL8);
  $container.find(".select2-result-repository__belanja_tiga").append('<b>'+repo.COL5+'.'+repo.COL7 + '.' +repo.COL9 +'</b> - ' +repo.COL10 );
  $container.find(".select2-result-repository__belanja_empat").append('<b>'+repo.COL5+'.'+repo.COL7 + '.' +repo.COL9 +'.'+repo.COL11 +'</b> - ' +repo.COL12);
  $container.find(".select2-result-repository__belanja_lima").append('<b>'+repo.COL5+'.'+repo.COL7 + '.' +repo.COL9 +'.'+repo.COL11 +'.' +repo.COL13 +'</b> - ' +repo.COL14);
  $container.find(".select2-result-repository__dinas").append('<b class="text-default">'+repo.COL20+'</b>');

  return $container;
}

function formatSimdaSelection (repo) {
  <?php
  echo '
    //var repo = '.json_encode($pek).';
    ';
    ?>
/*
  var drop2html = '';
  var value = '';
    $('#kdPekerjaan option:selected').each(function(){
        //drop2html += '<option value="' + $(this).val() + '">' + $(this).text() + '</option>';
        drop2html +='<li class="select2-selection__choice" title="' + $(this).text() + '">'+
            '<span class="select2-selection__choice__remove" role="presentation">×</span>' + $(this).text() + 
        '</li>';
        value = $(this).text();
    });
    var isi = $('#result,  .select2-selection__choice').replaceWith(drop2html);
    */
    return repo.pekerjaan || repo.COL30 ;
   console.log(repo.pekerjaan);
   //console.log(value);

}

            


            /*
            $('.js-data-example-ajax').select2({
            ajax: {
                url: 'https://api.github.com/search/repositories',
                dataType: 'json'
                // Additional AJAX parameters go here; see the end of this chapter for the full code of this example
            }
            });
            */
///// CONTOH AJAX SELECT 2
///// https://select2.org/data-sources/ajax
/////
/*
            $(".js-data-example-ajaxs").select2({
            ajax: {
                url: "https://api.github.com/search/repositories",
                dataType: 'json',
                delay: 250,
                data: function (params) {
                return {
                    q: params.term, // search term
                    page: params.page
                };
                },
                processResults: function (data, params) {
                // parse the results into the format expected by Select2
                // since we are using custom formatting functions we do not need to
                // alter the remote JSON data, except to indicate that infinite
                // scrolling can be used
                params.page = params.page || 1;

                return {
                    results: data.items,
                    pagination: {
                    more: (params.page * 10) < data.total_count
                    }
                };
                },
                cache: true
            },
            placeholder: 'Search for a repository',
            minimumInputLength: 1,
            templateResult: formatRepo,
            templateSelection: formatRepoSelection
            });
*/




<?php

echo '/*';
print_r($getIDPekerjaan->result_array());
echo '*/';
    echo '
    var pekerjaan = '. json_encode($pek);

$idpek = array();
foreach ($pek as $key) {
  if($key['kdpekerjaan']!=""){
    array_push($idpek, $key['kdpekerjaan']);
  }
}

if(count($idpek)>0){
    echo '
    var idpekerjaan = '. json_encode($idpek).';';
    echo'
    $("#info-paket").show();
    $("#ruasTitle").append(\'<b>Daftar Ruas Paket ini:</b>\');
    for(let i=0;i< pekerjaan.length; i++){
            $("#ruasPekerjaan").append(\'<li>\'+ pekerjaan[i].name +  \' .       <code>Rp. \' + pekerjaan[i].pagu +\'</code></li>\');
    }
    
    '; 


  }else{
    echo '
    var idpekerjaan = "";';
}
    echo '
    var countPekerjaan = "'.count($pek).'";';
?>

// Mengambi ID pekerjaan pakda paket  yang akan di tampilkan pada select
console.log(pekerjaan);
  //var paketSelect = $("#select-test").select2();
  var paketSelect = $(".js-data-simda-ajax").select2();
  if(pekerjaan.length == 0 || pekerjaan.length >= 2 ){
    paketSelect.attr('multiple','multiple');
    paketSelect.attr('name','kdPekerjaan[]');
  }else{
    paketSelect.removeAttr('multiple');
    paketSelect.attr('name','kdPekerjaan');
  }
  console.error('pekerjaan.length '+pekerjaan.length );
  for (let index = 0; index < pekerjaan.length; index++) {
    
    // create the option and append to Select2
    var option = new Option(pekerjaan[index].name,pekerjaan[index].kdpekerjaan, true, true);
    //console.log(option);
    paketSelect.append(option).trigger('change');
    
  }
  var options =[];
  var logs = $('select#kdPekerjaan,ul.select2-selection__rendered option:selected').text(); 
  options.push(logs);
  console.log(options); 
/*
  $('#addBtn').click(function(e){
    e.preventDefault();
    //Get the selected Items in the dropdown 1
    var drop2html = '';
    $('#kdPekerjaan option:selected').each(function(){
        //drop2html += '<option value="' + $(this).val() + '">' + $(this).text() + '</option>';
        drop2html +='<li class="select2-selection__choice" title="' + $(this).text() + '">'+
            '<span class="select2-selection__choice__remove" role="presentation">×</span>' + $(this).text() + 
        '</li>';


    });

    $('#result,  .select2-selection__choice').replaceWith(drop2html);

});
*/





  // Select2 by Ajax
  paketSelect.select2({
              ajax: {
                     // type: 'GET',
                      url: '<?= base_url('simda/cari') ?>',
                      dataType: 'json',
                      delay: 350,
                      data: function (params) {
                      return {
                          q: params.term, // search term
                          page: params.page 
                      };
                      },
                      processResults: function (data, params) {
                      // parse the results into the format expected by Select2
                      // since we are using custom formatting functions we do not need to
                      // alter the remote JSON data, except to indicate that infinite
                      // scrolling can be used
                      params.page = params.page || 1;

                      return {
                          results: data.items,
                          pagination: {
                          more: (params.page * 10) < data.total_count
                          }
                      };
                      },
                      success:function (params) {
                        //console.log(params);
                        $('.select2-selection__choice').append($(this).attr('title'));
                      },
                      cache: true
                  },
                  //multiple:true,
                  placeholder: 'Ketik disini untuk mencari nama "pekerjaan" sesuai data SIMDA ',
                  minimumInputLength: 3,
                  templateResult: formatSimda,
                  templateSelection: formatSimdaSelection,                  
                  }).on('select2:select', function (e) {
                      var data = e.params.data;
                      //console.log(formatSimdaSelection)
                      //console.log(data);
                      //set text to input 
                      $('.select2-setText').text(data.COL30);
                     //jika ada yang sama remove yang ada
                     $.ajax({
                      type: "method",
                      url: "<?= base_url('/paket/cek_paket_detail/')?>"+ data.id,
                      data: "data",
                      dataType: "text",
                      success: function (response) {
                        if(response==1){
                          alert('Pekerjaan \n'+ data.COL30 + '\n sudah terdaftar, silahkan masukan pekerjaan yang lain.');
                          $('li.select2-selection__choice:last').remove();
                        }
                      }
                    });
                      
                  });     
                 // $('select#kdPekerjaan,ul.select2-selection__rendered option:selected').text()           
    });

 


</script>

    <script type="text/javascript">
        // CODE HERE
    </script>
    <!-- custom js m_opd-->
    




<?php
/* End of file tbpaket/custom_js.php */
/* Location: ./application/view/tbpaket/custom_js.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2020-01-19 17:20:41 */
/* http://harviacode.com */

/*============================================================================*/
/* Modify by Meedun 2020 */
/* version 1.4a */
/* Generated 19 Jan 2020 */
/*Template name : template/AdminLTE */
/*============================================================================*/
?>
