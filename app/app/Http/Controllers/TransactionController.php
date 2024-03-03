<?php

namespace App\Http\Controllers;

use App\Http\Resources\TransactionResource;
use App\Models\Expense;
use App\Models\Income;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    //

    public function index()
    {
        return view("transactions.index");
    }
    public function getTransaction()
    {
        $expenses = Expense::limit(50)->orderBy("date","desc")->get();
        $incomes = Income::limit(50)->orderBy("date","desc")->get();
        $transactions = collect([]);
        $transactions = $transactions->merge($expenses);
        $transactions = $transactions->merge($incomes);
        return TransactionResource::collection($transactions);


    }
}
