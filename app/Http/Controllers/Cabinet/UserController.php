<?php

namespace App\Http\Controllers\Cabinet;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\University;
use App\Models\Faculty;
use App\Models\Course;
use App\Models\Group;
use App\Models\Network;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $this->authorize('viewAny', User::class);

        $users = User::with(['group.course.faculty.university'])->paginate(10);
        return view('cabinet.users.index', compact('users'));
    }

    public function create()
    {
        $this->authorize('create', User::class);

        $universities = University::all();
        $faculties = Faculty::all();
        $courses = Course::all();
        $groups = Group::all();
        $networks = Network::all();

        return view('cabinet.users.create', compact('universities', 'faculties', 'courses', 'groups', 'networks'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', User::class);

        $validated = $request->validate([
            'lastname' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'patronymic' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'id_group' => 'nullable|exists:groups,id',
            'networks' => 'array',
            'networks.*.network_id' => 'exists:networks,id',
            'networks.*.url' => 'nullable|string|max:255',
        ]);

        $user = User::create([
            'lastname' => $validated['lastname'],
            'firstname' => $validated['firstname'],
            'patronymic' => $validated['patronymic'] ?? null,
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'id_group' => $validated['id_group'] ?? null,
        ]);

        if (isset($validated['networks'])) {
            foreach ($validated['networks'] as $network) {
                if (!empty($network['url'])) {
                    $user->networks()->attach($network['network_id'], ['url' => $network['url']]);
                }
            }
        }

        return redirect()->route('cabinet.students.index')->with('success', 'Пользователь добавлен.');
    }

    public function edit(User $student)
    {
        $this->authorize('update', $student);

        $student->load('group.course.faculty.university');

        $universities = University::all();
        $faculties = Faculty::select('id', 'university_id', 'name')->get();
        $courses   = Course::select('id', 'faculty_id', 'name')->get();
        $groups    = Group::select('id', 'course_id', 'name')->get();

        $networks = Network::all();
        $userNetworks = $student->networks()->pluck('url', 'network_id')->toArray();

        return view('cabinet.users.edit', compact(
            'student',
            'universities',
            'faculties',
            'courses',
            'groups',
            'networks',
            'userNetworks'
        ));
    }

    public function update(Request $request, User $student)
    {
        $this->authorize('update', $student);

        $validated = $request->validate([
            'lastname' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'patronymic' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,' . $student->id,
            'password' => 'nullable|string|min:8|confirmed',
            'group_id' => 'nullable|exists:groups,id',
            'networks' => 'array',
            'networks.*.network_id' => 'exists:networks,id',
            'networks.*.url' => 'nullable|string|max:255',
        ]);

        $student->update([
            'lastname' => $validated['lastname'],
            'firstname' => $validated['firstname'],
            'patronymic' => $validated['patronymic'] ?? null,
            'email' => $validated['email'],
            'group_id' => $validated['group_id'] ?? null,
            'password' => !empty($validated['password']) ? Hash::make($validated['password']) : $student->password,
        ]);

        // Обновление соцсетей
        $sync = [];
        foreach ($validated['networks'] ?? [] as $item) {
            if (!empty($item['url'])) {
                $sync[$item['network_id']] = ['url' => $item['url']];
            }
        }
        $student->networks()->sync($sync);

        return redirect()->route('cabinet.students.index')->with('success', 'Пользователь обновлён.');
    }

    public function destroy(User $student)
    {
        $this->authorize('delete', $student);
        $student->delete();

        return redirect()->route('cabinet.students.index')->with('success', 'Пользователь удалён.');
    }
}
