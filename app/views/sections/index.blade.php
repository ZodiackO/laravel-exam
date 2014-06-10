@extends('layouts.scaffold')

@section('main')

<h1>All Section Index</h1>

<p>{{ link_to_route('section.create', 'Add new section', array('exid'=>$exam)) }}</p>
คะแนนปัจจุบัน: {{$score}}/{{$totalscore}}
@if ($sections)
<div class="col-md-12">
	<div class="panel-group" id="accordion">

		@foreach ($sections as $section)

			<div class="panel panel-default">
				<div class="panel-heading">
					<h4 class="panel-title">
	
						<table width="1078">
							<tr>
								<td width="700">
									<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" id="collapses" href="#collapse{{$section->secid}}">
										ตอนที่ {{$section->number}} : {{$section->name}} ({{SectionsController::sumScoresection($section->secid)}} คะแนน)
									</a>
								</td>
								<td>
									{{ Form::open(array('method' => 'DELETE', 'route' => array('section.destroy', $section->secid))) }}
										{{ link_to_route('question', 'Add', array('secid'=>$section->secid, 'exid'=>$exam), array('class' => 'btn btn-success')) }}
			                    		{{ link_to_route('section.edit', 'Edit', array($section->secid), array('class' => 'btn btn-info')) }}
			                            {{ Form::submit('Delete', array('class' => 'btn btn-sm btn-danger')) }}
			                        {{ Form::close() }}
								</td>
							</tr>
						</table>
						
					</h4>

				</div>
				<div id="collapse{{$section->secid}}" class="panel-collapse collapse">
					<div class="panel-body">
						<table class="table table-striped table-bordered">
						@foreach ($m_questions as $m_question)
							@if ($m_question->secid == $section->secid)
							<tr>
								<td></td>
								<td>ข้อ {{$m_question->number}}</td>
								<td>{{$m_question->question}}</td>
								<td>({{$m_question->score}} คะแนน)</td>
								<td>ระดับ{{$m_question->level}}</td>
								<td>
									{{ Form::open(array('method' => 'DELETE', 'route' => array('question.destroy', $m_question->qid))) }}
			                    		{{ link_to_route('question.edit', 'Edit', array($m_question->qid), array('class' => 'btn btn-info')) }}
			                            {{ Form::submit('Delete', array('class' => 'btn btn-sm btn-danger')) }}
			                        {{ Form::close() }}
								</td>
							</tr>
							@endif
						@endforeach
						</table>
					</div>
				</div>
			</div><!-- /panel -->
		@endforeach
	</div><!-- /panel-group -->
</div>

	
@else
	There are no section
@endif

@stop
