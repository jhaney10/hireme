<?php

namespace App\Http\Controllers;


use DB;
use App\Sitter;
use App\User;
use App\Sittingday;
use App\Iddetail;
use App\Sitterchildgrp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Http\Validator;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

         $userid = Auth::user()->id;
        $chksitters=DB::table('users')
                    ->where(['usertype'=>'sitter'])
                    ->count();
        $chkparents=DB::table('users')
                    ->where(['usertype'=>'parent'])
                    ->count();
        $chkbook=DB::table('bookings')
                ->count();
        $sitters =DB::table('sitters')
                ->join('users','sitters.iduser','=','users.id')
                ->select('sitters.*','users.*')
                ->get();
        $parents =DB::table('users')
                ->where(['usertype'=>'parent'])
                ->get();
        $bookings=DB::table('bookings')
                ->join('bookedsitters','bookings.id','=','bookedsitters.idbookings')
                ->get();
        $reviews =DB::table('reviews')
                ->join('users','reviews.idsitter','=','users.id')
                ->get();
        $references=DB::table('city')
                ->join('sitters','city.id','=','sitters.ref_city')
                ->join('iddetails','sitters.iduser','=','iddetails.user_id')
                ->where(['iddetails.owner'=>'referee'])
                ->get();
        $ongoing=DB::table('acceptedjobs')
                ->join('bookings','acceptedjobs.idbookings','=','bookings.id')
                ->where(['acceptedjobs.status'=>'Ongoing'])
                ->get();
        $completed=DB::table('acceptedjobs')
                ->join('bookings','acceptedjobs.idbookings','=','bookings.id')
                ->where(['acceptedjobs.status'=>'Completed'])
                ->get();
        $rejected=DB::table('rejectedjobs')
                ->join('bookings','rejectedjobs.idbookings','=','bookings.id')
                ->get();

        $chkongoing=DB::table('acceptedjobs')
                ->where(['acceptedjobs.status'=>'Ongoing'])
                ->count();
        $chkcompleted=DB::table('acceptedjobs')
                ->where(['acceptedjobs.status'=>'Completed'])
                ->count();
        $chkrejected=DB::table('rejectedjobs')
                ->count();


        return view('admin.admin',['sitter'=>$sitters,'parents'=>$parents,'bookings'=>$bookings,'review'=>$reviews,'references'=>$references,'ongoing'=>$ongoing,'completed'=>$completed,'rejected'=>$rejected,'chksit'=>$chksitters,'chkpar'=>$chkparents,'chkbk'=>$chkbook,'chkon'=>$chkongoing,'chkcomp'=>$chkcompleted,'chkrej'=>$chkrejected,'userid'=>$userid]);
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
    public function update(Request $request)
    {
        $sitstatus=$request->sitstatus;
        $refstatus=$request->refstatus;
        $medstatus=$request->medstatus;
        $id=$request->sitterid;

        DB::table('sitters')
        ->where(['iduser'=>$id])
        ->update(['appr_status'=>$sitstatus,'med_status'=>$medstatus,'ref_status'=>$refstatus]);
        session()->flash('message','Updated Successfully');
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
}
