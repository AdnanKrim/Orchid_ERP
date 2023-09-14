@extends('CRM.layouts_successLeeds.leedsNav')
@section('leedContent')

    <div class="col-md-12">
        <div class="card">
            <h4 class="card-header">All Measurement Structures</h4>
            <div class="card-body bg-white">
{{--                <h4 class="text-success">{{Session::get('message')}}</h4>--}}
                <div class="bg-white">
                    <form action="{{route('search-house-area-type', ['id'=>$leed->id])}}" method="GET">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-6">
                                <input type="text" class="form-control bg-white" name="searchType" value="Search"/>
                            </label>
                            <div class="col-md-6 ml-0">
                                <span class="float-right col-md-6"><a href="{{route('add-measure-struct', ['id'=>$leed->id])}}" class="btn btn-success float-right">+Add</a></span>
                                <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered mb-0">
                        <thead class="bg-orange">
                        <tr class="text-light">
                            <th>#</th>
                            <th>measurementTypeId</th>
                            <th>measurementStructureName</th>
                            <th>unit</th>
                            <th>Note</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($measureStruct as $mStr)
                            <?php
                                $mti = $mStr->measurementTypeId;
                                $mts = \App\Models\CRM\Measurement\MeasurementType::where('id', $mti)->get();
                            ?>
                            @foreach($mts as $mtn)
                            <tr>
                                <th scope="row">{{$loop->iteration}}</th>
                                <td>{{$mtn['measurementTypeName']}}</td>
                                <td>{{$mStr->measurementStructureName}}</td>
                                <td>{{$mStr->unit}}</td>
                                <td>{{$mStr->note}}</td>
                                <td>
                                    <a href="{{route('edit-measure-struct',['id'=>$leed->id, 'mStr'=>$mStr->id])}}" class="btn btn-success btn-sm mx-1">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="" class="btn btn-danger btn-sm" onclick="deleteMStr({{$mStr->id}})">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                    <form method="POST" action="{{route('delete-measure-struct',['id'=>$leed->id, 'mStr'=>$mStr->id])}}" id="deleteMStrForm{{$mStr->id}}">
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function deleteMStr(id)
        {
            event.preventDefault();
            var check = confirm('Are You Sure Want To Delete This!');
            if(check)
            {
                document.getElementById('deleteMStrForm'+id).submit();
            }
        }
    </script>
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
                title: 'New Company Information Added Successfully'
            })
        }
        function wise_words()
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
                title: 'Company Information Deleted Successfully'
            })
        }
        function update()
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
                title: 'Company Information Updated Successfully'
            })
        }
    </script>
@endsection

