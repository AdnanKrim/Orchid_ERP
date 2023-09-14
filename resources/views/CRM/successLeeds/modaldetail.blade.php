<div class="modal fade" id="detailModal{{$meeting->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" >
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Meeting Detail</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-element" >
                    <div class="row border border-dark border-4"  style="background-color: #FF00FF;">
                        <label class="col-md-6 col-form-label">Meeting Date</label>
                        <label class="col-md-6 col-form-label">{!! date('d M y',strtotime($meeting->meetingDateAndTime)) !!}</label>
                    </div>
                    <div class="row border border-dark border-4">
                        <label class="col-md-6 col-form-label">Meeting Time</label>
                        <label class="col-md-6 col-form-label">{!! date('h:i A',strtotime($meeting->meetingDateAndTime)) !!}</label>
                    </div>
                    <div class="row border border-dark border-4"style="background-color: #FF00FF;">
                        <label class="col-md-6 col-form-label">Meeting Detail</label>
                        <label class="col-md-6 col-form-label">{{$meeting->detail}}</label>
                    </div>
                    <div class="row border border-dark border-4">
                        <label class="col-md-6 col-form-label">Client Comments</label>
                        <label class="col-md-6 col-form-label">{{$meeting->clientComments}}</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
