@extends('master.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="py-5">
            <div class="container">

                <div class="row">
                    <div class="col-md-10 mx-auto">
                        <h4 class="text-success">{{ Session::get('message') }}</h4>
                        <div class="card">
                            <div class="card-header">Send Email </div>
                            <div class="card-body">

                                <form action="/send-email" method="POST" enctype="multipart/form-data">
                                    @csrf


                                    <div class="form-group row">

{{--                                        <label class="col-md-4 col-form-label" >Subject</label>--}}
                                        <div class="col-md-8">
                                            <input type="hidden" class="form-control" name="templateId" value="{{$temp->id}}" />
                                            <label >Subject:</label>
                                            <input type="text" class="form-control" style="height: 4rem;" name="subject" value="{{$temp->subject}}" />
                                            <label style="margin-top: 1rem;">Message:</label>
                                            <textarea  class="form-control" style="height: 12rem; " name="body">{{$temp->body}}</textarea>
                                            <label style="margin-top: 1rem;">Attachment:</label>
                                            <input type="file" class="form-control" name="attachment"  />
                                        </div>
                                        <div class="col-md-4">
                                            <label >Send to:</label> <br>
                                            <input class="form-check-input" type="checkbox" onclick="checkAll(this)" id="option-all" checked>
                                            <label class="form-check-label" for="option-all" > Select All </label> <br>
                                            @foreach($supp as $suppl)
                                                @if($suppl->email != null)
                                                    <?php
                                                    if($suppl->clientName){
                                                        $client = $suppl->clientName;
                                                    }
                                                    if($suppl->companyOrStoreName){
                                                        $client = $suppl->companyOrStoreName;
                                                    }
                                                    ?>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" checked id="inlineCheckbox1" name="email[]" value="{{$suppl->email}}">
                                                <label class="form-check-label" for="inlineCheckbox1">{{$client}}</label>

                                            </div> <br>
                                                @endif
                                            @endforeach


                                        </div>
                                    </div>
{{--                                    <div class="form-group row">--}}
{{--                                        <label class="col-md-4 col-form-label">Message</label>--}}
{{--                                        <div class="col-md-8">--}}
{{--                                            <textarea  class="form-control" name="body"></textarea>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                    <div class="form-group row">
                                        <label class="col-md-5 col-form-label"></label>
                                        <div class="col-md-7">
                                            <input type="submit" class="btn btn-success" value="Send" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script>
        // var checkboxes = document.querySelectorAll("input[type ='checkbox']");
        // function checkAll(myCheckbox){
        //     if (myCheckbox.checked === true){
        //      checkboxes.forEach(function(checkbox){
        //          checkbox.checked = true;
        //      });
        //
        //     }else{
        //         console.log('No');
        //     }
        // }
        // $(document).ready(function(){
        //     $("input:checkbox").prop("checked", "true");
        // });
        function checkAll(main){

            all = document.getElementsByName('email[]');
            for(var a=0; a < all.length; a++  ){
                all[a].checked = main.checked;
            }
            // if (all[a].checked == false){
            //     main.checked = false;
            // }
        }
    </script>
@endsection
