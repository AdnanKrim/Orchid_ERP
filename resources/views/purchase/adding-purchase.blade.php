@extends('master.app')
@section('content')

    <div class="content-wrapper"  >

        <section class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        <h4 class="text-success">{{ Session::get('message') }}</h4>
                        <div class="card">
                            <div class="card-header">Add Purchase </div>
                            <div class="card-body">
                                <add-purchase :userr={{ Auth::user() }}></add-purchase>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>





@endsection

<script>

    import AddPurchase from "../../js/components/AddPurchase";
    export default {
        components: {AddPurchase}
    }
</script>
