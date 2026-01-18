<div class="modal fade" id="scheduleModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">Set Match Schedule</h5>
            </div>

            <div class="modal-body">
                <input type="hidden" id="match_id">

                <div class="mb-2">
                    <label>Court</label>
                    <select id="court_id" class="form-control">
                        @foreach ($courts as $court)
                            <option value="{{ $court->id }}">{{ $court->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-2">
                    <label>Time</label>
                    <input type="time" id="scheduled_time" class="form-control">
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-primary" onclick="saveSchedule()">Save</button>
            </div>

        </div>
    </div>
</div>
