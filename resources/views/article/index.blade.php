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
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Authorization',
                        // "Bearer notAuth" + sessionStorage.getItem('accesstoken'));
                        "Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjBhZmRkOTgxZGM4Y2QyNDM5MzQyMDE1NTU2MzljZmUyNTM4YmI4MTY2MWI0OThmY2JhZTFhYzBiYjdlY2NhODJiNTczMTllNDZkZWVkNDRiIn0.eyJhdWQiOiIxIiwianRpIjoiMGFmZGQ5ODFkYzhjZDI0MzkzNDIwMTU1NTYzOWNmZTI1MzhiYjgxNjYxYjQ5OGZjYmFlMWFjMGJiN2VjY2E4MmI1NzMxOWU0NmRlZWQ0NGIiLCJpYXQiOjE1NTc1Nzk5MDQsIm5iZiI6MTU1NzU3OTkwNCwiZXhwIjoxNTg5MjAyMzA0LCJzdWIiOiIyIiwic2NvcGVzIjpbXX0.uwZuZ2Mfx_8zcIKNRgYzoXra6lLyL98HX56LyBOH-VOiYR3aGu3nhJMIUE6m01NF5RDRqjziM3lWVhBJbbTXUAOa8BZNw3UVVs1ylUua9yiNQy82EAW7mI_pbQjGZAP45hWgQeqanZLRrJqHiLcnkwDSgNp_12U9tN0f3mQ2tgyv48eJnA0ERWgUF4Y7Pps_w7WjSGECeuFSMVPU7Ej5-xNz4rpRo_mRUWvrHldzWw2msp-EWgsag0wCyMfpKlSs6ZYFLAC0RLCyuPnNXLWb_IPO21ExbzoC2oXM2OarjFmQqwoBw5ygPwFU4xaIRX4uMf2KLMFyOmtU5AkNvgjH13EzJUGWj4-FaI0Oo2BagDMs1jjhgHsfgbbzbk_z7KvrmX7IuDVa3pp8xzLtrD7CHPYSOzPjDIjMeIx-WEd7BbzeXjEKguRO1OqFPJc8OQeSIonvb7aM4WMZ05uZAnhhacbsmqK61gWVIGimlsJKqwCWUL7ZoRY0q2JdyYWYUImrawYOXhsmrpJpMz3zzM8A-PKR5yuXzubALyd3B8YOMH2kQ6rsAkbFsRN_gud08uzIJ6yC1siHPxO4nGqxCfUR8zV9iZQzdeDIK4fa6DXG6smdZRRl9mgcBy0ZexyehuPFKdZDtT2go1rDuhmTDca3WeDOA5o5Ibu_x1FVznvIfD0");
                },
                data: {
                    userid: "anmtd",
                },
                error: function() {
                    console.log('Not Found');
                },
                timeout: 3000,
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