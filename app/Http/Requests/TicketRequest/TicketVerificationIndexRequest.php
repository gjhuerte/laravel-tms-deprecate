<?php

namespace App\Http\Requests\TicketRequest;

use App\Services\TicketService;
use App\Services\Ticket\ActivityService;
use Illuminate\Foundation\Http\FormRequest;

class TicketVerificationIndexRequest extends FormRequest
{

    private $activityService;
    private $ticketService;

    /**
     * Constructor class
     */
    public function __construct()
    {
        $this->ticketService = new TicketService;
        $this->activityService = new ActivityService;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $ticket = $this->ticketService->find($this->id);
        $isTicketOwner = $ticket->isMine();
        $userCount = $this->activityService->verifiedByUserCount($ticket);

        if($userCount <= 0 && ! $isTicketOwner) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //
        ];
    }
}
