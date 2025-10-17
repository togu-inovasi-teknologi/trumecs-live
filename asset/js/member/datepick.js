var dateToday = new Date();
$('#datepick')
.datepicker({
	format: 'dd/mm/yyyy',
	autoclose: true,
	endDate: '0d',
})
.on('changeDate', function(e) {}); 
