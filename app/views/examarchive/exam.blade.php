@extends('layouts.exam_endless')

@section('breadC')
	<li class="active">คลังข้อสอบ</li>	 	 
@stop

@section('main')
<div class="panel panel-default">
	<div class="panel-heading">
		<span class="label label-info pull-right">{{ sizeof($questions) }} Items</span>
		<h2>คลังข้อสอบ</h2>
		<p>{{ link_to(route('archive',array("exid"=>$oldexid)), 'Back') }}</p>
		<p>
			<button type="button" id="sendex" class="btn btn-success">Complete</button>
			<a href="#sectionModal" role="button" data-toggle="modal" class="btn btn-success">สร้างตอน</a>		
		</p>
		<p>เลือกตอน
			<div id="section">

			</div>
		</p>
	</div>


@if ($questions)
	<div class="panel panel-default table-responsive">

		<div class="padding-md clearfix">
			<div class="padding-md">
			<div class="row">
				<label class="col-lg-1 control-label">ข้อสอบ</label>
				<div class="col-lg-2">
					<select name="column_filter" class="form-control" data-column="1" id="col1_filter">
						<option value="">ทั้งหมด</option>
						@foreach ($exams as $exam)
							<option value="{{ $exam->subject }}">{{ $exam->subject }}</option>
						@endforeach
					</select>
				</div>

				<label class="col-lg-1 control-label">ปีการศึกษา</label>
				<div class="col-lg-2">
					<select name="column_filter" class="form-control" data-column="3" id="col3_filter">
						<option value="">ทั้งหมด</option>
						@foreach ($acyears as $acyear)
							<option value="{{ $acyear->acyear }}">{{ $acyear->acyear }}</option>
						@endforeach
					</select>
				</div>

				<label class="col-lg-1 control-label">สอบ</label>
				<div class="col-lg-2">
					<select name="column_filter" class="form-control" data-column="5" id="col5_filter">
						<option value="">ทั้งหมด</option>
						<option value="1">กลางภาค</option>
						<option value="2">ปลายภาค</option>
					</select>
				</div>

				<label class="col-lg-1 control-label">โจทย์</label>
				<div class="col-lg-2">
					<select name="column_filter" class="form-control" data-column="6" id="col6_filter">
						<option value="">ทั้งหมด</option>
						<option value="c">ข้อช้อย</option>
						<option value="w">ข้อเขียน</option>
					</select>
				</div>
			</div>
			<div class="row">
				<label class="col-lg-1 control-label">ระดับ</label>
				<div class="col-lg-2">
					<select name="column_filter" class="form-control" data-column="7" id="col7_filter">
						<option value="">ทั้งหมด</option>
						<option value="1">1</option>
						<option value="2">2</option>
						<option value="3">3</option>
						<option value="4">4</option>
						<option value="5">5</option>
					</select>
				</div>
			</div>
			</div>
				<table class="table table-striped dataTable" id="dataTable" aria-describedby="dataTable_info">
					<thead>
						<tr role="row">

							<th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width:20px; vertical-align:middle;">

							</th>
							<th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width:20px; vertical-align:middle; display:none;"></th>
							
							<th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="width:500px;">
								คำถาม
							</th>
							<th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" >
								ปีการศึกษา
							</th>
							<th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" >
								ภาคเรียน
							</th>
							<th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="display:none;"></th>

							<th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" >
								ชนิดโจทย์
							</th>
							<th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" >
								ระดับ
							</th>
							<th class="ui-state-default" role="columnheader" tabindex="0" aria-controls="dataTable" rowspan="1" colspan="1" style="vertical-align:middle;"></th>
						</tr>
					</thead>

					<tbody role="alert" aria-live="polite" aria-relevant="all">
						@foreach ($questions as $question)
							<tr class="odd">
								<td style="vertical-align:middle;">
									<label class="label-checkbox">
										<input type="checkbox" name="choose[]" value="{{ $question->qid }}" class="chk-row" />
										<span class="custom-checkbox"></span>
									</label>
								</td>
								<td style="vertical-align:middle; display:none;">{{ $question->subject }}</td>
								<td style="vertical-align:middle;">{{ $question->question }}</td>
								<td style="vertical-align:middle;">{{ $question->acyear }}</td>
								<td style="vertical-align:middle;">{{ $question->term }}</td>
								<td style="vertical-align:middle; display:none;">{{ $question->type }}</td>
								<td style="vertical-align:middle;">{{ $question->qtype }}</td>
								<td style="vertical-align:middle;">{{ $question->level }}</td>
								<td style="vertical-align:middle;">
									<a href="#" class="btn btn-sm btn-success" id="changebc">รายละเอียด</a>
									<!--a href="{{ URL::route('exam',array($question->qid)) }}" class="btn btn-sm btn-success" id="changebc">รายละเอียด</a--> 
								</td>
							</tr>
						@endforeach
						
						</tbody>
						
					</table>
		</div><!-- /.padding-md -->
	</div>
</div>



@else
	There are no members
@endif

{{ Form::open(array('route' => array('section-storem'), 'id' => 'formsection')) }}
        <div class="modal fade" id="sectionModal">
        
  			<div class="modal-dialog">
    			<div class="modal-content">
      				<div class="modal-header">
        				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4>Add Section</h4>
      				</div>
				    <div class="modal-body">

							<div class="form-group">
								<label>ชื่อตอน</label>
								<input name="name" type="text" class="form-control input-sm" placeholder="">
								<input type="hidden" name="_method" value="POST">
							</div><!-- /form-group -->
							
				    </div>
				    <div class="modal-footer">
				        <button class="btn btn-success btn-sm" data-dismiss="modal" aria-hidden="true">Close</button>
						{{ Form::submit('Submit', array('class' => 'btn btn-danger btn-sm', 'id' => 'sec')) }}
				    </div>
			  	</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- /.modal -->
{{ Form::close() }}

<script>
/*----------------------------- dataTable -----------------------------*/
function filterGlobal () {
    $('#dataTable').DataTable().search(
        $('#global_filter').val(),
        $('#global_regex').prop('checked'),
        $('#global_smart').prop('checked')
    ).draw();
}
 
function filterColumn ( i ) {
    $('#dataTable').DataTable().column( i ).search(
        $('#col'+i+'_filter').val()
    ).draw();
}
 
$(document).ready(function() {
	/*----------------------------- Select -----------------------------*/
	var selectsec = false;
	var secid = '';
	var objarr = [];

    $('input[name="choose[]"]').on('change', function(){
    	if(selectsec){
    		/*
	    	var values = new Array();
	    	var currarr = [];
	    	$("input[name='choose[]']:checked").each(function() {

				values.push($(this).val());
				currarr.push({
			  		qid: $(this).val(),
			  		secid: secid
			  	});

			});*/
    		var qid = $(this).val();
    		var same = false;
    		var delindex = '';
			$.each(objarr, function(index, value){
				if(qid == value['qid']){
					delindex = index;
					same = true;
				}
			});
			if(!same){
				objarr.push({
		    		qid: $(this).val(),
		    		secid: secid
		    	});
			}else{
				objarr.splice(delindex,1);
			}
	    	
	    	console.log(objarr);

	    	
	    }else{
	    	alert('Select section, Please');
	    	$(this).prop('checked', false);
	    }

    });

    /*----------------------------- DataTable -----------------------------*/
    $('#dataTable').dataTable();
 
    $('input.global_filter').on( 'keyup click', function () {
        filterGlobal();
    } );
 
    $('select[name="column_filter"]').on( 'change', function () {
    	console.log($(this).attr('data-column'));
        filterColumn( $(this).attr('data-column') );
    } );

	/*
    $('input[name="choose[]"]').on('change', function(){
    	//alert('555');
    	console.log($(this).val());
    });
	*/



/*----------------------------- Show Section -----------------------------*/
	var sec = "";
	@foreach ($sections as $section)
		sec += '<button type="button" id="btnsec" value="{{$section->secid}}" class="btn btn-danger tooltip-test" data-toggle="tooltip" data-placement="top" title="" data-original-title="{{ $section->name }}">ตอนที่ {{$section->number}}</button>';

	@endforeach

	$("div#section").html(sec);

/*----------------------------- Add Section -----------------------------*/

	$("#formsection").submit(function(e){

		e.preventDefault();

		var $form = $(this),
		   term = $form.find("input[name='name']").val(),
		   url = $form.attr("action");

		var posting = $.post(url,{
			name: term,
			exid: '{{$oldexid}}'
		});

		posting.done(function(data){

			var section = '';
				$.each(data, function(index, value){
					console.log(value['number']);
					section += '<button type="button" class="btn btn-danger tooltip-test" data-toggle="tooltip" data-placement="top" title="" data-original-title="'+value['name']+'">ตอนที่ '+value['number']+'</button>';
				});
				$("div#section").html(section);

			$("#sectionModal").modal('hide');

			document.getElementById("formsection").reset();
			console.log(section);

		});
	});

/*----------------------------- Check Button -----------------------------*/
	$('button#btnsec').on('click', function(){
		$(this).prop('disabled', true);
		$('button#btnsec').not(this).prop('disabled', false);
		selectsec = true;
		secid = $(this).attr('value');
		console.log('secid: '+secid);
	});

/*----------------------------- Send Exam -----------------------------*/

	$('button#sendex').on('click', function(e){
		
		e.preventDefault();

		var url = '{{route("duplicate")}}';
/*
		var posting = $.post(url,
			[{

				exid: '{{$oldexid}}'
			}]
			);
*/
		//objarr = JSON.stringify(objarr);
		var posting = $.post(url, {
			exid: '{{ $oldexid }}',
			data: objarr
		});
		posting.done(function(data){
			console.log(data);
			window.location.href = "{{ url('section/'.$oldexid.'/') }}";
		});
		posting.fail(function(){
			alert('fail');
		});
	});
});





	</script>
@stop

