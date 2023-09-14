@extends('CRM.layouts_successLeeds.leedsNav')
@section('leedContent')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card bg-white">
                        <h4 class="card-header text-center mt-3"> All Deed Files </h4>
                        <hr  style = 'background-color:blueviolet; opacity:1 !important; border-width:0; color:#000000; height:2px; lineheight:0; width:100%; margin-bottom:0px !important;'>
                        <div class="card-body bg-white">
                            <div class="bg-white ">
                                <form action="{{ route('deedCreate',['id'=>$leed->id]) }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row col-md-12 ">
                                        <div class="col-md-4 form-group row ">
                                            <input type="hidden" name="leedId" value="{{ $leed->id }}" >
                                            <input type="file" multiple class="form-control" required name="files[]"/>
                                        </div>
                                        <div class="col-md-3 form-group row ml-3">
                                            <button type="submit" class="btn btn-success">Add Deed</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            @if($files != "empty")
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        <thead class="bg-orange">
                                        <tr class="text-light">
                                            <th>#</th>
                                            <th>File</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($files as $file)
                                            @php
                                                $v = pathinfo($file->file, PATHINFO_EXTENSION);
                                            @endphp
                                            <tr>
                                                <td scope="row">{{$loop->iteration}}</td>
                                                <td>
                                                    @if($v == 'png'||$v == 'jpeg'||$v == 'png'|| $v == 'jpg'|| $v == 'ico' )
                                                        <img src="{{asset('Deed/'.$file->file)}}"  height="100" width="120">
                                                    @else
                                                        <i class="fa-solid fa-file-pdf fa-xl" style="color:red;width:30px"></i> {{$file->file}}
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{route('delete-deed',['id'=>$file->id])}}" ><i class="fa fa-trash fa-2x"></i>  </a>
                                                    <a href ="{{route('download-deedFile',['id'=>$leed->id,$file->id])}}"> <span style="float:right">
                                                        <i class="fa-solid fa-download fa-xl ml-2" style="color:green;"></i> Download</span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function create()
        {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 9000
            });
            event.preventDefault();
            Toast.fire({
                icon: 'success',
                title: 'New Deed Added Successfully'
            })
        }
        function deleteDeed()
        {
            var Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 9000
            });
            event.preventDefault();
            Toast.fire({
                icon: 'success',
                title: 'Deed Deleted Successfully'
            })
        }
    </script>
@endsection
