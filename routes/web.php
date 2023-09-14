<?php

use App\Http\Controllers\Account\AccountChartController;
use App\Http\Controllers\Account\AccountGroupController;
use App\Http\Controllers\Account\AccountTypeController;
use App\Http\Controllers\Account\generalLedgerController;
use App\Http\Controllers\Account\JournalEntry\AdjustingJournalController;
use App\Http\Controllers\Account\JournalEntry\GeneralJournalController;
use App\Http\Controllers\Hrm\Other\IncrementController;
use App\Http\Controllers\inventory\stockAdjustmentController;
use App\Http\Controllers\inventory\stockTransferController;
use App\Http\Controllers\Report\ProfitAndLossController;
use App\Http\Controllers\Report\BalanceReportController;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\HtDepDrop;
use App\Http\Controllers\CRM\LeedsController;
use App\Http\Controllers\CRM\LeedsGroupController;
use App\Http\Controllers\CRM\ClientController;
use App\Http\Controllers\Project\ProjectCategoryController;
use App\Http\Controllers\Project\ProjectDealController;
use App\Http\Controllers\Project\ProjectEstimateController;
use App\Http\Controllers\Role\RoleController;
use App\Http\Controllers\CRM\SuccessLeedsPanelController;
use App\Http\Controllers\CRM\QuotationController;
use App\Http\Controllers\CRM\MeasureController;
use App\Http\Controllers\product\ProductController;
use App\Http\Controllers\product\CategoryController;
use App\Http\Controllers\product\SubController;
use App\Http\Controllers\product\UnitController;
use App\Http\Controllers\product\BrandController;
use App\Http\Controllers\product\ModelController;
use App\Http\Controllers\product\SizeController;
use App\Http\Controllers\product\ColorController;
use App\Http\Controllers\supplier\SupplierController;
use App\Http\Controllers\Purchase\PurchaseTypeController;
use App\Http\Controllers\Purchase\PurchaseController;
use App\Http\Controllers\Purchase\PurchaseReturnController;
use App\Http\Controllers\FollowUp\FollowUpController;
use App\Http\Controllers\inventory\StockController;
//use App\Http\Controllers\CRM\PaymentController;
use App\Http\Controllers\Labour\LabourController;
use App\Http\Controllers\Setting\SettingController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Menu\MenuController;
use App\Http\Controllers\Menu\SubmenuController;
use App\Http\Controllers\Menu\SubSubmenuController;
use App\Http\Controllers\MenuPermission\MenuPermissionController;
use App\Http\Controllers\CRM\DesignController;
use App\Http\Controllers\Hrm\DepartmentController;
use App\Http\Controllers\Hrm\DesignationController;
use App\Http\Controllers\Hrm\EmployeeController;
use App\Http\Controllers\Hrm\Other\TransfersController;
use App\Http\Controllers\Hrm\Other\ResignationController;
use App\Http\Controllers\Hrm\Other\PromotionController;
use App\Http\Controllers\Hrm\Other\ComplaintsController;
use App\Http\Controllers\Hrm\Other\TerminationController;
use App\Http\Controllers\Hrm\Leave\HolidayController;
use App\Http\Controllers\Hrm\Leave\LeaveTypeController;
use App\Http\Controllers\Hrm\Leave\LeavePurposeController;
use App\Http\Controllers\Hrm\Leave\ApplyLeaveController;
use App\Http\Controllers\Hrm\Leave\employeeLeaveBalanceController;
use App\Http\Controllers\Hrm\Payroll\PayrollTypeController;
use App\Http\Controllers\Hrm\Payroll\PayrollGenerateController;
use App\Http\Controllers\Hrm\Payroll\GeneratePayslipController;
use App\Http\Controllers\Hrm\Payroll\AdvanceSalaryController;
use App\Http\Controllers\Hrm\Loan\GrantLoanController;
use App\Http\Controllers\Hrm\Loan\LoanInstallmentController;
use App\Http\Controllers\Hrm\Shift\ShiftController;
use App\Http\Controllers\Hrm\Attendance\DailyAttendanceController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\CRM\DeedController;
use App\Http\Controllers\Sales\SalesController;
use App\Http\Controllers\Bank\bankController;
use App\Http\Controllers\Bank\DepositController;
use App\Http\Controllers\Bank\WithdrawController;
use App\Http\Controllers\Account\AccountController;
use App\Http\Controllers\Expense\ExpCategoryController;
use App\Http\Controllers\Expense\ExpenseController;
use App\Http\Controllers\Transfer\TransferController;
use App\Http\Controllers\Payment\SupplierPaymentController;
use App\Http\Controllers\PrinterBill\Pb_ColorController;
use App\Http\Controllers\PrinterBill\Pb_DecorationTypeController;
use App\Http\Controllers\PrinterBill\Pb_HouseAreaTypeController;
use App\Http\Controllers\PrinterBill\Pb_ColorQuantityController;
use App\Http\Controllers\Report\SalesReportController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::group(['name' => 'Home', 'middleware' => 'auth'], function() {
    Route::get('/', [App\Http\Controllers\HomeController::class, 'log'])->name('log');
    Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'log'])->name('dashboard');
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});
Route::group(['name' => 'CRM_leeds', 'middleware' => 'auth'], function() {
    Route::get('/leeds', [LeedsController::class, 'index'])->name('leeds');
    Route::post('/newLeeds', [LeedsController::class, 'create'])->name('newLeeds');
    Route::get('/leedsList', [LeedsController::class, 'leedlist'])->name('leedsList');
    Route::get('/editLeeds/{id}', [LeedsController::class, 'edit'])->name('editLeeds');
    Route::post('/updateLeeds/{id}', [LeedsController::class, 'update'])->name('updateLeeds');
    Route::post('/deleteLeeds', [LeedsController::class, 'delete'])->name('deleteLeeds');
    Route::get('/getLeeds/{id}', [LeedsController::class, 'getLeed'])->name('getLeeds');
    Route::get('/promote-demote-leed/{id}', [LeedsController::class, 'promoteDemoteLeed'])->name('promote-demote-leed');
});
Route::group(['name' => 'CRM_leedsGroup', 'middleware' => 'auth'], function() {
    Route::get('/allLeedsGroup', [LeedsGroupController::class, 'groupList'])->name('allLeedsGroup');
    Route::get('/add-group', [LeedsGroupController::class, 'addGroup'])->name('add-group');
    Route::post('/new-group', [LeedsGroupController::class, 'createGroup'])->name('new-group');
    Route::get('/edit-group/{id}', [LeedsGroupController::class, 'editGroup'])->name('edit-group');
    Route::post('/update-group/{id}', [LeedsGroupController::class, 'updateGroup'])->name('update-group');
    Route::post('/delete-group/{id}', [LeedsGroupController::class, 'deleteGroup'])->name('delete-group');
    Route::get('/search-group', [LeedsGroupController::class, 'searchGroup'])->name('search-group');
    Route::get('/search', [LeedsGroupController::class, 'getGroups'])->name('search');
    Route::get('/leeds-in-group/{id}', [LeedsGroupController::class, 'leedsInGroup'])->name('leeds-in-group');
});
Route::group(['name' => 'CRM_successLeeds', 'middleware' => 'auth'], function() {
    Route::get('/all-success-leeds', [LeedsController::class, 'successList'])->name('all-success-leeds');
    Route::get('/allClients', [ClientController::class, 'allClient'])->name('allClients');
});
Route::group(['name' => 'CRM_successLeedsPanel', 'middleware' => 'auth'], function() {
    Route::get('/success-leeds-panel/{id}', [SuccessLeedsPanelController::class, 'successLeedsPanel'])->name('success-leeds-panel');
    Route::get('/add-meeting/{id}', [SuccessLeedsPanelController::class, 'addMeeting'])->name('add-meeting');
    Route::post('/new-meeting/{id}', [SuccessLeedsPanelController::class, 'createMeeting'])->name('new-meeting');
    Route::get('/all-meeting/{id}', [SuccessLeedsPanelController::class, 'allMeeting'])->name('all-meeting');
    Route::get('/edit-meeting/{id}/{mId}', [SuccessLeedsPanelController::class, 'editMeeting'])->name('edit-meeting');
    Route::post('/edit-meeting/{id}/{mId}', [SuccessLeedsPanelController::class, 'updateMeeting'])->name('update-meeting');
    Route::get('/delete-meeting/{id}/{mId}', [SuccessLeedsPanelController::class, 'deleteMeeting'])->name('delete-meeting');

    Route::get('/all-house-area-type/{id}', [QuotationController::class, 'allHouseTypes'])->name('all-house-area-type');
    Route::get('/add-house-area-type/{id}', [QuotationController::class, 'addHouseTypes'])->name('add-house-area-type');
    Route::post('/new-house-area-type/{id}', [QuotationController::class, 'createHouseTypes'])->name('new-house-area-type');
    Route::get('/edit-house-area-type/{id}/{houseType}', [QuotationController::class, 'editHouseTypes'])->name('edit-house-area-type');
    Route::post('/update-house-area-type/{id}/{houseType}', [QuotationController::class, 'updateHouseTypes'])->name('update-house-area-type');
    Route::get('/delete-house-area-type/{id}/{houseType}', [QuotationController::class, 'deleteHouseTypes'])->name('delete-house-area-type');
    Route::get('/search-house-area-type/{id}', [QuotationController::class, 'searchHouseTypes'])->name('search-house-area-type');

    Route::get('/all-decoration-type/{id}', [QuotationController::class, 'allDecorationType'])->name('all-decoration-type');
    Route::get('/add-decoration-type/{id}', [QuotationController::class, 'addDecorationType'])->name('add-decoration-type');
    Route::post('/new-decoration-type/{id}', [QuotationController::class, 'createDecorationType'])->name('new-decoration-type');
    Route::get('/edit-decoration-type/{id}/{decor}', [QuotationController::class, 'editDecorationType'])->name('edit-decoration-type');
    Route::post('/update-decoration-type/{id}/{decor}', [QuotationController::class, 'updateDecorationType'])->name('update-decoration-type');
    Route::post('/delete-decoration-type/{id}/{decor}', [QuotationController::class, 'deleteDecorationType'])->name('delete-decoration-type');

    Route::get('/edit-sub-body/{id}', [QuotationController::class, 'editSubBody'])->name('edit-sub-body');
    Route::post('/update-sub-body/{id}/{sbId}', [QuotationController::class, 'updateSubBody'])->name('update-sub-body');

    Route::get('/all-quotation/{id}', [QuotationController::class, 'allQuotation'])->name('all-quotation');
});
Route::group(['name' => 'Cart_measurements', 'middleware' => 'auth'], function() {
    Route::get('/add-measure-type/{id}', [MeasureController::class, 'addMeasureType'])->name('add-measure-type');
    Route::post('/new-measure-type/{id}', [MeasureController::class, 'createMeasureType'])->name('new-measure-type');
    Route::get('/all-measure-types/{id}', [MeasureController::class, 'allMeasureTypes'])->name('all-measure-types');
    Route::get('/edit-measure-type/{id}/{mtId}', [MeasureController::class, 'editMeasureType'])->name('edit-measure-type');
    Route::post('/update-measure-type/{id}/{mtId}', [MeasureController::class, 'updateMeasureType'])->name('update-measure-type');
    Route::post('/delete-measure-type/{id}/{mtId}', [MeasureController::class, 'deleteMeasureType'])->name('delete-measure-type');

    Route::get('/all-measure-struct/{id}', [MeasureController::class, 'allMeasureStruct'])->name('all-measure-struct');
    Route::get('/add-measure-struct/{id}', [MeasureController::class, 'addMeasureStruct'])->name('add-measure-struct');
    Route::post('/new-measure-struct/{id}', [MeasureController::class, 'createMeasureStruct'])->name('new-measure-struct');
    Route::get('/edit-measure-struct/{id}/{mStr}', [MeasureController::class, 'editMeasureStruct'])->name('edit-measure-struct');
    Route::post('/update-measure-struct/{id}/{mStr}', [MeasureController::class, 'updateMeasureStruct'])->name('update-measure-struct');
    Route::post('/delete-measure-struct/{id}/{mStr}', [MeasureController::class, 'deleteMeasureStruct'])->name('delete-measure-struct');

    Route::get('/view-measurement/{id}', [MeasureController::class, 'viewMeasurement'])->name('view-measurement');
    Route::get('/measure-cart/{id}', [MeasureController::class, 'measureCart'])->name('measure-cart');
    Route::get('/view-measure-cart/{id}/{mId}', [MeasureController::class, 'viewMeasureCart'])->name('view-measure-cart');
    Route::get('/view-measure-pdf/{id}/{mId}', [MeasureController::class, 'viewMeasurePdf'])->name('view-measure-pdf');
    Route::get('/download-measure-pdf/{id}/{mId}', [MeasureController::class, 'downloadMeasurePdf'])->name('download-measure-pdf');
    Route::get('/mail-measure-pdf/{id}/{mId}', [MeasureController::class, 'mailMeasurePdf'])->name('mail-measure-pdf');
});
Route::group(['name' => 'Cart_quotation', 'middleware' => 'auth'], function() {
    Route::get('/all-cart/{id}', [QuotationController::class, 'allCart'])->name('all-cart');
    Route::get('/add-cart/{id}', [QuotationController::class, 'addCart'])->name('add-cart');
//    Route::post('/create-cart/{id}', [QuotationController::class, 'createCart'])->name('create-cart');
    Route::get('/view-cart/{id}/{qId}', [QuotationController::class, 'viewCart'])->name('view-cart');
    Route::get('/view-pdf/{id}/{qId}', [QuotationController::class, 'viewPdf'])->name('view-pdf');
    Route::get('/download-pdf/{id}/{qId}', [QuotationController::class, 'downloadPdf'])->name('download-pdf');
    Route::get('/mail-pdf/{id}/{qId}', [QuotationController::class, 'mailPdf'])->name('mail-pdf');
});
Route::group(['name' => 'Project', 'middleware' => 'auth'], function() {
    Route::group(['name' => 'Category', 'middleware' => 'auth'], function() {
        Route::get('/add-project-category', [ProjectCategoryController::class, 'addCategory'])->name('add-project-category');
        Route::post('/new-project-category', [ProjectCategoryController::class, 'createCategory'])->name('new-project-category');
        Route::get('/all-Project-Categories', [ProjectCategoryController::class, 'allCategory'])->name('all-Project-Categories');
        Route::get('/categories-info/{id}',[ProjectCategoryController::class,'CategoryInfo'])->name('CategoryInfo');
        Route::post('/delete-category',[ProjectCategoryController::class,'categoryDelete'])->name('categoryDelete');
        Route::get('/category-edit/{id}',[ProjectCategoryController::class,'getCategory'])->name('getCategory');
        Route::post('/update-project-category', [ProjectCategoryController::class, 'updateCategory'])->name('updateCategory');
    });
    Route::group(['name' => 'Deal', 'middleware' => 'auth'], function() {
        Route::get('/add-project-deal', [ProjectDealController::class, 'addDeal'])->name('addDeal');
        Route::get('/all-deal', [ProjectDealController::class, 'allDeal'])->name('allDeal');
        Route::post('/add-project-deal-post', [ProjectDealController::class, 'addDealPost'])->name('addDealPost');
        Route::get('/project-deal-info/{id}',[ProjectDealController::class,'DealInfo'])->name('DealInfo');
        Route::post('/delete-project-deal',[ProjectDealController::class,'dealDelete'])->name('dealDelete');
        Route::get('/project-deal-edit/{id}',[ProjectDealController::class,'getDeal'])->name('getDeal');
        Route::post('/update-project-deal-post', [ProjectDealController::class, 'updateDealPost'])->name('updateDealPost');
    });

    Route::get('/all-project-list', [ProjectDealController::class, 'allProjectList'])->name('allProjectList');

    Route::group(['name' => 'Estimate', 'middleware' => 'auth'], function() {
        Route::get('/project-estimate-list',[ProjectEstimateController::class,'projectEstimateList'])->name('project-estimate-list');
        Route::get('/addEstimate',[ProjectEstimateController::class,'addEstimate'])->name('addEstimate');
        Route::post('/project-estimate-delete',[ProjectEstimateController::class,'projectEstimateDelete'])->name('deleteProjectEstimate');
        Route::get('/project-estimate-info/{id}',[ProjectEstimateController::class,'getProjectEstimateInformation'])->name('ProjectEstimateInfo');
        Route::get('/project-estimate-search',[ProjectEstimateController::class,'projectEstimateSearch']);
        Route::get('/project-estimate-pdf/{id}',[ProjectEstimateController::class,'projectEstimatePDF']);
        Route::get('/estimate-download-pdf/{id}',[ProjectEstimateController::class,'projectEstimateDwnPDF']);
        Route::get('/estimate-mail-pdf/{id}',[ProjectEstimateController::class,'projectEstimateMailPDF']);
    });
});

Route::group(['name' => 'Setting','middleware' => 'auth'],function(){
    Route::get('/add-company-info',[SettingController::class,'addCompanyInfo'])->name('add-company-info');
    Route::post('/createCompanyInfo',[SettingController::class,'createCompanyInfo'])->name('createCompanyInfo');
    Route::get('/allCompanyInfo',[SettingController::class,'allCompanyInfoList'])->name('allCompanyInfo');
    Route::get('/editCompanyInfo/{id}',[SettingController::class,'edit'])->name('editCompanyInfo');
    Route::post('/updateCompanyInfo/{id}',[SettingController::class,'update'])->name('updateCompanyInfo');
//    Route::post('/deleteCompanyInfo/{id}',[SettingController::class,'delete'])->name('deleteCompanyInfo');
    Route::post('/deleteCompanyInfo',[SettingController::class,'delete'])->name('deleteCompanyInfo');
    Route::get('/CompanyInfoSearch',[SettingController::class,'CompanyInfoSearch'])->name('CompanyInfoSearch');
    Route::get('/companyInfo/{id}',[SettingController::class,'getCategoryInformation'])->name('companyInfo');
    Route::get('/business-branch',[SettingController::class,'businessBranch'])->name('business-branch');
    Route::post('/create-business-branch',[SettingController::class,'createBusinessBranch'])->name('create-business-branch');
    Route::get('/add-business-branch',[SettingController::class,'addBusinessBranch'])->name('add-business-branch');
    Route::get('/businessBranchDel/{id}',[SettingController::class,'businessBranchDel'])->name('businessBranchDel');
    Route::post('/deleteBranch',[SettingController::class,'deleteBranch'])->name('deleteBranch');
    Route::get('/editBusinessBranch/{id}',[SettingController::class,'editBusinessBranch'])->name('editBusinessBranch');
    Route::post('/updateBusinessBranch/{id}',[SettingController::class,'updateBusinessBranch'])->name('updateBusinessBranch');
    Route::get('/businessBranchSearch',[SettingController::class,'businessBranchSearch'])->name('businessBranchSearch');
});
Route::group(['name' => 'product', 'middleware' => 'auth'],function(){
     Route::get('/add-product-category',[CategoryController::class,'catagory']);
     Route::post('/addCategory',[CategoryController::class,'addCategory']);
     Route::get('/categoryList',[CategoryController::class,'categoryList'])->name('all-Product-Categories');
     Route::get('/edit/{id}',[CategoryController::class,'show']);
     Route::post('/delete',[CategoryController::class,'delete'])->name('deleteCategory');
     Route::get('/category-info/{id}',[CategoryController::class,'getCategoryInformation'])->name('categoryInfo');
     Route::post('/update/{id}',[CategoryController::class,'update']);
     Route::get('/category-search',[CategoryController::class,'categorySearch']);

     Route::get('/s-categorylist',[SubController::class ,'scategoryList']);
     Route::get('/add-scategory',[SubController::class,'addScategory']);
     Route::post('addscategory',[SubController::class,'addScatetory']);
     Route::get('/s-edit/{id}',[SubController::class,'showuptbl']);
     Route::post('/s-delete',[SubController::class,'Sdelete'])->name('deleteSubCategory');
     Route::get('/Scategory-info/{id}',[SubController::class,'getSubCategoryInformation'])->name('subCategoryInfo');
     Route::post('/s-update/{id}',[SubController::class,'Supdate']);
     Route::get('/sub-category-search',[SubController::class,'subCategorySearch']);

     Route::get('/unit-list',[UnitController::class,'unitlist']);
     Route::get('/add-unit',[UnitController::class,'addunit']);
     Route::post('/add-unit-element',[UnitController::class,'saveunit']);
     Route::get('/u-edit/{id}',[UnitController::class,'edit']);
     Route::post('/u-update/{id}',[UnitController::class,'Uupdate']);
     Route::post('/u-delete',[UnitController::class,'udelete'])->name('deleteUnit');
     Route::get('/unit-info/{id}',[UnitController::class,'getUnitInformation'])->name('UnitInfo');
     Route::get('/unit-search',[UnitController::class,'unitSearch']);

     Route::get('/brand-list',[BrandController::class,'brandlist']);
     Route::get('/add-brand',[BrandController::class,'addbrand']);
     Route::post('/addBrand',[BrandController::class,'addingBrand']);
     Route::get('/b-edit/{id}',[BrandController::class,'bedit']);
     Route::post('/b-delete',[BrandController::class,'bdelete'])->name('deleteBrand');
     Route::get('/brand-info/{id}',[BrandController::class,'getBrandInformation'])->name('BrandInfo');
     Route::post('/b-update/{id}',[BrandController::class,'Bupdate']);
     Route::get('/brand-search',[BrandController::class,'brandSearch']);

     Route::get('/model-list',[ModelController::class,'modelList']);
     Route::get('/add-model',[ModelController::class,'addmodelform']);
     Route::post('/addmodel',[ModelController::class,'addmodel']);
     Route::post('/m-delete',[ModelController::class,'mdelete'])->name('deleteModel');
     Route::get('/model-info/{id}',[ModelController::class,'getModelInformation'])->name('ModelInfo');
     Route::get('/m-edit/{id}',[ModelController::class,'medit']);
     Route::post('/m-update/{id}',[ModelController::class,'Mupdate']);
     Route::get('/model-search',[ModelController::class,'modelSearch']);

     Route::get('/size-list',[SizeController::class,'sizelist']);
     Route::get('/add-size',[SizeController::class,'addsizeform']);
     Route::post('/addSize',[SizeController::class,'addsize']);
     Route::post('/sz-delete',[SizeController::class,'szdelete'])->name('deleteSize');
     Route::get('/size-info/{id}',[SizeController::class,'getSizeInformation'])->name('SizeInfo');
     Route::get('/sz-edit/{id}',[SizeController::class,'szedit']);
     Route::post('/sz-update/{id}',[SizeController::class,'szupdate']);
     Route::get('/size-search',[SizeController::class,'sizeSearch']);

     Route::get('/color-list',[ColorController::class,'colorlist']);
     Route::get('/add-color',[ColorController::class,'addcolorform']);
     Route::post('/addColor',[ColorController::class,'addcolor']);
     Route::post('/clr-delete',[ColorController::class,'clrdelete'])->name('deleteColor');
     Route::get('/color-info/{id}',[ColorController::class,'getColorInformation'])->name('ColorInfo');
     Route::get('/c-edit/{id}',[ColorController::class,'cedit']);
     Route::post('/c-update/{id}',[ColorController::class,'cupdate']);
     Route::get('/color-search',[ColorController::class,'colorSearch']);

     Route::get('/product-list',[ProductController::class,'productList']);
     Route::get('/add-product',[ProductController::class,'addProductForm']);
     Route::post('/addProduct',[ProductController::class,'addProduct']);
     Route::get('/p-edit/{id}',[ProductController::class,'pedit']);
     Route::post('/p-delete',[ProductController::class,'pdelete'])->name('deleteProduct');
     Route::get('/product-info/{id}',[ProductController::class,'getProductInformation'])->name('ProductInfo');
     Route::post('/p-update/{id}',[ProductController::class,'pupdate']);
     Route::get('/product-search',[ProductController::class,'productSearch']);

});
Route::group(['name' => 'supplier', 'middleware' => 'auth'],function(){
     Route::get('/suppGrp-list',[SupplierController::class,'suppGrpList']);
     Route::get('/add-suppGrp',[SupplierController::class,'addSuppGrpForm']);
     Route::post('/addSuppGrp',[SupplierController::class,'addSuppGrp']);
     Route::post('/suppGrp-delete',[SupplierController::class,'suppGrpDelete'])->name('deleteSupplierGroup');
     Route::get('/suppGrp-info/{id}',[SupplierController::class,'getSuppGrpInformation'])->name('SupplierGroupInfo');
     Route::get('/suppGrp-edit/{id}',[SupplierController::class,'suppGrpEdit']);
     Route::post('/suppGrp-update/{id}',[SupplierController::class,'suppGrpUpdate']);
     Route::get('/suppGrp-search',[SupplierController::class,'suppGrpSearch']);

     Route::get('/supplier-list',[SupplierController::class,'supplierList']);
     Route::get('/add-supplier',[SupplierController::class,'addSupplierForm']);
     Route::post('/addSupplier',[SupplierController::class,'addSupplier']);
     Route::post('/supp-delete',[SupplierController::class,'suppDelete'])->name('deleteSupplier');
     Route::get('/supp-info/{id}',[SupplierController::class,'getSupplierInformation'])->name('SupplierInfo');
     Route::get('/supplier-edit/{id}',[SupplierController::class,'supplierEdit']);
     Route::post('/supplier-update/{id}',[SupplierController::class,'supplierUpdate']);
     Route::get('/supplier-search',[SupplierController::class,'supplierSearch']);

//  Purchase    Route::get('/add-purchase',[PurchaseController::class,'addPurchase']);

});
Route::group(['name' => 'purchase', 'middleware' => 'auth'],function(){
    Route::get('/purchase-type-list',[PurchaseTypeController::class,'purchaseTypeList']);
    Route::get('/add-purchase-type-form',[PurchaseTypeController::class,'addPurchaseTypeForm']);
    Route::post('/addPurchaseType',[PurchaseTypeController::class,'addPurchaseType']);
    Route::post('/purchase-type-delete',[PurchaseTypeController::class,'purchasetypedelete'])->name('deletePurchaseType');
    Route::get('/purchase-type-info/{id}',[PurchaseTypeController::class,'getPurchaseTypeInformation'])->name('PurchaseTypeInfo');
    Route::get('/purchase-type-edit/{id}',[PurchaseTypeController::class,'purchaseTypeEdit']);
    Route::post('/purchase-type-update/{id}',[PurchaseTypeController::class,'purchaseTypeUpdate']);
    Route::get('/purchase-type-search',[PurchaseTypeController::class,'purchaseTypeSearch']);

    Route::get('/create-purchase',[PurchaseController::class, 'addingPurchase']);
    Route::get('/update-purchase/{id}',[PurchaseController::class,'updatePurchase']);
    Route::get('/purchase-list',[PurchaseController::class,'purchaseList'],);
    Route::get('/purchase-info/{id}',[PurchaseController::class,'getPurchaseInformation'])->name('purchaseInfo');
    Route::post('/purchase-delete',[PurchaseController::class,'purchaseDelete'])->name('deletePurchase');
    Route::get('/purchase-invoice/{id}',[PurchaseController::class,'purchaseInvoice']);
    Route::get('/purchase-pdf/{id}',[PurchaseController::class,'purchasePDF']);
    Route::get('/download-pdf/{id}',[PurchaseController::class,'purchaseDwnPDF']);
    Route::get('/mail-pdf/{id}',[PurchaseController::class,'purchaseMailPDF']);
    Route::get('/purchase-total',[PurchaseController::class,'purchaseTotal']);
    Route::get('/purchase-approved/{id}',[PurchaseController::class,'purchaseApproved']);
    Route::get('/approval-view',[PurchaseController::class,'approvalView']);

    Route::get('/return-purchase/{id}',[PurchaseReturnController::class,'purchaseReturnForm']);
    Route::get('/purchase-return-list',[PurchaseReturnController::class,'purchaseReturnList']);
    Route::get('/purchase-return-info/{id}',[PurchaseReturnController::class,'getPurchaseReturnInformation'])->name('purchaseReturnInfo');
    Route::post('/purchase-return-delete',[PurchaseReturnController::class,'purchaseReturnDelete'])->name('deletePurchaseReturn');
    Route::get('/purchase-return-pdf/{id}',[PurchaseReturnController::class,'purchaseReturnPDF']);
    Route::get('/return-download-pdf/{id}',[PurchaseReturnController::class,'purchaseReturnDwnPDF']);
    Route::get('/return-mail-pdf/{id}',[PurchaseReturnController::class,'purchaseReturnMailPDF']);




});
Route::group(['name' => 'labour', 'middleware' => 'auth'],function(){
    Route::get('/labour-list',[LabourController::class,'labourlist']);
    Route::get('/add-labour-form',[LabourController::class,'addLabourForm']);
    Route::post('/addLabour',[LabourController::class,'addlabour']);
    Route::post('/lbr-delete',[LabourController::class,'lbrdelete'])->name('deleteLabour');
    Route::get('/labour-info/{id}',[LabourController::class,'getLabourInformation'])->name('LabourInfo');
    Route::get('/labour-edit/{id}',[LabourController::class,'lbrEdit']);
    Route::post('/labour-update/{id}',[LabourController::class,'labourUpdate']);
    Route::get('/labour-search',[LabourController::class,'labourSearch']);

    Route::get('/labour-type-list',[LabourController::class,'labourTypeList']);
    Route::get('/add-labour-type-form',[LabourController::class,'addLabourTypeForm']);
    Route::post('/addLabourType',[LabourController::class,'addLabourType']);
    Route::post('/lbr-type-delete',[LabourController::class,'lbrtypedelete'])->name('deleteLabourType');
    Route::get('/labour-type-info/{id}',[LabourController::class,'getLabourTypeInformation'])->name('LabourTypeInfo');
    Route::get('/labour-type-edit/{id}',[LabourController::class,'lbrTypeEdit']);
    Route::post('/labour-type-update/{id}',[LabourController::class,'labourTypeUpdate']);
    Route::get('/labour-type-search',[LabourController::class,'labourTypeSearch']);

    Route::get('/add-labour-bill',[LabourController::class,'addLabourBill']);
    Route::get('/labour-bill-list',[LabourController::class,'labourBillList']);
    Route::post('/lbr-bill-delete',[LabourController::class,'lbrbilldelete'])->name('deleteLabourBill');
    Route::get('/labour-bill-info/{id}',[LabourController::class,'getLabourBillInformation'])->name('LabourBillInfo');
    Route::get('/labour-bill-pdf/{id}',[LabourController::class,'labourBillPDF']);
    Route::get('/labour-bill-download-pdf/{id}',[LabourController::class,'labourBillDwnPDF']);
    Route::get('/labour-bill-mail-pdf/{id}',[LabourController::class,'labourBillMailPDF']);
});
Route::group(['name' => 'followup', 'middleware' => 'auth'],function(){
    Route::get('/email-template',[FollowUpController::class,'emailTemplate']);
    Route::get('/email-template-form',[FollowUpController::class,'addEmailTempForm']);
    Route::post('/add-email-template',[FollowUpController::class,'addEmailTemplate']);
    Route::post('/email-template-delete',[FollowUpController::class,'emailTemplateDelete'])->name('deleteEmailTemplate');
    Route::get('/email-template-info/{id}',[FollowUpController::class,'getEmailInformation'])->name('emailTemplateInfo');
    Route::get('/edit-email-template/{id}',[FollowUpController::class,'editEmailTemplate']);
    Route::post('/update-email-template/{id}',[FollowUpController::class,'updateEmailTemplate']);
    Route::get('/send-email-form/{id}',[FollowUpController::class,'sendEmailForm']);
    Route::post('/send-email',[FollowUpController::class,'sendEmail']);
    Route::get('/email-body',[FollowUpController::class,'emailBody']);
    Route::get('/email-template-search',[FollowUpController::class,'emailTemplateSearch']);


    Route::get('/email-history',[FollowUpController::class,'emailHistory']);
//    Route::post('/email-history-set',[FollowUpController::class,'emailHistorySet']);

    Route::get('/sms-template',[FollowUpController::class,'smsTemplate']);
    Route::get('/sms-template-form',[FollowUpController::class,'addSmsTempForm']);
    Route::post('/add-sms-template',[FollowUpController::class,'addSmsTemplate']);
    Route::post('/sms-template-delete',[FollowUpController::class,'SMSTemplateDelete'])->name('deleteSMSTemplate');
    Route::get('/sms-template-info/{id}',[FollowUpController::class,'getSMSInformation'])->name('SMSTemplateInfo');
    Route::get('/send-sms-form/{id}',[FollowUpController::class,'sendSmsForm']);
    Route::get('/edit-sms-template/{id}',[FollowUpController::class,'editSmsTemplate']);
    Route::post('/update-sms-template/{id}',[FollowUpController::class,'updateSmsTemplate']);
    Route::post('/send-sms',[FollowUpController::class,'sendSMS']);
    Route::get('/sms-template-search',[FollowUpController::class,'SMSTemplateSearch']);

    Route::get('/sms-history',[FollowUpController::class,'SMSHistory']);

    Route::get('/watsapp-template',[FollowUpController::class,'watsappTemplate']);
    Route::get('/watsapp-template-form',[FollowUpController::class,'addWatsappTempForm']);
    Route::post('/add-watsapp-template',[FollowUpController::class,'addWatsappTemplate']);
    Route::get('/send-message-form/{id}',[FollowUpController::class,'sendMessageForm']);
    Route::get('/edit-watsapp-template/{id}',[FollowUpController::class,'editWatsappTemplate']);
    Route::post('/update-watsapp-template/{id}',[FollowUpController::class,'updateWatsappTemplate']);


});

Route::group(['name' => 'role', 'middleware' => 'auth'],function(){

    Route::get('/add-role',[RoleController::class,'roleCreateForm'])->name('addRoleView');
    Route::post('/add-role-submit',[RoleController::class,'roleCreateSubmission'])->name('addRole');
    Route::get('/role-list',[RoleController::class,'RoleList'])->name('roleList');
    Route::get('/role-info/{id}',[RoleController::class,'getRoleInformation'])->name('roleInfo');
    Route::post('/role-delete',[RoleController::class,'deleteRole'])->name('deleteRole');

    Route::get('/role-edit/{id}',[RoleController::class,'roleEdit'])->name('RoleEdit');
    Route::post('/role-edit',[RoleController::class,'roleEditSubmit'])->name('RoleEditSubmit');

});

Route::group(['name' => 'user', 'middleware' => 'auth'],function(){
    Route::get('/add-user',[UserController::class,'userCreateForm'])->name('addUserView');
    Route::post('/add-user-post',[UserController::class,'userCreateSubmit'])->name('addUser');
    Route::get('/user-list',[UserController::class,'userList'])->name('userList');
    Route::get('/user-info/{id}',[UserController::class,'getUserInformation'])->name('userInfo');
    Route::get('/user-edit/{id}',[UserController::class,'userEdit'])->name('userEdit');
    Route::post('/user-edit',[UserController::class,'userEditSubmit'])->name('userEditSubmit');
    Route::post('/user-delete',[UserController::class,'deleteUser'])->name('deleteUser');

});
Route::group(['name' => 'menu', 'middleware' => 'auth'],function(){
    Route::get('/add-menu',[MenuController::class,'menuCreateForm'])->name('addMenuView');
    Route::get('/menu-list',[MenuController::class,'menuList'])->name('menuList');
    Route::post('/add-menu-submit',[MenuController::class,'menuCreateSubmission'])->name('addMenu');
    Route::get('/menu-edit/{id}',[MenuController::class,'menuEdit'])->name('MenuEdit');
    Route::post('/menu-edit',[MenuController::class,'menuEditSubmit'])->name('MenuEditSubmit');
    Route::get('/menu-info/{id}',[MenuController::class,'getMenuInformation'])->name('menuInfo');
    Route::get('/menu-delete/{id}',[MenuController::class,'deleteMenu'])->name('deleteMenu');
});
Route::group(['name' => 'submenu', 'middleware' => 'auth'],function(){
    Route::get('/add-submenu',[SubmenuController::class,'SubmenuCreateForm'])->name('addSubMenuView');
    Route::get('/sub-menu-list',[SubmenuController::class,'SubmenuList'])->name('SubmenuList');
    Route::post('/add-sub-menu-submit',[SubmenuController::class,'SubmenuCreateSubmission'])->name('addSubMenu');
    Route::get('/sub-menu-info/{id}',[SubmenuController::class,'getSubMenuInformation'])->name('submenuInfo');
    Route::get('/submenu-edit/{id}',[SubmenuController::class,'submenuEdit'])->name('SubMenuEdit');
    Route::post('/submenu-edit',[SubmenuController::class,'submenuEditSubmit'])->name('SubmenuEditSubmit');
    Route::get('/submenu-delete/{id}',[SubmenuController::class,'deleteSubMenu'])->name('deleteSubMenu');
});

Route::group(['name' => 'sub-submenu', 'middleware' => 'auth'],function(){
    Route::get('/add-sub-submenu',[SubSubmenuController::class,'SubSubmenuCreateForm'])->name('addSubSubMenuView');
    Route::get('/sub-sub-menu-list',[SubSubmenuController::class,'SubSubmenuList'])->name('SubSubmenuList');
    Route::post('/add-sub-sub-menu-submit',[SubSubmenuController::class,'SubSubmenuCreateSubmission'])->name('addSubSubMenu');
    Route::get('/sub-sub-menu-info/{id}',[SubSubmenuController::class,'getSubSubMenuInformation'])->name('SubsubmenuInfo');
    Route::get('/sub-submenu-edit/{id}',[SubSubmenuController::class,'SubsubmenuEdit'])->name('SubSubMenuEdit');
    Route::post('/sub-submenu-edit',[SubSubmenuController::class,'SubsubmenuEditSubmit'])->name('SubSubmenuEditSubmit');
    Route::get('/sub-submenu-delete/{id}',[SubSubmenuController::class,'deleteSubSubMenu'])->name('deleteSubSubMenu');
});

Route::group(['name' => 'menu-permission', 'middleware' => 'auth'],function(){
    Route::get('/menu-permission',[MenuPermissionController::class,'MenuPermitView'])->name('menuPermission');
    Route::post('/menu-permission-submit',[MenuPermissionController::class,'givepermission'])->name('menupermissionsubmit');
});


Route::group(['name' => 'Admin','middleware' => 'auth'],function() {
    Route::get('/updateAdminPassword',[AdminController::class,'updateAdminPassword'])->name('updateAdminPassword');
    Route::get('/updateAdminDetails',[AdminController::class,'updateAdminDetails'])->name('updateAdminDetails');
    Route::post('/updateAdminDetails1',[AdminController::class,'updateAdminDetails1'])->name('updateAdminDetails1');
    Route::post('/updateAdminPassword',[AdminController::class,'updateAdminPassword1'])->name('updateAdminPassword1');
    Route::post('/check-admin-password',[AdminController::class,'checkAdminPassword']);
});

Route::group(['name' => 'DesignWork','middleware' => 'auth'],function(){
    Route::get('/design/{id}',[DesignController::class,'designPage'])->name('designPage');
    Route::post('/updateDesignWork/{id}/{did}',[DesignController::class,'updateDesignWork'])->name('updateDesignWork');
    Route::post('/createDesignWork/{id}',[DesignController::class,'createDesignWork'])->name('createDesignWork');
    Route::post('/insertComment/{id}',[DesignController::class,'insertComment'])->name('insertComment');
    Route::post('/insertFile/{id}',[DesignController::class,'insertFile'])->name('insertFile');
    Route::get('/download-file/{id}/{fId}',[DesignController::class,'downloadfile'])->name('download-file');
});
Route::group(['name' => 'Deed','middleware' => 'auth'],function(){
    Route::get('/deed/{id}',[DeedController::class,'allDeed'])->name('allDeed');
    Route::get('/deedGoCreate/{id}',[DeedController::class,'deedGoCreate'])->name('deedGoCreate');
    Route::post('/deedCreate/{id}',[DeedController::class,'deedCreate'])->name('deedCreate');
    Route::get('/delete-deed/{id}', [DeedController::class, 'deletedeed'])->name('delete-deed');
    Route::get('/download-deedFile/{id}/{fileId}',[DeedController::class,'downloadFile'])->name('download-deedFile');
});

Route::group(['name' => 'Hrm','middleware' => 'auth'],function(){

    Route::group(['name' => 'Department','middleware' => 'auth'],function(){
    Route::get('/add-Department',[DepartmentController::class,'deptCreateForm'])->name('deptCreateView');
    Route::post('/addDepartmentreq',[DepartmentController::class,'deptCreate'])->name('deptCreate');
    Route::get('/dept-list',[DepartmentController::class,'deptList'])->name('deptList');
    Route::get('/dept-info/{id}',[DepartmentController::class,'getDeptInformation'])->name('deptInfo');
    Route::post('/delete-dept',[DepartmentController::class,'deleteDept'])->name('deleteDept');
    Route::get('/dept-edit/{id}',[DepartmentController::class,'getDept'])->name('getDept');
    Route::post('/dept-update',[DepartmentController::class,'updateDept'])->name('updateDept');
    Route::get('/search-dept',[DepartmentController::class,'deptSearch'])->name('deptSearch');
});

Route::group(['name' => 'Designation','middleware' => 'auth'],function(){
    Route::get('/add-Designation',[DesignationController::class,'designationCreateForm'])->name('designationCreateForm');
    Route::get('/designation-list',[DesignationController::class,'designationList'])->name('designationList');
    Route::post('/addDesignationreq',[DesignationController::class,'designationCreate'])->name('designationCreate');
    Route::get('/designation-info/{id}',[DesignationController::class,'getDesignationInformation'])->name('designationInfo');
    Route::post('/delete-designation',[DesignationController::class,'deleteDesignation'])->name('deleteDesignation');
    Route::get('/designation-edit/{id}',[DesignationController::class,'getDesignation'])->name('getDesignation');
    Route::post('/dept-edit',[DesignationController::class,'updateDesignation'])->name('updateDesignation');
    Route::get('/search-designation',[DesignationController::class,'designationSearch'])->name('designationSearch');
});

Route::group(['name' => 'Designation','middleware' => 'auth'],function(){
    Route::get('/add-Employee',[EmployeeController::class,'empCreateForm'])->name('empCreateForm');
    Route::post('/add-Employee-Post',[EmployeeController::class,'empCreate'])->name('empCreate');
    Route::get('/Employee-list',[EmployeeController::class,'empList'])->name('empList');
    Route::get('/Employee-Info/{id}',[EmployeeController::class,'getEmployee'])->name('getEmployee');
    Route::get('/Employee/{id}',[EmployeeController::class,'GetEmployeeInfo'])->name('GetEmployeeInfo');
    Route::post('/Employee-Update',[EmployeeController::class,'updateEmployee'])->name('updateEmployee');
    Route::post('/Employee-Delete',[EmployeeController::class,'DeleteEmployee'])->name('DeleteEmployee');
    Route::get('/Employee-Image/{id}',[EmployeeController::class,'getImage'])->name('getImage');
    Route::get('/Employee-Password/{id}',[EmployeeController::class,'getPassword'])->name('getPassword');
    Route::post('/Employee-Password-Update',[EmployeeController::class,'changePassword'])->name('changePassword');
    Route::post('/employee-imageUpdate',[EmployeeController::class,'imageUpdate'])->name('imageUpdate');
    Route::get('/Employee-Immigration/{id}',[EmployeeController::class,'Immigration'])->name('Immigration');
    Route::get('/Employee-Econtact/{id}',[EmployeeController::class,'EmergencyContact'])->name('EmergencyContact');
    Route::get('/Employee-social/{id}',[EmployeeController::class,'socialNetwork'])->name('socialNetwork');
    Route::get('/Employee-document/{id}',[EmployeeController::class,'document'])->name('document');
    Route::get('/Employee-qualification/{id}',[EmployeeController::class,'qualification'])->name('qualification');
    Route::get('/Employee-bank/{id}',[EmployeeController::class,'bankAccount'])->name('bankAccount');
    Route::get('/Employee-contract/{id}',[EmployeeController::class,'contract'])->name('contract');
    Route::get('/Employee-leave/{id}',[EmployeeController::class,'leave'])->name('leave');
    Route::get('/Employee-shift/{id}',[EmployeeController::class,'Shift'])->name('Shift');
    Route::get('/Employee-location/{id}',[EmployeeController::class,'Location'])->name('Location');
    Route::get('/Employee-experience/{id}',[EmployeeController::class,'WorkExperience'])->name('WorkExperience');
    Route::post('/Employee-Immigration-Post',[EmployeeController::class,'ImmigrationPost'])->name('ImmigrationPost');
    Route::post('/Employee-Econtact-Post',[EmployeeController::class,'EcontactPost'])->name('EcontactPost');
    Route::post('/Employee-social-Post',[EmployeeController::class,'socialNetworkPost'])->name('socialNetworkPost');
    Route::post('/Employee-document-Post',[EmployeeController::class,'DocumentPost'])->name('DocumentPost');
    Route::post('/Employee-experience-Post',[EmployeeController::class,'WorkExperiencePost'])->name('WorkExperiencePost');
    Route::post('/Employee-qualification-Post',[EmployeeController::class,'QualificationPost'])->name('QualificationPost');
    Route::post('/Employee-shift-Post',[EmployeeController::class,'shiftPost'])->name('shiftPost');
    Route::post('/Employee-bank-Post',[EmployeeController::class,'BankAccountPost'])->name('BankAccountPost');
    Route::post('/Employee-contract-Post',[EmployeeController::class,'ContractPost'])->name('ContractPost');
    Route::post('/Employee-leave-Post',[EmployeeController::class,'LeavePost'])->name('LeavePost');
    Route::post('/Employee-location-Post',[EmployeeController::class,'LocationPost'])->name('LocationPost');
    Route::get('/Employee-Get-Immigration/{id}',[EmployeeController::class,'GetImmigration'])->name('GetImmigration');
    Route::post('/Employee-Delete-Immigration',[EmployeeController::class,'DeleteImmigration'])->name('DeleteImmigration');
    Route::get('/Employee-Get-Econtact/{id}',[EmployeeController::class,'GetEmergencyContact'])->name('GetEmergencyContact');
    Route::post('/Employee-Delete-Econtact',[EmployeeController::class,'DeleteEmergencyContact'])->name('DeleteEmergencyContact');
    Route::get('/Employee-Get-Document/{id}',[EmployeeController::class,'GetDocument'])->name('GetDocument');
    Route::post('/Employee-Delete-Document',[EmployeeController::class,'DeleteDocument'])->name('DeleteDocument');
    Route::get('/Employee-Get-Qualification/{id}',[EmployeeController::class,'GetQualification'])->name('GetQualification');
    Route::post('/Employee-Delete-Qualification',[EmployeeController::class,'DeleteQualification'])->name('DeleteQualification');
    Route::get('/Employee-Get-WorkExperience/{id}',[EmployeeController::class,'GetWorkExperience'])->name('GetWorkExperience');
    Route::post('/Employee-Delete-WorkExperience',[EmployeeController::class,'DeleteWorkExperience'])->name('DeleteWorkExperience');
    Route::get('/Employee-Get-BankAccount/{id}',[EmployeeController::class,'GetBankAccount'])->name('GetBankAccount');
    Route::post('/Employee-Delete-BankAccount',[EmployeeController::class,'DeleteBankAccount'])->name('DeleteBankAccount');
    Route::get('/Employee-Get-Contract/{id}',[EmployeeController::class,'GetContract'])->name('GetContract');
    Route::post('/Employee-Delete-Contract',[EmployeeController::class,'DeleteContract'])->name('DeleteContract');
    Route::get('/Employee-Get-Leave/{id}',[EmployeeController::class,'GetLeave'])->name('GetLeave');
    Route::post('/Employee-Delete-Leave',[EmployeeController::class,'DeleteLeave'])->name('DeleteLeave');
    Route::get('/Employee-Get-location/{id}',[EmployeeController::class,'GetLocation'])->name('GetLocation');
    Route::post('/Employee-Delete-location',[EmployeeController::class,'DeleteLocation'])->name('DeleteLocation');
    Route::post('/Employee-Immigration-Update',[EmployeeController::class,'ImmigrationUpdate'])->name('ImmigrationUpdate');
    Route::post('/Employee-Location-Update',[EmployeeController::class,'LocationUpdate'])->name('LocationUpdate');
    Route::post('/Employee-Econtact-Update',[EmployeeController::class,'EcontactUpdate'])->name('EcontactUpdate');
    Route::post('/Employee-Leave-Update',[EmployeeController::class,'LeaveUpdate'])->name('LeaveUpdate');
    Route::post('/Employee-Contract-Update',[EmployeeController::class,'ContractUpdate'])->name('ContractUpdate');
    Route::post('/Employee-Bank-Update',[EmployeeController::class,'BankAccountUpdate'])->name('BankAccountUpdate');
    Route::post('/Employee-WorkExperience-Update',[EmployeeController::class,'WorkExperienceUpdate'])->name('WorkExperienceUpdate');
    Route::post('/Employee-Qualification-Update',[EmployeeController::class,'QualificationUpdate'])->name('QualificationUpdate');
    Route::post('/Employee-Document-Update',[EmployeeController::class,'DocumentUpdate'])->name('DocumentUpdate');
});

Route::group(['name' => 'Other','middleware' => 'auth'],function(){

    Route::group(['name' => 'Transfer','middleware' => 'auth'],function(){
        Route::get('/add-Transfer',[TransfersController::class,'addTransfer'])->name('addTransfer');
        Route::get('/Transfer-list',[TransfersController::class,'transferList'])->name('transferList');
        Route::get('/Transfer-Info/{id}',[TransfersController::class,'transferInfo'])->name('transferInfo');
        Route::post('/add-Transfer-post',[TransfersController::class,'addTransferPost'])->name('addTransferPost');
        Route::post('/Transfer-delete',[TransfersController::class,'transferDelete'])->name('transferDelete');
        Route::get('/Transfer-edit/{id}',[TransfersController::class,'getTransfer'])->name('getTransfer');
        Route::post('/update-Transfer',[TransfersController::class,'UpdateTransfer'])->name('UpdateTransfer');
    });
    Route::group(['name' => 'Resignation','middleware' => 'auth'],function(){
        Route::get('/add-Resignation',[ResignationController::class,'addResignation'])->name('addResignation');
        Route::get('/Resignation-list',[ResignationController::class,'ResignationList'])->name('ResignationList');
        Route::post('/add-Resignation-post',[ResignationController::class,'addResignationPost'])->name('addResignationPost');
        Route::get('/Resignation-Info/{id}',[ResignationController::class,'resignationInfo'])->name('resignationInfo');
        Route::post('/Resignation-delete',[ResignationController::class,'resignationDelete'])->name('resignationDelete');
        Route::get('/Resignation-edit/{id}',[ResignationController::class,'getResignation'])->name('getResignation');
        Route::post('/update-Resignation-post',[ResignationController::class,'updateResignation'])->name('updateResignation');
    });
    Route::group(['name' => 'Promotion','middleware' => 'auth'],function(){
        Route::get('/add-Promotion',[PromotionController::class,'addPromotion'])->name('addPromotion');
        Route::get('/Promotion-list',[PromotionController::class,'promotionList'])->name('promotionList');
        Route::post('/add-Promotion-post',[PromotionController::class,'addPromotionPost'])->name('addPromotionPost');
        Route::get('/Promotion-Info/{id}',[PromotionController::class,'promotionInfo'])->name('promotionInfo');
        Route::post('/Promotion-delete',[PromotionController::class,'promotionDelete'])->name('promotionDelete');
        Route::get('/Promotion-edit/{id}',[PromotionController::class,'getPromotion'])->name('getPromotion');
        Route::post('/update-Promotion',[PromotionController::class,'updatePromotion'])->name('updatePromotion');
    });
    Route::group(['name' => 'Complaint','middleware' => 'auth'],function(){
        Route::get('/add-Complaint',[ComplaintsController::class,'addComplaint'])->name('addComplaint');
        Route::get('/Complaint-list',[ComplaintsController::class,'ComplaintsList'])->name('ComplaintsList');
        Route::post('/add-Complaint-post',[ComplaintsController::class,'addComplaintPost'])->name('addComplaintPost');
        Route::get('/Complaint-Info/{id}',[ComplaintsController::class,'complaintInfo'])->name('complaintInfo');
        Route::post('/Complaint-delete',[ComplaintsController::class,'complaintDelete'])->name('complaintDelete');
        Route::get('/Complaint-edit/{id}',[ComplaintsController::class,'getComplaint'])->name('getComplaint');
        Route::post('/update-Complaint',[ComplaintsController::class,'updateComplaint'])->name('updateComplaint');
    });
    Route::group(['name' => 'Termination','middleware' => 'auth'],function(){
        Route::get('/add-Termination',[TerminationController::class,'addTermination'])->name('addTermination');
        Route::get('/Termination-list',[TerminationController::class,'TerminationList'])->name('TerminationList');
        Route::post('/add-Termination-post',[TerminationController::class,'addTerminationPost'])->name('addTerminationPost');
        Route::get('/Termination-Info/{id}',[TerminationController::class,'terminationInfo'])->name('terminationInfo');
        Route::post('/Termination-delete',[TerminationController::class,'terminationDelete'])->name('terminationDelete');
        Route::get('/Termination-edit/{id}',[TerminationController::class,'getTermination'])->name('getTermination');
        Route::post('/Termination-Complaint',[TerminationController::class,'updateTermination'])->name('updateTermination');
    });
    Route::group(['name' => 'Increment','middleware' => 'auth'],function(){
        Route::get('/add-Increment',[IncrementController::class,'addIncrement'])->name('addIncrement');
        Route::get('/Increment-list',[IncrementController::class,'IncrementList'])->name('IncrementList');
        Route::get('/Increment-search',[IncrementController::class,'IncrementSearch'])->name('IncrementSearch');
        Route::post('/Increment-post',[IncrementController::class,'addIncrementPost'])->name('addIncrementPost');
        Route::get('/Increment-Info/{id}',[IncrementController::class,'IncrementInfo'])->name('IncrementInfo');
        Route::post('/Increment-delete',[IncrementController::class,'IncrementDelete'])->name('IncrementDelete');
        Route::get('/Increment-edit/{id}',[IncrementController::class,'getIncrement'])->name('getIncrement');
        Route::post('/Increment-update',[IncrementController::class,'updateIncrement'])->name('updateIncrement');
    });
});
Route::group(['name' => 'leaves','middleware' => 'auth'],function(){

    Route::get('/employee-leave-balance-list',[employeeLeaveBalanceController::class,'employeeLeaveBalance'])->name('employeeLeaveBalance');

    Route::group(['name' => 'Holiday','middleware' => 'auth'],function(){
        Route::get('/add-Holiday',[HolidayController::class,'addHoliday'])->name('addHoliday');
        Route::post('/add-Holiday-post',[HolidayController::class,'addHolidayPost'])->name('addHolidayPost');
        Route::get('/Holiday-list',[HolidayController::class,'holidayList'])->name('holidayList');
        Route::get('/holiday-Info/{id}',[HolidayController::class,'holidayInfo'])->name('holidayInfo');
        Route::post('/holiday-delete',[HolidayController::class,'holidayDelete'])->name('holidayDelete');
        Route::get('/holiday-edit/{id}',[HolidayController::class,'getHoliday'])->name('getHoliday');
        Route::post('/update-Holiday',[HolidayController::class,'updateHoliday'])->name('updateHoliday');
    });

    Route::group(['name' => 'LeaveType','middleware' => 'auth'],function(){
        Route::get('/add-LeaveType',[LeaveTypeController::class,'addLeaveType'])->name('addLeaveType');
        Route::post('/add-LeaveType-post',[LeaveTypeController::class,'addLeaveTypePost'])->name('addLeaveTypePost');
        Route::get('/LeaveType-list',[LeaveTypeController::class,'LeaveTypeList'])->name('LeaveTypeList');
        Route::get('/LeaveType-Info/{id}',[LeaveTypeController::class,'LeaveTypeInfo'])->name('LeaveTypeInfo');
        Route::post('/LeaveType-delete',[LeaveTypeController::class,'LeaveTypeDelete'])->name('LeaveTypeDelete');
        Route::get('/LeaveType-edit/{id}',[LeaveTypeController::class,'getLeaveType'])->name('getLeaveType');
        Route::post('/LeaveType-update',[LeaveTypeController::class,'LeaveTypeUpdate'])->name('LeaveTypeUpdate');
    });

    Route::group(['name' => 'LeavePurpose','middleware' => 'auth'],function(){
        Route::get('/add-LeavePurpose',[LeavePurposeController::class,'addLeavePurpose'])->name('addLeavePurpose');
        Route::post('/add-LeavePurpose-post',[LeavePurposeController::class,'addLeavePurposePost'])->name('addLeavePurposePost');
        Route::get('/LeavePurpose-list',[LeavePurposeController::class,'LeavePurposeList'])->name('LeavePurposeList');
        Route::get('/LeavePurpose-Info/{id}',[LeavePurposeController::class,'LeavePurposeInfo'])->name('LeavePurposeInfo');
        Route::post('/LeavePurpose-delete',[LeavePurposeController::class,'LeavePurposeDelete'])->name('LeavePurposeDelete');
        Route::get('/LeavePurpose-edit/{id}',[LeavePurposeController::class,'getLeavePurpose'])->name('getLeavePurpose');
        Route::post('/LeavePurpose-update',[LeavePurposeController::class,'LeavePurposeUpdate'])->name('LeavePurposeUpdate');
    });
    Route::group(['name' => 'applyLeave','middleware' => 'auth'],function(){
        Route::get('/add-applyLeave',[ApplyLeaveController::class,'addApplyLeave'])->name('addApplyLeave');
        Route::get('/applyLeave-list',[ApplyLeaveController::class,'ApplyLeaveList'])->name('ApplyLeaveList');
        Route::post('/add-applyLeave-post',[ApplyLeaveController::class,'addApplyLeavePost'])->name('addApplyLeavePost');
        Route::get('/applyLeave-Info/{id}',[ApplyLeaveController::class,'ApplyLeaveInfo'])->name('ApplyLeaveInfo');
        Route::post('/applyLeave-delete',[ApplyLeaveController::class,'ApplyLeaveDelete'])->name('ApplyLeaveDelete');
        Route::get('/applyLeave-edit/{id}',[ApplyLeaveController::class,'getApplyLeave'])->name('getApplyLeave');
        Route::post('/applyLeave-update',[ApplyLeaveController::class,'ApplyLeaveUpdate'])->name('ApplyLeaveUpdate');
        Route::get('/employeeLeave-list',[ApplyLeaveController::class,'EmployeeLeaveList'])->name('EmployeeLeaveList');
    });
});
Route::group(['name' => 'payroll','middleware' => 'auth'],function(){
    Route::group(['name' => 'payrollType','middleware' => 'auth'],function(){
        Route::get('/add-payrollType',[PayrollTypeController::class,'addPayrollType'])->name('addPayrollType');
        Route::post('/add-payrollType-post',[PayrollTypeController::class,'addPayrollTypePost'])->name('addPayrollTypePost');
        Route::get('/payrollType-list',[PayrollTypeController::class,'PayrollTypeList'])->name('PayrollTypeList');
        Route::get('/payrollType-Info/{id}',[PayrollTypeController::class,'payrollTypeInfo'])->name('payrollTypeInfo');
        Route::post('/payrollType-delete',[PayrollTypeController::class,'payrollTypeDelete'])->name('payrollTypeDelete');
        Route::get('/payrollType-edit/{id}',[PayrollTypeController::class,'getPayrollType'])->name('getPayrollType');
        Route::post('/payrollType-update',[PayrollTypeController::class,'updateTypePost'])->name('updateTypePost');
    });
    Route::group(['name' => 'payrollGenerate','middleware' => 'auth'],function(){
        Route::get('/add-payrollGenerate',[PayrollGenerateController::class,'addPayrollGenerate'])->name('addPayrollGenerate');
        Route::post('/add-payrollGenerate-post',[PayrollGenerateController::class,'addPayrollGeneratePost'])->name('addPayrollGeneratePost');
        Route::get('/payrollGenerate-list',[PayrollGenerateController::class,'PayrollGenerateList'])->name('PayrollGenerateList');
        Route::get('/payrollGenerate-Info/{id}',[PayrollGenerateController::class,'payrollGenerateInfo'])->name('payrollGenerateInfo');
        Route::post('/payrollGenerate-delete',[PayrollGenerateController::class,'payrollGenerateDelete'])->name('payrollGenerateDelete');
        Route::get('/payrollGenerate-edit/{id}',[PayrollGenerateController::class,'getPayrollGenerate'])->name('getPayrollGenerate');
        Route::post('/payrollGenerate-update',[PayrollGenerateController::class,'updatePayrollGenerate'])->name('updatePayrollGenerate');
    });
    Route::group(['name' => 'generatePayslip','middleware' => 'auth'],function(){
        Route::get('/add-generatePayslip',[GeneratePayslipController::class,'GeneratePayslip'])->name('GeneratePayslip');
        Route::post('/add-generatePayslip-post',[GeneratePayslipController::class,'GeneratePayslipPost'])->name('GeneratePayslipPost');
    });
    Route::group(['name' => 'advanceSalary','middleware' => 'auth'],function(){
        Route::get('/add-advance-salary',[AdvanceSalaryController::class,'CreateAdvanceSalary'])->name('CreateAdvanceSalary');
        Route::get('/advance-salary-list',[AdvanceSalaryController::class,'advanceSalaryList'])->name('advanceSalaryList');
        Route::post('/add-advance-salary-post',[AdvanceSalaryController::class,'AdvanceSalaryPost'])->name('AdvanceSalaryPost');
        Route::get('/advance-salary-Info/{id}',[AdvanceSalaryController::class,'AdvanceSalaryInfo'])->name('AdvanceSalaryInfo');
        Route::post('/advance-salary-delete',[AdvanceSalaryController::class,'AdvanceSalaryDelete'])->name('AdvanceSalaryDelete');
        Route::get('/advance-salary-edit/{id}',[AdvanceSalaryController::class,'getAdvanceSalary'])->name('getAdvanceSalary');
        Route::post('/advance-salary-update',[AdvanceSalaryController::class,'AdvanceSalaryUpdate'])->name('AdvanceSalaryUpdate');
    });
});
Route::group(['name' => 'loan','middleware' => 'auth'],function(){
    Route::group(['name' => 'grantLoan','middleware' => 'auth'],function(){
        Route::get('/add-grantloan',[GrantLoanController::class,'addGrantLoanForm'])->name('addGrantLoanForm');
        Route::post('/add-grantloan-post',[GrantLoanController::class,'addGrantLoanPost'])->name('addGrantLoanPost');
        Route::get('/grantloan-loan-list',[GrantLoanController::class,'GrantLoanList'])->name('GrantLoanList');
        Route::get('/grantloan-edit/{id}',[GrantLoanController::class,'getGrantLoan'])->name('getGrantLoan');
        Route::get('/grantloan-Info/{id}',[GrantLoanController::class,'getGrantLoanInformation'])->name('getGrantLoanInformation');
        Route::post('/grantloan-delete',[GrantLoanController::class,'deleteGrantLoan'])->name('deleteGrantLoan');
        Route::post('/grantloan-update',[GrantLoanController::class,'GrantLoanUpdate'])->name('GrantLoanUpdate');
        });
        Route::group(['name' => 'loanInstallment','middleware' => 'auth'],function(){
            Route::get('/add-loanInstallment',[LoanInstallmentController::class,'addLoanInstallmentForm'])->name('addLoanInstallmentForm');
            Route::get('/loanInstallment-list',[LoanInstallmentController::class,'LoanInstallmentList'])->name('LoanInstallmentList');
            Route::post('/add-loanInstallment-post',[LoanInstallmentController::class,'addLoanInstallmentPost'])->name('addLoanInstallmentPost');
            Route::get('/loanInstallment-edit/{id}',[LoanInstallmentController::class,'getLoanInstallment'])->name('getLoanInstallment');
            Route::get('/loanInstallment-Info/{id}',[LoanInstallmentController::class,'getLoanInstallmentInformation'])->name('getLoanInstallmentInformation');
            Route::post('/loanInstallment-delete',[LoanInstallmentController::class,'deleteLoanInstallment'])->name('deleteLoanInstallment');
            Route::post('/loanInstallment-update',[LoanInstallmentController::class,'LoanInstallmentUpdate'])->name('LoanInstallmentUpdate');
        });
    });
    Route::group(['name' => 'shift','middleware' => 'auth'],function(){
        Route::group(['name' => 'shiftName','middleware' => 'auth'],function(){
            Route::get('/add-shift',[ShiftController::class,'addShift'])->name('addShift');
            Route::post('/add-shift-post',[ShiftController::class,'addShiftPost'])->name('addShiftPost');
            Route::get('/shift-list',[ShiftController::class,'ShiftList'])->name('ShiftList');
            Route::get('/shift-Info/{id}',[ShiftController::class,'getShiftInformation'])->name('getShiftInformation');
            Route::post('/shift-delete',[ShiftController::class,'deleteShift'])->name('deleteShift');
            Route::get('/shift-edit/{id}',[ShiftController::class,'getShift'])->name('getShift');
            Route::post('/shift-update',[ShiftController::class,'updateShift'])->name('updateShift');
        });
        Route::group(['name' => 'shiftSchedule','middleware' => 'auth'],function(){
        Route::get('/add-shift-schedule',[ShiftController::class,'addShiftSchedule'])->name('addShiftSchedule');
        Route::post('/add-shift-schedule-post',[ShiftController::class,'addShiftSchedulePost'])->name('addShiftSchedulePost');
        Route::get('/shift-schedule-list',[ShiftController::class,'ShiftScheduleList'])->name('ShiftScheduleList');
        Route::get('/shift-schedule-Info/{id}',[ShiftController::class,'getShiftScheduleInformation'])->name('getShiftScheduleInformation');
        Route::post('/shift-schedule-delete',[ShiftController::class,'deleteShiftSchedule'])->name('deleteShiftSchedule');
        Route::get('/shift-schedule-edit/{id}',[ShiftController::class,'getShiftSchedule'])->name('getShiftSchedule');
        Route::post('/shift-schedule-update',[ShiftController::class,'updateShiftSchedule'])->name('updateShiftSchedule');
        });
        Route::group(['name' => 'shiftSchedule','middleware' => 'auth'],function(){
            Route::get('/add-default-off-day',[ShiftController::class,'addDefaultOffDay'])->name('addDefaultOffDay');
            Route::post('/add-default-off-day-post',[ShiftController::class,'addDefaultOffDayPost'])->name('addDefaultOffDayPost');
            Route::get('/default-off-day-list',[ShiftController::class,'offDayList'])->name('offDayList');
            Route::get('/default-off-day-Info/{id}',[ShiftController::class,'getoffDayInformation'])->name('getoffDayInformation');
            Route::post('/default-off-day-delete',[ShiftController::class,'deleteoffDay'])->name('deleteoffDay');
            Route::get('/default-off-day-edit/{id}',[ShiftController::class,'getoffDay'])->name('getoffDay');
            Route::post('/update-default-off-day-post',[ShiftController::class,'updateDefaultOffDayPost'])->name('updateDefaultOffDayPost');
        });
    });
    Route::group(['name' => 'Attendance','middleware' => 'auth'],function(){
        Route::get('/daily-attendance',[DailyAttendanceController::class,'dailyAttendance'])->name('dailyAttendance');
        Route::get('/take-attendance',[DailyAttendanceController::class,'Attendance'])->name('Attendance');
        Route::post('/take-attendance-post',[DailyAttendanceController::class,'AttendancePost'])->name('AttendancePost');
        Route::get('/filter-attendance',[DailyAttendanceController::class,'filterAttendance'])->name('filterAttendance');
    });
});
Route::group(['name' => 'sales','middleware' => 'auth'],function(){
    Route::get('/all-sales',[SalesController::class,'allSales'])->name('allSales');
});
Route::group(['name' => 'bank','middleware' => 'auth'],function(){
    Route::get('/all-bank',[bankController::class,'allBank'])->name('all.bank');
    Route::get('/add-bank',[bankController::class,'addBank'])->name('add.bank');
    Route::post('/new-bank',[bankController::class,'createBank'])->name('new.bank');
    Route::get('/edit-bank/{id}',[bankController::class,'editBank'])->name('edit.bank');
    Route::post('/update-bank/{id}',[bankController::class,'updateBank'])->name('update.bank');
    Route::post('/delete-bank/{id}',[bankController::class,'deleteBank'])->name('delete.bank');
});
Route::group(['name' => 'bank_Deposit','middleware' => 'auth'],function(){
    Route::get('/all-deposit',[DepositController::class,'allDeposit'])->name('all.deposit');
    Route::get('/add-deposit',[DepositController::class,'addDeposit'])->name('add.deposit');
    Route::post('/new-deposit',[DepositController::class,'createDeposit'])->name('new.deposit');
    Route::get('/edit-deposit/{id}',[DepositController::class,'editDeposit'])->name('edit.deposit');
    Route::post('/update-deposit/{id}',[DepositController::class,'updateDeposit'])->name('update.deposit');
    Route::post('/delete-deposit/{id}',[DepositController::class,'deleteDeposit'])->name('delete.deposit');
});
Route::group(['name' => 'bank-Withdraw','middleware' => 'auth'],function(){
    Route::get('/all-withdraw',[WithdrawController::class,'allWithdraw'])->name('all.withdraw');
    Route::get('/add-withdraw',[WithdrawController::class,'addWithdraw'])->name('add.withdraw');
    Route::post('/new-withdraw',[WithdrawController::class,'createWithdraw'])->name('new.withdraw');
    Route::get('/edit-withdraw/{id}',[WithdrawController::class,'editWithdraw'])->name('edit.withdraw');
    Route::post('/update-withdraw/{id}',[WithdrawController::class,'updateWithdraw'])->name('update.withdraw');
    Route::post('/delete-withdraw/{id}',[WithdrawController::class,'deleteWithdraw'])->name('delete.withdraw');
});
Route::group(['name' => 'bank-Account','middleware' => 'auth'],function(){
    Route::get('/all-account',[AccountController::class,'allAccount'])->name('all.account');
    Route::get('/all-acc-balance',[AccountController::class,'allAccountBalance'])->name('all.account.balance');
    Route::get('/add-account',[AccountController::class,'addAccount'])->name('add.account');
    Route::post('/new-account',[AccountController::class,'createAccount'])->name('new.account');
    Route::get('/edit-account/{id}',[AccountController::class,'editAccount'])->name('edit.account');
    Route::post('/update-account/{id}',[AccountController::class,'updateAccount'])->name('update.account');
    Route::post('/delete-account/{id}',[AccountController::class,'deleteAccount'])->name('delete.account');
});
Route::group(['name' => 'bank-Account','middleware' => 'auth'],function(){
    Route::group(['name' => 'bank-Account','middleware' => 'auth'],function(){
        Route::get('/all-account-type',[AccountTypeController::class,'allAccountType'])->name('allAccountType');
        Route::get('/get-account-type/{id}',[AccountTypeController::class,'getAccountType'])->name('getAccountType');
        Route::post('/update-account-type',[AccountTypeController::class,'updateAccountType'])->name('updateAccountType');
    });
    Route::group(['name' => 'account-group','middleware' => 'auth'],function(){
        Route::get('/account-group',[AccountGroupController::class,'addAccountGroup'])->name('addAccountGroup');
        Route::post('/account-group-post',[AccountGroupController::class,'addAccountGroupPost'])->name('addAccountGroupPost');
        Route::get('/account-group-list',[AccountGroupController::class,'AccountGroupList'])->name('AccountGroupList');
       Route::get('/get-account-group-info/{id}',[AccountGroupController::class,'getAccountGroupInformation'])->name('getAccountGroupInformation');
        Route::post('/account-group-delete',[AccountGroupController::class,'deleteAccountGroup'])->name('deleteAccountGroup');
        Route::post('/account-group-update',[AccountGroupController::class,'updateAccountGroup'])->name('updateAccountGroup');
      Route::get('/account-group-get/{id}',[AccountGroupController::class,'getAccountGroup'])->name('getAccountGroup');
        Route::get('/account-group-search',[AccountGroupController::class,'AccountGroupSearch'])->name('AccountGroupSearch');
    });
    Route::group(['name' => 'account-chart','middleware' => 'auth'],function(){
        Route::get('/account-chart',[AccountChartController::class,'addAccountChart'])->name('addAccountChart');
        Route::get('/account-chart-list',[AccountChartController::class,'AccountChartList'])->name('AccountChartList');
//        Route::post('/account-chart-post',[AccountChartController::class,'addAccountChartPost'])->name('addAccountChartPost');
        Route::get('/get-account-chart-info/{id}',[AccountChartController::class,'getAccountChartInformation'])->name('getAccountChartInformation');
        Route::post('/account-chart-delete',[AccountChartController::class,'deleteAccountChart'])->name('deleteAccountChart');
        Route::get('/account-chart-search',[AccountChartController::class,'AccountChartSearch'])->name('AccountChartSearch');
        Route::get('/account-chart-get/{id}',[AccountChartController::class,'getAccountChart'])->name('getAccountChart');
        Route::post('/account-chart-update',[AccountChartController::class,'updateAccountChart'])->name('updateAccountChart');
    });
    Route::group(['name' => 'journal-entry','middleware' => 'auth'],function(){
        Route::group(['name' => 'general-journal-entry','middleware' => 'auth'],function(){
            Route::get('/add-generalJournal',[GeneralJournalController::class,'addgeneralJournal'])->name('addgeneralJournal');
            Route::get('/generalJournal-list',[GeneralJournalController::class,'generalJournalList'])->name('generalJournalList');
            Route::get('/get-generalJournal-info/{id}',[GeneralJournalController::class,'getGeneralJournal'])->name('getGeneralJournal');
            Route::post('/generalJournal-delete',[GeneralJournalController::class,'deleteGeneralJournal'])->name('deleteGeneralJournal');
        });
        Route::group(['name' => 'adjusting-journal-entry','middleware' => 'auth'],function(){
            Route::get('/add-adjustingJournal',[AdjustingJournalController::class,'addadjustingJournal'])->name('addadjustingJournal');
            Route::get('/adjustingJournal-list',[AdjustingJournalController::class,'adjustingJournalList'])->name('adjustingJournalList');
            Route::get('/get-adjustingJournal-info/{id}',[AdjustingJournalController::class,'getAdjustingJournal'])->name('getAdjustingJournal');
            Route::post('/adjustingJournal-delete',[AdjustingJournalController::class,'deleteAdjustingJournal'])->name('deleteAdjustingJournal');
        });
    });

    Route::group(['name' => 'ledger','middleware' => 'auth'],function(){
        Route::get('/generalledger-list',[generalledgerController::class,'generalLedgerList'])->name('generalLedgerList');
        Route::get('/receivable/{id}',[generalledgerController::class,'receivableList'])->name('receivableList');
        Route::get('/filter-receivable',[generalledgerController::class,'filterReceivableList'])->name('filterReceivableList');
    });

});

Route::group(['name' => 'Expense-Category','middleware' => 'auth'],function(){
    Route::get('/all-exp-category',[ExpCategoryController::class,'allCategory'])->name('all.exp.category');
    Route::get('/add-exp-category',[ExpCategoryController::class,'addCategory'])->name('add.exp.category');
    Route::post('/new-exp-category',[ExpCategoryController::class,'createCategory'])->name('new.exp.category');
    Route::get('/edit-exp-category/{id}',[ExpCategoryController::class,'editCategory'])->name('edit.exp.category');
    Route::post('/update-exp-category/{id}',[ExpCategoryController::class,'updateCategory'])->name('update.exp.category');
    Route::post('/delete-exp-category/{id}',[ExpCategoryController::class,'deleteCategory'])->name('delete.exp.category');
});
Route::group(['name' => 'Expense','middleware' => 'auth'],function(){
    Route::get('/all-exp',[ExpenseController::class,'allExpense'])->name('all.exp');
    Route::get('/add-exp',[ExpenseController::class,'addExpense'])->name('add.exp');
    Route::post('/new-exp',[ExpenseController::class,'createExpense'])->name('new.exp');
    Route::get('/edit-exp/{id}',[ExpenseController::class,'editExpense'])->name('edit.exp');
    Route::post('/update-exp/{id}',[ExpenseController::class,'updateExpense'])->name('update.exp');
    Route::post('/delete-exp/{id}',[ExpenseController::class,'deleteExpense'])->name('delete.exp');
});
Route::group(['name' => 'FundTransfer','middleware' => 'auth'],function(){
    Route::get('/all-transfer',[TransferController::class,'allTransfer'])->name('all.transfer');
    Route::get('/add-transfer',[TransferController::class,'addTransfer'])->name('add.transfer');
    Route::post('/new-transfer',[TransferController::class,'createTransfer'])->name('new.transfer');
//    Route::get('/edit-exp/{id}',[ExpenseController::class,'editExpense'])->name('edit.exp');
//    Route::post('/update-exp/{id}',[ExpenseController::class,'updateExpense'])->name('update.exp');
//    Route::post('/delete-exp/{id}',[ExpenseController::class,'deleteExpense'])->name('delete.exp');
});
Route::group(['name' => 'stock','middleware' => 'auth'],function(){
    Route::group(['name' => 'stockList','middleware' => 'auth'],function(){
        Route::get('/stock-data',[StockController::class,'createStock']);
        Route::get('/stock-list',[StockController::class,'stockList'])->name('stockList');
    });
    Route::group(['name' => 'stockAdjustment','middleware' => 'auth'],function(){
        Route::get('/add-stockAdjustment',[stockAdjustmentController::class,'addstockAdjust'])->name('addstockAdjust');
        Route::get('/stockAdjustment-list',[stockAdjustmentController::class,'stockAdjustList'])->name('stockAdjustList');
        Route::post('/add-stockAdjustment-post',[stockAdjustmentController::class,'addstockAdjustPost'])->name('addstockAdjustPost');
        Route::post('/update-stockAdjustment',[stockAdjustmentController::class,'UpdatestockAdjust'])->name('UpdatestockAdjust');
        Route::get('/stockAdjustment-Info/{id}',[stockAdjustmentController::class,'stockAdjustInfo'])->name('stockAdjustInfo');
        Route::get('/get-stockAdjustment/{id}',[stockAdjustmentController::class,'getStockAdjust'])->name('getStockAdjust');
        Route::get('/stockAdjustment-search',[stockAdjustmentController::class,'stockAdjustSearch'])->name('stockAdjustSearch');
        Route::post('/stockAdjustment-delete',[stockAdjustmentController::class,'stockAdjustDelete'])->name('stockAdjustDelete');
    });
    Route::group(['name' => 'stockTransfer','middleware' => 'auth'],function(){
        Route::get('/add-stockTransfer',[stockTransferController::class,'stockTransfer'])->name('stockTransfer');
        Route::post('/add-stockTransfer-post',[stockTransferController::class,'stockTransferPost'])->name('stockTransferPost');
        Route::post('/stockTransfer-update',[stockTransferController::class,'stockTransferUpdate'])->name('stockTransferUpdate');
        Route::get('/stockTransfer-list',[stockTransferController::class,'stockTransferList'])->name('stockTransferList');
        Route::get('/stockTransfer-Info/{id}',[stockTransferController::class,'stockTransferInfo'])->name('stockTransferInfo');
        Route::get('/get-stockTransfer/{id}',[stockTransferController::class,'getstockTransfer'])->name('getstockTransfer');
        Route::post('/stockTransfer-delete',[stockTransferController::class,'stockTransferDelete'])->name('stockTransferDelete');
        Route::get('/stockTransfer-search',[stockTransferController::class,'stockTransferSearch'])->name('stockTransferSearch');
    });

});
Route::group(['name' => 'Supplier-Payment','middleware' => 'auth'],function(){
    Route::get('/all-supplier-payment',[SupplierPaymentController::class,'allSupplierPaymentDetails'])->name('all.supplier.payment');
    Route::get('/supplier-transaction-list/{id}',[SupplierPaymentController::class,'supplierTransactions'])->name('supplier.transaction.list');
    Route::post('/new-supplier-payment',[SupplierPaymentController::class,'createSupplier'])->name('new.supplier-payment');
});
Route::group(['name' => 'PainterBill-House-Area-Type','middleware' => 'auth'],function(){
    Route::get('/pb/house-area-type/all',[Pb_HouseAreaTypeController::class,'allHouseAreaType'])->name('pb.hat.all');
    Route::get('/pb/house-area-type/add',[Pb_HouseAreaTypeController::class,'addHouseAreaType'])->name('pb.hat.add');
    Route::get('/pb/house-area-type/edit',[Pb_HouseAreaTypeController::class,'editHouseAreaType'])->name('pb.hat.edit');
    Route::post('/pb/house-area-type/update',[Pb_HouseAreaTypeController::class,'updateHouseAreaType'])->name('pb.hat.update');
    Route::post('/pb/house-area-type/new',[Pb_HouseAreaTypeController::class,'createHouseAreaType'])->name('pb.hat.new');
    Route::post('/pb/house-area-type/delete',[Pb_HouseAreaTypeController::class,'deleteHouseAreaType'])->name('pb.hat.delete');
});
Route::group(['name' => 'PainterBill-Decoration-Type','middleware' => 'auth'],function(){
    Route::get('/pb/decoration-type/all',[Pb_DecorationTypeController::class,'allDecorationType'])->name('pb.dec.all');
    Route::get('/pb/decoration-type/add',[Pb_DecorationTypeController::class,'addDecorationType'])->name('pb.dec.add');
    Route::get('/pb/decoration-type/edit',[Pb_DecorationTypeController::class,'editDecorationType'])->name('pb.dec.edit');
    Route::post('/pb/decoration-type/update',[Pb_DecorationTypeController::class,'updateDecorationType'])->name('pb.dec.update');
    Route::post('/pb/decoration-type/new',[Pb_DecorationTypeController::class,'createDecorationType'])->name('pb.dec.new');
    Route::post('/pb/decoration-type/delete',[Pb_DecorationTypeController::class,'deleteDecorationType'])->name('pb.dec.delete');
});
Route::group(['name' => 'PainterBill-Color','middleware' => 'auth'],function(){
    Route::get('/pb/color/all',[Pb_ColorController::class,'allColor'])->name('pb.color.all');
    Route::get('/pb/color/add',[Pb_ColorController::class,'addColor'])->name('pb.color.add');
    Route::get('/pb/color/edit',[Pb_ColorController::class,'editColor'])->name('pb.color.edit');
    Route::post('/pb/color/update',[Pb_ColorController::class,'updateColor'])->name('pb.color.update');
    Route::post('/pb/color/new',[Pb_ColorController::class,'createColor'])->name('pb.color.new');
    Route::post('/pb/color/delete',[Pb_ColorController::class,'deleteColor'])->name('pb.color.delete');
});
Route::group(['name' => 'PainterBill-Color-Quantity','middleware' => 'auth'],function(){
    Route::get('/pb/color-qty/add',[Pb_ColorQuantityController::class,'addColorQty'])->name('pb.color.qty.add');
});

//sales report
Route::group(['name' => 'report','middleware' => 'auth'],function(){
    Route::get('/sales-report',[SalesReportController::class,'index'])->name('sales-report');
    Route::get('/create-sales-report',[SalesReportController::class,'create'])->name('create-sales-report');
    Route::post('/store-sales-report',[SalesReportController::class,'store'])->name('store-sales-report');
});


    Route::group(['name' => 'balanceReport','middleware' => 'auth'],function(){
        Route::get('/balance-report',[BalanceReportController::class,'balanceReport'])->name('balanceReport');
        Route::get('/filter-balance-report',[BalanceReportController::class,'filterBalancereport'])->name('filterBalancereport');
    });
Route::group(['name' => 'accountingMethod','middleware' => 'auth'],function(){
    Route::get('/profitAndLoss-report',[ProfitAndLossController::class,'profitAndLossReport'])->name('profitAndLossReport');
    Route::get('/filter-profitAndLoss-report',[ProfitAndLossController::class,'FilterprofitAndLossReport'])->name('FilterprofitAndLossReport');
});



