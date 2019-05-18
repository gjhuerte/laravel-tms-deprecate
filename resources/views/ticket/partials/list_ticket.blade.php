<div class="col-12 mb-3">
    <div class="card bg-light rounded-0">
        <div class="card-header">
            {{ __('Target Ticket') }}
        </div>

        <div class="card-body p-0">
            <ul class="list-unstyled border-light p-3">
                <li class="border-bottom pb-3"> 
                    <strong>Code: </strong> {{ $ticket->code }}
                </li>
                <li class="border-bottom py-3"> 
                    <strong>Title: </strong> {{ $ticket->title }}
                </li>
                <li class="border-bottom py-3"> 
                    <strong>Author: </strong> {{ $ticket->author->full_name }}
                </li>
                <li class="border-bottom py-3"> 
                    <strong>Created At: </strong> {{ $ticket->created_at }}
                </li>
                <li class="pt-3"> 
                    <strong>Current Status: </strong> 

                    <span class="badge badge-info text-uppercase">
                        {{ $ticket->status }}
                    </span>
                </li>
            </ul>
        </div>
    </div> 
</div>
