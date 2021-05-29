<?php

namespace App\Http\Controllers;

use App\Transactions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class TransactionsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $transactions = Transactions::where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(10);
        return view('transactions', ['transactions' => $transactions]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {

        $this->validate($request, [
            'amount' => "required|numeric|between:1,5000",
        ]);

        $inputs = ['user_id' => Auth::id(), 'amount' => $request->amount];


        $transaction = new Transactions($inputs);
        $saved = $transaction->save();

        if (!$saved) {

            return view('transactions')->with('message', 'Something went wrong, please try again!');
        }

        $transactions = Transactions::where('user_id', Auth::id())->orderBy('created_at', 'desc')->paginate(10);
        return view('transactions', ['transactions' => $transactions])->with('message', 'Transaction with amount ' . $request->amount . ' added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $transaction = Transactions::find($id);
        $transaction->delete();

        return response($id);

    }
}
