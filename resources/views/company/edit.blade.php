@extends('adminlte::page')
@section('title', 'Dashboard')

@if (Auth::user()->account_type == 'Z' || Auth::user()->account_type == 'A' && Auth::user()->company_name == $company->company_name)
	@section('content_header')
		<h1>Editing {{ $company->company_name }}'s Profile</h1><hr>
		<img src="{{ asset('app/logo/'.$company->logo) }}" alt="{{ $company->company_name }} Logo" title="{{ $company->company_name }} Logo" style="width: 100px; top: 20px; right:60px; position: absolute;">
	@stop

	@section('content')
		<div class="col-xs-6" style="margin: 20px;">
			<div class="register-box-body">
				<form action="{{ route('company.edit', $company->company_name) }}" method="POST">
					{{ method_field('PUT') }}
					{!! csrf_field() !!}

					<div class="form-group has-feedback {{ $errors->has('company_name') ? 'has-error' : '' }}">
						<label>Company Name:</label>
						<input type="text" name="company_name" class="form-control" autocomplete="off" value="{{ $company->company_name }}" required autofocus> 
						<span class="glyphicon glyphicon-user form-control-feedback"></span>
						@if ($errors->has('company_name'))
							<span class="help-block">
								<strong>{{ $errors->first('company_name') }}</strong>
							</span>
						@endif
					</div>

					<div class="form-group has-feedback {{ $errors->has('address') ? 'has-error' : '' }}">
						<label>Address:</label>
						<input type="text" name="address" class="form-control" autocomplete="off" value="{{ $company->address }}">
						<span class="glyphicon glyphicon-home form-control-feedback"></span>
						@if ($errors->has('address'))
							<span class="help-block">
								<strong>{{ $errors->first('address') }}</strong>
							</span>
						@endif
					</div>

					<div class="form-group has-feedback {{ $errors->has('email') ? 'has-error' : '' }}">
						<label>Email:</label>
						<input type="email" name="email" class="form-control" autocomplete="off" value="{{ $company->email }}">
						<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
						@if ($errors->has('email'))
							<span class="help-block">
								<strong>{{ $errors->first('email') }}</strong>
							</span>
						@endif
					</div>

					<div class="form-group has-feedback {{ $errors->has('phone') ? 'has-error' : '' }}">
						<label>Contact Number:</label>
						<input type="text" name="phone" class="form-control" autocomplete="off" value="{{ $company->phone }}">
						<span class="glyphicon glyphicon-phone form-control-feedback"></span>
						@if ($errors->has('phone'))
							<span class="help-block">
								<strong>{{ $errors->first('phone') }}</strong>
							</span>
						@endif
					</div>

					<div class="form-group has-feedback {{ $errors->has('fax') ? 'has-error' : '' }}">
						<label>FAX:</label>
						<input type="text" name="fax" class="form-control" autocomplete="off" value="{{ $company->fax }}">
						<span class="glyphicon glyphicon-fax form-control-feedback"></span>
						@if ($errors->has('fax'))
							<span class="help-block">
								<strong>{{ $errors->first('fax') }}</strong>
							</span>
						@endif
					</div>

					<div class="form-group has-feedback {{ $errors->has('logo') ? ' has-error' : '' }}">
						<label>Logo:</label>
						<span class="glyphicon glyphicon-image form-control-feedback"></span>
						<div>
							<select id="logo" name="logo" class="form-control">
									<option value="">None</option>
							@foreach($files as $file)
								@if($file->company_name == Auth::user()->company_name)
									<option value="{{ $file->file_name }}" >{{ $file->file_name }}</option>
								@else
								@endif
							@endforeach
							</select> 
						</div>
					</div>
					&emsp;

					<button type="submit" class="btn btn-primary btn-block btn-flat"> Update </button>
				</form>
			</div>
		</div>
		<div>
			<div class="col-xs-4">
				<div class="well edit-form-group" style="background-color: #636B6F; color: #F5F8FA; margin: 20px;">
					<h4>Further Infomation</h4>
					<hr>
					<dl class="dl-horizontal">
						<label>Created at:</label>
						<p>{{ date( 'jS F, y', strtotime($company->created_at)) }}</p>
						<p>{{ date( 'h:ia', strtotime($company->created_at)) }}</p>
					</dl>
					<dl class="dl-horizontal">
						<label>Updated at:</label>
						<p>{{ date( 'jS F, y', strtotime($company->updated_at)) }}</p>
						<p>{{ date( 'h:ia', strtotime($company->updated_at)) }}</p>
					</dl>
					<div class="row">
						<form action="{{ route('company.upload', $company->company_name) }}">
							<button type="submit" class="btn btn-primary btn-block btn-flat">Upload Logo</button>
						</form>
					</div>
					&emsp;
					<div class="row">
						<form action="{{ route('company.show', $company->company_name) }}">
							<button type="submit" class="btn btn-warning btn-block btn-flat">Cancel</button>
						</form>
						@if (Auth::user()->account_type == 'Z')
							&emsp;
							<form action="{{ route('company.destroy', $company->company_name) }}" method="POST">
								{{ method_field('PUT') }}
								{!! csrf_field() !!}
								<input type="hidden" name="status" value="disabled">
								<button type="submit" class="btn btn-danger btn-block btn-flat">Delete</button>
							</form>
						@else

						@endif
					</div>
				</div>
			</div>
		</div>
	@stop
@else
	@section('content')
		<div class="login-box">
			<div class="login-logo">
				<h1>Hey!</h1>
				<div class="login-box-body" style="background-color: #ECF0F5;">
					<p>I'm sorry but you are not authorised to access this area.</p>
					<a href="{{ route('company.index') }}" class="btn btn-primary btn-block btn-flat" style="color: white;">Back</a>
				</div>
			</div>
		</div>
	@stop
@endif