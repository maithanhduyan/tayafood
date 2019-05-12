@extends('layouts.app')

@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('libs/datatables/css/jquery.dataTables.css')}}">
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="articleTable" class="display" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Body</th>
                                    <th>created_at</th>
                                    <th>updated_at</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script type="text/javascript" charset="utf8" src="{{asset('libs/datatables/js/jquery.dataTables.min.js')}}"></script>

<script>
    $(document).ready(function() {
        $.fn.dataTable.ext.errMode = 'throw';
        var table = $('#articleTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                type: 'GET',
                contentType: "application/json",
                url: "{{route('articles.list')}}",
                dataType: 'json',
            },
            columns: [{
                    "data": "id"
                },
                {
                    "data": "title"
                },
                {
                    "data": "body"
                },
                {
                    "data": "created_at"
                },
                {
                    "data": "updated_at"
                },
            ],
            ordering: true,
            info: false,
        });

    });
</script>
@endpush