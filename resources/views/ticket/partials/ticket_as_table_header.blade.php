<tr>
    <th colspan=2 style="font-weight: normal">
        <strong>Code: </strong>{{ $ticket->code }}
    </th>
    <th colspan=2 style="font-weight: normal">
        <strong>Title: </strong>{{ $ticket->title }}
    </th>
</tr>
<tr>
    <th colspan=2 style="font-weight: normal">
        <strong>Author: </strong>{{ $ticket->author->full_name ?? 'Not Set' }}
    </th>
    <th colspan=2 style="font-weight: normal">
        <strong>Created At: </strong>{{ $ticket->created_at }}
    </th>
</tr>
<tr>
    <th colspan=2 style="font-weight: normal">
        <strong>Current Assigned: </strong>{{ $ticket->assigned_personnel }}
    </th>
    <th colspan=2 style="font-weight: normal">
        <strong>Status: </strong>{{ $ticket->status }}
    
    </th>
</tr>
<tr>
    <th colspan=4 style="font-weight: normal">
        <strong>Details: </strong>{{ $ticket->details }}
    </th>
</tr>
<tr>
    <th colspan=4 style="font-weight: normal">
        <strong>Remarks: </strong>{{ $ticket->additional_info }}
    </th>
</tr>
