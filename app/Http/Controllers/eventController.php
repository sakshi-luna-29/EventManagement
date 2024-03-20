<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Event, ticket};


class eventController extends Controller
{
    public function index(Request $request)
    {

        $data = Event::with('tickets')->get();

        return view('event', compact('data'));
    }

    public function event(Request $request)
    {
        $event = new Event();
        $event->event_name = $request->input('event_name');
        $event->description = $request->input('description');
        $event->start_date = $request->input('start_date');
        $event->end_date = $request->input('end_date');
        $event->organizer = $request->input('organizer');

        $event->save();

        return response()->json(['success' => true, 'message' => 'Event saved successfully']);
    }


    public function ticket(Request  $request)
    {

        $data = $request->all();
        $find_event = Event::find($data['event_id']);
        if (empty($find_event)) {
            return response()->json(['error' => true, 'message' => "Event does not exist"]);
        } else {
            $ticket_create =  ticket::updateOrcreate(
                [
                    'id' => $data['id'],
                ],
                [
                    'ticket_id' => $data['ticket_id'],
                    'event_id' => $data['event_id'],
                    'price'    => $data['price'],
                ]
            );
            if ($ticket_create) {
                return response()->json(['success' => true, 'message' => "Tickets Saved Successfully", 'data' => $ticket_create]);
            } else {
                return response()->json(['error' => true, 'message' => "Something went wrong. please try again"]);
            }
        }
    }
    public function ticketDel(Request  $request)
    {
        $data = $request->all();
        $find_ticket = ticket::find($data['id'])->get();
        if (!$find_ticket) {
            return response()->json(['error' => true, 'message' => "Ticket does not exist"]);
        } else {
            $result = ticket::where('id', $data['id'])->delete();

            if ($result) {
                return response()->json(['success' => true, 'message' => "Ticket deleted successfully."]);
            } else {
                return response()->json(['error' => true, 'message' => "Something went wrong. please try again"]);
            }
        }
    }
}
