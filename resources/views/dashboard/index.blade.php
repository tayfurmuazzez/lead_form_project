@extends('layouts.master')
@section('title','Dashboard')
@section('styles')
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2" style="font-size: xxx-large; color: midnightblue;">
                <b>
                    WELCOME DASHBOARD PAGE
                </b>
            </div>
            <div class="col-md-2" style="padding-top: 20px;">
                <a class="btn btn-sm btn-danger" href="{{route('logout')}}">Log Out</a>
            </div>

            <div class="col-md-8 col-md-offset-2">
                @if($isAdmin)
                    <div class="alert alert-success text-muted mt-1" role="alert">
                        You are admin so you can see lead forms...
                    </div>
                @else
                    <div class="alert alert-danger text-muted mt-1" role="alert">
                        You are not admin so you can not see lead forms...
                    </div>
                @endif
            </div>

            @if($isAdmin)
                <div class="col-md-12 card card-block">
                    <div class="container">
                        <div class="mt-3 table-responsive">
                            <table class="table table-bordered data-table mt-2 w-100">
                            </table>
                        </div>
                    </div>
                </div>
            @endif

        </div>

    </div>


@endsection

@section('scripts')
    <script type="text/javascript">
        let datatable = null;

        @if($isAdmin)
        datatable = $('.data-table').DataTable({
            processing: true,
            serverSide: true,
            responsive:true,
            ordering:false,
            ajax: {
                url : "{{ route('getLeadFormList') }}",
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data:function(d){
                    d.userId = "{{$userId}}"
                },
            },
            columns: [
                {data: 'name',title: 'Customer Name'},
                {data: 'email',title: 'Customer Email'},
                {data: 'phone_number',title: 'Phone Number'},
                {data: 'address',title: 'Customer Address'},
                {data: 'comment',title: 'Comment'},
                {data: 'reference_page',name:'reference_page',title: 'Reference Page'},
                {data: 'server_ip',title: 'Reference Page'},
                {data: 'created_at',title: 'Created At'}
            ]
        });
        @endif
    </script>
@endsection
