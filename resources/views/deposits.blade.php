@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
					<table class="table">
						<thead>
						  <tr>
							<th scope="col">#</th>
							<th scope="col">invested</th>
							<th scope="col">percent</th>
							<th scope="col">percent total</th>
							<th scope="col">accrue_times</th>
							<th scope="col">active</th>
							<th scope="col">created_at</th>
						  </tr>
						</thead>
						<tbody>
						    @foreach ($deposits as $deposit)
							<tr>
								<th scope="row">{{ $deposit->id }}</th>
								<td>{{ $deposit->invested }}</td>
								<td>{{__('20%')}}</td>
								<td>{{ $deposit->percent }}</td>
								<td>{{ $deposit->accrue_times }}</td>
								<td>{{ $deposit->active }}</td>
								<td>{{ $deposit->created_at }}</td>
							</tr>
							@endforeach
						</tbody>
					  </table>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

