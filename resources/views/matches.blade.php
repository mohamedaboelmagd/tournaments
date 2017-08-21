<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Tourments</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
        <script
                src="https://code.jquery.com/jquery-2.2.4.min.js"
                integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
                crossorigin="anonymous"></script>
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <style>
            .alert{
                margin-top: 15px;
            }
            .container-page{
                padding-top: 15px;
            }
        </style>
    </head>
    <body>
        <div class="container-fluid container-page">
            @include('flash::message')


<div class="row content">
        <div class="col-sm-3 sidenav">
          <h4>Tourments</h4>
          <ul class="nav nav-pills nav-stacked">
            <li class="active"><a href="/">Back</a></li>
          </ul>

        </div>


        <div class="col-sm-9">


            <div class="flex-center position-ref full-height container-fluid">
<h2>Matches</h2>
                <table class="table table-striped">
                    <tr>
                        <td>home_team</td>
                        <td>away_team</td>
                        <td>goals_in</td>
                        <td>goals_out</td>
                        <td>controls</td>
                    </tr>
                    @foreach($matches as $key=>$value)
                        <tr>
                            <td>{{$value->home_team}}</td>
                            <td>{{$value->away_team}}</td>
                            <td>{{$value->goals_in}}</td>
                            <td>{{$value->goals_out}}</td>
                            <td>
                            @if(is_null($value->goals_in))
                                <button type="button" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#myModal" data-whatever="{{$value->id}}">add score</button>
                            @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>

        </div>
      </div>




        </div>


        <!-- Modal -->
        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
                    </div>
                    <div class="modal-body">

                        <form action="/matches/score" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="nameInput1">home_team</label>
                                <input type="text" name="nameInput1" class="form-control" id="nameInput1" placeholder="Name">
                            </div>
                            <div class="form-group">
                                <label for="nameInput2">away_team</label>
                                <input type="text" name="nameInput2" class="form-control" id="nameInput2" placeholder="Name">
                            </div>
                            <input type="hidden" id="idMatch" name="idMatch" value=""/>
                            <button type="submit" class="btn btn-default">Submit</button>
                        </form>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        {{--<button type="button" class="btn btn-primary">Save changes</button>--}}
                    </div>
                </div>
            </div>
        </div>

    <script type="text/javascript">
        $('#myModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var recipient = button.data('whatever') // Extract info from data-* attributes
            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            //modal.find('.modal-title').text('New message to ' + recipient)
            modal.find('.modal-body #idMatch').val(recipient);
        })
    </script>
    </body>
</html>
