@extends('CRM.layouts_successLeeds.leedsNav')
@section('leedContent')
    <div class="content-wrapper mx-auto">
        <section class="pb-5 pt-0">
            <div class="mx-3 px-5">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">Measurement Cart</div>
                            <div class="card-body">
{{--                                <h4 class="text-success">{{ Session::get('message') }}</h4>--}}
                                <measure-cart></measure-cart>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>



    </div>

@endsection
<script>
    import MeasureCart from "../../../../js/components/measureCart";
    export default {
        components: {MeasureCart}
    }
</script>
