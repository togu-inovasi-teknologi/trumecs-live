 <div class="row historypesanan">
     <div class="col-md-12">
         <strong class="f22">Kelola Tender</strong>
         <hr />
     </div>
     <div class="col-md-12 table-responsive">
         <table class="table table-hover tbl-claim">
             <thead>
                 <tr>
                     <th>Perusahaan</th>
                     <th>PIC</th>
                     <th>Dibuat</th>
                     <th>Batas Akhir</th>
                     <th>Status</th>
                 </tr>
             </thead>
             <tbody>
                 <?php foreach ($tender->result() as $key => $item) : ?>
                     <tr>
                         <td><?php echo $item->company ?></td>
                         <td><?php echo $item->name ?></td>
                         <td><?php echo $item->created ?></td>
                         <td><?php echo $item->due_date ?></td>
                         <td><?php echo $item->status == '0' ? '<span class="label label-default" style="font-weight:normal">Menunggu</span>' : '<span class="label label-success" style="font-weight:normal">Diterima</span>' ?></td>
                     </tr>
                 <?php endforeach; ?>
             </tbody>
             <tfoot>
                 <tr>
                     <th>Perusahaan</th>
                     <th>PIC</th>
                     <th>Dibuat</th>
                     <th>Batas Akhir</th>
                     <th>Status</th>
                 </tr>
             </tfoot>
         </table>
     </div>
 </div>