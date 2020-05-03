@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])
@section('content')
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title ">Employees</h4>
                            <p class="card-category"> Here you can manage Employees</p>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 text-right">
                                    <a href="{{ route('employee.create') }}" class="btn btn-sm btn-primary"> add
                                        employee</a>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <table class="table">
                                    <thead class=" text-primary">
                                    <tr>
                                        <th>
                                            first Name
                                        </th>
                                        <th>
                                            last Name
                                        </th>
                                        <th>
                                            Email
                                        </th>
                                        <th>
                                            phone
                                        </th>
                                        <th>
                                            company name
                                        </th>
                                        <th class="text-right">
                                            Actions
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($Employees as $employee)
                                        <tr>
                                            <td>{{$employee->first_name}}</td>
                                            <td>{{$employee->last_name}}</td>
                                            <td>{{$employee->email}}</td>
                                            <td>{{$employee->phone}}</td>
                                            <td>{{$employee->company->name}}</td>

                                            <td class="td-actions text-right">
                                                <a rel="tooltip" class="btn btn-success btn-link"
                                                   href="{{ route('employee.edit', $employee->id)}}"
                                                   data-original-title="" title="">
                                                    <i class="material-icons">edit</i>
                                                    <div class="ripple-container"></div>
                                                </a>
                                                <form method="post" class="delete_form" action="{{route('employee.destroy',$employee->id)}}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button type="submit">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    {{$Employees->links()}}
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
