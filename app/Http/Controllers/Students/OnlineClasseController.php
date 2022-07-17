<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\Grade;
use App\Models\online_classe;
use Carbon\Carbon;
use Illuminate\Http\Request;
use MacsiDigital\Zoom\Facades\Zoom;

class OnlineClasseController extends Controller
{
    use \App\Http\Traits\MeetingZoomTrait;
    public function index()
    {
        $online_classes = online_classe::all();
        return view('pages.online_classes.index', compact('online_classes'));
    }
    public function create()
    {
        $Grades = Grade::all();
        return view('pages.online_classes.add', compact('Grades'));
    }

    public function indirectCreate()
    {
        $Grades = Grade::all();
        return view('pages.online_classes.indirect', compact('Grades'));
    }

    public function store(Request $request)
    {

//        $meeting = Zoom::meeting()->make([
//            'topic' => 'New meeting',
//            'type' => 8,
//            'start_time' => new Carbon('2020-08-12 10:00:00'), // best to use a Carbon instance here.
//        ]);
//
//        $meeting->settings()->make([
//            'join_before_host' => true,
//            'approval_type' => 1,
//            'registration_type' => 2,
//            'enforce_login' => false,
//            'waiting_room' => false,
//        ]);

        try {

            $meeting = $this->createMeeting($request);
            online_classe::create([
                'integration' => true,
                'Grade_id' => $request->Grade_id,
                'Classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'user_id' => auth()->user()->id,
                'meeting_id' => $meeting->id,
                'topic' => $request->topic,
                'start_at' => $request->start_time,
                'duration' => $meeting->duration,
                'password' => $meeting->password,
                'start_url' => $meeting->start_url,
                'join_url' => $meeting->join_url,
            ]);
            toastr()->success(trans('messages.success'));
            return redirect()->route('online_classes.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }



    public function storeIndirect(Request $request)
    {
        try {
            online_classe::create([
                'integration' => false,
                'Grade_id' => $request->Grade_id,
                'Classroom_id' => $request->Classroom_id,
                'section_id' => $request->section_id,
                'user_id' => auth()->user()->id,
                'meeting_id' => $request->meeting_id,
                'topic' => $request->topic,
                'start_at' => $request->start_time,
                'duration' => $request->duration,
                'password' => $request->password,
                'start_url' => $request->start_url,
                'join_url' => $request->join_url,
            ]);
            toastr()->success(trans('messages.success'));
            return redirect()->route('online_classes.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }
    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy(Request $request)
    {
        try {
            $info = online_classe::find($request->id);
            if ($info->integration == true){
                $meeting = Zoom::meeting()->find($request->meeting_id);
                $meeting->delete();
                //online_classe::where('meeting_id', $request->id)->delete();
                online_classe::destroy($request->id);
            }
            else{
                //online_classe::where('meeting_id', $request->id)->delete();
                online_classe::destroy($request->id);


            }




            toastr()->success(trans('messages.Delete'));
            return redirect()->route('online_classes.index');
        } catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }

    }
}
