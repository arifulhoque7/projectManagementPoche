@extends('layouts.master')

@section('title', 'Project Management')
@section('page-name', 'Project Management')

@section('extra-css')
<style>

h3.widget-user-username {
    margin-left: 0!important;
}
h3.widget-user-username a{
    color: #ffffff!important;
}
h3.widget-user-username a:hover{
    color: #ffffff!important;
    text-decoration: underline;
    font-weight: 500;
}


h5.widget-user-desc{
    margin-left: 0!important;
}
.badge{
    font-size: 18px;
}

</style>
@endsection


@section('main-content')
    @csrf
    <div class="card card-dark">
        <div class="card-header">

            <h3 class="card-title">
                Companywise Projects
            </h3>

            {{-- <span class="float-right" style="margin-right: 10px;">
                <button type="button" class="btn bg-gradient-primary" data-toggle="modal" data-target="#addExtraModal"
                    onclick="clearAddModal()">Add Project
                </button>
            </span> --}}

        </div>
        <div class="card-body">

            <div class="row">
                {{-- id="holder{{ $company->id }}" --}}
                @foreach ($companys as $company)
                    <div class="col-md-4" >
                        <div class="card card-widget widget-user-2">
                            <div class="widget-user-header bg-dark">
                                <h3 class="widget-user-username ">
                                    <a href="{{ route('project.view') }}/{{ $company['id'] }}">{{ $company['name'] }}</a>
                                </h3>
                                <h5 class="widget-user-desc">{{ $company['address'] }}</h5>
                            </div>
                            <div class="card-body p-0">
                                <ul class="nav flex-column " style="background-color: aliceblue;">
                                    <li class="nav-item">
                                        <a href="#" class="nav-link">
                                            Total Projects <span
                                                class="float-right badge bg-primary">{{ $company['total_projects'] }}</span>
                                        </a>
                                    </li>

                                    <li class="nav-item">
                                        <span class="nav-link">
                                            Total Project Value <span
                                                class="float-right badge bg-primary">{{ $company['total_projects_value'] }}</span>
                                        </span>
                                    </li>

                                    <li class="nav-item">
                                        <span class="nav-link">
                                            Total Paid Amount <span
                                                class="float-right badge bg-primary">{{ $company['total_paid_amount'] }}</span>
                                        </span>
                                    </li>

                                    <li class="nav-item">
                                        <span class="nav-link">
                                            Total Due Amount <span
                                                class="float-right badge bg-primary">{{ $company['total_projects_value'] - $company['total_paid_amount'] }}</span>
                                        </span>
                                    </li>

                                    <li class="nav-item">
                                        <span class="nav-link">
                                            Company Entry Date <span
                                                class="float-right badge bg-success">{{ $company['created_at'] }}</span>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
        <!-- /.card -->

        <div class="card-footer">

        </div>
    </div>



@endsection


@section('extra-js')

@endsection
