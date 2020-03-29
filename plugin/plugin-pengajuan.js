
(function(){
	$('#datepicker').datepicker({
      format:'dd-mm-yyyy',
      autoclose:true
    });
	$('#datepicker2').datepicker({
      format:'dd-mm-yyyy',
      autoclose:true
    });
    $('.select2').select2();
    $('.tgl-2').change(function(){
    		var today = $('.tgl-1').val(),
    		booking = $('.tgl-2').val();
    		if(today == booking){
    			$('#jangka_waktu').val('Hari ini');
    		}else{
    			ajaxRequest(function( result ){
        			console.log(result);
        			$('#jangka_waktu').val(''+result);
        		});
    		}
    });
})();