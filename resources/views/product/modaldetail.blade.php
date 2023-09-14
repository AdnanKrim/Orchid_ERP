
<div class="modal fade" id="detailModal{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content" >
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Product Detail</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="modal-element" >
                     <div class="row" style="background-color: orange;">
                         <label class="col-md-6 col-form-label">Product Name:</label>
                         <label class="col-md-6 col-form-label">{{$product->productName}}</label>
                     </div>
                    <div class="row">
                        <label class="col-md-6 col-form-label">Product Code:</label>
                        <label class="col-md-6 col-form-label">{{$product->productCode}}</label>
                    </div>
                    <div class="row"style="background-color: orange;">
                        <label class="col-md-6 col-form-label">SKU</label>
                        <label class="col-md-6 col-form-label">{{$product->SKU}}</label>
                    </div>
                    <div class="row">
                        <label class="col-md-6 col-form-label">Category:</label>
                        <label class="col-md-6 col-form-label">{{$product->categoryId}}</label>
                    </div>
                    <div class="row"style="background-color: orange;">
                        <label class="col-md-6 col-form-label">Sub Category:</label>
                        <label class="col-md-6 col-form-label">{{$product->subCategoryId}}</label>
                    </div>
                    <div class="row">
                        <label class="col-md-6 col-form-label">Unit:</label>
                        <label class="col-md-6 col-form-label">{{$product->unitId}}</label>
                    </div>
                    <div class="row"style="background-color: orange;">
                        <label class="col-md-6 col-form-label">Brand:</label>
                        <label class="col-md-6 col-form-label">{{$product->brandId}}</label>
                    </div>
                    <div class="row">
                        <label class="col-md-6 col-form-label">Model:</label>
                        <label class="col-md-6 col-form-label">{{$product->modelId}}</label>
                    </div>
                    <div class="row"style="background-color: orange;" >
                        <label class="col-md-6 col-form-label">Size:</label>
                        <label class="col-md-6 col-form-label">{{$product->sizeId}}</label>
                    </div>
                    <div class="row">
                        <label class="col-md-6 col-form-label">Color:</label>
                        <label class="col-md-6 col-form-label">{{$product->colorId}}</label>
                    </div>
                    <div class="row"style="background-color: orange;">
                        <label class="col-md-6 col-form-label">Length:</label>
                        <label class="col-md-6 col-form-label">{{$product->length}}</label>
                    </div>
                    <div class="row">
                        <label class="col-md-6 col-form-label">Height:</label>
                        <label class="col-md-6 col-form-label">{{$product->height}}</label>
                    </div>
                    <div class="row"style="background-color: orange;">
                        <label class="col-md-6 col-form-label">Width:</label>
                        <label class="col-md-6 col-form-label">{{$product->width}}</label>
                    </div>
                    <div class="row">
                        <label class="col-md-6 col-form-label">Business Branch:</label>
                        <label class="col-md-6 col-form-label">{{$product->businessBranchId}}</label>
                    </div>
                    <div class="row"style="background-color: orange;">
                        <label class="col-md-6 col-form-label">Description:</label>
                        <label class="col-md-6 col-form-label">{{$product->note}}</label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



