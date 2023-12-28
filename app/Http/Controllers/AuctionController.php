<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auction;
use Illuminate\Support\Carbon;
use App\Http\Requests\AuctionRequest;

class AuctionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $auctions = Auction::where('end_date', '>', Carbon::now()->addHours(1))
            ->get()
            ->map(function($auction) {
                if (is_numeric(substr($auction->title,-14))) {
                    $auction->title = substr($auction->title, 0, -14);
                }
                return $auction;
            });

        return inertia(
            'Auction/Index',
            [
                'auctions' => $auctions
            ]
        );
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Auction/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuctionRequest $request)
    {
        Auction::create($request->validated());

        return redirect()->route('auction.index')
            ->with('success', 'Aukcja została utworzona');
    }

    /**
     * Display the specified resource.
     */
    public function show(Auction $auction)
    {
        return inertia(
            'Auction/Show',
            [
                'auction' => $auction
            ]
        );
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Auction $auction)
    {
        return inertia(
            'Auction/Edit',
            [
                'auction' => $auction
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Auction $auction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Auction $auction)
    {
        //
    }
}
