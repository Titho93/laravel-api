<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Tecnology;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::orderBy('id', 'desc')->paginate(10);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Project $project)
    {
        $method = 'POST';
        $route = route('admin.projects.store');
        $tecnologies = Tecnology::all();
        return view('admin.projects.create', compact('project', 'tecnologies', 'method', 'route'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form_data = $request->all();

        $new_project = new Project();
        $new_project->fill($form_data);
        $new_project->slug = Str::slug($request->name, "-");
        if (array_key_exists('image', $form_data)) {
            $new_project->image = Storage::put('uploads', $form_data['image']);
        }
        $new_project->save();

        if (array_key_exists('tecnologies', $form_data)) {
            $new_project->tecnologies()->attach($form_data['tecnologies']);
        }
        return redirect()->route('admin.projects.show', $new_project);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $method = 'PUT';
        $route = route('admin.projects.update', $project);
        $tecnologies = Tecnology::all();
        return view('admin.projects.edit', compact('project', 'tecnologies', 'method', 'route'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $form_data = $request->all();

        Storage::disk('public');

        if (array_key_exists('image', $form_data)) {
            if ($project->image) {
                Storage::disk('public')->delete($project->image);
            }
            $form_data['image'] = Storage::put('uploads', $form_data['image']);
        }

        if (array_key_exists('tecnologies', $form_data)) {
            $project->tecnologies()->attach($form_data['tecnologies']);
        }

        $project->update($form_data);

        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route("admin.projects.index");
    }
}
