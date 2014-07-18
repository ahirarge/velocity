<?php 

use Ahir\Velocity\VelocityModel;

class VelocityDetailController extends BaseController {

	/**
	 * Get Detail
	 *
	 * @param  integer $id
	 * @return View
	 */
	public function getDetail($id)
	{
		$data['record'] = VelocityModel::find($id);
		$data['title'] = 'Detail';
		return View::make('velocity::row_detail', $data);
	}

}