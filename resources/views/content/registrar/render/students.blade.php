<table>
    <thead>
        <th>Student No.</th>
        <th>Name</th>
        <th>Course</th>
        <th>Section</th>
    </thead>
    <tbody>
        @foreach ($students as $student)
            <tr>
                <td>{{ $student->student_no }}</td>
                <td>{{ $student->lastname.', '.$student->firstname.' '.$student->middlename }}</td>
                <td>{{ $student->code }}</td>
                <td>{{ $student->section_name }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
