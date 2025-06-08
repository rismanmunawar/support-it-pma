@forelse ($users as $user)
<tr>
    <td class="px-4 py-2 border-b dark:border-gray-700">{{ $user->nik }}</td>
    <td class="px-4 py-2 border-b dark:border-gray-700">{{ $user->name }}</td>
    <td class="px-4 py-2 border-b dark:border-gray-700">{{ $user->role }}</td>
    <td class="px-4 py-2 border-b dark:border-gray-700">{{ $user->role_desc }}</td>
    <td class="px-4 py-2 border-b dark:border-gray-700">{{ $user->branch }}</td>
    <td class="px-4 py-2 border-b dark:border-gray-700">{{ $user->email }}</td>
    <td class="px-4 py-2 border-b dark:border-gray-700">{{ $user->phone }}</td>
    <td class="px-4 py-2 border-b dark:border-gray-700">
        <div class="flex space-x-2">
            <a href="{{ route('users.edit', $user->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
            <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500 hover:text-red-700">Delete</button>
            </form>
        </div>
    </td>
</tr>
@empty
<tr>
    <td colspan="8" class="text-center py-4 text-gray-500 dark:text-gray-400">No users found.</td>
</tr>
@endforelse