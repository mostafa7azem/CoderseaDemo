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

    @foreach($employees as $employee)
        <tr>
            <td>{{$employee->first_name}}</td>
            <td>{{$employee->last_name}}</td>
            <td>{{$employee->email}}</td>
            <td>{{$employee->phone}}</td>
            <td>{{$employee->company->name}}</td>
        </tr>
    @endforeach
    </tbody>
</table>

