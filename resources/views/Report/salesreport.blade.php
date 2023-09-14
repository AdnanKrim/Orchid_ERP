@extends('master.app')
@section('content')
<div class="content-wrapper">
    <section class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 mx-auto">
                        <div class="card">
                            <div class="card-header">
                                <span>Sales Report</span>
                                <span class="float-right col-md-6">
                                    <a href="{{route('create-sales-report')}}" class="btn btn-success float-right">
                                        +Add
                                    </a>
                                </span>

                            </div>
                            <div class="card-body">
                                <sales-report></sales-report>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
      </div>
    @endsection
    <script>
        import salesReport from "../../../js/components/salesReport";
        export default {
            components: {salesReport}
        }
    </script>

