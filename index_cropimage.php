 <div class="box box-primary">	
	<div class="box-body">
	<form></form>
	<div class="col-lg-6">  
	<form role="form" id="uploadForm" method="post" enctype="multipart/form-data">
	<label>Upload Image File:</label><br/>
	<input name="userImage" id="userImage" type="file" class="form-control"  required accept="image/*" />
	<input name="RefId" id="RefId" type="hidden" value="<?= $RefId_primo ?>" />
	<br>
	  <div class="form-group pull-right">
		<input type="submit" value="Submit" class="btn btn-primary" />
	  </div>	
	</form>
	</div>
	 </div>
</div>


<?php if(empty($getFilePath)): ?>
          <div class="box box-primary">
            <div class="box-header with-border">
                <h3></h3>
                <?php
					
					function Get_ImagesToFolder($dir){
						$ImagesArray = [];
						$file_display = [ 'jpg', 'jpeg', 'png', 'gif' ];

						if (file_exists($dir) == false) {
							return ["Directory \'', $dir, '\' not found!"];
						} 
						else {
							$dir_contents = scandir($dir);
							foreach ($dir_contents as $file) {
								$file_type = pathinfo($file, PATHINFO_EXTENSION);
								if (in_array($file_type, $file_display) == true) {
									$ImagesArray[] = $file;
								}
							}
							return $ImagesArray;
						}
					}
						
					
					 $path_dir = $_SERVER['DOCUMENT_ROOT']."\\".$ProjectName."\\uploadfiles\\".$RefId_primo."\\images\\";						
					$Images = Get_ImagesToFolder($path_dir);
			
					
						

                ?>
                <table class="display table table-bordered table-striped">
                    <thead>
                          <tr>
							<th width="50%" ></th>
							<th>FileName</th>
							<th>Action</th>
					
                          </tr>
                    </thead>
                    <tbody>
                          <?php foreach($Images as $image): ?>
               
                              <tr>		
								<td><img src="<?= "uploadfiles/".$RefId_primo."/images/".$image ?>" alt="image" style="width:10%"></td>
                                <td><?= $image ?></td>
                                <td>
                                  <a href="<?= "uploadfiles\\".$RefId_primo."\\".$image ?>"  download  class="btn btn-success">Download Image</a> 
                                </td>
                                
                                
                              </tr>
 
                          <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
          </div>
          <?php endif; ?>




</div>


<script>
  $(function () {
	$('table.display').DataTable( {} );
	$('#example1').DataTable()
	  $('#example2').DataTable({
		'paging'      : true,
		'lengthChange': false,
		'searching'   : false,
		'ordering'    : true,
		'info'        : true,
		'autoWidth'   : false
	  })
	  $('#example3').DataTable({
		'paging'      : true,
		'lengthChange': false,
		'searching'   : false,
		'ordering'    : true,
		'info'        : true,
		'autoWidth'   : false
	  })
	  $('#example4').DataTable({
		'paging'      : true,
		'lengthChange': false,
		'searching'   : false,
		'ordering'    : true,
		'info'        : true,
		'autoWidth'   : false
	  })
  })
</script>



<script type="text/javascript">
$(document).ready(function (e){
$("#uploadForm").on('submit',(function(e){
e.preventDefault();
		$.ajax({
		url: 'Controller/uploadimage.php',
		type: "POST",
		data:  new FormData(this),
		contentType: false,
		cache: false,
		processData:false,
		beforeSend:function(){

				
		},
		success: function(data){
	
			
					swal({
						type:'success',
						title:"Uploaded!",
						text:""
					}).then(function(){
							
						location.reload();
					});	
		
		},
		error: function(){} 	        
		
		
		});
}));
});
</script>