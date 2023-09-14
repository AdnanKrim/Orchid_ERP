@extends('master.app')
@section('content')

    <div class="content-wrapper"  >

        <section class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        <h4 class="text-success">{{ Session::get('message') }}</h4>
                        <div class="card">
                            <div class="card-header">Add General Journal Entry </div>
                            <div class="card-body">
                                <add-general-journal :userr={{ Auth::user() }}></add-general-journal>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>





@endsection
<script>
    import AddGeneralJournal from "../../../../js/components/addGeneralJournal";
    export default {
        components: {AddGeneralJournal}
    }
</script>
