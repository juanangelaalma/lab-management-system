<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use tidy;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('lab.info', [
            'events' => Event::latest()->get(),
        ]);
    }

    public function table() {
        return view('staff.info.table', [
            'events'    => Event::latest()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('staff.info.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'image'         => 'required|mimes:png,jpg,jpeg|max:1024',
            'name'          => 'required',
            'responsible'   => 'required',
            'start'         => 'required',
            'end'           => 'required',
        ]);

        $description = $request->description;
        $dom = new \DomDocument();
        $dom->loadHtml($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $imageFile = $dom->getElementsByTagName('img');

        foreach($imageFile as $item => $image) {
            $data = $image->getAttribute('src');
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $imgeData = base64_decode($data);
            $image_name= "/assets/img/events/" . time().$item.'.png';
            $path = public_path() . $image_name;
            file_put_contents($path, $imgeData);
            
            $image->removeAttribute('src');
            $image->setAttribute('src', $image_name);
        }

        $description = $dom->saveHTML();

        $thumbnailName = time().'.'.$request->image->extension();

        $request->image->storeAs("/assets/img/events/thumbs/", $thumbnailName, 'public');
        
        $event = Event::create([
            'image'         => $thumbnailName,
            'name'          => $request->name,
            'responsible'   => $request->responsible,
            'start'         => $request->start,
            'end'           => $request->end,
            'description'   => $description
        ]);

        return redirect(route('staff.info.table'))->with('success', 'Berhasil menambagkan info lab');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('lab.read', [
            'info'  => $event
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        return view('staff.info.edit', [
            'event'    => $event
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        // dd($request->description);
        $request->validate([
            'name'          => 'required',
            'responsible'   => 'required',
            'start'         => 'required',
            'end'           => 'required',
        ]);

        if($request->image) {
            $thumbnailName = time().'.'.$request->image->extension();

            $request->image->storeAs("/assets/img/events/thumbs/", $thumbnailName, 'public');

            Storage::delete('public/assets/img/events/thumbs/' . $event->image);

            $event->image = $thumbnailName;
        }

        $description = $request->description;
        $dom = new \DomDocument();
        @$dom->loadHtml($description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $imageFile = $dom->getElementsByTagName('img');

        foreach($imageFile as $item => $image) {
            $data = $image->getAttribute('src');
            if(str_contains($data, ";")){
                list($type, $data) = explode(';', $data);
                list($temp, $data) = explode(',', $data);
                $imgeData = base64_decode($data);
                $image_name= "/assets/img/events/" . time().$item.'.png';
                $path = public_path() . $image_name;
                file_put_contents($path, $imgeData);
                
                $image->removeAttribute('src');
                $image->setAttribute('src', $image_name);
            }
        }

        $description = $dom->saveHTML();


        $event->name = $request->name;
        $event->responsible = $request->responsible;
        $event->start = $request->start;
        $event->end = $request->end;
        $event->description = $description;

        $event->save();

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();
        Storage::delete('public/assets/img/events/thumbs/' . $event->image);
        
        return back()->with('success', 'Berhasil menghapus data!');
    }
}
