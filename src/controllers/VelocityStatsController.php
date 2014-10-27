<?php 

use Ahir\Velocity\Models\Logs;

class VelocityStatsController extends BaseController {

    /**
     * Get Live
     *
     * @return View
     */
    public function getLive()
    {
        $data['lives'] = Logs::orderBy('id', 'desc')
                                      ->paginate(15);
        $data['title'] = 'Live';
        return View::make('velocity::live', $data);
    }

    /**
     * Get Slowspeed
     *
     * @return View
     */
    public function getSlowspeed()
    {
        $data['lives'] = Logs::select(
                                            'ahir_velocity.*', 
                                            DB::raw('avg(response_time) as response_time')
                                        )
                                      ->groupBy('url')
                                      ->orderBy('response_time', 'desc')
                                      ->paginate(15);
        $data['title'] = 'Slowspeed';
        return View::make('velocity::slowspeed', $data);
    }

    /**
     * Get Memory Usage
     *
     * @return View
     */
    public function getMemoryUsage()
    {
        $data['lives'] = Logs::select(
                                            'ahir_velocity.*', 
                                            DB::raw('avg(memory_usage) as memory_usage')
                                        )
                                      ->groupBy('url')
                                      ->orderBy('memory_usage', 'desc')
                                      ->paginate(15);
        $data['title'] = 'Memory Usage';
        return View::make('velocity::memory_usage', $data);
    }

    /**
     * Get Memory Usage
     *
     * @return View
     */
    public function getStats()
    {
        $data['total_record'] = Logs::count();
        $data['avg_response_time'] = Logs::select(
                                                        DB::raw('avg(response_time) as time')
                                                    )
                                                  ->first();
        $data['avg_memory_usage'] = Logs::select(
                                                        DB::raw('avg(memory_usage) as memory')
                                                    )
                                                  ->first();

        $data['title'] = 'Stats';
        return View::make('velocity::stats', $data);
    }

}