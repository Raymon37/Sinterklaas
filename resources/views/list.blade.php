<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Wenslijst Sinterklaas</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" />
</head>
<style>
    body {
        background-image: url("/img/chocolade_letter.jpg");
          text-align: center;
    }
</style>
<body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <a class="navbar-brand" href="/">Home</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
<br>
    <div class="container">
        <div class="row">
            <div class="col-lg-offset-3 col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Wenslijst <a href="#" id="addNew" class="pull-right" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus" aria-hidden="true"></i></h3></a>
                    </div>
                    <div class="panel-body" id="items">
                       <ul class="list-group">
                       @foreach ($items as $item)
                        <li class="list-group-item ourItem" data-toggle="modal" data-target="#myModal">{{$item->item}}
                           <input type="hidden" id="itemId" value="{{$item->id}}">
                        </li>
                       @endforeach
                       </ul>
                      </div>
                </div>
            </div>
    
            <div class="col-lg-2">
                <input type="text" class="form-control" name="item" id="searchItem" placeholder="Search">
            </div>

            <div class="modal fade" id="myModal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Add New Item</h4>
                    </div>
                    <div class="modal-body">
                    <input type="hidden" id="id">
                        <p><input type="text" placeholder="Write Item Here" id="addItem" class="form-control"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" id="delete" data-dismiss="modal" style="display: none">Delete</button>
                        <button type="button" class="btn btn-primary" id="saveChanges" data-dismiss="modal style="display: none">Save changes</button>
                        <button type="button" class="btn btn-primary" id="AddButton" data-dismiss="modal">Add Item</button>
                    </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
    {{csrf_field()}}
            <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> 
            <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.js"></script>
            <script>
                $(document).ready(function() {
                    $(document).on('click', '.ourItem', function(event) {
                            var text = $(this).text();
                            var id = $(this).find('#itemId').val();
                            $('#title').text('Edit Item');
                            var text = $.trim(text);
                            $('#addItem').val(text);
                            $('#delete').show('400');
                            $('#saveChanges').show('400');
                            $('#AddButton').hide('400');
                            $('#id').val(id);
                            console.log(text);
                    });

                    $(document).on('click', '#addNew', function(event) {
                        $('#title').text('Add New Item');
                        $('#addItem').val("");
                        $('#delete').hide('400');
                        $('#saveChanges').hide('400');
                        $('#AddButton').show('400');
                    });

                    $('#AddButton').click(function(event) {
                        var text = $('#addItem').val();
                        if (text =="") {
                            alert('Please type anything for item');
                            }else{
                                $.post('list', {'text': text, '_token':$('input[name=_token]').val()}, function(data) {                            
                                    console.log(data);
                                    $('#items').load(location.href + ' #items');
                                });
                            }
                        });

                    $('#delete').click(function(event) {
                        var id = $("#id").val();
                        $.post('delete', {'id': id,'_token':$('input[name=_token]').val()}, function(data) {
                            $('#items').load(location.href + ' #items');  
                            console.log(data);
                        });
                    }); 

                    $('#saveChanges').click(function(event) {
                        var id = $("#id").val();
                        var value = $.trim($("#addItem").val());
                        $.post('update', {'id': id,'value': value,'_token':$('input[name=_token]').val()}, function(data) {
                            $('#items').load(location.href + ' #items');  
                            console.log(data);
                        });
                    }); 

                    $( function() {
                        var availableTags = [
                        "ActionScript",
                        "AppleScript",
                        "Asp",
                        "BASIC",
                        "C",
                        "C++",
                        "Clojure",
                        "COBOL",
                        "ColdFusion",
                        "Erlang",
                        "Fortran",
                        "Groovy",
                        "Haskell",
                        "Java",
                        "JavaScript",
                        "Lisp",
                        "Perl",
                        "PHP",
                        "Python",
                        "Ruby",
                        "Scala",
                        "Scheme"
                        ];
                        $( "#searchItem" ).autocomplete({
                        source: 'http://localhost:8000/search'
                        });
                    });
                }); 
        </script>
</body>
</html>