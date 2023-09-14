@extends('CRM.layouts_successLeeds.leedsNav')
@section('leedContent')

<div class="col-md-12">

    <section class="pt-2">
        <div class="container">
            <div class="row">
                <div class="col-md-12 mx-auto">
                    <div class="card">
                        <div class="card-header">Add Measurement Form</div>
                        <div class="card-body">
                            <h4 class="text-success">{{ Session::get('message') }}</h4>

<br>
                    <div class="container">
                    @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <strong>Sorry!</strong> Here have some issue please check<br><br>
                        <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                        </ul>
                    </div>
                    @endif

                    @if(session('message'))
                    <div class="alert alert-success">
                      {{ session('message') }}
                    </div>
                    @endif


                    <form method="post" action="{{route('new-measurement',['id'=>$leed->id])}}" enctype="multipart/form-data">
                        @csrf

                        <div class="input-group realprocode control-group lst increment" >
                          <input type="file" name="files[]" multiple class="myfrm form-control">
                          <div class="input-group-btn">
                          </div>
                        </div>


                        <button type="submit" class="btn btn-success" style="margin-top:10px">Submit</button>

                    </form>


                    <table class="">
                        @foreach($measures as $measure)
                            <?php
                            $files =json_decode($measure->files);
                            ?>
                        <tr class="">
                          <td class="">

                                @foreach($files as $key=> $file)
                                    <div class="imgWrap">
                                        <div class="imgcontain">
                                            <img src="{{asset('measure-files/'.$file)}}" alt="{{'measure-files/'.$file}}" height="100" width="120">
                                            <a href="{{route('delete-measurement', ['index'=>$key,'id'=>$measure->id])}}" class="text-danger"><i class="fa fa-trash"></i> </a>
                                        </div>
                                    </div>


                            @endforeach
                            <td>
                        </tr>
                        @endforeach
                    </table>

                    <form method="post" action="" enctype="multipart/form-data">
                        @csrf

                        <div class="input-group realprocode control-group lst increment" >
                          <input type="file" name="files[]" multiple class="myfrm form-control">
                          <div class="input-group-btn">
                          </div>
                        </div>


                        <button type="submit" class="btn btn-success" style="margin-top:10px">Update</button>

                    </form>



                    </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>



@endsection('leedContent')
