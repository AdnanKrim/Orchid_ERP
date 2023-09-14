@extends('master.app')
@section('content')

    <div class="content-wrapper"  >

        <section class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 mx-auto">
                        <h4 class="text-success">{{ Session::get('message') }}</h4>
                        <div class="card">
                            <div class="card-header">Create Chart of Account </div>
                            <div class="card-body">
                                <add-account-chart></add-account-chart>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>





@endsection
<script>
    import addAccountChart from "../../../../js/components/addAccountChart";
    export default {
        components: {addAccountChart}
    }
</script>
