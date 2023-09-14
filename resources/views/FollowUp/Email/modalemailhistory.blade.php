<div class="modal fade" id="detailModal{{$history->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" >
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Email History Detail</h3>

            </div>

            <div class="modal-body">
                <div class="modal-element" >
                    <?php













                    $temp = \App\Models\FollowUp\emailTemplate::where('id',$history->templateId)->first();
                    $group = \App\Models\FollowUp\FollowUpGroup::where('id',$temp->groupId)->first();
                    $email = implode(",",json_decode($history->email));
                    ?>
                    <div class="row" style="background-color: orange;">
                        <label class="col-md-6 col-form-label">FollowUp Group:</label>
                        <label class="col-md-6 col-form-label">{{$group->groupName}}</label>
                    </div>
                    <div class="row">
                        <label class="col-md-6 col-form-label">Subject:</label>
                        <label class="col-md-6 col-form-label">{{$history->subject}}</label>
                    </div>
                    <div class="row"style="background-color: orange;">
                        <label class="col-md-6 col-form-label">Message:</label>
                        <label class="col-md-6 col-form-label">{{$history->body}}</label>
                    </div>
                    <div class="row">
                        <label class="col-md-6 col-form-label">Email:</label>
                        <label class="col-md-6 col-form-label">{{$email}}</label>
                    </div>


                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
