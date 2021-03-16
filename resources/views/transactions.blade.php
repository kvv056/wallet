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
							<th scope="col">amount</th>
							<th scope="col">type</th>
							<th scope="col">created_at</th>
						  </tr>
						</thead>
						<tbody>
						    @foreach ($transactions as $transaction)
							<tr>
								<th scope="row">{{ $transaction->id }}</th>
								<td>{{ $transaction->amount }}</td>
								<td>{{ $transaction->type }}</td>
								<td>{{ $transaction->created_at }}</td>
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

