<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <style>
            .alert{
                margin-top: 15px;
            }
            .container-page{
                padding-top: 15px;
            }
            .form-collection{
                border: 1px solid;
                padding: 15px;
                border-radius: 4px;
                margin: 5px;
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
            <li class="active"><a href="/">Home</a></li>
            <li><a href="/matches">Show Matches</a></li>
          </ul>

            <div class="col-lg-12 form-collection">
                <form action="/add" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="nameInput">Name</label>
                        <input type="text" name="nameInput" class="form-control" id="nameInput" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="logoInputFile">File input</label>
                        <input type="file" name="logoInputFile" id="logoInputFile">
                        <p class="help-block">Example block-level help text here.</p>
                    </div>
                    <button type="submit" class="btn btn-default">Add Team</button>
                </form>
            </div>

            <div class="col-lg-12 form-collection">
                <form action="/add/matches" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="team1">Select team1:</label>
                        <select class="form-control" name="team1" id="team1">
                            @foreach($data as $key=>$value)
                                <option>{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="team2">Select team2:</label>
                        <select class="form-control" name="team2" id="team2">
                            @foreach($data as $key=>$value)
                                <option>{{$value->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-default">Add Matches</button>
                </form>
            </div>
        </div>


        <div class="col-sm-9">


            <div class="flex-center position-ref full-height container-fluid">
                <h2>Ranking</h2>
                <table class="table table-striped">
                    <tr>
                        <td>Id</td>
                        <td>team</td>
                        <td>logo</td>
                        <td>played</td>
                        <td>win</td>
                        <td>draw</td>
                        <td>loss</td>
                        <td>goals_in</td>
                        <td>goals_out</td>
                        <td>points</td>
                    </tr>

                    @foreach($data as $key=>$value)
                        <tr>
                            <td>{{$value->id}}</td>
                            <td>{{$value->name}}</td>
                            <td><img src="{{$value->logo}}" style="width: 100px"/></td>
                            <td>{{$value->matches_played}}</td>
                            <td>{{$value->win}}</td>
                            <td>{{$value->draw}}</td>
                            <td>{{$value->loss}}</td>
                            <td>{{$value->goals_in}}</td>
                            <td>{{$value->goals_out}}</td>
                            <td>{{$value->points}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>

        </div>
      </div>
    </div>
    </body>
</html>
