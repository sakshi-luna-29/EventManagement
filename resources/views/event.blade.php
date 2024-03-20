<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Events</title>
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>

</head>

<body>
    <form id="EventForm">
        <div class="form-group">
            <label class="col-sm-2 control-label">Event</label>
            <div class="col-sm-12">
                <input type="text" id="eventName" name="event_name">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-2 control-label">Event Description </label>
            <div class="col-sm-12">
                <textarea name="description" id="description" required="" placeholder="Enter Details" class="form-control"></textarea>
            </div>
        </div>


        <div class="form-group">
            <label class="col-sm-2 control-label">Start Date</label>
            <div class="col-sm-12">
                <input type="date" id="start_date" name="start_date">
            </div>
        </div>


        <div class="form-group">
            <label class="col-sm-2 control-label">End Date</label>
            <div class="col-sm-12">
                <input type="date" name="end_date" id="end_date">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Organizer</label>
            <div class="col-sm-12">
                <input type="text" name="organizer" id="organizer">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 control-label">Tickets</label>
            <div class="col-sm-12">

                <button type="button" class="btn btn-primary" id="add_ticket"> Add Ticket</button>
            </div>
        </div>
        <div class="form-group">
            <button type="button" type="submit" id="createNewEvent" class="btn btn-Danger"> Save Event </button>
        </div>
    </form>

    <table class="table table-bordered data-table">
        <thead>
            <tr>
                <th col=20%>Id : </th>
                <th col=20%>Ticket No. : </th>
                <th col=20%>Price : </th>
                <th> </th>
                <th> </th>

            </tr>
        </thead>
        <tbody id="data-table">
            <form id="ticket_save">
                <tr id="add_ticket_col">
                    <td col=20%>
                        <input type="text" id="event_id" name="event_id" required>
                    </td>

                    <td col=20%><input type="text" id="ticket_id" name="ticket_id" required>
                    </td>
                    <td col=20%>
                        <input type="text" id="price" name="price" required>
                    </td>
                    <td col=20%>
                        <button type="submit" id="save_ticket" class="btn btn-primary" value="Save">
                    </td>

                </tr>

            </form>
            @if(!empty($data))
            @foreach($data as $dd)

            @php
            $ticket_id = $dd['tickets'] ;

            @endphp
            @if(!empty($ticket_id))
            @foreach($ticket_id as $td)

            <form>

                <tr id="{{$td['id']}}">
                    <td id="id_{{$td['id']}}" col=20%>{{$dd->id}}</td>
                    <td id="ticket_{{$td['id']}}" col=20%> {{$td['ticket_id']}}
                    <td id="pp_{{$td['id']}}" col=20%>{{ $td['price']}}</td>
                    <td><a href="javascript:void(0)" data-toggle="tooltip" data-id="{{$td['id']}}" class="btn btn-primary editProduct">Edit</a></td>
                    <td><a href="javascript:void(0)" data-toggle="tooltip" data-id="{{$td['id']}}" class="btn btn-danger deleteProduct">Delete</a> </td>
                    <div id="editModal_{{$td['id']}}" class="modal" tabindex="-1">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Modal title</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Event Id:</label>
                                        <div class="col-sm-12">
                                            <input type="hidden" id="id_table_ticket_{{$td['id']}}" name="id_table_ticket" value="{{$td['id']}}">

                                            <input type="text" id="event_id_{{$td['id']}}" name="event_id" value="{{$dd->id}}" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Ticket Id:</label>
                                        <div class="col-sm-12">
                                            <input type="text" id="ticket_id_{{$td['id']}}" value="{{$td['ticket_id']}}" required>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label">Price :</label>
                                        <div class="col-sm-12">
                                            <input type="text" id="price_{{$td['id']}}" value="{{$td['price']}}" required>
                                        </div>
                                    </div>

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="button" id="{{$td['id']}}" class="btn btn-primary editSaveButton">Save changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </tr>

            </form>
            @endforeach
            @endif
            @endforeach
            @endif
        </tbody>
    </table>

</body>

</html>

<script type="text/javascript">
    $('#add_ticket_col').hide();
    $('.editProduct').click(function() {
        var id = $(this).data('id');


        $("#editModal_" + id).modal('show');
    })

    $('#createNewEvent').click(function() {

        var event_name = $('#eventName').val();
        var description = $('#description').val();
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        var organizer = $('#organizer').val();

        var data = {
            _token: '{{ csrf_token() }}',
            event_name: event_name,
            description: description,
            start_date: start_date,
            end_date: end_date,
            organizer: organizer
        }

        $.ajax({
            url: "{{ route('event.save')}}",
            method: 'POST',
            data: data,
            success: function(response) {
                alert('Success! Response: ' + response.message);

            },
            error: function(response) {
                alert('Error: ' + response.message);
            }
        });
    });

    $('#save_ticket').click(function() {

        var event_id = $('#event_id').val();
        var ticket_id = $('#ticket_id').val();
        var price = $('#price').val();

        var data1 = {
            _token: '{{ csrf_token() }}',
            event_id: event_id,
            ticket_id: ticket_id,
            price: price,
            id: null
        }
        $.ajax({
            url: "{{ route('ticket.save')}}",
            method: 'POST',
            data: data1,
            success: function(response) {
                console.log(response);

                var tbody = $('#data-table tbody');
                var data5 = response.data;
                console.log(data5);
                var row = $('<tr id=' + data5.id + '>');
                row.append('<td>' + data5.event_id + '</td>');
                row.append('<td>' + data5.ticket_id + '</td>');
                row.append('<td>' + data5.price + '</td>');
                row.append('<td><a href="javascript:void(0)" data-toggle="tooltip"  data-id= ' + data5.id + 'class="btn btn-primary editProduct">Edit</a></td>');

                row.append('<td><a href="javascript:void(0)" data-toggle="tooltip"  data-id= ' + data5.id + 'class="btn btn-danger deleteProduct">Delete</a></td>');
                tbody.append(row);
                alert('Success! Response: ' + response.message);


            },
            error: function(response) {
                alert('Error: ' + response.message);
            }
        });

    });
    $('#add_ticket').click(function() {
        $('#add_ticket_col').show();
    });

    $('body').on('click', '.editSaveButton', function() {
        var element_id = $(this).prop('id');
        var event_id1 = $('#event_id_' + element_id).val();
        var ticket_id1 = $('#ticket_id_' + element_id).val();
        var price1 = $('#price_' + element_id).val();
        var id3 = $('#id_table_ticket_' + element_id).val();
        var data3 = {
            event_id: event_id1,
            ticket_id: ticket_id1,
            price: price1,
            id: id3
        }
        console.log(data3);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/ticket',
            type: "Post",
            data: data3,
            success: function(response) {
                $('#id_' + id3).text(event_id1);
                $('#ticket_' + id3).text(ticket_id1);
                $('#pp_' + id3).text(price1);
                alert('Success! Response: ' + response.message);

            },
            error: function(response) {
                alert('Error: ' + response.message);

            }
        });

    });

    $('body').on('click', '.deleteProduct', function() {

        var del_id = $(this).data('id');
        confirm("Are You sure want to delete !");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: '/ticket',
            type: "DELETE",
            data: {
                id: del_id,
            },
            success: function(data) {
                $('#' + del_id).hide();
                alert('Success! Response: ' + data.message);

            },
            error: function(data) {
                alert('Error: ' + data.message);
            }
        });
    });
</script>