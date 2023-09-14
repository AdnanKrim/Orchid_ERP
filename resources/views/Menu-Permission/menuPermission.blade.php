@extends('CRM.layouts_successLeeds.app')
@section('content')
<div class="content-wrapper">
<section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 mx-auto">
                    <div class="card">
                        <div class="card-header">
                            <span>Menu Permission</span>
                        </div>
                        <div class="card-body">
                            <menu-permission></menu-permission>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  </div>
@endsection
<script>
    import MenuPermission from "../../../js/components/MenuPermission";
    export default {
        components: {MenuPermission}
    }
</script>


