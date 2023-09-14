@extends('master.app')
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <section class="py-5 bg-light">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 mx-auto">
                        <div class="card">
                            <div class="card-header">Edit Account</div>
                            <div class="card-body">
                                <h4 class="text-success">{{ Session::get('message') }}</h4>
                                <form action="{{route('update.account',['id'=>$acc->id])}}" method="POST">
                                    @csrf
                                    <add-account :acc="{{json_encode($acc) }}"></add-account>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- /.content-wrapper -->
@endsection
<script>
    import addAccount from "../../js/components/addAccount";
    export default {
        components: {addAccount}
    }
</script>
