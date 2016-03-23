<!doctype html>
<html lang="FR">
  <head>
    <meta charset="utf-8">
    <title>autocomplete</title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script>
      $(function() {
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
        $( "#searchTown" ).autocomplete({
          source: availableTags
        });
      });
    </script>
  </head>

  <body>
    <div class="ui-widget">
      <label for="searchTown">Tags: </label>
      <input id="searchTown">
    </div>
  </body>
</html>

