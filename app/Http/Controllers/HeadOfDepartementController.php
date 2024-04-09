<?php

namespace App\Http\Controllers;

use App\Http\Requests\LecturerStoreRequest;
use App\Http\Requests\LecturerUpdateRequest;
use App\Models\HeadOfDepartement;
use App\Models\Lecturer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HeadOfDepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $title = 'Apakah anda yakin?';
        $text = "Anda tidak akan bisa mengembalikannya!";
        confirmDelete($title, $text);
        
        $kajur = HeadOfDepartement::first();
        return view('dashboard.kajur.index', compact('kajur'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $lecturers = Lecturer::all();
        return view('dashboard.kajur.create', compact('lecturers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LecturerStoreRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();

        DB::beginTransaction();

        try {
            $existingKajur = HeadOfDepartement::first();

            if ($existingKajur) {
                $existingKajur->delete();

                $existingUser = User::where('role', 'kajur')->first();
                if ($existingUser) {
                    $existingUser->delete();
                }
            }

            $user = new User();
            $user->name = $validatedData['fullname'];
            $user->email = $validatedData['email'];
            $user->username = $validatedData['nidn'];
            $user->password = Hash::make('kajur' . $validatedData['nidn']);
            $user->role = 'HoD';

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $fileName = time() . '_kajur_' . $user->username . '.' . $file->getClientOriginalExtension();

                $file->storeAs('public/images/profile-photo', $fileName);

                $user->photo = $fileName;
            }

            $user->save();

            $kajur = new HeadOfDepartement();
            $kajur->user_id = $user->id;
            $kajur->nip = $validatedData['nip'];
            $kajur->nidn = $validatedData['nidn'];
            $kajur->front_degree = $validatedData['gelar-depan'];
            $kajur->back_degree = $validatedData['gelar-belakang'];
            $kajur->position = $validatedData['jabatan'];
            $kajur->rank = $validatedData['pangkat'];
            $kajur->type = $validatedData['golongan'];
            $kajur->phone_number = $validatedData['no-hp'];

            $kajur->save();

            DB::commit();

            return redirect()->route('dashboard.kajur.index')->with('toast_success', 'Ketua Jurusan added successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('error', 'Failed to add Ketua Jurusan. Please try again.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(HeadOfDepartement $kajur): View
    {
        $title = 'Apakah anda yakin?';
        $text = "Anda tidak akan bisa mengembalikannya!";
        confirmDelete($title, $text);

        return view('dashboard.kajur.show', compact('kajur'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HeadOfDepartement $kajur): View
    {
        return view('dashboard.kajur.edit', compact('kajur'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LecturerUpdateRequest $request, HeadOfDepartement $kajur): RedirectResponse
    {
        $validatedData = $request->validated();

        DB::beginTransaction();

        try {
            if(isset($validatedData['nidn'])) {
                $kajur->user->username = $validatedData['nidn'];
                $kajur->nidn = $validatedData['nidn'];
                $kajur->user->password = Hash::make('kajur' . $validatedData['nidn']);
            }
            
            if(isset($validatedData['nip'])) {
                $kajur->nip = $validatedData['nip'];
            }

            if(isset($validatedData['email'])) {
                $kajur->user->email = $validatedData['email'];
            }

            $kajur->front_degree = $validatedData['gelar-depan'];
            $kajur->back_degree = $validatedData['gelar-belakang'];
            $kajur->position = $validatedData['jabatan'];
            $kajur->rank = $validatedData['pangkat'];
            $kajur->type = $validatedData['golongan'];
            $kajur->phone_number = $validatedData['no-hp'];

            if ($request->hasFile('foto')) {
                $file = $request->file('foto');
                $fileName = time() . '_kajur_' . $kajur->user->username . '.' . $file->getClientOriginalExtension();

                $file->storeAs('public/images/profile-photo', $fileName);

                $kajur->user->photo = $fileName;
            }

            $kajur->save();

            DB::commit();

            return redirect()->route('dashboard.kajur.index')->with('toast_success', 'Ketua Jurusan updated successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withInput()->with('error', 'Failed to update Ketua Jurusan. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HeadOfDepartement $kajur): RedirectResponse
    {
        DB::beginTransaction();

        try {
            $kajur->delete();
            $kajur->user->delete();

            DB::commit();

            return redirect()->route('dashboard.kajur.index')->with('toast_success', 'Ketua Jurusan deleted successfully.');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'Failed to delete Ketua Kurusan. Please try again.');
        }
    }
}
