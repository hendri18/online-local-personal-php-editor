<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Text Editor</title>
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="node_modules/codemirror/lib/codemirror.css">
    <link rel="stylesheet" href="node_modules/codemirror/theme/monokai.css">
    <style>
        #run{
            border-radius: 0;
            width: 100%;
            padding: 10px;
        }
        #result{
            margin-top: 20px;
        }

        footer{
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            padding: 10px;
        }
    </style>
</head>
<body>
    <div id="code"></div>
    <button id="run" class="btn btn-success">Run</button>
    <div class="container-fluid">
        <div id="result"></div>
    </div>
    <footer>© Hendri Heryanto <?php echo date('Y') ?></footer>
<script src="node_modules/jquery/dist/jquery.min.js"></script>
<script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="node_modules/codemirror/lib/codemirror.js"></script>
<script src="node_modules/codemirror/addon/edit/matchbrackets.js"></script>
<script src="node_modules/codemirror/addon/edit/closebrackets.js"></script>
<script src="node_modules/codemirror/addon/edit/closetag.js"></script>
<script src="node_modules/codemirror/mode/htmlmixed/htmlmixed.js"></script>
<script src="node_modules/codemirror/mode/xml/xml.js"></script>
<script src="node_modules/codemirror/mode/javascript/javascript.js"></script>
<script src="node_modules/codemirror/mode/css/css.js"></script>
<script src="node_modules/codemirror/mode/clike/clike.js"></script>
<script src="node_modules/codemirror/mode/php/php.js"></script>
<script>
    var myCodeMirror = CodeMirror(document.getElementById('code'), {
        lineNumbers: true,
        matchBrackets: true,
        mode: "application/x-httpd-php",
        indentUnit: 4,
        indentWithTabs: true,
        theme: "monokai",
        autoCloseBrackets: true
    });
    myCodeMirror.setValue('<?php echo "<?php" ?> \n');
    $(document).ready(function(){
        $('#run').on("click", function(e){
            e.preventDefault();

            $.ajax({
                url: 'process.php',
                type: 'POST',
                data:{
                    input: myCodeMirror.getValue()
                },
                complete: function(){
                    $.ajax({
                        url: 'result.php',
                        type: 'GET',
                        success: function (response) {
                            $("#result").html(response);
                        },
                        error: function () {
                            console.log("error: " + response);
                        }
                    });
                }
            })
        })
    });
</script>
</body>
</html>