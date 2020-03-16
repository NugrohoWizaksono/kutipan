<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $quotes = Quote::all();

        return view('quotes.index', compact('quotes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('quotes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title'     => 'required|min:5',
            'subject'   => 'required|min:10'
        ]);

        $slug = str_slug($request->title, '-');

        // cek duplikasi slug
        if (Quote::where('slug', $slug)->first() != null) {
            $slug = $slug . "-" . time();
        }

        $quote = Quote::create([
            'title'     => $request->title,
            'slug'      => $slug,
            'subject'   => $request->subject,
            'user_id'   => Auth::user()->id
        ]);

        return redirect('quotes')->with('msg','Kutipan berhasil disubmit');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $quote = Quote::where('slug', $id)->first();
        if (empty($quote)) {
            abort(404);
        }

        return view('quotes.single', compact('quote'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $quote = Quote::FindOrFail($id);
        if ($quote->isOwner()) {
            return view('quotes.edit', compact('quote'));
        } else {
            abort(403);
        }
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $quote = Quote::FindOrFail($id);
        if ($quote->isOwner()) {
            $quote->update([
                'title'     => $request->title,
                'subject'   => $request->subject
            ]);
        } else {
            abort(403);
        }      
        
        return redirect('quotes')->with('msg','Kutipan berhasil diedit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $quote = Quote::FindOrFail($id);
        if ($quote->isOwner()) {
            $quote->delete();
        } else {
            abort(403);
        }      
        
        return redirect('quotes')->with('msg','Kutipan berhasil didelete');
    }
}
