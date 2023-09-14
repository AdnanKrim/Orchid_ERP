<?php

namespace App\Http\Controllers\Hrm;
use App\Models\HRMS\Contract;
use App\Models\HRMS\Department;
use App\Models\HRMS\Designation;
use App\Models\HRMS\Immigration;
use App\Models\HRMS\EmergencyContact;
use App\Models\HRMS\Leave;
use App\Models\HRMS\Location;
use App\Models\HRMS\SocialNetworking;
use App\Models\HRMS\WorkExperience;
use App\Models\HRMS\Qualification;
use App\Models\HRMS\Document;
use App\Models\HRMS\Shift;
use App\Models\HRMS\BankAccount;
use App\Models\HRMS\Shift\HrmShift;
use App\Models\CRM\Role;
use App\Models\User;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function empCreateForm(){
        $deparments = Department::all();
        $designation = Designation::all();
        $roles = Role::all();
        $shifts = HrmShift::all();
        return view('Hrm.Employee.addEmp')->with('departments',$deparments)->with('designations',$designation)->with('roles',$roles)->with('shifts',$shifts);
    }

    public function empCreate(Request $request){
        $userCheck = User::where('email',$request->email)->first();

        if($userCheck){
            return  redirect()->route('empList')->with('Create_Message', 'Email Already Used');
        }
        else{
            $user = new User();
            $user->name = $request->name;
            $user->dateOfJoining = $request->joining;
            $user->departmentId = $request->dept;
            $user->designationId = $request->designation;
            $user->roleId = $request->role;
            $user->gender = $request->gender;
            $user->dateOfBarth = $request->dob;
            if($request->hasfile('image')){
                $nameImage = $request->file('image')->getClientOriginalName();
                $folder = $request->file('image')->move(public_path('employeeImages').'/',$nameImage);
            }
            else{
                $nameImage = "index.png";
            }
            $user->photo = $nameImage;
            $user->phone = $request->phone;
            $user->email = $request->email;
            $user->BasicSalary = $request->salary;
            $user->otRate = $request->otRate;
            $user->shift = $request->shiftName;
            $user->offDays = json_encode($request->offDay);
            $user->Status = $request->status;
            $user->loginIllegible = 0;
                $userSave = $user->save();
                $deptName = Department::where('id',$request->dept)->first();
                $user->employeeId = $deptName->departmentName . '-'. $user->id ;
                $result = $user->save();
                if($result){
                    return  redirect()->route('empList')->with('Create_Message', 'Employee Added Successfully');
                }
        }
    }

    public function empList(){
        $users = User::all();
        $dept = Department::all();
        $designation = Designation::all();
        $roles = Role::all();
        return view('Hrm.Employee.empList')->with('users',$users)->with('departments',$dept)->with('designations',$designation)->with('roles',$roles);
    }

    public function getEmployee(Request $request){
        $user = User::where('id',$request->id)->first();
        $departments = Department::all();
        $departmentName = Department::where('id',$user->departmentId)->first();
        $designations = Designation::all();
        $designationName = Designation::where('id',$user->designationId)->first();
        $roles = Role::all();
        $roleName = Role::where('id',$user->roleId)->first();
        $shifts = HrmShift::all();
        $shiftName = HrmShift::where('shiftName',$user->shift)->first();
        $offDays = json_decode($user->offDays);

        return view('Hrm.Employee.basicInfo')->with('user',$user)->with('departments',$departments)->with('departmentName',$departmentName)->with('designations',$designations)->with('designationName',$designationName)->with('roles',$roles)->with('roleName',$roleName)->with('shifts',$shifts)->with('shiftName',$shiftName)->with('offDays',$offDays);
    }

    public function updateEmployee(Request $request){
        $user = User::where('id',$request->id)->first();
        $user->name = $request->name;
        $user->dateOfJoining = $request->joining;
        $user->departmentId = $request->dept;
        $user->designationId = $request->designation;
        $user->roleId = $request->role;
        $user->gender = $request->gender;
        $user->dateOfBarth = $request->dob;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->BasicSalary = $request->salary;
        $user->otRate = $request->otRate;
        $user->shift = $request->shiftName;
        $user->offDays = json_encode($request->offDay);
        $user->Status = $request->status;
        $result = $user->save();
        if ($result) {
            return  redirect()->route('empList')->with('Update_Message', 'Employee Updated Successfully');
        }
    }
    public function GetEmployeeInfo(Request $request){
        $employee = User::where('id',$request->id)->first();
        return $employee;
    }
    public function DeleteEmployee(Request $request){
        $employee = User::where('id',$request->id)->delete();
        return  redirect()->route('empList')->with('Delete_Message', 'Employee Updated Successfully');
    }

    public function getImage(Request $request){
        $user = User::where('id',$request->id)->first();
        return view('Hrm.Employee.updateImage')->with('user',$user);
    }

    public function getPassword(Request $request){
        $user = User::where('id',$request->id)->first();
        return view('Hrm.Employee.updatePass')->with('user',$user);
    }

    public function imageUpdate(Request $request){
        $user = User::where('id',$request->id)->first();
        if($request->hasfile('image')){
            $nameImage = $request->file('image')->getClientOriginalName();
            $folder = $request->file('image')->move(public_path('employeeImages').'/',$nameImage);
        }
        $user->photo = $nameImage;
        $res = $user->save();
        if($res){
            return  redirect()->route('empList')->with('Update_Message', 'Employee Updated Successfully');
        }
    }

    public function changePassword(Request $request){
        $user = User::where('id',$request->id)->first();
        $user->password = bcrypt($request->npass);
        if($request->npass === $request->cpass){
            $res = $user->save();
            if($res){
                return  redirect()->route('empList')->with('Update_Message', 'Employee Updated Successfully');
            }
        }
        else{
            return  redirect()->back();
        }
    }
    public function Immigration(Request $request){
        $user = User::where('id',$request->id)->first();
        $immigrations = Immigration::where('EmployeeId',$user->id)->get();
        return view('Hrm.Employee.Immigration')->with('user',$user)->with('immigrations',$immigrations);
    }
    public function EmergencyContact(Request $request){
        $user = User::where('id',$request->id)->first();
        $econtacts = EmergencyContact::where('EmployeeId',$user->id)->get();
        return view('Hrm.Employee.EmergencyContact')->with('user',$user)->with('econtacts',$econtacts);
    }
    public function socialNetwork(Request $request){
        $user = User::where('id',$request->id)->first();
        $sn = socialNetworking::where('EmployeeId',$request->id)->first();
        return view('Hrm.Employee.socialNetworking')->with('user',$user)->with('sn',$sn);
    }
    public function document(Request $request){
        $user = User::where('id',$request->id)->first();
        $documents = Document::where('EmployeeId',$user->id)->get();
        return view('Hrm.Employee.Document')->with('user',$user)->with('documents',$documents);
    }
    public function qualification(Request $request){
        $user = User::where('id',$request->id)->first();
        $qualifications = Qualification::where('EmployeeId',$user->id)->get();
        return view('Hrm.Employee.Qualification')->with('user',$user)->with('qualifications',$qualifications);
    }
    public function bankAccount(Request $request){
        $user = User::where('id',$request->id)->first();
        $banks = bankAccount::where('EmployeeId',$user->id)->get();
        return view('Hrm.Employee.bankAccount')->with('user',$user)->with('banks',$banks);
    }
    public function contract(Request $request){
        $user = User::where('id',$request->id)->first();
        $contracts = Contract::where('EmployeeId',$user->id)->get();
        return view('Hrm.Employee.contract')->with('user',$user)->with('contracts',$contracts);
    }
    public function leave(Request $request){
        $user = User::where('id',$request->id)->first();
        $leaves = Leave::where('EmployeeId',$user->id)->get();
        return view('Hrm.Employee.leave')->with('user',$user)->with('leaves',$leaves);
    }
    public function Shift(Request $request){
        $user = User::where('id',$request->id)->first();
        $shift = Shift::where('EmployeeId',$request->id)->first();
        return view('Hrm.Employee.shift')->with('user',$user)->with('shift',$shift);
    }
    public function Location(Request $request){
        $user = User::where('id',$request->id)->first();
        $locations = Location::where('EmployeeId',$user->id)->get();
        return view('Hrm.Employee.location')->with('user',$user)->with('locations',$locations);
    }
    public function WorkExperience(Request $request){
        $user = User::where('id',$request->id)->first();
        $experiences = WorkExperience::where('EmployeeId',$user->id)->get();
        return view('Hrm.Employee.workExperience')->with('user',$user)->with('experiences',$experiences);
    }
    public function ImmigrationPost(Request $request){

        $validate = $request->validate([
            'document'=>'required',
            'issue'=>'required',
            'expiry'=>'required',
            'documentNumber'=>'required',
            'reviewDate'=>'required',
            'country'=>'required',
            'documentPic'=>'required',

        ]);
        if ($request->issue < $request->expiry) {
            $immigration = new Immigration();
            $immigration->EmployeeId = $request->id;
            $immigration->DocumentType = $request->document;
            $immigration->IssueDate = $request->issue;
            $immigration->ExpiryDate = $request->expiry;
            $immigration->DocumentNumber = $request->documentNumber;
            $immigration->ReviewDate = $request->reviewDate;
            $immigration->Country = $request->country;
            if ($request->hasfile('documentPic')) {
                $documentFile = $request->file('documentPic')->getClientOriginalName();
                $folder = $request->file('documentPic')->move(public_path('Immigration_Images') . '/', $documentFile);
            } else {
                $documentFile = "";
            }
            $immigration->DocumentFile = $documentFile;
            $result = $immigration->save();
            if ($result) {
                return redirect()->back()->with('Create_Message', 'Immigration Added Successfully');
            }
        }
        else{
            return redirect()->back()->with('Error_Message', 'Invalid Expiry Date');
        }
    }

    public function EcontactPost(Request $request){
        $user = User::where('id',$request->id)->first();
        $econtact = new EmergencyContact();
        $econtact->EmployeeId = $request->id;
        $econtact->Relation = $request->relation;
        $econtact->RelationType = json_encode($request->contactType);
        $econtact->WorkEmail = $request->WorkEmail;
        $econtact->PersonalEmail = $request->PersonalEmail;
        $econtact->Name = $request->name;
        $econtact->WorkPhone = $request->ext . $request->workPhone;
        $econtact->MobilePhone = $request->mobilePhone;
        $econtact->HomePhone = $request->homePhone;
        $econtact->Address1 = $request->address1;
        $econtact->Address2 = $request->address2;
        $econtact->State = $request->state;
        $econtact->City = $request->city;
        $econtact->Country = $request->country;
        $result = $econtact->save();
        if ($result) {
            return  redirect()->back()->with('Create_Message', 'Emergency Contact Added Successfully');
        }
    }
    public function socialNetworkPost(Request $request){
        $check = socialNetworking::where('EmployeeId',$request->id)->first();
        if($check){
            $check->facebookProfile = $request->fbprofile;
            $check->twitterProfile = $request->twitterProfile;
            $check->bloggerProfile = $request->bloggerProfile;
            $check->linkedinProfile = $request->linkedinprofile;
            $check->googlePlusProfile = $request->googleProfile;
            $check->instagramProfile = $request->intagramprofile;
            $check->pinterestProfile = $request->PinterestProfile;
            $check->youtubeProfile = $request->youtubeProfile;
            $result = $check->save();
             if ($result) {
                return  redirect()->back()->with('Update_Message', 'Social Network Update Successfully');
            }
        }
        else{
        $sn = new socialNetworking();
        $sn->EmployeeId = $request->id;
        $sn->facebookProfile = $request->fbprofile;
        $sn->twitterProfile = $request->twitterProfile;
        $sn->bloggerProfile = $request->bloggerProfile;
        $sn->linkedinProfile = $request->linkedinprofile;
        $sn->googlePlusProfile = $request->googleProfile;
        $sn->instagramProfile = $request->intagramprofile;
        $sn->pinterestProfile = $request->PinterestProfile;
        $sn->youtubeProfile = $request->youtubeProfile;
        $result = $sn->save();
        if ($result) {
            return  redirect()->back()->with('Create_Message', 'Social Network Added Successfully');
        }
    }
    }
    public function DocumentPost(Request $request){
        $doc = new Document();
        $doc->EmployeeId = $request->id;
        $doc->documentType = $request->dtype;
        $doc->title = $request->dtitle;
        $doc->notificationEmail = $request->notEmail;
        $doc->dateOfExpiry = $request->doe;
        if ($request->hasfile('documentPic')) {
            $documentFile = $request->file('documentPic')->getClientOriginalName();
            $folder = $request->file('documentPic')->move(public_path('EmpDocuments') . '/', $documentFile);
        } else {
            $documentFile = "";
        }
        $doc->documentFile = $documentFile;
        $doc->notificationAfterExpire = $request->expNotification;
        $doc->description = $request->description;
        $result = $doc->save();
        if ($result) {
            return  redirect()->back()->with('Create_Message', 'Document Added Successfully');
        }
        else{
            return  redirect()->back()->with('Update_Message', 'Document Added Successfully');
        }

    }

    public function WorkExperiencePost(Request $request){
        $validate = $request->validate([
            'name'=>'required',
            'post'=>'required',
            'from'=>'required',
            'to'=>'required',
        ]);
        if($request->from < $request->to){
        $we = new WorkExperience();
        $we->EmployeeId = $request->id;
        $we->CompanyName = $request->name;
        $we->From = $request->from;
        $we->To = $request->to;
        $we->Post = $request->post;
        $we->Description = $request->description;
        $result = $we->save();
        if ($result) {
            return  redirect()->back()->with('Create_Message', 'Work Experience Added Successfully');
        }
    }
    else{
        return redirect()->back()->with('Error_Message', 'Invalid Expiry Date');
    }
    }
    public function QualificationPost(Request $request){
        $validate = $request->validate([
            'school'=>'required',
            'eduLevel'=>'required',
            'from'=>'required',
            'to'=>'required',
            'language'=>'required',
        ]);
        if($request->from < $request->to){
        $qualification = new Qualification();
        $qualification->EmployeeId = $request->id;
        $qualification->Institution = $request->school;
        $qualification->From = $request->from;
        $qualification->To = $request->to;
        $qualification->EducationLevel = $request->eduLevel;
        $qualification->Language = $request->language;
        $qualification->ProfessionalCertificate = $request->pcourse;
        $qualification->Description = $request->description;
        $result = $qualification->save();
        if ($result) {
            return  redirect()->back()->with('Create_Message', 'Qualification Added Successfully');
        }
    }
    else{
        return redirect()->back()->with('Error_Message', 'Invalid Expiry Date');
    }

    }

    public function shiftPost(Request $request){
        $check = Shift::where('EmployeeId',$request->id)->first();
        if($check){
            $check->From = $request->from;
            $check->To = $request->to;
            $check->Shift = $request->shift;
            $result = $check->save();
             if ($result) {
                return  redirect()->back()->with('Update_Message', 'Shift Update Successfully');
            }
        }
        else{
        $shift = new Shift();
        $shift->EmployeeId = $request->id;
        $shift->From = $request->from;
        $shift->To = $request->to;
        $shift->Shift = $request->shift;
        $result = $shift->save();
        if ($result) {
            return  redirect()->back()->with('Create_Message', 'Shift Added Successfully');
        }
    }
    }

    public function BankAccountPost(Request $request){
        $validate = $request->validate([
            'atype'=>'required',
            'bname'=>'required',
            'anumber'=>'required',
            'bcode'=>'required',
            'branch'=>'required',
        ]);
        $bank = new BankAccount();
        $bank->EmployeeId = $request->id;
        $bank->AccountType = $request->atype;
        $bank->BankName = $request->bname;
        $bank->AccountNumber = $request->anumber;
        $bank->BankCode = $request->bcode;
        $bank->BankBranch = $request->branch;
        $result = $bank->save();
        if ($result) {
            return  redirect()->back()->with('Create_Message', 'Bank Account Added Successfully');
        }

    }

    public function ContractPost(Request $request){
        if($request->from < $request->to){
        $contract = new Contract();
        $contract->EmployeeId = $request->id;
        $contract->ContractType = $request->ctype;
        $contract->ContractTitle = $request->ctitle;
        $contract->From = $request->from;
        $contract->To = $request->to;
        $contract->Designation = $request->designation;
        $contract->Description = $request->description;
        $result = $contract->save();
        if ($result) {
            return  redirect()->back()->with('Create_Message', 'Contract Added Successfully');
        }
    }
    else{
        return redirect()->back()->with('Error_Message', 'Invalid Expiry Date');
    }
    }

    public function LeavePost(Request $request){
        $leave = new Leave();
        $leave->EmployeeId = $request->id;
        $leave->Contract = $request->contract;
        $leave->CasualLeave = $request->casual;
        $leave->MedicalLeave = $request->medical;
        $result = $leave->save();
        if ($result) {
            return  redirect()->back()->with('Create_Message', 'Leave Information Added Successfully');
        }

    }

    public function LocationPost(Request $request){
        if($request->from < $request->to){
        $location = new Location();
        $location->EmployeeId = $request->id;
        $location->From = $request->from;
        $location->To = $request->to;
        $location->Location = $request->location;
        $result = $location->save();
        if ($result) {
            return  redirect()->back()->with('Create_Message', 'Location Information Added Successfully');
        }
    }
    else{
        return  redirect()->back()->with('Error_Message', 'Location Information Added Successfully');
    }
    }
    public function GetImmigration(Request $request){
        $immigration = Immigration::where('id',$request->id)->first();
        return $immigration;
    }
    public function DeleteImmigration(Request $request){
        $immigration = Immigration::where('id',$request->id)->delete();
        return  redirect()->back()->with('Delete_Message', 'Location Information Added Successfully');
    }

    public function GetEmergencyContact(Request $request){
        $ec = EmergencyContact::where('id',$request->id)->first();
        return $ec;
    }
    public function DeleteEmergencyContact(Request $request){
        $ec = EmergencyContact::where('id',$request->id)->delete();
        return  redirect()->back()->with('Delete_Message', 'Emergency Contact Information Added Successfully');
    }

    public function GetDocument(Request $request){
        $document = Document::where('id',$request->id)->first();
        return $document;
    }
    public function DeleteDocument(Request $request){
        $document = Document::where('id',$request->id)->delete();
        return  redirect()->back()->with('Delete_Message', 'Document Information Deleted Successfully');
    }

    public function GetQualification(Request $request){
        $qualification = Qualification::where('id',$request->id)->first();
        return $qualification;
    }
    public function DeleteQualification(Request $request){
        $qualification = Qualification::where('id',$request->id)->delete();
        return  redirect()->back()->with('Delete_Message', 'Qualification Information Deleted Successfully');
    }

    public function GetWorkExperience(Request $request){
        $we = WorkExperience::where('id',$request->id)->first();
        return $we;
    }
    public function DeleteWorkExperience(Request $request){
        $we = WorkExperience::where('id',$request->id)->delete();
        return  redirect()->back()->with('Delete_Message', 'Work Experience Information Deleted Successfully');
    }
    public function GetBankAccount(Request $request){
        $ba = BankAccount::where('id',$request->id)->first();
        return $ba;
    }
    public function DeleteBankAccount(Request $request){
        $ba = BankAccount::where('id',$request->id)->delete();
        return  redirect()->back()->with('Delete_Message', 'Bank Account Information Deleted Successfully');
    }
    public function GetContract(Request $request){
        $contract = Contract::where('id',$request->id)->first();
        return $contract;
    }
    public function DeleteContract(Request $request){
        $contract = Contract::where('id',$request->id)->delete();
        return  redirect()->back()->with('Delete_Message', 'Contract Information Deleted Successfully');
    }
    public function GetLeave(Request $request){
        $leave = Leave::where('id',$request->id)->first();
        return $leave;
    }
    public function DeleteLeave(Request $request){
        $leave = Leave::where('id',$request->id)->delete();
        return  redirect()->back()->with('Delete_Message', 'location Information Deleted Successfully');
    }
    public function GetLocation(Request $request){
        $location = Location::where('id',$request->id)->first();
        return $location;
    }
    public function DeleteLocation(Request $request){
        $location = Location::where('id',$request->id)->delete();
        return  redirect()->back()->with('Delete_Message', 'location Information Deleted Successfully');
    }
    public function ImmigrationUpdate(Request $request){

        $validate = $request->validate([
            'document'=>'required',
            'issue'=>'required',
            'expiry'=>'required',
            'documentNumber'=>'required',
            'reviewDate'=>'required',
            'country'=>'required',
        ]);
        if ($request->issue < $request->expiry) {
            $immigration = Immigration::where('id',$request->immigrationId)->first();
            $immigration->EmployeeId = $request->id;
            $immigration->DocumentType = $request->document;
            $immigration->IssueDate = $request->issue;
            $immigration->ExpiryDate = $request->expiry;
            $immigration->DocumentNumber = $request->documentNumber;
            $immigration->ReviewDate = $request->reviewDate;
            $immigration->Country = $request->country;
            if ($request->hasfile('documentPic')) {
                $documentFile = $request->file('documentPic')->getClientOriginalName();
                $folder = $request->file('documentPic')->move(public_path('Immigration_Images') . '/', $documentFile);
            } else {
                $documentFile = $immigration->DocumentFile;
            }
            $immigration->DocumentFile = $documentFile;
            $result = $immigration->save();
            if ($result) {
                return redirect()->back()->with('Update_Message', 'Immigration Update_Message Successfully');
            }
        }
        else{
            return redirect()->back()->with('Error_Message', 'Invalid Expiry Date');
        }
    }
    public function LocationUpdate(Request $request){
        if($request->from < $request->to){
        $location = Location::where('id',$request->locationId)->first();
        $location->From = $request->from;
        $location->To = $request->to;
        $location->Location = $request->location;
        $result = $location->save();
        if ($result) {
            return  redirect()->back()->with('Update_Message', 'Location Information Update Successfully');
        }
    }
    else{
        return  redirect()->back()->with('Error_Message', 'Location Information Added Successfully');
    }
    }

    public function LeaveUpdate(Request $request){
        $leave = Leave::where('id',$request->leaveId)->first();
        $leave->EmployeeId = $request->id;
        $leave->Contract = $request->contract;
        $leave->CasualLeave = $request->casual;
        $leave->MedicalLeave = $request->medical;
        $result = $leave->save();
        if ($result) {
            return  redirect()->back()->with('Update_Message', 'Leave Information Update Successfully');
        }

    }

    public function ContractUpdate(Request $request){
        if($request->from < $request->to){
        $contract = Contract::where('id',$request->contractId)->first();
        $contract->EmployeeId = $request->id;
        $contract->ContractType = $request->ctype;
        $contract->ContractTitle = $request->ctitle;
        $contract->From = $request->from;
        $contract->To = $request->to;
        $contract->Designation = $request->designation;
        $contract->Description = $request->description;
        $result = $contract->save();
        if ($result) {
            return  redirect()->back()->with('Update_Message', 'Contract Update Successfully');
        }
    }
    else{
        return redirect()->back()->with('Error_Message', 'Invalid Expiry Date');
    }
    }
    public function BankAccountUpdate(Request $request){
        $validate = $request->validate([
            'atype'=>'required',
            'bname'=>'required',
            'anumber'=>'required',
            'bcode'=>'required',
            'branch'=>'required',
        ]);
        $bank = BankAccount::where('id',$request->bankId)->first();
        $bank->EmployeeId = $request->id;
        $bank->AccountType = $request->atype;
        $bank->BankName = $request->bname;
        $bank->AccountNumber = $request->anumber;
        $bank->BankCode = $request->bcode;
        $bank->BankBranch = $request->branch;
        $result = $bank->save();
        if ($result) {
            return  redirect()->back()->with('Update_Message', 'Bank Account Added Successfully');
        }

    }
    public function WorkExperienceUpdate(Request $request){
        $validate = $request->validate([
            'name'=>'required',
            'post'=>'required',
            'from'=>'required',
            'to'=>'required',
        ]);
        if($request->from < $request->to){
        $we = WorkExperience::where('id',$request->workId)->first();
        $we->EmployeeId = $request->id;
        $we->CompanyName = $request->name;
        $we->From = $request->from;
        $we->To = $request->to;
        $we->Post = $request->post;
        $we->Description = $request->description;
        $result = $we->save();
        if ($result) {
            return  redirect()->back()->with('Update_Message', 'Work Experience Updated Successfully');
        }
    }
    else{
        return redirect()->back()->with('Error_Message', 'Invalid Expiry Date');
    }
    }
    public function QualificationUpdate(Request $request){
        $validate = $request->validate([
            'school'=>'required',
            'eduLevel'=>'required',
            'from'=>'required',
            'to'=>'required',
            'language'=>'required',
        ]);
        if($request->from < $request->to){
        $qualification = Qualification::where('id',$request->qualificationId)->first();
        $qualification->EmployeeId = $request->id;
        $qualification->Institution = $request->school;
        $qualification->From = $request->from;
        $qualification->To = $request->to;
        $qualification->EducationLevel = $request->eduLevel;
        $qualification->Language = $request->language;
        $qualification->ProfessionalCertificate = $request->pcourse;
        $qualification->Description = $request->description;
        $result = $qualification->save();
        if ($result) {
            return  redirect()->back()->with('Update_Message', 'Qualification Added Successfully');
        }
    }
    else{
        return redirect()->back()->with('Error_Message', 'Invalid Expiry Date');
    }

    }

    public function DocumentUpdate(Request $request){
        $doc = Document::where('id',$request->documentId)->first();
        $doc->EmployeeId = $request->id;
        $doc->documentType = $request->dtype;
        $doc->title = $request->dtitle;
        $doc->notificationEmail = $request->notEmail;
        $doc->dateOfExpiry = $request->doe;
        if ($request->hasfile('documentPic')) {
            $documentFile = $request->file('documentPic')->getClientOriginalName();
            $folder = $request->file('documentPic')->move(public_path('EmpDocuments') . '/', $documentFile);
        } else {
            $documentFile = $doc->documentFile;
        }
        $doc->documentFile = $documentFile;
        $doc->notificationAfterExpire = $request->expNotification;
        $doc->description = $request->description;
        $result = $doc->save();
        if ($result) {
            return  redirect()->back()->with('Update_Message', 'Document Added Successfully');
        }

    }

    public function EcontactUpdate(Request $request){
        $user = User::where('id',$request->id)->first();
        $econtact = EmergencyContact::where('id',$request->econtactId)->first();
        $econtact->EmployeeId = $request->id;
        $econtact->Relation = $request->relation;
        $econtact->RelationType = json_encode($request->contactType);
        $econtact->WorkEmail = $request->WorkEmail;
        $econtact->PersonalEmail = $request->PersonalEmail;
        $econtact->Name = $request->name;
        $econtact->WorkPhone = $request->ext . $request->workPhone;
        $econtact->MobilePhone = $request->mobilePhone;
        $econtact->HomePhone = $request->homePhone;
        $econtact->Address1 = $request->address1;
        $econtact->Address2 = $request->address2;
        $econtact->State = $request->state;
        $econtact->City = $request->city;
        $econtact->Country = $request->country;
        $result = $econtact->save();
        if ($result) {
            return  redirect()->back()->with('Update_Message', 'Emergency Contact Added Successfully');
        }
    }


}
