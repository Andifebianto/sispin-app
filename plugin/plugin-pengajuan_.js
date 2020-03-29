var request_flag = 0;
$('table #get_acc').each(function(){
	$(this).click(function(){
		if( $(this).attr('id') == 'get_acc' ){
			if(request_flag != 1){
				request_flag = 1;
				var id_pengajuan = $(this).attr('alt');
				var btn = $(this); // tombol ini

				ajax_ubah_status(btn, id_pengajuan, function(result){
					var data = JSON.parse(result);
					if(data.result){
						btn.removeClass('btn-warning');
						btn.removeAttr('id');
						btn.addClass('btn-success');
						btn.html('<i class="fa fa-check"></i> Sudah Acc');
						request_flag = 0;
					}else{
						request_flag = 0;
						btn.html("<i class='fa fa-spinner'></i> Beri Acc");
						alert('Server bermasalah, silahkan ulangi lagi.');
					}
				});
				// batas kondisi jika flag == 0
			}
		}
		
	});
});