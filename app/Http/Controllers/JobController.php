<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;

class JobController extends Controller
{
    public function publicIndex(Request $request){
        //finir de prendre la requete pour category 
        $query = Job::with(["company","category","location"]);

        if($request->has("category")){
            $query->whereHas("category", fn($q)=>
            $q->where("name",$request->category)
            );
        }
         if ($request->has('location')) {
            $query->whereHas('location', fn($q) =>
                $q->where('name', $request->location)
            );
         }
         if ($request->has('search')) {
            $query->where('title', 'like', '%'.$request->search.'%');
        }
        return $query->get()->map(function ($job) {
            return [
                'id'          => $job->id,
                'title'       => $job->title,
                'description' => $job->description,
                'company'     => $job->company?->company_name ?? '',
                'category'    => $job->category?->name ?? '',
                'location'    => $job->location?->name ?? '',
                'canton'      => $job->canton ?? '',
                'zip'         => $job->zip ?? '',
                'homeOffice'  => (bool) $job->home_office,
                'language'    => $job->language ?? '',
                'workplace'   => $job->workplace ?? '',
                'url'          => '',
                'publishedAt'  => $job->created_at?->toIso8601String(),
                'contactEmail' => $job->email ?? '',
                'contactPhone' => $job->phone ?? '',
            ];
        });
    }

    public function show(Job $job){
        return $job->load(["company","category","location"]);
    }

    public function store(Request $request){
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'location_id' => 'required|exists:locations,id',
        ]);
         $job = Job::create([
            'company_id'  => $request->user()->id,
            ...$data,
        ]);

        return response()->json($job, 201);
    }

    public function update(Request $request, Job $job){
        if ($job->company_id !== $request->user()->id) {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $data = $request->validate([
            'title'       => 'sometimes|string|max:255',
            'description' => 'sometimes|string',
            'category_id' => 'sometimes|exists:categories,id',
            'location_id' => 'sometimes|exists:locations,id',
        ]);

        $job->update($data);

        return $job;
    }

    public function destroy(Request $request, Job $job){
        if($job->company_id !== $request->user()->id){
            return response()->json(["message"=>"Forbidden"],403);
        }
        $job->delete();

        return response()->json(null, 204);
    }
}
