<?php

namespace App\Observers;

use App\Models\PrRequest;
use App\Models\Approval;

use Illuminate\Support\Facades\Notification;


class PrRequestObserver
{

    public function creating(PrRequest $prrequest)
    {
        $processingStatus = Approval::where('approval_name','Pending')->first();

        $prrequest->approval()->associate($processingStatus);
    }
    /**
     * Handle the pr request "created" event.
     *
     * @param  \App\PrRequest  $prRequest
     * @return void
     */
    // public function created(PrRequest $prrequest)
    // {
    //     $processingStatus = Status::whereName('pending')->first();

    //     $prrequest->approvals()->associate($processingStatus); 
    // }

    /**
     * Handle the pr request "updated" event.
     *
     * @param  \App\PrRequest  $prRequest
     * @return void
     */
    public function updated(PrRequest $prRequest)
    {
        //
    }

    /**
     * Handle the pr request "deleted" event.
     *
     * @param  \App\PrRequest  $prRequest
     * @return void
     */
    public function deleted(PrRequest $prRequest)
    {
        //
    }

    /**
     * Handle the pr request "restored" event.
     *
     * @param  \App\PrRequest  $prRequest
     * @return void
     */
    public function restored(PrRequest $prRequest)
    {
        //
    }

    /**
     * Handle the pr request "force deleted" event.
     *
     * @param  \App\PrRequest  $prRequest
     * @return void
     */
    public function forceDeleted(PrRequest $prRequest)
    {
        //
    }
}
