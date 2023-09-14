@extends('CRM.layouts_successLeeds.leedsNav')
@section('leedContent')

    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Add Quotation</div>
            <div class="card-body">
                <h4 class="text-success">{{ Session::get('message') }}</h4>
                <form action="{{route('new-quotation', ['id'=>$leed->id])}}" method="POST">
                    @csrf
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">House Area Type</label>
                        <div class="col-md-8">
                            <input type="text" list="typeSub" class="form-control" required name="houseAreaTypeId">
                            <datalist id="typeSub">
                                @foreach($subBodies as $subBody)
                                    <option>{{$subBody->subject}}</option>
                                @endforeach
                            </datalist>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Decoration Type</label>
                        <div class="col-md-8">
                            <input type="text" list="typeSub" class="form-control" required name="decorType">
                            <datalist id="typeSub">
                                @foreach($subBodies as $subBody)
                                    <option>{{$subBody->subject}}</option>
                                @endforeach
                            </datalist>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Subject</label>
                        <div class="col-md-8">
                            <input type="text" list="typeSub" class="form-control" required name="subject">
                            <datalist id="typeSub">
                                @foreach($subBodies as $subBody)
                                    <option>{{$subBody->subject}}</option>
                                @endforeach
                            </datalist>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Body</label>
                        <div class="col-md-8">
                            <input type="text" list="typeBody" list="type" class="form-control" required name="body">
                            <datalist id="typeBody">
                                @foreach($subBodies as $subBody)
                                    <option>{{$subBody->body}}</option>
                                @endforeach
                            </datalist>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Total Amount</label>
                        <div class="col-md-8">
                            <input type="number" class="form-control" required name="totalAmount"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Total Vat</label>
                        <div class="col-md-8">
                            <input type="number" class="form-control" required name="totalVat"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Grand Total</label>
                        <div class="col-md-8">
                            <input type="number" class="form-control" required name="grandTotal"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label">Note</label>
                        <div class="col-md-8">
                            <input type="text" class="form-control" required name="note"/>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-4 col-form-label"></label>
                        <div class="col-md-8">
                            <input type="submit" class="btn btn-success" value="Save"/>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>



@endsection('leedContent')

