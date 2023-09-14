@extends('master.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="py-5">
            <div class="container">

                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <h4 class="text-success">{{ Session::get('message') }}</h4>
                        <div class="card">

                            <div class="card-header">Update Labour </div>
                            <div class="card-body">
                                <form action="/labour-update/{{$labor->id}}" method="POST">
                                    @csrf

                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label>Labour Name<span style='color: #ff0000;'>*</span></label>
                                            <input type="text" class="form-control" name="labourName" value="{{$labor->labourName}}" />
                                            <span style="color:red;">@error('labourName'){{ $message }}@enderror</span>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Labour Id</label>
                                            <input type="text" class="form-control" name="labourId" value="{{$labor->labourId}}" />
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label>Mobile Number</label>
                                            <input type="text" class="form-control" name="mob1No" value="{{$labor->mob1No}}"/>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Mobile Number(additional)</label>
                                            <input type="text" class="form-control" name="mob2No" value="{{$labor->mob2No}}"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label>Email</label>
                                            <input type="text" class="form-control" name="email" value="{{$labor->email}}"/>
                                        </div>
                                        <div class="col-md-6">
                                            <label>City/Police Station</label>
                                            <input type="text" class="form-control" name="subDistrict" value="{{$labor->subDistrict}}"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-md-6">
                                            <label for="horizontal-firstname-input" class=" col-form-label">State/District</label>
                                            <div class=" input-group search_select_box">
                                                {{--                                              <span class="input-group-text bg-white"><i class="fa-solid fa-earth-africa" style="color:#4666ff"></i> </span>--}}
                                                <select id="state" class="form-control bg-white " name="district" data-live-search="true">
                                                    <option @if($labor->district === "Bagerhat") selected @endif value="Bagerhat">Bagerhat</option>
                                                    <option @if($labor->district === "Bandarban") selected @endif value="Bandarban">Bandarban</option>
                                                    <option @if($labor->district === "Barguna") selected @endif value="Barguna">Barguna</option>
                                                    <option @if($labor->district === "Barisal") selected @endif value="Barisal">Barisal</option>
                                                    <option @if($labor->district === "Bhola") selected @endif value="Bhola">Bhola</option>
                                                    <option @if($labor->district === "Bogra") selected @endif value="Bogra">Bogra</option>
                                                    <option @if($labor->district === "Brahmanbaria") selected @endif value="Brahmanbaria">Brahmanbaria</option>
                                                    <option @if($labor->district === "Chandpur") selected @endif value="Chandpur">Chandpur</option>
                                                    <option @if($labor->district === "Chittagong") selected @endif value="Chittagong">Chittagong</option>
                                                    <option @if($labor->district === "Chuadanga") selected @endif value="Chuadanga">Chuadanga</option>
                                                    <option @if($labor->district === "Comilla") selected @endif value="Comilla">Comilla</option>
                                                    <option @if($labor->district === "Cox's Bazar") selected @endif value="Cox's Bazar">Cox's Bazar</option>
                                                    <option @if($labor->district === "Dhaka") selected @endif value="Dhaka">Dhaka</option>
                                                    <option @if($labor->district === "Dinajpur") selected @endif value="Dinajpur">Dinajpur</option>
                                                    <option @if($labor->district === "Faridpur") selected @endif value="Faridpur">Faridpur</option>
                                                    <option @if($labor->district === "Feni") selected @endif value="Feni">Feni</option>
                                                    <option @if($labor->district === "Gaibandha") selected @endif value="Gaibandha">Gaibandha</option>
                                                    <option @if($labor->district === "Gazipur") selected @endif value="Gazipur">Gazipur</option>
                                                    <option @if($labor->district === "Gopalganj") selected @endif value="Gopalganj">Gopalganj</option>
                                                    <option @if($labor->district === "Habiganj") selected @endif value="Habiganj">Habiganj</option>
                                                    <option @if($labor->district === "Jaipurhat") selected @endif value="Jaipurhat">Jaipurhat</option>
                                                    <option @if($labor->district === "Jamalpur") selected @endif value="Jamalpur">Jamalpur</option>
                                                    <option @if($labor->district === "Jessore") selected @endif value="Jessore">Jessore</option>
                                                    <option @if($labor->district === "Jhalakati") selected @endif value="Jhalakati">Jhalakati</option>
                                                    <option @if($labor->district === "Khagrachari") selected @endif  value="Khagrachari">Jhenaidah</option>
                                                    <option @if($labor->district === "Jhenaidah") selected @endif value="Jhenaidah">Jhenaidah</option>
                                                    <option @if($labor->district === "Khagrachari") selected @endif value="Khagrachari">Khagrachari</option>
                                                    <option @if($labor->district === "Khulna") selected @endif value="Khulna">Khulna</option>
                                                    <option @if($labor->district === "Kishoreganj") selected @endif value="Kishoreganj">Kishoreganj</option>
                                                    <option @if($labor->district === "Kurigram") selected @endif value="Kurigram">Kurigram</option>
                                                    <option @if($labor->district === "Kushtia") selected @endif value="Kushtia">Kushtia</option>
                                                    <option @if($labor->district === "Lakshmipur") selected @endif value="Lakshmipur">Lakshmipur</option>
                                                    <option @if($labor->district === "Lalmonirhat") selected @endif value="Lalmonirhat">Lalmonirhat</option>
                                                    <option @if($labor->district === "Madaripur") selected @endif value="Madaripur">Madaripur</option>
                                                    <option @if($labor->district === "Magura") selected @endif value="Magura">Magura</option>
                                                    <option @if($labor->district === "Manikganj") selected @endif value="Manikganj">Manikganj</option>
                                                    <option @if($labor->district === "Meherpur") selected @endif value="Meherpur">  Meherpur</option>
                                                    <option @if($labor->district === "Moulvibazar") selected @endif value="Moulvibazar">Moulvibazar</option>
                                                    <option @if($labor->district === "Munshiganj") selected @endif value="Munshiganj">Munshiganj</option>
                                                    <option @if($labor->district === "Mymensingh") selected @endif value="Mymensingh">Mymensingh</option>
                                                    <option @if($labor->district === "Naogaon") selected @endif value="Naogaon"> Naogaon</option>
                                                    <option @if($labor->district === "Narail") selected @endif value="Narail">Narail</option>
                                                    <option @if($labor->district === "Narayanganj") selected @endif value="Narayanganj">Narayanganj</option>
                                                    <option @if($labor->district === "Narsingdi") selected @endif value="Narsingdi">Narsingdi</option>
                                                    <option @if($labor->district === "Natore") selected @endif value="Natore">Natore</option>
                                                    <option @if($labor->district === "Nawabganj") selected @endif value="Nawabganj">Nawabganj</option>
                                                    <option @if($labor->district === "Netrakona") selected @endif value="Netrakona">Netrakona</option>
                                                    <option @if($labor->district === "Nilphamari") selected @endif value="Nilphamari">Nilphamari</option>
                                                    <option @if($labor->district === "Noakhali") selected @endif value="Noakhali">Noakhali</option>
                                                    <option @if($labor->district === "Pabna") selected @endif value="Pabna">Pabna</option>
                                                    <option @if($labor->district === "Panchagarh") selected @endif value="Panchagarh">Panchagarh</option>
                                                    <option @if($labor->district === "Parbattya Chattagram") selected @endif value="Parbattya Chattagram">Parbattya Chattagram</option>
                                                    <option @if($labor->district === "Patuakhali") selected @endif value="Patuakhali">Patuakhali</option>
                                                    <option @if($labor->district === "Pirojpur") selected @endif value="Pirojpur">Pirojpur</option>
                                                    <option @if($labor->district === "Rajbari") selected @endif value="Rajbari">Rajbari</option>
                                                    <option @if($labor->district === "Rajshahi") selected @endif value="Rajshahi">Rajshahi</option>
                                                    <option @if($labor->district === "Rangpur") selected @endif value="Rangpur">Rangpur </option>
                                                    <option @if($labor->district === "Satkhira") selected @endif value="Satkhira">Satkhira</option>
                                                    <option @if($labor->district === "Shariatpur") selected @endif value="Shariatpur">Shariatpur</option>
                                                    <option @if($labor->district === "Sherpur") selected @endif value="Sherpur">Sherpur</option>
                                                    <option @if($labor->district === "Sirajganj") selected @endif value="Sirajganj">Sirajganj</option>
                                                    <option @if($labor->district === "Sunamganj") selected @endif value="Sunamganj">Sunamganj</option>
                                                    <option @if($labor->district === "Sylhet") selected @endif value="Sylhet">Sylhet</option>
                                                    <option @if($labor->district === "Tangail") selected @endif value="Tangail">Tangail</option>
                                                    <option @if($labor->district === "Thakurgaon") selected @endif value="Thakurgaon">Thakurgaon</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <label>Address</label>
                                            <input type="text" class="form-control" name="address" value="{{$labor->address}}"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-2 col-form-label">About</label>
                                        <div class="col-md-10">
                                            <textarea  class="form-control" name="note" >{{$labor->note}}</textarea>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label"></label>
                                        <div class="col-md-8">
                                            <input type="submit" class="btn btn-success" value="Update" />
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
    <!-- /.content-wrapper -->
@endsection
