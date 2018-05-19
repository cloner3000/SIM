

<div id="table-wrapper" class="col-xs-12">
    <div class="box">
        <div class="box-header">
         
          <button class="btn btn-primary btn-flat pull-right" data-toggle="tooltip" onclick="addPerbaikan();"><i class="fa fa-plus" id="add"></i> Tambah Perbaikan</button>
          <a href="<?php echo base_url('Admin/Excel/export_excel') ?>" class="btn btn-warning btn-flat pull-right" data-toggle="tooltip" ><i class="fa fa-download " ></i> Export Data</a>
        </div>
        <!-- /.box-header 3998ad -->
        <div class="box-body table-responsive">
            <table class="table table1 table-bordered table-striped">
                <thead>
                    <tr style="background:  #551E1E; color: white; text-align: center;">
                      
                        <th width="5%">No</th>
                        <th width="20%">Nama Aset</th>
                        <th>Tipe Aset</th>
                        <th>Tanggal Perbaikan</th>
                        <th>Tanggal Selesai</th>
                        <th>Status</th>
                         <th>Lokasi</th>
                         <th style="text-align: center; width: 10%">Aksi</th>

                    </tr>
                </thead>
                <tbody>
                 <?php $i=1; ?>
                 <?php foreach ($listPerbaikan->result() as $row): ?>
                    <tr>
                       <td><?php echo $i; $i++; ?></td>
                        <td><?php echo $row->nama_aset; ?></td>
                        <td><?php echo $row->tipe_aset; ?></td>
                        <td><?php echo $row->tgl_perbaikan; ?></td>
                        <td><?php echo  $row->tgl_selesai; ?></td>
                         <td style="text-align: center;"> <a class="btn btn-warning btn-flat btn-xs "><?php echo  $row->status; ?></a></td>
                        <td style="text-align: center;">
                                <button onclick="lokasiAset(<?php echo $row->aset_id; ?>);" class="btn btn-info btn-flat" type="button" data-toggle="tooltip">
                                <i class="fa fa-search"></i></button>
                        </td>
                        <td style=" width: 100px;text-align: center;">
                            <div class="btn-group">
                                <button onclick="deleteAset(<?php echo $row->aset_id; ?>);" class="btn btn-success btn-flat" data-toggle="tooltip" title="Perbaikan selesai">
                                <i class="fa fa-check"></i></button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                       <th>No</th>
                       <th>Nama Aset</th>
                        <th>Tipe Aset</th>
                        <th>Tanggal Perbaikan</th>
                        <th>Tanggal Selesai</th>
                        <th>Status</th>
                         <th>Lokasi</th>
                         <th style="width: 100px">Aksi</th>
                    </tr>
                </tfoot>
            </table>
        </div>
    <!-- /.box-body -->
     </div>
    <!-- /.box -->
</div><!-- .col -->

<!-- modal tambah perbaikan -->
<div id="modalTambahPerbaikan" class="modal fade"  role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Tambah  Perbaikan</h4>
         </div>
         <div class="modal-body">
             <div class="form-group">
                <label>Aset</label>
                <select name="asetPerbaikan" class="form-control select2" style="width: 100%;" id="selectaset" onChange="selectaset()">
                  <?php
                  foreach ($aset->result() as $option): ?>
                    <option value="<?php echo $option->id_aset; ?>" > <?php echo $option->nama; ?></option>    
                  <?php endforeach; ?>
                </select>
              </div>
              <div id="detailAset">
          
             </div>
         </div>
         <div class="modal-footer">
            <div class="btn-group">
               <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Tidak</button>
               <button id="btn-tambah-perbaikan" data-dismiss="modal" class="btn btn-success btn-flat">tambah</button>
            </div>
         </div>
      </div>
   </div>
</div>

 <!-- modal konfirmasi hapus -->
<div id="modalDelete-aset" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Hapus Aset</h4>
         </div>
         <div class="modal-body">
             Apakah anda ingin menghapus Aset ini?
         </div>
         <div class="modal-footer">
            <div class="btn-group">
               <button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Tidak</button>
               <button id="btn-delete-aset" type="button" class="btn btn-danger btn-flat">Ya</button>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- modal lihat lokasi dan ubah lokasi -->
<div id="modalLokasi-aset" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static" data-keyboard="false">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header"  style="text-align: center;">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Lokasi Aset</h4>
         </div>

         <div class="modal-body">
             <div class="form-group">
                <form role="form" method="post" action="" id="lokasi-awal">
                  <label>Kampus </label>
                    <div class="form-group">
                      <input name="curr_kampus" id="curr_kampus" type="text" class="form-control "  disabled> 
                    </div>
                  <label>Fakultas </label>
                    <div class="form-group">
                      <input name="curr_fakultas" id="curr_fakultas" type="text" class="form-control "  disabled> 
                    </div>
                  <label>Jurusan </label>
                    <div class="form-group">
                      <input name="curr_jurusan" id="curr_jurusan" type="text" class="form-control "  disabled> 
                  </div>
                  <label>Lokasi </label>
                    <div class="form-group">
                      <input name="curr_lokasi" id="curr_lokasi" type="text" class="form-control "  disabled>
                  </div>
                </form>
              </div>
         </div>
         <div class="modal-footer">
            <div class="btn-group">
               <button type="button" id="btn-cancel" class="btn btn-default btn-flat" data-dismiss="modal">Tutup</button>
            </div>
         </div>
         <div class="modal-header" >
        

      </div>
   </div>
</div>

<!--modal warning menu!-->
<div id="modalWarning-user" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Gagal Menambahkan Data</h4>
         </div>
         <div class="modal-body">
            Nama Aset Kosong !!!
         </div>
         <div class="modal-footer">
          <div class="btn-group">
            <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">tutup</button>
          </div>
        </div>
      </div>
   </div>
</div>


<script type="text/javascript">
    $(function () {
    //Initialize Select2 Elements
    $(".select2").select2();

    
  });
    
     $('#modalWarning-user').appendTo('body');

    function addPerbaikan() {
        
        $('#modalTambahPerbaikan').modal();

    }

  $('#btn-tambah-perbaikan').one('click',function(event) {
           $('#preloader').css('display','block');
            
            var id_aset = document.getElementById("selectaset").value;
          
           
            $.post(base_url+"Admin/Perbaikan/create/", {id_aset: id_aset }, function(data) {
                $('#preloader').css('display','none');
                $('#main-content').html(data);
                dataTable();
                //console.log(data);
            }); 
            
        });

    




     function lokasiAset(id) {
      
            $('#edit_id').val(id);
            $('#modalLokasi-aset').modal();
            $.get(base_url+"Admin/Aset/currLokasi/"+id, function(lokasi) {
            var lokasi=jQuery.parseJSON(lokasi+"");
              $('#curr_kampus').val(lokasi.nama_kampus);
              $('#curr_fakultas').val(lokasi.nama_fakultas);
              $('#curr_jurusan').val(lokasi.nama_jurusan);
              $('#curr_lokasi').val(lokasi.nama_lokasi);
                $('#btn-ubah-lokasi-aset').click(function(event) {
                        $('#ubah-lokasi').css('display','block');

                        
                        
                }); 
              
              
              //console.log(lokasi.nama);
            });


    }


   
    
   


   $(document).on('click', '#btn-cancel', function(event) {
        event.preventDefault();
        $('#btn-add').removeClass('disabled');  
        // $('#editor-wrapper').css('display', 'none');
        // $('#editor-wrapper2').css('display', 'none');
        $("#editor-wrapper").hide('slow');
        $("#editor-wrapper2").hide('slow');
        $('#ubah-lokasi').css('display','none');
        $('#ubah-lokasi').trigger("reset");
        
    });





  function selectaset()
     {
       aset_id = document.getElementById("selectaset").value;
       

      //alert("<?php echo base_url();?>Admin/Lokasi/select_jurusan/"+fakultas_id+"");
       $.ajax({
         url:"<?php echo base_url();?>Admin/Aset/select_aset/"+aset_id+"",
         success: function(response){
         $("#detailAset").html(response);
         },
         dataType:"html"
       });

       return false;
     }

 
</script>