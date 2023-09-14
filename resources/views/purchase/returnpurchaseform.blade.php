@extends('master.app')
@section('content')

    <div class="content-wrapper"  >

        <section class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        <h4 class="text-success">{{ Session::get('message') }}</h4>
                        <div class="card">
                            <div class="card-header">Return Purchase </div>
                            <div class="card-body">
                                <return-purchase></return-purchase>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


@endsection
<script>
    import ReturnPurchase from "../../js/components/ReturnPurchase";
    export default {
        components: {ReturnPurchase}
    }
</script>
