<?php 

use Ahir\Velocity\Models\Logs;

class VelocityDetailController extends BaseController {

    /**
     * Get Detail
     *
     * @param  integer $id
     * @return View
     */
    public function getDetail($id)
    {
        $data['record'] = Logs::find($id);
        $data['title'] = 'Detail';
        return View::make('velocity::row_detail', $data);
    }

}