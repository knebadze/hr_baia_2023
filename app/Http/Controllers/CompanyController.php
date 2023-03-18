<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CompanyController extends Controller
{
    function time_ago( $time )
    {

        // define( TIMEBEFORE_NOW,         'now' );
        // define( TIMEBEFORE_MINUTE,      '{num} minute ago' );
        // define( TIMEBEFORE_MINUTES,     '{num} minutes ago' );
        // define( TIMEBEFORE_HOUR,        '{num} hour ago' );
        // define( TIMEBEFORE_HOURS,       '{num} hours ago' );
        // define( TIMEBEFORE_YESTERDAY,   'yesterday' );
        // define( TIMEBEFORE_FORMAT,      '%e %b' );
        // define( TIMEBEFORE_FORMAT_YEAR, '%e %b, %Y' );
        $out    = ''; // what we will print out
        $now    = time(); // current time
        $diff   = $now - $time; // difference between the current and the provided dates

        if( $diff < 60 ) // it happened now
            return 'now';

        elseif( $diff < 3600 ) // it happened X minutes ago
            return str_replace( '{num}', ( $out = round( $diff / 60 ) ), $out == 1 ? '{num} minute ago' : '{num} minutes ago' );

        elseif( $diff < 3600 * 24 ) // it happened X hours ago
            return str_replace( '{num}', ( $out = round( $diff / 3600 ) ), $out == 1 ? '{num} hour ago' : '{num} hours ago' );

        elseif( $diff < 3600 * 24 * 2 ) // it happened yesterday
            return 'yesterday';

        else // falling back on a usual date format as it happened later than yesterday
            setlocale(LC_TIME, 'de_DE.UTF8');
            return strftime( date( 'Y', $time ) == date( 'Y' ) ? '%e %B' : '%e %B, %Y', $time );
    }

    public function index()
    {
        $test = $this->time_ago(strtotime('2023-03-15 15:39:46'));
        dd($test);
        $vacancy = Vacancy::where('status_id', 1)->where('e_or_c', 3)->with(['currency', 'category', 'workSchedule'])->get()->toArray();
        $data = [
            'model' => [
                'vacancy' => $vacancy,
            ]
        ];
        return view ('company', compact('data'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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

    public function destroy($id)
    {
        //
    }
}
