@extends('admin.layouts.app')
@section('content')
    <!-- [ breadcrumb ] start -->
    {{ Breadcrumbs::render('admin.events.show') }}
    <!-- [ breadcrumb ] end -->


    <!-- [ Main Content ] start -->
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header">
                    <h5>Hello card</h5>
                </div>
                <div class="card-body">
                    Lorem ipsum dolor, sit amet consectetur adipisicing elit. Labore error beatae assumenda aliquid? Iusto
                    sequi repellendus
                    doloribus dicta, voluptate odit odio perferendis id ipsam similique quasi praesentium sint saepe?
                    Obcaecati!
                </div>
            </div>
        </div>
        <!-- [ sample-page ] end -->
    </div>
    <!-- [ Main Content ] end -->
@endsection
