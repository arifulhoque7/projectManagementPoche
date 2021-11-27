<?php

namespace App\Http\Controllers;

use App\Models\EventModal;
use App\Models\ProjectModal;
use Illuminate\Http\Request;

class TimelineController extends Controller
{
    function index()
    {
        $tempProjects = ProjectModal::where([
            ['status', '>', 0]
        ])->orderBy('id', 'ASC')->get();

        $tempValue = array();
        $timelineProjects = array();
        foreach ($tempProjects as $project) {
            $tempValue['id'] = $project->id;
            $tempValue['name'] = $project->name;
            $tempValue['start'] = substr($project->starting_date, 0, 10);
            $tempValue['end'] = substr($project->finishing_date, 0, 10);
            // $tempValue['startYear'] = substr($project->starting_date,0,4);
            // $tempValue['startMonth'] = substr($project->starting_date,5,2);
            // $tempValue['startDay'] = substr($project->starting_date,8,2);   
            // $tempValue['endYear'] = substr($project->finishing_date,0,4);
            // $tempValue['endMonth'] = substr($project->finishing_date,5,2);
            // $tempValue['endDay'] = substr($project->finishing_date,8,2);   
            $tempValue['backgroundColor'] = '#0073b7';
            $tempValue['borderColor'] = '#0073b7';
            array_push($timelineProjects, $tempValue);
        }

        $tempEvents = EventModal::where([
            ['status', '>', 0]
        ])->orderBy('id', 'ASC')->get();

        $tempEvent = array();
        $timelineEvents = array();
        foreach ($tempEvents as $event) {
            $tempEvent['id'] = $event->id;
            $tempEvent['title'] = $event->title;
            $tempEvent['full_day'] = $event->full_day;
            $tempEvent['starting_date'] = substr($event->starting_date, 0, 16);
            $tempEvent['ending_date'] = substr($event->ending_date, 0, 16);
            if ($tempEvent['full_day'] == 0) {
                $tempEvent['backgroundColor'] = '#f39c12';
                $tempEvent['borderColor'] = '#f39c12';
            } else {
                $tempEvent['starting_date'] = substr($event->starting_date, 0, 10);
                $tempEvent['ending_date'] = substr($event->ending_date, 0, 10);
                // dd( $tempEvent['ending_date']);
                $tempEvent['backgroundColor'] = '#000000';
                $tempEvent['borderColor'] = '#000000';
            }
            array_push($timelineEvents, $tempEvent);
        }
        return view('timeline', compact('timelineProjects', 'timelineEvents'));
    }
}
