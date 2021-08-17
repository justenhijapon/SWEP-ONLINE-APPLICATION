<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <h4 class="modal-title"></h4>
</div>

<div class="modal-body">
    <div class="row">
        <div class="col-md-4">
            <div class="well well-sm">
                <dl class="dl-horizontal">
                    <dt>Project Code:</dt>
                    <dd>{{$project->project_code}}</dd>

                    <dt>Year:</dt>
                    <dd>{{$project->year}}</dd>

                    <dt>Activity:</dt>
                    <dd>{{$project->activity}}</dd>

                    <dt>Budget Allocated:</dt>
                    <dd>{{number_format($project->budget,2)}}</dd>

                    <dt>Budget Utilized:</dt>
                    <dd> January 01, 1990 </dd>

                    <dt>Balance:</dt>
                    <dd>January 01, 1990</dd>
                </dl>

                <p class="page-header-sm text-center on-well text-info">
                    Additional Information
                </p>

                <dl class="dl-horizontal">
                    <dt>Gender Issue/GAD Mandate</dt>
                    <dd>{{$project->issue}}</dd>

                    <dt>Cause of Gender Issue:</dt>
                    <dd>{{$project->cause}}</dd>

                    <dt>GAD Result Statement/GAD Objective:</dt>
                    <dd>{{$project->result_statement}}</dd>

                    <dt>Relevant Oraganization MFO/PAP or PPA:</dt>
                    <dd>{{$project->relevant_org}}</dd>

                    <dt>Performance Indicators/Targets:</dt>
                    <dd> {{$project->performance_indicators}} </dd>

                    <dt>Source of Budget:</dt>
                    <dd>{{$project->source_budget}} </dd>

                    <dt>Responsible Unit/Office</dt>
                    <dd>{{$project->responsible}} </dd>

                </dl>
            </div>
        </div>
    </div>




</div>

<div class="modal-footer">
    <div class="row">
        {!! __html::timestamp($project ,"4") !!}

        <div class="col-md-4">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>
