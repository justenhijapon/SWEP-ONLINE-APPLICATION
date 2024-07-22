<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h4 class="modal-title">{{ $user->lastname }}, {{ $user->firstname }} {{ substr($user->middlename, 0, 1) }}.</h4>
</div>
<div class="modal-body">

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Activity Log
                </div>
                <div class="panel-body">
                    <div class="box-body">
            <table class="table table-bordered table-striped table-hover" id="activity_table" style="width: 100% !important">
                <thead>
                <tr>
                    <th>Module</th>
                    <th>Event</th>
                    <th>Remarks</th>
                    <th>Created At</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($userActivity as $activity)
                    <tr>
                        <td>{{ $activity->module }}</td>
                        <td>{{ $activity->event }}</td>
                        <td>{{ $activity->remarks }}</td>
                        <td>{{ $activity->created_at->format('Y-m-d H:i:s') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
                </div>
            </div>

        </div>
    </div>
</div>
<div class="modal-footer">
    <div class="row">
        <div class="col-md-12">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#activity_table').DataTable();
    });
</script>

