@extends('master.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="py-5 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="card">
                            <div class="card-header text-center fs-3">Edit Business Branch</div>
                            <div class="card-body">
                                <h4 class="text-success">{{ Session::get('message') }}</h4>
                                <form action="{{route('updateBusinessBranch',['id'=>$businessBranch['id']])}}" method="POST"
                                      enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group row">
                                        <div class="col-md-4">
                                            <label>Business Branch Name</label>
                                            {{--                                            value="{{ $companyInfo->companyName }}"--}}
                                            <input type="text" class="form-control" name="branchName" value="{{ $businessBranch->branchName }}"/>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Business Branch Head</label>
                                            <input type="text" class="form-control" name="branchHead" value="{{$businessBranch->branchHead}}"/>
                                        </div>
                                        <div class="col-md-4">
                                            <label>City</label>
                                            <input type="text" class="form-control" name="city" value="{{$businessBranch->companyId}}"/>
                                        </div>

                                    </div>
                                    <div class="form-group row">


                                        <div class="col-md-4">
                                            <label >State</label>
                                            <div class="search_select_box">
                                                <select id="state" class="form-control bg-white " name="state" data-live-search="true">
                                                    <option @if($businessBranch->state == "Bagerhat") selected @endif value="Bagerhat">Bagerhat</option>
                                                    <option @if($businessBranch->state == "Bandarban") selected @endif value="Bandarban">Bandarban</option>
                                                    <option @if($businessBranch->state == "Barguna") selected @endif value="Barguna">Barguna</option>
                                                    <option @if($businessBranch->state == "Barisal") selected @endif value="Barisal">Barisal</option>
                                                    <option @if($businessBranch->state == "Bhola") selected @endif value="Bhola">Bhola</option>
                                                    <option @if($businessBranch->state == "Bogra") selected @endif value="Bogra">Bogra</option>
                                                    <option @if($businessBranch->state == "Brahmanbaria") selected @endif value="Brahmanbaria">Brahmanbaria</option>
                                                    <option @if($businessBranch->state == "Chandpur") selected @endif value="Chandpur">Chandpur</option>
                                                    <option @if($businessBranch->state == "Chittagong") selected @endif value="Chittagong">Chittagong</option>
                                                    <option @if($businessBranch->state == "Chuadanga") selected @endif value="Chuadanga">Chuadanga</option>
                                                    <option @if($businessBranch->state == "Comilla") selected @endif value="Comilla">Comilla</option>
                                                    <option @if($businessBranch->state == "Cox's Bazar") selected @endif  value="Cox's Bazar">Cox's Bazar</option>
                                                    <option @if($businessBranch->state == "Dhaka") selected @endif value="Dhaka" >Dhaka</option>
                                                    <option @if($businessBranch->state == "Dinajpur") selected @endif value="Dinajpur">Dinajpur</option>
                                                    <option @if($businessBranch->state == "Faridpur") selected @endif value="Faridpur">Faridpur</option>
                                                    <option @if($businessBranch->state == "Feni") selected @endif value="Feni">Feni</option>
                                                    <option @if($businessBranch->state == "Gaibandha") selected @endif value="Gaibandha">Gaibandha</option>
                                                    <option @if($businessBranch->state == "Gazipur") selected @endif value="Gazipur">Gazipur</option>
                                                    <option @if($businessBranch->state == "Gopalganj") selected @endif value="Gopalganj">Gopalganj</option>
                                                    <option @if($businessBranch->state == "Habiganj") selected @endif value="Habiganj">Habiganj</option>
                                                    <option @if($businessBranch->state == "Jaipurhat") selected @endif value="Jaipurhat">Jaipurhat</option>
                                                    <option @if($businessBranch->state == "Jamalpur") selected @endif value="Jamalpur">Jamalpur</option>
                                                    <option @if($businessBranch->state == "Jessore") selected @endif value="Jessore">Jessore</option>
                                                    <option @if($businessBranch->state == "Jhalakati") selected @endif value="Jhalakati">Jhalakati</option>
                                                    <option @if($businessBranch->state == "Jhenaidah") selected @endif value="Jhenaidah">Jhenaidah</option>
                                                    <option @if($businessBranch->state == "Khagrachari") selected @endif  value="Khagrachari">Khagrachari</option>
                                                    <option @if($businessBranch->state == "Khulna") selected @endif value="Khulna">Khulna</option>
                                                    <option @if($businessBranch->state == "Kishoreganj") selected @endif value="Kishoreganj">Kishoreganj</option>
                                                    <option @if($businessBranch->state == "Kurigram") selected @endif value="Kurigram">Kurigram</option>
                                                    <option @if($businessBranch->state == "Kushtia") selected @endif value="Kushtia">Kushtia</option>
                                                    <option @if($businessBranch->state == "Lakshmipur") selected @endif value="Lakshmipur">Lakshmipur</option>
                                                    <option @if($businessBranch->state == "Lalmonirhat") selected @endif value="Lalmonirhat">Lalmonirhat</option>
                                                    <option @if($businessBranch->state == "Madaripur") selected @endif value="Madaripur">Madaripur</option>
                                                    <option @if($businessBranch->state == "Magura") selected @endif value="Magura">Magura</option>
                                                    <option @if($businessBranch->state == "Manikganj") selected @endif value="Manikganj">Manikganj</option>
                                                    <option @if($businessBranch->state == "Meherpur") selected @endif value="Meherpur">  Meherpur</option>
                                                    <option @if($businessBranch->state == "Moulvibazar") selected @endif value="Moulvibazar">Moulvibazar</option>
                                                    <option @if($businessBranch->state == "Munshiganj") selected @endif  value="Munshiganj">Munshiganj</option>
                                                    <option @if($businessBranch->state == "Mymensingh") selected @endif value="Mymensingh">Mymensingh</option>
                                                    <option @if($businessBranch->state == "Naogaon") selected @endif value="Naogaon"> Naogaon</option>
                                                    <option @if($businessBranch->state == "Narail") selected @endif value="Narail">Narail</option>
                                                    <option @if($businessBranch->state == "Narayanganj") selected @endif value="Narayanganj">Narayanganj</option>
                                                    <option @if($businessBranch->state == "Narsingdi") selected @endif value="Narsingdi">Narsingdi</option>
                                                    <option @if($businessBranch->state == "Natore") selected @endif value="Natore">Natore</option>
                                                    <option @if($businessBranch->state == "Nawabganj") selected @endif value="Nawabganj">Nawabganj</option>
                                                    <option @if($businessBranch->state == "Netrakona") selected @endif  value="Netrakona">Netrakona</option>
                                                    <option @if($businessBranch->state == "Nilphamari") selected @endif  value="Nilphamari">Nilphamari</option>
                                                    <option @if($businessBranch->state == "Noakhali") selected @endif value="Noakhali">Noakhali</option>
                                                    <option @if($businessBranch->state == "Pabna") selected @endif value="Pabna">Pabna</option>
                                                    <option @if($businessBranch->state == "Panchagarh") selected @endif value="Panchagarh">Panchagarh</option>
                                                    <option @if($businessBranch->state == "Parbattya Chattagram") selected @endif value="Parbattya Chattagram">Parbattya Chattagram</option>
                                                    <option @if($businessBranch->state == "Patuakhali") selected @endif value="Patuakhali">Patuakhali</option>
                                                    <option @if($businessBranch->state == "Pirojpur") selected @endif value="Pirojpur">Pirojpur</option>
                                                    <option @if($businessBranch->state == "Rajbari") selected @endif value="Rajbari">Rajbari</option>
                                                    <option @if($businessBranch->state == "Rajshahi") selected @endif  value="Rajshahi">Rajshahi</option>
                                                    <option @if($businessBranch->state == "Rangpur") selected @endif value="Rangpur">Rangpur </option>
                                                    <option @if($businessBranch->state == "Satkhira") selected @endif value="Satkhira">Satkhira</option>
                                                    <option @if($businessBranch->state == "Shariatpur") selected @endif value="Shariatpur">Shariatpur</option>
                                                    <option @if($businessBranch->state == "Sherpur") selected @endif value="Sherpur">Sherpur</option>
                                                    <option @if($businessBranch->state == "Sirajganj") selected @endif value="Sirajganj">Sirajganj</option>
                                                    <option @if($businessBranch->state == "Sunamganj") selected @endif value="Sunamganj">Sunamganj</option>
                                                    <option @if($businessBranch->state == "Sylhet") selected @endif value="Sylhet">Sylhet</option>
                                                    <option @if($businessBranch->state == "Tangail") selected @endif value="Tangail">Tangail</option>
                                                    <option @if($businessBranch->state == "Thakurgaon") selected @endif value="Thakurgaon">Thakurgaon</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Country</label>
                                            <div class="input-group search_select_box">
                                                <select id="countrycountry" class="form-control bg-white" name="country" data-live-search="true">
                                                    <option>select country</option>
                                                    <option @if($businessBranch->country == "Afghanistan") selected @endif value="Afghanistan">Afghanistan</option>
                                                    <option @if($businessBranch->country == "Aland Islands") selected @endif value="Aland Islands">Aland Islands</option>
                                                    <option @if($businessBranch->country == "Albania") selected @endif value="Albania">Albania</option>
                                                    <option @if($businessBranch->country == "Algeria") selected @endif value="Algeria">Algeria</option>
                                                    <option @if($businessBranch->country == "American Samoa") selected @endif value="American Samoa">American Samoa</option>
                                                    <option @if($businessBranch->country == "Andorra") selected @endif value="Andorra">Andorra</option>
                                                    <option @if($businessBranch->country == "Angola") selected @endif value="Angola">Angola</option>
                                                    <option @if($businessBranch->country == "Anguilla") selected @endif value="Anguilla">Anguilla</option>
                                                    <option @if($businessBranch->country == "Antarctica") selected @endif value="Antarctica">Antarctica</option>
                                                    <option @if($businessBranch->country == "Antigua and Barbuda") selected @endif value="Antigua and Barbuda">Antigua and Barbuda</option>
                                                    <option @if($businessBranch->country == "Argentina") selected @endif value="Argentina">Argentina</option>
                                                    <option @if($businessBranch->country == "Armenia") selected @endif value="Armenia">Armenia</option>
                                                    <option @if($businessBranch->country == "Aruba") selected @endif value="Aruba">Aruba</option>
                                                    <option @if($businessBranch->country == "Australia") selected @endif value="Australia">Australia</option>
                                                    <option @if($businessBranch->country == "Austria") selected @endif value="Austria">Austria</option>
                                                    <option @if($businessBranch->country == "Azerbaijan") selected @endif value="Azerbaijan">Azerbaijan</option>
                                                    <option @if($businessBranch->country == "Bahamas") selected @endif value="Bahamas">Bahamas</option>
                                                    <option @if($businessBranch->country == "Bahrain") selected @endif value="Bahrain">Bahrain</option>
                                                    <option @if($businessBranch->country == "Bangladesh") selected @endif value="Bangladesh">Bangladesh</option>
                                                    <option @if($businessBranch->country == "Barbados") selected @endif value="Barbados">Barbados</option>
                                                    <option @if($businessBranch->country == "Belarus") selected @endif value="Belarus">Belarus</option>
                                                    <option @if($businessBranch->country == "Belgium") selected @endif value="Belgium">Belgium</option>
                                                    <option @if($businessBranch->country == "Belize") selected @endif  value="Belize">Belize</option>
                                                    <option @if($businessBranch->country == "Benin") selected @endif value="Benin">Benin</option>
                                                    <option @if($businessBranch->country == "Bermuda") selected @endif value="Bermuda">Bermuda</option>
                                                    <option @if($businessBranch->country == "Bhutan") selected @endif value="Bhutan">Bhutan</option>
                                                    <option @if($businessBranch->country == "Bolivia") selected @endif value="Bolivia">Bolivia</option>
                                                    <option @if($businessBranch->country == "Bonaire, Sint Eustatius and Saba") selected @endif value="Bonaire, Sint Eustatius and Saba">Bonaire, Sint Eustatius and Saba</option>
                                                    <option @if($businessBranch->country == "Bosnia and Herzegovina") selected @endif value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                                    <option @if($businessBranch->country == "Botswana") selected @endif value="Botswana">Botswana</option>
                                                    <option @if($businessBranch->country == "Bouvet Island") selected @endif value="Bouvet Island">Bouvet Island</option>
                                                    <option @if($businessBranch->country == "Brazil") selected @endif value="Brazil">Brazil</option>
                                                    <option @if($businessBranch->country == "British Indian Ocean Territocountry") selected @endif value="British Indian Ocean Territocountry">British Indian Ocean Territocountry</option>
                                                    <option @if($businessBranch->country == "Brunei Darussalam") selected @endif value="Brunei Darussalam">Brunei Darussalam</option>
                                                    <option @if($businessBranch->country == "Bulgaria") selected @endif value="Bulgaria">Bulgaria</option>
                                                    <option @if($businessBranch->country == "Burkina Faso") selected @endif value="Burkina Faso">Burkina Faso</option>
                                                    <option @if($businessBranch->country == "Burundi") selected @endif value="Burundi">Burundi</option>
                                                    <option @if($businessBranch->country == "Cambodia") selected @endif value="Cambodia">Cambodia</option>
                                                    <option @if($businessBranch->country == "Cameroon") selected @endif value="Cameroon">Cameroon</option>
                                                    <option @if($businessBranch->country == "Canada") selected @endif value="Canada">Canada</option>
                                                    <option @if($businessBranch->country == "Cape Verde") selected @endif value="Cape Verde">Cape Verde</option>
                                                    <option @if($businessBranch->country == "Cayman Islands") selected @endif value="Cayman Islands">Cayman Islands</option>
                                                    <option @if($businessBranch->country == "Central African Republic") selected @endif value="Central African Republic">Central African Republic</option>
                                                    <option @if($businessBranch->country == "Chad") selected @endif value="Chad">Chad</option>
                                                    <option @if($businessBranch->country == "Chile") selected @endif value="Chile">Chile</option>
                                                    <option @if($businessBranch->country == "China") selected @endif value="China">China</option>
                                                    <option @if($businessBranch->country == "Christmas Island") selected @endif value="Christmas Island">Christmas Island</option>
                                                    <option @if($businessBranch->country == "Cocos (Keeling) Islands") selected @endif value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                                    <option @if($businessBranch->country == "Colombia") selected @endif value="Colombia">Colombia</option>
                                                    <option @if($businessBranch->country == "Comoros") selected @endif value="Comoros">Comoros</option>
                                                    <option @if($businessBranch->country == "Congo") selected @endif value="Congo">Congo</option>
                                                    <option @if($businessBranch->country == "Congo, Democratic Republic of the Congo") selected @endif value="Congo, Democratic Republic of the Congo">Congo, Democratic Republic of the Congo</option>
                                                    <option @if($businessBranch->country == "Cook Islands") selected @endif value="Cook Islands">Cook Islands</option>
                                                    <option @if($businessBranch->country == "Costa Rica") selected @endif value="Costa Rica">Costa Rica</option>
                                                    <option @if($businessBranch->country == "Cote D'Ivoire") selected @endif value="Cote D'Ivoire">Cote D'Ivoire</option>
                                                    <option @if($businessBranch->country == "Croatia") selected @endif value="Croatia">Croatia</option>
                                                    <option @if($businessBranch->country == "Cuba") selected @endif value="Cuba">Cuba</option>
                                                    <option @if($businessBranch->country == "Curacao") selected @endif value="Curacao">Curacao</option>
                                                    <option @if($businessBranch->country == "Cyprus") selected @endif value="Cyprus">Cyprus</option>
                                                    <option @if($businessBranch->country == "Czech Republic") selected @endif value="Czech Republic">Czech Republic</option>
                                                    <option @if($businessBranch->country == "Denmark") selected @endif value="Denmark">Denmark</option>
                                                    <option @if($businessBranch->country == "Djibouti") selected @endif value="Djibouti">Djibouti</option>
                                                    <option @if($businessBranch->country == "Dominica") selected @endif value="Dominica">Dominica</option>
                                                    <option @if($businessBranch->country == "Dominican Republic") selected @endif value="Dominican Republic">Dominican Republic</option>
                                                    <option @if($businessBranch->country == "Ecuador") selected @endif value="Ecuador">Ecuador</option>
                                                    <option @if($businessBranch->country == "Egypt") selected @endif value="Egypt">Egypt</option>
                                                    <option @if($businessBranch->country == "El Salvador") selected @endif value="El Salvador">El Salvador</option>
                                                    <option @if($businessBranch->country == "Equatorial Guinea") selected @endif value="Equatorial Guinea">Equatorial Guinea</option>
                                                    <option @if($businessBranch->country == "Eritrea") selected @endif value="Eritrea">Eritrea</option>
                                                    <option @if($businessBranch->country == "Estonia") selected @endif value="Estonia">Estonia</option>
                                                    <option @if($businessBranch->country == "Ethiopia") selected @endif value="Ethiopia">Ethiopia</option>
                                                    <option @if($businessBranch->country == "Falkland Islands (Malvinas)") selected @endif value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                                    <option @if($businessBranch->country == "Faroe Islands") selected @endif value="Faroe Islands">Faroe Islands</option>
                                                    <option @if($businessBranch->country == "Fiji") selected @endif value="Fiji">Fiji</option>
                                                    <option @if($businessBranch->country == "Finland") selected @endif value="Finland">Finland</option>
                                                    <option @if($businessBranch->country == "France") selected @endif value="France">France</option>
                                                    <option @if($businessBranch->country == "French Guiana") selected @endif value="French Guiana">French Guiana</option>
                                                    <option @if($businessBranch->country == "French Polynesia") selected @endif value="French Polynesia">French Polynesia</option>
                                                    <option @if($businessBranch->country == "French Southern Territories") selected @endif value="French Southern Territories">French Southern Territories</option>
                                                    <option @if($businessBranch->country == "Gabon") selected @endif value="Gabon">Gabon</option>
                                                    <option @if($businessBranch->country == "Gambia") selected @endif value="Gambia">Gambia</option>
                                                    <option @if($businessBranch->country == "Georgia") selected @endif value="Georgia">Georgia</option>
                                                    <option @if($businessBranch->country == "Germany") selected @endif value="Germany">Germany</option>
                                                    <option @if($businessBranch->country == "Ghana") selected @endif value="Ghana">Ghana</option>
                                                    <option @if($businessBranch->country == "Gibraltar") selected @endif value="Gibraltar">Gibraltar</option>
                                                    <option @if($businessBranch->country == "Greece") selected @endif value="Greece">Greece</option>
                                                    <option @if($businessBranch->country == "Greenland") selected @endif value="Greenland">Greenland</option>
                                                    <option @if($businessBranch->country == "Grenada") selected @endif value="Grenada">Grenada</option>
                                                    <option @if($businessBranch->country == "Guadeloupe") selected @endif value="Guadeloupe">Guadeloupe</option>
                                                    <option @if($businessBranch->country == "Guam") selected @endif value="Guam">Guam</option>
                                                    <option @if($businessBranch->country == "Guatemala") selected @endif value="Guatemala">Guatemala</option>
                                                    <option @if($businessBranch->country == "Guernsey") selected @endif value="Guernsey">Guernsey</option>
                                                    <option @if($businessBranch->country == "Guinea") selected @endif value="Guinea">Guinea</option>
                                                    <option @if($businessBranch->country == "Guinea-Bissau") selected @endif value="Guinea-Bissau">Guinea-Bissau</option>
                                                    <option @if($businessBranch->country == "Guyana") selected @endif value="Guyana">Guyana</option>
                                                    <option @if($businessBranch->country == "Haiti") selected @endif value="Haiti">Haiti</option>
                                                    <option @if($businessBranch->country == "Heard Island and Mcdonald Islands") selected @endif value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                                                    <option @if($businessBranch->country == "Holy See (Vatican City State)") selected @endif value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                                    <option @if($businessBranch->country == "Honduras") selected @endif value="Honduras">Honduras</option>
                                                    <option @if($businessBranch->country == "Hong Kong") selected @endif value="Hong Kong">Hong Kong</option>
                                                    <option @if($businessBranch->country == "Hungary") selected @endif value="Hungary">Hungacountry</option>
                                                    <option @if($businessBranch->country == "Iceland") selected @endif value="Iceland">Iceland</option>
                                                    <option @if($businessBranch->country == "India") selected @endif value="IN">India</option>
                                                    <option @if($businessBranch->country == "Indonesia") selected @endif value="Indonesia">Indonesia</option>
                                                    <option @if($businessBranch->country == "Iran, Islamic Republic of") selected @endif value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                                    <option @if($businessBranch->country == "Iraq") selected @endif value="Iraq">Iraq</option>
                                                    <option @if($businessBranch->country == "Ireland") selected @endif value="Ireland">Ireland</option>
                                                    <option @if($businessBranch->country == "Isle of Man") selected @endif value="Isle of Man">Isle of Man</option>
                                                    <option @if($businessBranch->country == "Israel") selected @endif value="Israel">Israel</option>
                                                    <option @if($businessBranch->country == "Italy") selected @endif value="Italy">Italy</option>
                                                    <option @if($businessBranch->country == "Jamaica") selected @endif value="Jamaica">Jamaica</option>
                                                    <option @if($businessBranch->country == "Japan") selected @endif value="Japan">Japan</option>
                                                    <option @if($businessBranch->country == "Jersey") selected @endif value="Jersey">Jersey</option>
                                                    <option @if($businessBranch->country == "Jordan") selected @endif value="Jordan">Jordan</option>
                                                    <option @if($businessBranch->country == "Kazakhstan") selected @endif value="Kazakhstan">Kazakhstan</option>
                                                    <option @if($businessBranch->country == "Kenya") selected @endif value="Kenya">Kenya</option>
                                                    <option @if($businessBranch->country == "Kiribati") selected @endif value="Kiribati">Kiribati</option>
                                                    <option @if($businessBranch->country == "Korea, Democratic People's Republic of") selected @endif value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                                    <option @if($businessBranch->country == "Korea, Republic of") selected @endif value="Korea, Republic of">Korea, Republic of</option>
                                                    <option @if($businessBranch->country == "Kosovo") selected @endif value="Kosovo">Kosovo</option>
                                                    <option @if($businessBranch->country == "Kuwait") selected @endif value="Kuwait">Kuwait</option>
                                                    <option @if($businessBranch->country == "Kyrgyzstan") selected @endif value="Kyrgyzstan">Kyrgyzstan</option>
                                                    <option @if($businessBranch->country == "Lao People's Democratic Republic") selected @endif value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                                    <option @if($businessBranch->country == "Latvia") selected @endif value="Latvia">Latvia</option>
                                                    <option @if($businessBranch->country == "Lebanon") selected @endif value="Lebanon">Lebanon</option>
                                                    <option @if($businessBranch->country == "Lesotho") selected @endif value="Lesotho">Lesotho</option>
                                                    <option @if($businessBranch->country == "Liberia") selected @endif value="Liberia">Liberia</option>
                                                    <option @if($businessBranch->country == "Libyan Arab Jamahiriya") selected @endif  value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                                    <option @if($businessBranch->country == "Liechtenstein") selected @endif value="Liechtenstein">Liechtenstein</option>
                                                    <option @if($businessBranch->country == "Lithuania") selected @endif value="Lithuania">Lithuania</option>
                                                    <option @if($businessBranch->country == "Luxembourg") selected @endif value="Luxembourg">Luxembourg</option>
                                                    <option @if($businessBranch->country == "Macao") selected @endif value="Macao">Macao</option>
                                                    <option @if($businessBranch->country == "Macedonia, the Former Yugoslav Republic of") selected @endif value="Macedonia, the Former Yugoslav Republic of">Macedonia, the Former Yugoslav Republic of</option>
                                                    <option @if($businessBranch->country == "Madagascar") selected @endif value="Madagascar">Madagascar</option>
                                                    <option @if($businessBranch->country == "Malawi") selected @endif value="Malawi">Malawi</option>
                                                    <option @if($businessBranch->country == "Malaysia") selected @endif value="Malaysia">Malaysia</option>
                                                    <option @if($businessBranch->country == "Maldives") selected @endif value="Maldives">Maldives</option>
                                                    <option @if($businessBranch->country == "Mali") selected @endif value="Mali">Mali</option>
                                                    <option @if($businessBranch->country == "Malta") selected @endif value="Malta">Malta</option>
                                                    <option @if($businessBranch->country == "Marshall Islands") selected @endif value="Marshall Islands">Marshall Islands</option>
                                                    <option @if($businessBranch->country == "Martinique") selected @endif value="Martinique">Martinique</option>
                                                    <option @if($businessBranch->country == "Mauritania") selected @endif value="Mauritania">Mauritania</option>
                                                    <option @if($businessBranch->country == "Mauritius") selected @endif value="Mauritius">Mauritius</option>
                                                    <option @if($businessBranch->country == "Mayotte") selected @endif value="Mayotte">Mayotte</option>
                                                    <option @if($businessBranch->country == "Mexico") selected @endif value="MX">Mexico</option>
                                                    <option @if($businessBranch->country == "Micronesia, Federated States of") selected @endif value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                                    <option @if($businessBranch->country == "Moldova, Republic of") selected @endif value="Moldova, Republic of">Moldova, Republic of</option>
                                                    <option @if($businessBranch->country == "Monaco") selected @endif value="Monaco">Monaco</option>
                                                    <option @if($businessBranch->country == "Mongolia") selected @endif value="Mongolia">Mongolia</option>
                                                    <option @if($businessBranch->country == "Montenegro") selected @endif value="Montenegro">Montenegro</option>
                                                    <option @if($businessBranch->country == "Montserrat") selected @endif value="Montserrat">Montserrat</option>
                                                    <option @if($businessBranch->country == "Morocco") selected @endif value="Morocco">Morocco</option>
                                                    <option @if($businessBranch->country == "Mozambique") selected @endif value="Mozambique">Mozambique</option>
                                                    <option @if($businessBranch->country == "Myanmar") selected @endif value="Myanmar">Myanmar</option>
                                                    <option @if($businessBranch->country == "Namibia") selected @endif value="Namibia">Namibia</option>
                                                    <option @if($businessBranch->country == "Nauru") selected @endif value="Nauru">Nauru</option>
                                                    <option @if($businessBranch->country == "Nepal") selected @endif  value="Nepal">Nepal</option>
                                                    <option @if($businessBranch->country == "Netherlands") selected @endif value="Netherlands">Netherlands</option>
                                                    <option @if($businessBranch->country == "Netherlands Antilles") selected @endif value="Netherlands Antilles">Netherlands Antilles</option>
                                                    <option @if($businessBranch->country == "New Caledonia") selected @endif value="New Caledonia">New Caledonia</option>
                                                    <option @if($businessBranch->country == "New Zealand") selected @endif value="New Zealand">New Zealand</option>
                                                    <option @if($businessBranch->country == "Nicaragua") selected @endif value="Nicaragua">Nicaragua</option>
                                                    <option @if($businessBranch->country == "Niger") selected @endif value="Niger">Niger</option>
                                                    <option @if($businessBranch->country == "Nigeria") selected @endif value="Nigeria">Nigeria</option>
                                                    <option @if($businessBranch->country == "Niue") selected @endif value="Niue">Niue</option>
                                                    <option @if($businessBranch->country == "Norfolk Island") selected @endif value="Norfolk Island">Norfolk Island</option>
                                                    <option @if($businessBranch->country == "Northern Mariana Islands") selected @endif value="Northern Mariana Islands">Northern Mariana Islands</option>
                                                    <option @if($businessBranch->country == "Norway") selected @endif value="Norway">Norway</option>
                                                    <option @if($businessBranch->country == "Oman") selected @endif value="Oman">Oman</option>
                                                    <option @if($businessBranch->country == "Pakistan") selected @endif value="Pakistan">Pakistan</option>
                                                    <option @if($businessBranch->country == "Palau") selected @endif value="Palau">Palau</option>
                                                    <option @if($businessBranch->country == "Palestinian Territory, Occupied") selected @endif value="Palestinian Territory, Occupied">Palestinian Territocountry, Occupied</option>
                                                    <option @if($businessBranch->country == "Panama") selected @endif value="Panama">Panama</option>
                                                    <option @if($businessBranch->country == "Papua New Guinea") selected @endif value="Papua New Guinea">Papua New Guinea</option>
                                                    <option @if($businessBranch->country == "Paraguay") selected @endif value="Paraguay">Paraguay</option>
                                                    <option @if($businessBranch->country == "Peru") selected @endif value="Peru">Peru</option>
                                                    <option @if($businessBranch->country == "Philippines") selected @endif value="Philippines">Philippines</option>
                                                    <option @if($businessBranch->country == "Pitcairn") selected @endif value="Pitcairn">Pitcairn</option>
                                                    <option @if($businessBranch->country == "Poland") selected @endif value="Poland">Poland</option>
                                                    <option @if($businessBranch->country == "Portugal") selected @endif value="Portugal">Portugal</option>
                                                    <option @if($businessBranch->country == "Puerto Rico") selected @endif value="Puerto Rico">Puerto Rico</option>
                                                    <option @if($businessBranch->country == "Qatar") selected @endif value="Qatar">Qatar</option>
                                                    <option @if($businessBranch->country == "Reunion") selected @endif value="Reunion">Reunion</option>
                                                    <option @if($businessBranch->country == "Romania") selected @endif value="Romania">Romania</option>
                                                    <option @if($businessBranch->country == "Russian Federation") selected @endif value="Russian Federation">Russian Federation</option>
                                                    <option @if($businessBranch->country == "Rwanda") selected @endif value="Rwanda">Rwanda</option>
                                                    <option @if($businessBranch->country == "Saint Barthelemy") selected @endif value="Saint Barthelemy">Saint Barthelemy</option>
                                                    <option @if($businessBranch->country == "Saint Helena") selected @endif value="Saint Helena">Saint Helena</option>
                                                    <option @if($businessBranch->country == "Saint Kitts and Nevis") selected @endif value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                                    <option @if($businessBranch->country == "Saint Lucia") selected @endif value="Saint Lucia">Saint Lucia</option>
                                                    <option @if($businessBranch->country == "Saint Martin") selected @endif value="Saint Martin">Saint Martin</option>
                                                    <option @if($businessBranch->country == "Saint Pierre and Miquelon") selected @endif value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                                    <option @if($businessBranch->country == "Saint Vincent and the Grenadines") selected @endif value="Saint Vincent and the Grenadines">Saint Vincent and the Grenadines</option>
                                                    <option @if($businessBranch->country == "Samoa") selected @endif value="Samoa">Samoa</option>
                                                    <option @if($businessBranch->country == "San Marino") selected @endif value="San Marino">San Marino</option>
                                                    <option @if($businessBranch->country == "Sao Tome and Principe") selected @endif value="Sao Tome and Principe">Sao Tome and Principe</option>
                                                    <option @if($businessBranch->country == "Saudi Arabia") selected @endif value="Saudi Arabia">Saudi Arabia</option>
                                                    <option @if($businessBranch->country == "Senegal") selected @endif value="Senegal">Senegal</option>
                                                    <option @if($businessBranch->country == "Serbia") selected @endif value="Serbia">Serbia</option>
                                                    <option @if($businessBranch->country == "Serbia and Montenegro") selected @endif value="Serbia and Montenegro">Serbia and Montenegro</option>
                                                    <option @if($businessBranch->country == "Seychelles") selected @endif value="Seychelles">Seychelles</option>
                                                    <option @if($businessBranch->country == "Sierra Leone") selected @endif value="Sierra Leone">Sierra Leone</option>
                                                    <option @if($businessBranch->country == "Singapore") selected @endif value="Singapore">Singapore</option>
                                                    <option @if($businessBranch->country == "Sint Maarten") selected @endif value="Sint Maarten">Sint Maarten</option>
                                                    <option @if($businessBranch->country == "Slovakia") selected @endif value="Slovakia">Slovakia</option>
                                                    <option @if($businessBranch->country == "Slovenia") selected @endif value="Slovenia">Slovenia</option>
                                                    <option @if($businessBranch->country == "Solomon Islands") selected @endif value="Solomon Islands">Solomon Islands</option>
                                                    <option @if($businessBranch->country == "Somalia") selected @endif value="Somalia">Somalia</option>
                                                    <option @if($businessBranch->country == "South Africa") selected @endif value="South Africa">South Africa</option>
                                                    <option @if($businessBranch->country == "South Georgia and the South Sandwich Islands") selected @endif value="South Georgia and the South Sandwich Islands">South Georgia and the South Sandwich Islands</option>
                                                    <option @if($businessBranch->country == "South Sudan") selected @endif value="South Sudan">South Sudan</option>
                                                    <option @if($businessBranch->country == "Spain") selected @endif value="Spain">Spain</option>
                                                    <option @if($businessBranch->country == "Sri Lanka") selected @endif value="Sri Lanka">Sri Lanka</option>
                                                    <option @if($businessBranch->country == "Sudan") selected @endif value="Sudan">Sudan</option>
                                                    <option @if($businessBranch->country == "Suriname") selected @endif value="Suriname">Suriname</option>
                                                    <option @if($businessBranch->country == "Svalbard and Jan Mayen") selected @endif value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                                    <option @if($businessBranch->country == "Swaziland") selected @endif value="Swaziland">Swaziland</option>
                                                    <option @if($businessBranch->country == "Sweden") selected @endif value="Sweden">Sweden</option>
                                                    <option @if($businessBranch->country == "Switzerland") selected @endif value="Switzerland">Switzerland</option>
                                                    <option @if($businessBranch->country == "Syrian Arab Republic") selected @endif value="Syrian Arab Republic">Syrian Arab Republic</option>
                                                    <option @if($businessBranch->country == "Taiwan, Province of China") selected @endif  value="Taiwan, Province of China">Taiwan, Province of China</option>
                                                    <option @if($businessBranch->country == "Tajikistan") selected @endif value="Tajikistan">Tajikistan</option>
                                                    <option @if($businessBranch->country == "Tanzania, United Republic of") selected @endif value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                                    <option @if($businessBranch->country == "Thailand") selected @endif value="Thailand">Thailand</option>
                                                    <option @if($businessBranch->country == "Timor-Leste") selected @endif value="Timor-Leste">Timor-Leste</option>
                                                    <option @if($businessBranch->country == "Togo") selected @endif value="Togo">Togo</option>
                                                    <option @if($businessBranch->country == "Tokelau") selected @endif value="Tokelau">Tokelau</option>
                                                    <option @if($businessBranch->country == "Tonga") selected @endif value="Tonga">Tonga</option>
                                                    <option @if($businessBranch->country == "Trinidad and Tobago") selected @endif value="Trinidad and Tobago">Trinidad and Tobago</option>
                                                    <option @if($businessBranch->country == "Tunisia") selected @endif value="Tunisia">Tunisia</option>
                                                    <option @if($businessBranch->country == "Turkey") selected @endif value="Turkey">Turkey</option>
                                                    <option @if($businessBranch->country == "Turkmenistan") selected @endif  value="Turkmenistan">Turkmenistan</option>
                                                    <option @if($businessBranch->country == "Turks and Caicos Islands") selected @endif value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                                    <option @if($businessBranch->country == "Tuvalu") selected @endif value="Tuvalu">Tuvalu</option>
                                                    <option @if($businessBranch->country == "Uganda") selected @endif value="Uganda">Uganda</option>
                                                    <option @if($businessBranch->country == "Ukraine") selected @endif value="Ukraine">Ukraine</option>
                                                    <option @if($businessBranch->country == "United Arab Emirates") selected @endif value="United Arab Emirates">United Arab Emirates</option>
                                                    <option @if($businessBranch->country == "United Kingdom") selected @endif value="United Kingdom">United Kingdom</option>
                                                    <option @if($businessBranch->country == "United States") selected @endif value="United States">United States</option>
                                                    <option @if($businessBranch->country == "United States Minor Outlying Islands") selected @endif value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                                    <option @if($businessBranch->country == "Uruguay") selected @endif value="Uruguay">Uruguay</option>
                                                    <option @if($businessBranch->country == "Uzbekistan") selected @endif value="Uzbekistan">Uzbekistan</option>
                                                    <option @if($businessBranch->country == "Vanuatu") selected @endif value="Vanuatu">Vanuatu</option>
                                                    <option @if($businessBranch->country == "Venezuela") selected @endif value="Venezuela">Venezuela</option>
                                                    <option @if($businessBranch->country == "Viet Nam") selected @endif value="Viet Nam">Viet Nam</option>
                                                    <option @if($businessBranch->country == "Virgin Islands, British") selected @endif value="Virgin Islands, British">Virgin Islands, British</option>
                                                    <option @if($businessBranch->country == "Virgin Islands, U.s.") selected @endif value="Virgin Islands, U.s.">Virgin Islands, U.s.</option>
                                                    <option @if($businessBranch->country == "Wallis and Futuna") selected @endif value="Wallis and Futuna">Wallis and Futuna</option>
                                                    <option @if($businessBranch->country == "Western Sahara") selected @endif value="Western Sahara">Western Sahara</option>
                                                    <option @if($businessBranch->country == "Yemen") selected @endif value="Yemen">Yemen</option>
                                                    <option @if($businessBranch->country == "Zambia") selected @endif value="Zambia">Zambia</option>
                                                    <option @if($businessBranch->country == "Zimbabwe") selected @endif value="Zimbabwe">Zimbabwe</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <label>Phone Number</label>
                                            <input type="text" class="form-control" name="phoneNo" value="{{$businessBranch->phoneNo}}"/>
                                        </div>
                                    </div>
                                    <div class="form-group row">

                                        <div class="col-md-4">
                                            <label>Email</label>
                                            <input class="form-control" type="email" name="email" value="{{$businessBranch->email}}">
                                        </div>
                                        <div class="col-md-4">
                                            <label >Address</label>
                                            <textarea class="form-control" id="comment" name="address" value="{{$businessBranch->address}}"></textarea>
                                        </div>

                                        <div class="col-md-4">
                                            <label>Note</label>
                                            <textarea class="form-control" name="note" value="{{$businessBranch->note}}"></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12 text-center ">
                                        <input type="submit" class="btn btn-success " value="Update"/>
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
