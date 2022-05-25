<!DOCTYPE html>
<html>
<head>
    <title>Notes</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>
<body>

<div class="container-notes">
    
</div><!--container-notes-->

<div class="btn-add"><b>+</b></div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(function(){
        $('.btn-add').click(function(){
            var el = '<div class="single-notes"><textarea placeholder="Your new note..."></textarea></div>';
            $('.container-notes').append(el);

            var textArea = $('.single-notes').last().find('textarea');

            var date = new Date();
            var hh = date.getHours();
            var mm = date.getMinutes();

            var finalTime = hh+":"+mm;
            textArea.html("New notes in: "+finalTime+" - ");
        })
    })
</script>
</body>
</html>