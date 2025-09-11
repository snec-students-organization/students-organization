@foreach($institutions as $institution)
    <h2>{{ $institution->name }}</h2>
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>UID</th>
                <th>Class</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($institution->students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>{{ $student->uid }}</td>
                    <td>{{ $student->class }}</td>
                    <td>{{ ucfirst($student->status) }}</td>
                    <td>
                        <form method="POST" action="{{ route('admin.students.update_status', $student) }}">
                            @csrf
                            @method('PATCH')
                            <select name="status">
                                <option value="pending" @if($student->status == 'pending') selected @endif>Pending</option>
                                <option value="verified" @if($student->status == 'verified') selected @endif>Verified</option>
                                <option value="working_fund" @if($student->status == 'working_fund') selected @endif>Working Fund</option>
                            </select>
                            <button type="submit">Update</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No students in this institution.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endforeach

