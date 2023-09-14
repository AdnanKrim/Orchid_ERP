@extends('master.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="py-2 bg-white">
            <form  action="{{route('updateLeeds', ['id'=>$leeds->id])}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="card col-md-12 mx-auto bg-white">
                    <h3 class="text-primary">{{Session::get('message')}}</h3>
                    <div class="row">
                        <div class="col-sm-6 bg-white">
                            <div class="card bg-white">
                                <div class="card-header">Update leeds</div>
                                <div class="card-body">
                                    <div class="form-group row mb-2">
                                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Client Name<span style='color: #ff0000;'>*</span></label>
                                        <div class="col-sm-9 input-group">
                                            <span class="input-group-text bg-white"><i class="fa-solid fa-hotel" style="color:#dc143c"></i></span>
                                            <input id="text" type="text" required class="form-control bg-white " name="clientName" placeholder="Company" value="{{$leeds->clientName}}">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Phone<span style='color: red;'>*</span></label>
                                        <div class="col-sm-9 input-group">
                                            <span class="input-group-text bg-white"><i class="fa-solid fa-phone" style="color:#4666ff"></i></span>
                                            <input id="phone" type="number" required class="form-control bg-white" name="phoneNo" placeholder="phone" value="{{$leeds->phoneNo}}">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9 input-group">
                                            <span class="input-group-text bg-white"><i class="fa-solid fa-envelope" style="color:#4666ff"></i></span>
                                            <input id="email" type="email" class="form-control bg-white" name="email" placeholder="Email" value="{{$leeds->email}}">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Street<span style='color: red;'>*</span></label>
                                        <div class="col-sm-9 input-group">
                                            <span class="input-group-text bg-white"><i class="fa-solid fa-address-card" style="color:#dc143c"></i></span>
                                            <textarea id="street" required class="form-control bg-white" name="area" placeholder="address">{{$leeds->area}}</textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">City</label>
                                        <div class="col-sm-9 input-group">
                                            <span class="input-group-text bg-white"><i class="fa-solid fa-city" style="color:#dc143c "></i></span>
                                            <input id="city" type="text" class="form-control bg-white" name="address" placeholder="city" value="{{$leeds->address}}">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">State</label>
                                        <div class="col-sm-9 input-group search_select_box">
                                            <span class="input-group-text bg-white"><i class="fa-solid fa-earth-africa" style="color:#4666ff"></i> </span>
                                            <select id="state" class="form-control bg-white " name="district" data-live-search="true">
                                                <option @if($leeds->district === "Bagerhat") selected @endif value="Bagerhat">Bagerhat</option>
                                                <option @if($leeds->district === "Bandarban") selected @endif value="Bandarban">Bandarban</option>
                                                <option @if($leeds->district === "Barguna") selected @endif value="Barguna">Barguna</option>
                                                <option @if($leeds->district === "Barisal") selected @endif value="Barisal">Barisal</option>
                                                <option @if($leeds->district === "Bhola") selected @endif value="Bhola">Bhola</option>
                                                <option @if($leeds->district === "Bogra") selected @endif value="Bogra">Bogra</option>
                                                <option @if($leeds->district === "Brahmanbaria") selected @endif value="Brahmanbaria">Brahmanbaria</option>
                                                <option @if($leeds->district === "Chandpur") selected @endif value="Chandpur">Chandpur</option>
                                                <option @if($leeds->district === "Chittagong") selected @endif value="Chittagong">Chittagong</option>
                                                <option @if($leeds->district === "Chuadanga") selected @endif value="Chuadanga">Chuadanga</option>
                                                <option @if($leeds->district === "Comilla") selected @endif value="Comilla">Comilla</option>
                                                <option @if($leeds->district === "Cox's Bazar") selected @endif value="Cox's Bazar">Cox's Bazar</option>
                                                <option @if($leeds->district === "Dhaka") selected @endif value="Dhaka">Dhaka</option>
                                                <option @if($leeds->district === "Dinajpur") selected @endif value="Dinajpur">Dinajpur</option>
                                                <option @if($leeds->district === "Faridpur") selected @endif value="Faridpur">Faridpur</option>
                                                <option @if($leeds->district === "Feni") selected @endif value="Feni">Feni</option>
                                                <option @if($leeds->district === "Gaibandha") selected @endif value="Gaibandha">Gaibandha</option>
                                                <option @if($leeds->district === "Gazipur") selected @endif value="Gazipur">Gazipur</option>
                                                <option @if($leeds->district === "Gopalganj") selected @endif value="Gopalganj">Gopalganj</option>
                                                <option @if($leeds->district === "Habiganj") selected @endif value="Habiganj">Habiganj</option>
                                                <option @if($leeds->district === "Jaipurhat") selected @endif value="Jaipurhat">Jaipurhat</option>
                                                <option @if($leeds->district === "Jamalpur") selected @endif value="Jamalpur">Jamalpur</option>
                                                <option @if($leeds->district === "Jessore") selected @endif value="Jessore">Jessore</option>
                                                <option @if($leeds->district === "Jhalakati") selected @endif value="Jhalakati">Jhalakati</option>
                                                <option @if($leeds->district === "Khagrachari") selected @endif  value="Khagrachari">Jhenaidah</option>
                                                <option @if($leeds->district === "Jhenaidah") selected @endif value="Jhenaidah">Jhenaidah</option>
                                                <option @if($leeds->district === "Khagrachari") selected @endif value="Khagrachari">Khagrachari</option>
                                                <option @if($leeds->district === "Khulna") selected @endif value="Khulna">Khulna</option>
                                                <option @if($leeds->district === "Kishoreganj") selected @endif value="Kishoreganj">Kishoreganj</option>
                                                <option @if($leeds->district === "Kurigram") selected @endif value="Kurigram">Kurigram</option>
                                                <option @if($leeds->district === "Kushtia") selected @endif value="Kushtia">Kushtia</option>
                                                <option @if($leeds->district === "Lakshmipur") selected @endif value="Lakshmipur">Lakshmipur</option>
                                                <option @if($leeds->district === "Lalmonirhat") selected @endif value="Lalmonirhat">Lalmonirhat</option>
                                                <option @if($leeds->district === "Madaripur") selected @endif value="Madaripur">Madaripur</option>
                                                <option @if($leeds->district === "Magura") selected @endif value="Magura">Magura</option>
                                                <option @if($leeds->district === "Manikganj") selected @endif value="Manikganj">Manikganj</option>
                                                <option @if($leeds->district === "Meherpur") selected @endif value="Meherpur">  Meherpur</option>
                                                <option @if($leeds->district === "Moulvibazar") selected @endif value="Moulvibazar">Moulvibazar</option>
                                                <option @if($leeds->district === "Munshiganj") selected @endif value="Munshiganj">Munshiganj</option>
                                                <option @if($leeds->district === "Mymensingh") selected @endif value="Mymensingh">Mymensingh</option>
                                                <option @if($leeds->district === "Naogaon") selected @endif value="Naogaon"> Naogaon</option>
                                                <option @if($leeds->district === "Narail") selected @endif value="Narail">Narail</option>
                                                <option @if($leeds->district === "Narayanganj") selected @endif value="Narayanganj">Narayanganj</option>
                                                <option @if($leeds->district === "Narsingdi") selected @endif value="Narsingdi">Narsingdi</option>
                                                <option @if($leeds->district === "Natore") selected @endif value="Natore">Natore</option>
                                                <option @if($leeds->district === "Nawabganj") selected @endif value="Nawabganj">Nawabganj</option>
                                                <option @if($leeds->district === "Netrakona") selected @endif value="Netrakona">Netrakona</option>
                                                <option @if($leeds->district === "Nilphamari") selected @endif value="Nilphamari">Nilphamari</option>
                                                <option @if($leeds->district === "Noakhali") selected @endif value="Noakhali">Noakhali</option>
                                                <option @if($leeds->district === "Pabna") selected @endif value="Pabna">Pabna</option>
                                                <option @if($leeds->district === "Panchagarh") selected @endif value="Panchagarh">Panchagarh</option>
                                                <option @if($leeds->district === "Parbattya Chattagram") selected @endif value="Parbattya Chattagram">Parbattya Chattagram</option>
                                                <option @if($leeds->district === "Patuakhali") selected @endif value="Patuakhali">Patuakhali</option>
                                                <option @if($leeds->district === "Pirojpur") selected @endif value="Pirojpur">Pirojpur</option>
                                                <option @if($leeds->district === "Rajbari") selected @endif value="Rajbari">Rajbari</option>
                                                <option @if($leeds->district === "Rajshahi") selected @endif value="Rajshahi">Rajshahi</option>
                                                <option @if($leeds->district === "Rangpur") selected @endif value="Rangpur">Rangpur </option>
                                                <option @if($leeds->district === "Satkhira") selected @endif value="Satkhira">Satkhira</option>
                                                <option @if($leeds->district === "Shariatpur") selected @endif value="Shariatpur">Shariatpur</option>
                                                <option @if($leeds->district === "Sherpur") selected @endif value="Sherpur">Sherpur</option>
                                                <option @if($leeds->district === "Sirajganj") selected @endif value="Sirajganj">Sirajganj</option>
                                                <option @if($leeds->district === "Sunamganj") selected @endif value="Sunamganj">Sunamganj</option>
                                                <option @if($leeds->district === "Sylhet") selected @endif value="Sylhet">Sylhet</option>
                                                <option @if($leeds->district === "Tangail") selected @endif value="Tangail">Tangail</option>
                                                <option @if($leeds->district === "Thakurgaon") selected @endif value="Thakurgaon">Thakurgaon</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Zip Code</label>
                                        <div class="col-sm-9 input-group">
                                            <span class="input-group-text bg-white"><i class="fa-solid fa-code-fork" style="color:#4666ff  "></i></span>
                                            <input id="zip" type="number" class="form-control bg-white" name="zipCode" placeholder="zipcode" value="{{$leeds->zipCode}}">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Website</label>
                                        <div class="col-sm-9 input-group">
                                            <span class="input-group-text bg-white"><i class="icofont-ui-browser" style="color:#dc143c;font-size:1.2rem  "></i></span>
                                            <input id="website" type="text" class="form-control bg-white" name="website" placeholder="website" value="{{$leeds->website}}">
                                        </div>
                                    </div>
                                    <div class="form-group row mb-2">
                                        <label for="horizontal-firstname-input" class="col-sm-3 col-form-label">Logo/Photo*</label>
                                        <div class="col-sm-9 input-group">
                                            <input id="logo" type="file" class="form-control bg-white" name="logo" accept="image/*">
                                        </div>
                                    </div>
                                    <img src="{{asset($leeds->logo)}}" class="pb-2" alt="" style="height: 80px; width: 80px; margin-left: 169px"/>
                                    <div class="form-group row mb-2">
                                        <label for="country" class="col-sm-3 col-form-label">Country*</label>
                                        <div class="col-sm-9 input-group search_select_box">
                                            <span class="input-group-text bg-white"><i class="fas fa-lock"></i></span>
                                            <select id="country" class="form-control bg-white"  name="country" data-live-search="true">
                                                <option>{{$leeds->country}}</option>
                                                <option value="Afghanistan">Afghanistan</option>
                                                <option value="Åland Islands">Åland Islands</option>
                                                <option value="Albania">Albania</option>
                                                <option value="Algeria">Algeria</option>
                                                <option value="American Samoa">American Samoa</option>
                                                <option value="Andorra">Andorra</option>
                                                <option value="Angola">Angola</option>
                                                <option value="Anguilla">Anguilla</option>
                                                <option value="Antarctica">Antarctica</option>
                                                <option value="Antigua and Barbuda">Antigua and Barbuda</option>
                                                <option value="Argentina">Argentina</option>
                                                <option value="Armenia">Armenia</option>
                                                <option value="Aruba">Aruba</option>
                                                <option value="Australia">Australia</option>
                                                <option value="Austria">Austria</option>
                                                <option value="Azerbaijan">Azerbaijan</option>
                                                <option value="Bahamas">Bahamas</option>
                                                <option value="Bahrain">Bahrain</option>
                                                <option selected value="Bangladesh">Bangladesh</option>
                                                <option value="Barbados">Barbados</option>
                                                <option value="Belarus">Belarus</option>
                                                <option value="Belgium">Belgium</option>
                                                <option value="Belize">Belize</option>
                                                <option value="Benin">Benin</option>
                                                <option value="Bermuda">Bermuda</option>
                                                <option value="Bhutan">Bhutan</option>
                                                <option value="Bolivia">Bolivia</option>
                                                <option value="Bosnia and Herzegovina">Bosnia and Herzegovina</option>
                                                <option value="Botswana">Botswana</option>
                                                <option value="Bouvet Island">Bouvet Island</option>
                                                <option value="Brazil">Brazil</option>
                                                <option value="British Indian Ocean Territory">British Indian Ocean Territory</option>
                                                <option value="Brunei Darussalam">Brunei Darussalam</option>
                                                <option value="Bulgaria">Bulgaria</option>
                                                <option value="Burkina Faso">Burkina Faso</option>
                                                <option value="Burundi">Burundi</option>
                                                <option value="Cambodia">Cambodia</option>
                                                <option value="Cameroon">Cameroon</option>
                                                <option value="Canada">Canada</option>
                                                <option value="Cape Verde">Cape Verde</option>
                                                <option value="Cayman Islands">Cayman Islands</option>
                                                <option value="Central African Republic">Central African Republic</option>
                                                <option value="Chad">Chad</option>
                                                <option value="Chile">Chile</option>
                                                <option value="China">China</option>
                                                <option value="Christmas Island">Christmas Island</option>
                                                <option value="Cocos (Keeling) Islands">Cocos (Keeling) Islands</option>
                                                <option value="Colombia">Colombia</option>
                                                <option value="Comoros">Comoros</option>
                                                <option value="Congo">Congo</option>
                                                <option value="Congo, The Democratic Republic of The">Congo, The Democratic Republic of The</option>
                                                <option value="Cook Islands">Cook Islands</option>
                                                <option value="Costa Rica">Costa Rica</option>
                                                <option value="Cote D'ivoire">Cote D'ivoire</option>
                                                <option value="Croatia">Croatia</option>
                                                <option value="Cuba">Cuba</option>
                                                <option value="Cyprus">Cyprus</option>
                                                <option value="Czechia">Czechia</option>
                                                <option value="Denmark">Denmark</option>
                                                <option value="Djibouti">Djibouti</option>
                                                <option value="Dominica">Dominica</option>
                                                <option value="Dominican Republic">Dominican Republic</option>
                                                <option value="Ecuador">Ecuador</option>
                                                <option value="Egypt">Egypt</option>
                                                <option value="El Salvador">El Salvador</option>
                                                <option value="Equatorial Guinea">Equatorial Guinea</option>
                                                <option value="Eritrea">Eritrea</option>
                                                <option value="Estonia">Estonia</option>
                                                <option value="Ethiopia">Ethiopia</option>
                                                <option value="Falkland Islands (Malvinas)">Falkland Islands (Malvinas)</option>
                                                <option value="Faroe Islands">Faroe Islands</option>
                                                <option value="Fiji">Fiji</option>
                                                <option value="Finland">Finland</option>
                                                <option value="France">France</option>
                                                <option value="French Guiana">French Guiana</option>
                                                <option value="French Polynesia">French Polynesia</option>
                                                <option value="French Southern Territories">French Southern Territories</option>
                                                <option value="Gabon">Gabon</option>
                                                <option value="Gambia">Gambia</option>
                                                <option value="Georgia">Georgia</option>
                                                <option value="Germany">Germany</option>
                                                <option value="Ghana">Ghana</option>
                                                <option value="Gibraltar">Gibraltar</option>
                                                <option value="Greece">Greece</option>
                                                <option value="Greenland">Greenland</option>
                                                <option value="Grenada">Grenada</option>
                                                <option value="Guadeloupe">Guadeloupe</option>
                                                <option value="Guam">Guam</option>
                                                <option value="Guatemala">Guatemala</option>
                                                <option value="Guernsey">Guernsey</option>
                                                <option value="Guinea">Guinea</option>
                                                <option value="Guinea-bissau">Guinea-bissau</option>
                                                <option value="Guyana">Guyana</option>
                                                <option value="Haiti">Haiti</option>
                                                <option value="Heard Island and Mcdonald Islands">Heard Island and Mcdonald Islands</option>
                                                <option value="Holy See (Vatican City State)">Holy See (Vatican City State)</option>
                                                <option value="Honduras">Honduras</option>
                                                <option value="Hong Kong">Hong Kong</option>
                                                <option value="Hungary">Hungary</option>
                                                <option value="Iceland">Iceland</option>
                                                <option value="India">India</option>
                                                <option value="Indonesia">Indonesia</option>
                                                <option value="Iran, Islamic Republic of">Iran, Islamic Republic of</option>
                                                <option value="Iraq">Iraq</option>
                                                <option value="Ireland">Ireland</option>
                                                <option value="Isle of Man">Isle of Man</option>
                                                <option value="Israel">Israel</option>
                                                <option value="Italy">Italy</option>
                                                <option value="Jamaica">Jamaica</option>
                                                <option value="Japan">Japan</option>
                                                <option value="Jersey">Jersey</option>
                                                <option value="Jordan">Jordan</option>
                                                <option value="Kazakhstan">Kazakhstan</option>
                                                <option value="Kenya">Kenya</option>
                                                <option value="Kiribati">Kiribati</option>
                                                <option value="Korea, Democratic People's Republic of">Korea, Democratic People's Republic of</option>
                                                <option value="Korea, Republic of">Korea, Republic of</option>
                                                <option value="Kuwait">Kuwait</option>
                                                <option value="Kyrgyzstan">Kyrgyzstan</option>
                                                <option value="Lao People's Democratic Republic">Lao People's Democratic Republic</option>
                                                <option value="Latvia">Latvia</option>
                                                <option value="Lebanon">Lebanon</option>
                                                <option value="Lesotho">Lesotho</option>
                                                <option value="Liberia">Liberia</option>
                                                <option value="Libyan Arab Jamahiriya">Libyan Arab Jamahiriya</option>
                                                <option value="Liechtenstein">Liechtenstein</option>
                                                <option value="Lithuania">Lithuania</option>
                                                <option value="Luxembourg">Luxembourg</option>
                                                <option value="Macao">Macao</option>
                                                <option value="Macedonia, The Former Yugoslav Republic of">Macedonia, The Former Yugoslav Republic of</option>
                                                <option value="Madagascar">Madagascar</option>
                                                <option value="Malawi">Malawi</option>
                                                <option value="Malaysia">Malaysia</option>
                                                <option value="Maldives">Maldives</option>
                                                <option value="Mali">Mali</option>
                                                <option value="Malta">Malta</option>
                                                <option value="Marshall Islands">Marshall Islands</option>
                                                <option value="Martinique">Martinique</option>
                                                <option value="Mauritania">Mauritania</option>
                                                <option value="Mauritius">Mauritius</option>
                                                <option value="Mayotte">Mayotte</option>
                                                <option value="Mexico">Mexico</option>
                                                <option value="Micronesia, Federated States of">Micronesia, Federated States of</option>
                                                <option value="Moldova, Republic of">Moldova, Republic of</option>
                                                <option value="Monaco">Monaco</option>
                                                <option value="Mongolia">Mongolia</option>
                                                <option value="Montenegro">Montenegro</option>
                                                <option value="Montserrat">Montserrat</option>
                                                <option value="Morocco">Morocco</option>
                                                <option value="Mozambique">Mozambique</option>
                                                <option value="Myanmar">Myanmar</option>
                                                <option value="Namibia">Namibia</option>
                                                <option value="Nauru">Nauru</option>
                                                <option value="Nepal">Nepal</option>
                                                <option value="Netherlands">Netherlands</option>
                                                <option value="Netherlands Antilles">Netherlands Antilles</option>
                                                <option value="New Caledonia">New Caledonia</option>
                                                <option value="New Zealand">New Zealand</option>
                                                <option value="Nicaragua">Nicaragua</option>
                                                <option value="Niger">Niger</option>
                                                <option value="Nigeria">Nigeria</option>
                                                <option value="Niue">Niue</option>
                                                <option value="Norfolk Island">Norfolk Island</option>
                                                <option value="Northern Mariana Islands">Northern Mariana Islands</option>
                                                <option value="Norway">Norway</option>
                                                <option value="Oman">Oman</option>
                                                <option value="Pakistan">Pakistan</option>
                                                <option value="Palau">Palau</option>
                                                <option value="Palestinian Territory, Occupied">Palestinian Territory, Occupied</option>
                                                <option value="Panama">Panama</option>
                                                <option value="Papua New Guinea">Papua New Guinea</option>
                                                <option value="Paraguay">Paraguay</option>
                                                <option value="Peru">Peru</option>
                                                <option value="Philippines">Philippines</option>
                                                <option value="Pitcairn">Pitcairn</option>
                                                <option value="Poland">Poland</option>
                                                <option value="Portugal">Portugal</option>
                                                <option value="Puerto Rico">Puerto Rico</option>
                                                <option value="Qatar">Qatar</option>
                                                <option value="Reunion">Reunion</option>
                                                <option value="Romania">Romania</option>
                                                <option value="Russian Federation">Russian Federation</option>
                                                <option value="Rwanda">Rwanda</option>
                                                <option value="Saint Helena">Saint Helena</option>
                                                <option value="Saint Kitts and Nevis">Saint Kitts and Nevis</option>
                                                <option value="Saint Lucia">Saint Lucia</option>
                                                <option value="Saint Pierre and Miquelon">Saint Pierre and Miquelon</option>
                                                <option value="Saint Vincent and The Grenadines">Saint Vincent and The Grenadines</option>
                                                <option value="Samoa">Samoa</option>
                                                <option value="San Marino">San Marino</option>
                                                <option value="Sao Tome and Principe">Sao Tome and Principe</option>
                                                <option value="Saudi Arabia">Saudi Arabia</option>
                                                <option value="Senegal">Senegal</option>
                                                <option value="Serbia">Serbia</option>
                                                <option value="Seychelles">Seychelles</option>
                                                <option value="Sierra Leone">Sierra Leone</option>
                                                <option value="Singapore">Singapore</option>
                                                <option value="Slovakia">Slovakia</option>
                                                <option value="Slovenia">Slovenia</option>
                                                <option value="Solomon Islands">Solomon Islands</option>
                                                <option value="Somalia">Somalia</option>
                                                <option value="South Africa">South Africa</option>
                                                <option value="South Georgia and The South Sandwich Islands">South Georgia and The South Sandwich Islands</option>
                                                <option value="Spain">Spain</option>
                                                <option value="Sri Lanka">Sri Lanka</option>
                                                <option value="Sudan">Sudan</option>
                                                <option value="Suriname">Suriname</option>
                                                <option value="Svalbard and Jan Mayen">Svalbard and Jan Mayen</option>
                                                <option value="Swaziland">Swaziland</option>
                                                <option value="Sweden">Sweden</option>
                                                <option value="Switzerland">Switzerland</option>
                                                <option value="Syrian Arab Republic">Syrian Arab Republic</option>
                                                <option value="Taiwan, Province of China">Taiwan, Province of China</option>
                                                <option value="Tajikistan">Tajikistan</option>
                                                <option value="Tanzania, United Republic of">Tanzania, United Republic of</option>
                                                <option value="Thailand">Thailand</option>
                                                <option value="Timor-leste">Timor-leste</option>
                                                <option value="Togo">Togo</option>
                                                <option value="Tokelau">Tokelau</option>
                                                <option value="Tonga">Tonga</option>
                                                <option value="Trinidad and Tobago">Trinidad and Tobago</option>
                                                <option value="Tunisia">Tunisia</option>
                                                <option value="Turkey">Turkey</option>
                                                <option value="Turkmenistan">Turkmenistan</option>
                                                <option value="Turks and Caicos Islands">Turks and Caicos Islands</option>
                                                <option value="Tuvalu">Tuvalu</option>
                                                <option value="Uganda">Uganda</option>
                                                <option value="Ukraine">Ukraine</option>
                                                <option value="United Arab Emirates">United Arab Emirates</option>
                                                <option value="United Kingdom">United Kingdom</option>
                                                <option value="United States">United States</option>
                                                <option value="United States Minor Outlying Islands">United States Minor Outlying Islands</option>
                                                <option value="Uruguay">Uruguay</option>
                                                <option value="Uzbekistan">Uzbekistan</option>
                                                <option value="Vanuatu">Vanuatu</option>
                                                <option value="Venezuela">Venezuela</option>
                                                <option value="Viet Nam">Viet Nam</option>
                                                <option value="Virgin Islands, British">Virgin Islands, British</option>
                                                <option value="Virgin Islands, U.S.">Virgin Islands, U.S.</option>
                                                <option value="Wallis and Futuna">Wallis and Futuna</option>
                                                <option value="Western Sahara">Western Sahara</option>
                                                <option value="Yemen">Yemen</option>
                                                <option value="Zambia">Zambia</option>
                                                <option value="Zimbabwe">Zimbabwe</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 bg-white">
                            <div class="col-sm-12">
                                <div class="card bg-white">
                                    <div class="card-header">
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row mb-2">
                                            <label for="name" class="col-sm-4 col-form-label">Client Priority<span style='color: red;'>*</span></label>
                                            <div class="col-sm-8 input-group search_select_box ">
                                                <span class="input-group-text bg-white"><i class="fa-solid fa-anchor-circle-xmark fa-lg" style="color:#4666ff"></i></span>
                                                <select class="form-control  bg-white" required name="clientPriority" placeholder="priority" data-live-search="true">
                                                    <option>Select Priority</option>
                                                    <option @if($leeds->clientPriority === "Important") selected @endif value="Important">Important</option>
                                                    <option @if($leeds->clientPriority === "Normal") selected @endif value="Normal">Normal</option>
                                                    <option @if($leeds->clientPriority === "Emergency") selected @endif value="Emergency">Emergency</option>
                                                    <option @if($leeds->clientPriority === "Rejected") selected @endif value="Rejected">Rejected</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="name" class="col-sm-4 col-form-label">Client Value<span style='color: red;'>*</span></label>
                                            <div class="col-sm-8 input-group search_select_box">
                                                <span class="input-group-text bg-white"><i class="fa-solid fa-hill-avalanche fa-lg" style="color:#dc143c"></i></span>
                                                <select class="form-control  bg-white" required name="clientValue" placeholder="value" data-live-search="true">
                                                    <option>Select Value</option>
                                                    <option @if($leeds->clientValue === "Low") selected @endif value="Low">Low</option>
                                                    <option @if($leeds->clientValue === "Medium") selected @endif value="Medium">Medium</option>
                                                    <option @if($leeds->clientValue === "High") selected @endif value="High">High</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="card bg-white">
                                    <div class="card-body">
                                        <div class="form-group row mb-2">
                                            <label for="name" class="col-sm-4 col-form-label">Source<span style='color: red;'>*</span></label>
                                            <div class="col-sm-8 input-group search_select_box">
                                                <span class="input-group-text bg-white"><i class="fa-brands fa-sourcetree fa-lg" style="color:#dc143c"></i></span>
                                                <select id="source" required class="form-control bg-white"  name="source" data-live-search="true">
                                                    <option>select source</option>
                                                    <option @if($leeds->source === "Google") selected @endif>Google</option>
                                                    <option @if($leeds->source === "Facebook") selected @endif>Facebook</option>
                                                    <option @if($leeds->source === "Twitter") selected @endif>Twitter</option>
                                                    <option @if($leeds->source === "LinkedIN") selected @endif>LinkedIN</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="" class="col-sm-4 col-form-label">AssignedTo<span style='color: red;'>*</span></label>
                                            <div class="col-sm-8 input-group search_select_box">
                                                <span class="input-group-text bg-white"><i class="fa-brands fa-atlassian fa-lg" style="color:#4666ff "></i></span>
                                                <select class="form-control" required name="assignedTo" data-live-search="true">
                                                    <option>Select Value</option>
                                                    @foreach($users as $user)
                                                        <option @if($user->id === $username ->id) selected @endif value="{{$user->id}}">{{$user->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="horizontal-firstname-input" class="col-sm-4 col-form-label">Comment</label>
                                            <div class="col-sm-8 input-group">
                                                <span class="input-group-text bg-white"><i class="fa-solid fa-comment fa-lg" style="color:#4666ff"></i></span>
                                                <textarea type="text" id="description" class="form-control bg-white" name="comment" placeholder="comment">{{$leeds->comment}}</textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row mb-2">
                                            <label for="name" class="col-sm-4 col-form-label">Status</label>
                                            <div class="col-sm-8 input-group search_select_box">
                                                <span class="input-group-text bg-white"><i class="fa-solid fa-arrow-up-from-water-pump fa-lg" style="color:#dc143c"></i></span>
                                                <select id="status" class="form-control " name="status" data-live-search="true">
                                                    <option>select</option>
                                                    <option @if($leeds->status === "Active") selected @endif>Active</option>
                                                    <option @if($leeds->status === "Inactive") selected @endif>Inactive</option>
                                                    <option @if($leeds->status === "New") selected @endif>New</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div>
                        <button type="submit" class="btn btn-success" style="margin-left: 647px">Update</button>
                    </div>
                </div>
            </form>
        </section>
    </div>
    <!-- /.content-wrapper -->
@endsection
