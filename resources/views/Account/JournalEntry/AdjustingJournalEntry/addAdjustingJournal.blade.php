@extends('master.app')
@section('content')

    <div class="content-wrapper"  >

        <section class="py-5">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 mx-auto">
                        <h4 class="text-success">{{ Session::get('message') }}</h4>
                        <div class="card">
                            <div class="card-header">Add Adjusting Journal Entry </div>
                            <div class="card-body">
                                <add-adjusting-journal :userr={{ Auth::user() }}></add-adjusting-journal>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>





@endsection
<script>
    import AddAdjustingJournalJournal from "../../../../js/components/addAdjustingJournal";
    export default {
        components: {AddAdjustingJournalJournal}
    }
</script>
