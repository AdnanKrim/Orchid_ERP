@extends('master.app')
@section('content')

    <div class="content-wrapper"  >

        <section class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        <h4 class="text-success">{{ Session::get('message') }}</h4>
                        <div class="card">
                            <div class="card-header">Update Purchase </div>
                            <div class="card-body">
                                <update-purchase > </update-purchase>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>


{{--    :purchase = "{!! $id !!}  "--}}


@endsection
<script>
    import UpdatePurchase from "../../js/components/UpdatePurchase";

    export default {
        components: {UpdatePurchase}
    }
</script>
