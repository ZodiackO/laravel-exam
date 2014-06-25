@extends('layouts.login')

@section('main')

	<script type="text/javascript">
		$(document).ready(function(){

				alert('ggg');
				e.preventDefault();
				var $form = $(this),
				   user = $form.find("input[name='username']").val(),
				   pass = $form.find("input[name='password']").val();
				   //url = $form.attr("action");

				   var posting = $.post('http://www.dedpu.com/exam/service/highscore',{

				   	});

				   	posting.done(function(data){
				   		console.log(data);
	
					});
			
		});
	</script>
@stop
