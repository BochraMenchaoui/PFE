<?php

namespace App\Http\Controllers\Admin;

use ArielMejiaDev\LarapexCharts\LarapexChart;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Comment;
use App\Models\User;
use App\Models\Word;
use Carbon\Carbon;

use App\Http\Traits\Stats;

class AdminDashboard extends Controller
{
    use Stats;
    /*
    TODO:
        1. Stats li machine ll larapex, yahkiw ala junuary te el alwen el kol, rodha specific to this year.
        2. zid stats mte views
    */

    /**
     * Fetches and generates admin stats.
     *
     * @return void
     */
    public function loadDashboard()
    {
        $data = [
            'usersCount'        => User::count(),
            'wordsCount'        => Word::count(),
            'commentsCount'     => Comment::count(),
            'collabCount'       => User::where('role', '=', 1)->count(),
            'topUsers'          => User::withCount('words')->orderBy('words_count', 'desc')->get()->take(5),
            'inactive'          => User::where('last_login', '<=', Carbon::today()->subDays(30))->get(),
            'usersThisMonth'    => count(User::where('created_at', '>', Carbon::today()->subDays(30))->get()),
            'usersLastMonth'    => count(User::whereBetween('created_at', [Carbon::today()->subDays(60), Carbon::today()->subDays(30)])->get()),
            'wordsThisMonth'    => count(Word::where('created_at', '>', Carbon::today()->subDays(30))->get()),
            'wordsLastMonth'    => count(Word::whereBetween('created_at', [Carbon::today()->subDays(60), Carbon::today()->subDays(30)])->get()),
            'commentsThisMonth' => count(Comment::where('created_at', '>', Carbon::today()->subDays(30))->get()),
            'commentsLastMonth' => count(Comment::whereBetween('created_at', [Carbon::today()->subDays(60), Carbon::today()->subDays(30)])->get()),
            'collabsThisMonth'  => count(User::where('created_at', '>', Carbon::today()->subDays(30))->where('role', 1)->get()),
            'collabsLastMonth'  => count(User::whereBetween('created_at', [Carbon::today()->subDays(60), Carbon::today()->subDays(30)])->where('role', 1)->get()),
            // 'likesCount'        => DB::table('likes')->count(),
            'region'        => DB::table('words')
                ->select(DB::raw('count(*) as words_count, region'))
                ->groupBy('region')
                ->orderBy('words_count', 'desc')
                ->get()
                ->take(5),
            'usersPerYear' => DB::table('users')
                ->select(DB::raw('month(created_at) as month_name, count(*) as users_count'))
                ->groupBy(DB::raw('month_name'))
                ->orderBy('month_name')
                ->pluck('users_count', 'month_name')->all(),
            'wordsPerYear' => DB::table('words')
                ->select(DB::raw('month(created_at) as month_name, count(*) as words_count'))
                ->groupBy(DB::raw('month_name'))
                ->orderBy('month_name')
                ->pluck('words_count', 'month_name')->all(),
            // 'dislikesCount'     => DB::table('dislikes')->count(),
        ];

        // 1. AreaChart
        $chart = (new LarapexChart)->areaChart()
            ->addData('Users', array_values($this->makeStats($data['usersPerYear'])))
            ->addData('Words', array_values($this->makeStats($data['wordsPerYear'])))
            ->setXAxis([__('January'), __('February'), __('March'), __('April'), __('May'), __('June'), __('July'), __('August'), __('September'), __('October'), __('November'), __('December')])
            ->setColors(['#29313d', '#F8BD7A'])
            ->setGrid(false, '#3F51B5', 0.1);

        return view(
            'admin.pages.dashboard',
            [
                'data'          => $data,
                'chart'         => $chart,
                'usersGrowth'   => $this->calculateGrowth((float) $data['usersThisMonth'], (float) $data['usersLastMonth']),
                'wordsGrowth'   => $this->calculateGrowth((float) $data['wordsThisMonth'], (float) $data['wordsLastMonth']),
                'collabsGrowth' => $this->calculateGrowth((float) $data['collabsThisMonth'], (float) $data['collabsLastMonth']),
            ]
        );
    }
}
