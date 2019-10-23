<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\DebitModal;
use App\CreditModal;
class DebitCreditController extends Controller
{
	public function __construct()//constrctor to authnticate the user
    {
        $this->middleware('auth');
    }//ending of constrcutor to authenticate user
	public function records()
	{
		$totalDebit=0;
		$totalCredit=0;
		$nowDebit=DebitModal::all();
		if($nowDebit != null)//debits model avilbel
		{
			$totalDebit=$this->lastMonthDebitCredit($nowDebit);
		}
		$nowCredit=CreditModal::all();
		if($nowCredit != null)
		{
			$totalCredit=$this->lastMonthDebitCredit($nowCredit);
		}
		return view('survey',[
			"totalDebit"=>$totalDebit,
			"totalCredit"=>$totalCredit,
		]);
	}

    public function lastMonthDebitCredit($now)	//lastMonthDebit function
    {
    	$now1=new Carbon();
		$monthNow=$now1->month;
		$dayNow=$now1->day;
		$lastMonthAmount=0;
		$previousMonth;
		if($monthNow==1)
		{
			$previousMonth=12;
		}
		else
		{
			$previousMonth=$monthNow-1;
		}
		for($i=0;$i<sizeof($now);$i++)
		{
			if( $now[$i]["created_at"]->month == $previousMonth) //$monthNow=$now1->month;
			{
				//if($now[$i]["created_at"]->day >= $dayNow)	//our records after present date
				//{
					$lastMonthAmount+= $now[$i]["amount"];	
				//}
			}
			/*else if($now[$i]["created_at"]->month == $monthNow)
			{
				if($now[$i]["created_at"]->day <= $dayNow)	//our records after present date
				{
					$lastMonthAmount+= $now[$i]["amount"];
				}
			}*/
		}//ending of for loop
		return ($lastMonthAmount);
    }
}
