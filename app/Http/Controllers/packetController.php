<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Packet;
use App\Charts\lineChart;



class packetController extends Controller
{

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
      $this->middleware('auth');
  }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get Values from DB
        $count = Packet::count();
        $data = Packet::all();
        $dataForLineChartf1 = Packet::where('device','00-14-22-01-23-45')->orderby('id','desc')->take(10)->select('f1')->get();
        $dataForLineChartf2 = Packet::where('device','00-14-22-01-23-45')->orderby('id','desc')->take(10)->select('f2')->get();
        $dataForLineChartf3 = Packet::where('device','00-14-22-01-23-45')->orderby('id','desc')->take(10)->select('f3')->get();
        $ChartLables =array();
        $variableValf1 =array();
        $variableValf2 =array();
        $variableValf3 =array();

        // Adding databse values to arrays
        for ($i=0; $i < 10; $i++) {
          try {
             $ChartLables[] = $i;
          } catch (\Exception $e) {
          }

          try {
             $variableValf1[] = $dataForLineChartf1[$i]->f1;
          } catch (\Exception $e) {
             $variableValf1[] = 0;
          }

          try {
             $variableValf2[] = $dataForLineChartf2[$i]->f2;
          } catch (\Exception $e) {
            $variableValf2[] = 0 ;
          }
          try {
             $variableValf3[] = $dataForLineChartf3[$i]->f3;

          } catch (\Exception $e) {
            $variableValf3[] = 0;
          }
        }

        // Passing Values to chart
        //$LineChart = new lineChart;
        $LineChart = new lineChart;
        $LineChart->labels($ChartLables);
        $LineChart->dataset('F1', 'line',$variableValf1)->options(['backgroundColor' => '#3BEDA0','fill' => false]);
        $LineChart->dataset('F2', 'line',$variableValf2)->options(['backgroundColor' => '#3BEDD0','fill' => false]);
        $LineChart->dataset('F3', 'line',$variableValf3)->options(['backgroundColor' => '#3BEDE0','fill' => false]);

        if ($count>0) {
          $DataCount = $count;
        }else{
          $DataCount = "No Data";
        }


        $LineChart1 = new lineChart;
        $api = url('/getChartData');
        $LineChart1->labels($ChartLables)->load($api);
        return view('pages.index',compact('LineChart','LineChart1'))->with('status',$DataCount)->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getDataForChart(){
      $data = [1,4,3];
      return $data;
    }


    public function UpdateChart(){
      // Get Values from DB
      $dataForLineChartf1 = Packet::where('device','00-14-22-01-23-45')->orderby('id','desc')->take(10)->select('f1')->get();
      $variableValf1 =array();

      // Adding databse values to arrays
      for ($i=0; $i < 10; $i++) {

        try {
           $variableValf1[] = $dataForLineChartf1[$i]->f1;
        } catch (\Exception $e) {
           $variableValf1[] = 0;
        }
      }

      $LineChart1 = new lineChart;
      $LineChart1->dataset('F1', 'line',$variableValf1)->options(['backgroundColor' => '#3BEDA0','fill' => false]);
      return $LineChart1->api();

    }
}
